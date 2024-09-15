@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ایجاد مقطع جدید</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{route('admin.degrees.index')}}">مقطع ها</a></li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">ایجاد</li>
                    </ol>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{route('admin.degrees.store')}}" method="post" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-9">

                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h5 class="text-primary fw-bold">
                                                <li class="fa fa-info mx-2"></li>
                                                جزئیات کلی
                                            </h5>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">

                                                <div class="col-lg-6 my-2">
                                                    <label class="form-label" for="title">عنوان:</label>
                                                    <input class="form-control" type="text" name="title" id="title"
                                                           value="{{old('title')}}" placeholder="عنوان را وارد کنید.">
                                                </div>




                                                <div class="col-lg-6 my-2">
                                                    <label class="form-label" for="title">تصویر شاخص:</label>
                                                    <div class="input-group">
                                                       <span class="input-group-btn">
                                                         <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                            class="btn btn-primary">
                                                           <i class="fa fa-picture-o"></i>
                                                             انتخاب
                                                         </a>
                                                       </span>
                                                        <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image')}}">
                                                    </div>
                                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label class="form-label" for="description">توضیحات:</label>
                                                    <textarea class="form-control my-editor" name="description" id="" cols="30" rows="10">{!! old('description') !!}</textarea>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-3">
                                    <div class="card ">
                                        <div class="card-header bg-light">
                                            <h5 class="text-primary fw-bold">
                                                <li class="fa fa-search mx-2"></li>
                                                موتور های جستجو
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="my-3">
                                                <label class="form-label" for="slug">اسلاگ (نامک):</label>
                                                <input class="form-control" type="text" name="slug" id="slug"
                                                       value="{{old('slug')}}"
                                                       placeholder="آدرس  صفحه ی مقطع را وارد کنید...">
                                            </div>


                                            <div class="my-3">
                                                <label class="form-label" for="meta_title">مِتا تایل:</label>
                                                <input class="form-control" type="text" name="meta_title"
                                                       id="meta_title"
                                                       value="{{old('meta_title')}}"
                                                       placeholder="متا تایتل صفحه ی مقطع را وارد کنید...">
                                            </div>

                                            <div class="my-3">
                                                <label class="form-label" for="meta_keywords">کلمات کلیدی:</label>
                                                <input class="form-control" type="text" name="meta_keywords"
                                                       id="meta_keywords"
                                                       value="{{old('meta_keywords')}}"
                                                       placeholder="با استفاده از , جدا کنید.">
                                            </div>

                                            <div class="my-3">
                                                <label class="form-label" for="meta_description">مِتا دیسکرپشن:</label>
                                                <textarea class="form-control" name="meta_description"
                                                          id="meta_description"
                                                          cols="30"
                                                          rows="3">{{old('meta_description')}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h5>
                                                <li class="fa fa-save mx-2"></li>
                                                انتشار
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="my-4">بعد از انتشار امکان ویرایش و حذف وجود دارد.</p>
                                            <button class="btn btn-success w-100" type="submit">انتشار مقطع
                                            </button>
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
            </script>

        @endsection

    @endsection
@endcomponent
