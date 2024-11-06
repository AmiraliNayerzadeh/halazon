@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ویرایش دیدگاه </h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{route('admin.comments.index')}}">دیدگا هاه</a>
                        </li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">ویرایش</li>
                    </ol>
                </div>
                <div class="card-body px-0 pt-0 pb-2 ">
                    <form action="{{route('admin.comments.update', $comment)}}" method="post" enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="col-lg-9 ">
                                <div class="card border position-sticky fixed-top">
                                    <div class="card-header bg-light">
                                        <h5 class="text-primary">جزئیات دیدگاه</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="form-group col-lg-4">
                                                <label for="user">نظر دهنده:</label>
                                                <select class="select2 form-control" name="user_id" id="user">
                                                    @foreach(\App\Models\User::all() as $user)
                                                        <option {{$comment->user_id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}} {{$user->family}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-lg-4">
                                                <label for="user">تاریخ:</label>
                                                <input disabled data-jdp type="text" class="form-control" id="created_at" name="created_at" value="{{!is_null($comment->created_at) ? str_replace('-', '/', jdate($comment->created_at)) : old('created_at')}}">
                                            </div>



                                            <div class="form-group col-lg-4">
                                                <label for="status">وضعیت:</label>
                                                <select class="select2 form-control" name="publish" id="user">
                                                    <option value="0" {{$comment->status == 0 ? 'selected' : ''}} >منتشر نشده</option>
                                                    <option value="1" {{$comment->status == 1 ? 'selected' : ''}} >منتشر شده</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-lg-6">
                                                <div class="my-2">
                                                    <ul>
                                                        <li>
                                                            نظر ایجاد شده برای:
                                                            @if($comment->commentable_type == 'App\Models\Blog')
                                                                وبلاگ
                                                            @elseif($comment->commentable_type == 'App\Models\User')
                                                                معلم
                                                            @elseif($comment->commentable_type == 'App\Models\Course')
                                                                کلاس
                                                            @elseif($comment->commentable_type == 'App\Models\Headline')
                                                                محتوای دوره
                                                            @else
                                                                {{$comment->commentable_type}}
                                                            @endif
                                                        </li>

                                                        <li>
                                                            @if($comment->commentable_type == 'App\Models\Blog')
                                                                <a href="{{route('blog.show' ,[ $comment->commentable->categories[0]->slug , $comment->commentable->slug])}}">{{$comment->commentable->title}}</a>
                                                            @elseif($comment->commentable_type == 'App\Models\User')
                                                                <a href="{{route('teacher.show' , $comment->commentable)}}">{{$comment->commentable->name}} {{$comment->commentable->family}}</a>
                                                            @elseif($comment->commentable_type == 'App\Models\Course')
                                                                <a href="{{route('course.show' , $comment->commentable)}}">{{$comment->commentable->title}}</a>
                                                            @elseif($comment->commentable_type == 'App\Models\Headline')
                                                                <a href="{{route('headline.show' ,[$comment->commentable->course,$comment->commentable])}}">{{$comment->commentable->title}}</a>
                                                            @else
                                                                {{$comment->commentable_type}}
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="description">توضیحات</label>
                                            <textarea name="comment" class="form-control" cols="30"
                                                      rows="4">{{old('comment') ? old('comment') : $comment->comment }}</textarea>
                                        </div>


                                    </div>
                                </div>

                                @if(count($comment->childs))
                                    @foreach($comment->childs as $child)
                                    <div class="card bg-white my-5 border">
                                        <div class="card-header bg-secondary"> پاسخ ثبت شده توسط: {{$child->user->name}} {{$child->user->family}}</div>

                                        <div class="card-body">
                                            متن نظر:
                                            {{$child->comment}}
                                        </div>
                                    </div>
                                    @endforeach
                                @endif

                            </div>


                            <div class="col-lg-3">


                                <div class="card mt-4 position-sticky fixed-top">
                                    <div class="card-header bg-success">
                                        <h5>
                                            <li class="mx-2 fa fa-save mx-2"></li>
                                            انتشار
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div>دیدگاه ها بعد از تایید در سایت نمایش داده خواهند شد.</div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-success w-100" name="status" type="submit">بروز
                                                    رسانی
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card mt-4 position-sticky fixed-top">
                                    <div class="card-header bg-secondary">
                                        <h5>
                                            <li class="mx-2 fa fa-save mx-2"></li>
                                            ایجاد پاسخ
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="my-2">اگر دیدگاه کاربر سوالی باشد یا نیاز به پاسخ به دیدگاه باشد
                                            میتوانید به ثبت پاسخ اقدام فرمایید.
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn bg-gradient-secondary w-100"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <li class="fa fa-plus mx-1"></li>
                                                    پاسخ به دیدگاه
                                                </button>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between">
                                    <div>
                                        <h5 class="modal-title" id="exampleModalLabel">ثبت پاسخ</h5>
                                    </div>
                                    <div>
                                        <button type="button" class="btn-close text-dark"
                                                data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <form action="{{route('admin.comments.store', $comment)}}" method="post">
                                    @method('POST')
                                    @csrf
                                    <input type="hidden" name="commentable_id" value="{{$comment->commentable->id}}">
                                    <input type="hidden" name="commentable_type" value="{{$comment->commentable_type}}">
                                    <input type="hidden" name="parent" value="{{$comment->id}}">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label for="user">نظر دهنده:</label>
                                                <select class="select2 form-control" name="user_id" id="user">
                                                    @foreach(\App\Models\User::all() as $user)
                                                        <option {{auth()->user()->id == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}} {{$user->family}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label for="comments">نظر:</label>
                                                <textarea class="form-control" name="comment" id="comments" cols="30" rows="4"></textarea>
                                            </div>


                                        </div>

                                    </div>
                                    <div class="card-footer border d-flex justify-content-end">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>




        @section('script')

            <script>
                jalaliDatepicker.startWatch({
                    'time': true
                });
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