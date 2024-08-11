@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ویرایش مقاله جدید</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{route('admin.blogs.index')}}">مقاله</a>
                        </li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">ویرایش</li>
                    </ol>
                </div>
                <div class="card-body px-0 pt-0 pb-2 ">
                    <form action="{{route('admin.blogs.update', $blog)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="col-lg-9 ">
                                <div class="card border position-sticky fixed-top">
                                    <div class="card-header bg-light">
                                        <h5 class="text-primary">جزئیات مقاله</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="title">عنوان نوشته</label>
                                                <input class="form-control" type="text" name="title" id="title"
                                                       value="{{old('title') ? old('title') : $blog->title }}">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="title">نویسنده</label>
                                                <select class="form-control select2" name="user_id" id="user_id">
                                                    <option></option>
                                                    @foreach(\App\Models\User::where('is_teacher' , 1)->get() as $teacher)
                                                        <option {{ $blog->user_id == $teacher->id ? 'selected' : '' }} value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->family}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="description">توضیحات</label>
                                            <textarea name="description" id="editor" cols="30"
                                                      rows="10">{{old('description') ? old('description') : $blog->description }}</textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3">

                                <div class="card my-2 border">
                                    <div class="card-header bg-light text-primary">
                                        <h5 class="text-primary">تصویر مقاله</h5>
                                    </div>
                                    <div class="card-body">

                                        @if(!is_null($blog->image))
                                        <img class="img-fluid rounded" src="{{$blog->image}}" alt="">
                                        @else
                                            <img src="/assets/user-avatar.png" class="img-fluid rounded"
                                        @endif
                                        
                                        <div class="my-2">
                                            <label class="form-label" for="password">تصویر:</label>

                                            <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                                <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image') ? old('image') : $blog->image }}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                </div>



                                <div class="card my-2 border">
                                    <div class="card-header bg-light text-primary">
                                        <h5 class="text-primary">ویدیو مقاله (اختیاری)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="my-2">
                                            <label class="form-label" for="password">ویدیو:</label>

                                            <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm-video" data-input="video" data-preview="holder"
                                                class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                                <input id="video" class="form-control" type="text" name="video" value="{{old('video') ? old('video') : $blog->video }}">
                                            </div>
                                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card mb-3 ">
                                    <div class="card-header bg-light">
                                        <h5 class="text-primary fw-bold">
                                            <li class="mx-2 fa fa-network-wired mx-2"></li>
                                            دسته بندی
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="my-3"
                                             style="height: 14rem ; overflow-x: hidden; overflow-y: scroll">
                                            @foreach(\App\Models\Category::where('parent_id' , null)->get() as $parent)
                                                <div class="form-check ">
                                                    <input name="category[]" value="{{$parent->id}}"
                                                           class="form-check-input"
                                                           type="checkbox" id="{{$parent->id}}"
                                                            {{in_array($parent->id , $blog->categories->pluck('id')->toArray()) ? 'checked ' : ''}}
                                                    >
                                                    <label class="form-check-label fw-bold" for="{{$parent->id}}">{{$parent->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                {{--SEO--}}
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h5 class="text-primary">سئو</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label class="form-label" for="meta_keyword">اسلاگ:</label>
                                            <input class="form-control" type="text" name="slug"
                                                   id="slug" placeholder="Separate by , "
                                                   value="{{old('slug') ? old('slug') : $blog->slug }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="meta_keyword">کلمه کلیدی:</label>
                                            <input class="form-control" type="text" name="meta_keyword"
                                                   id="meta_keyword" placeholder="Separate by , "
                                                   value="{{old('meta_keyword') ? old('meta_keyword') : $blog->meta_keyword }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="meta_title">متا تایتل:</label>
                                            <input class="form-control" type="text" name="meta_title" id="meta_title"
                                                   value="{{old('meta_title') ? old('meta_title') : $blog->meta_title }}">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="meta_description">متا دسکریپشن:</label>
                                            <input class="form-control" type="text" name="meta_description"
                                                   id="meta_description" value="{{old('meta_description') ? old('meta_description') : $blog->meta_description }}">
                                        </div>
                                    </div>
                                </div>
                                {{--End SEO--}}

                                <div class="card mt-4 position-sticky fixed-top">
                                    <div class="card-header bg-success">
                                        <h5>
                                            <li class="mx-2 fa fa-save mx-2"></li>
                                            انتشار
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button class="btn btn-warning w-100" name="status" value="0"
                                                        type="submit">ذخیره پیش نویس
                                                </button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button class="btn btn-success w-100" name="status" value="1"
                                                        type="submit">انتشار مقاله
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        @section('script')

            <script>
                jalaliDatepicker.startWatch();
            </script>

            <script>
                $('#lfm').filemanager('image');
                $('#lfm-video').filemanager('image');
            </script>
            <script>
                $(document).ready(function () {

                    $('.select2').select2({
                        theme: 'bootstrap-5',
                        placeholder: "انتخاب کنید...",
                    });
                });
            </script>
        @endsection

    @endsection
@endcomponent