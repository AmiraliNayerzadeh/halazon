@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست نظر ها</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>نظر دهنده</th>
                                <th>وضعیت</th>
                                <th>نوع</th>
                                <th>ایجاد شده در</th>
                                <th>زمان ایجاد</th>
                                <th>دارای پاسخ؟</th>

                                <th>ویرایش</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        @if(!is_null($comment->user->avatar))
                                            <img src="{{$comment->user->avatar}}" class="avatar avatar-md me-3"
                                                 alt="{{$comment->user->name}}">
                                        @else
                                            <img src="/assets/user-avatar.png" class="avatar avatar-md me-3"
                                                 alt="{{$comment->user->name}}">
                                        @endif
                                    </td>

                                    <td>{{$comment->user->name}} {{$comment->user->family}}</td>


                                    <td>
                                        @if($comment->status == 1)
                                            <span class="bdi rounded  bg-gradient-success">منتشر شده</span>
                                        @else
                                            <span class="bdi rounded  bg-gradient-warning">تایید نشده</span>
                                        @endif
                                    </td>



                                    <td>
                                        @if($comment->commentable_type == 'App\Models\Blog')
                                            نظر
                                        @elseif($comment->commentable_type == 'App\Models\User')
                                            معلم
                                        @elseif($comment->commentable_type == 'App\Models\Course')
                                            کلاس
                                        @else
                                            {{$comment->commentable_type}}
                                        @endif
                                    </td>

                                    <td>


                                        @if($comment->commentable_type == 'App\Models\Blog')
                                            <a href="{{route('blog.show' ,[ $comment->commentable->categories[0]->slug , $comment->commentable->slug])}}">{{$comment->commentable->title}}</a>
                                        @elseif($comment->commentable_type == 'App\Models\User')
                                            <a href="{{route('teacher.show' , $comment->commentable)}}">{{$comment->commentable->name}} {{$comment->commentable->family}}</a>
                                        @elseif($comment->commentable_type == 'App\Models\Course')
                                            <a href="{{route('course.show' , $comment->commentable)}}">{{$comment->commentable->title}}</a>
                                        @else
                                            {{$comment->commentable_type}}
                                        @endif

                                    </td>

                                    <td>{{count($comment->childs) ? 'بله' : 'بدون پاسخ'}}</td>



                                    <td>{{jdate($comment->created_at)}}</td>
                                    
                                    <td><a class="btn btn-warning" href="{{route('admin.comments.edit' , $comment)}}">ویرایش</a></td>



                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcomponent