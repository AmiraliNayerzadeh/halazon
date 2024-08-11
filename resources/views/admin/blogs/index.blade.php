@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست مقاله ها</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.blogs.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد مقاله جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>وضعیت</th>
                                <th>نویسنده</th>
                                <th>دسته بندی</th>
                                <th>زمان ایجاد</th>
                                <th>ویرایش</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>
                                        @if(!is_null($blog->image))
                                            <img src="{{$blog->image}}" class="avatar avatar-md me-3"
                                                 alt="{{$blog->name}}">
                                        @else
                                            <img src="/assets/user-avatar.png" class="avatar avatar-md me-3"
                                                 alt="{{$blog->name}}">
                                        @endif
                                    </td>

                                    <td>{{$blog->title}}</td>

                                    <td>
                                        @if($blog->status == 1)
                                            <span class="bdi rounded  bg-gradient-success">منتشر شده</span>
                                        @else
                                            <span class="bdi rounded  bg-gradient-warning">پیش نویس</span>
                                        @endif
                                    </td>

                                    <td><a href="{{route('teacher.show', $blog->user)}}">{{$blog->user->name}} {{$blog->user->family}}</a></td>

                                    <td>
                                        @if(count($blog->categories))
                                            @foreach($blog->categories as $category)
                                                {{$category->title}},
                                            @endforeach
                                        @else
                                            ثبت نشده
                                        @endif
                                    </td>

                                    <td>{{jdate($blog->created_at)->toDateString()}}</td>
                                    
                                    <td><a class="btn btn-warning" href="{{route('admin.blogs.edit' , $blog)}}">ویرایش</a></td>

                                    <td>
                                        @if($blog->status == 1)
                                            <a class="btn btn-primary" href="">مشاهده</a>
                                        @endif
                                    </td>


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