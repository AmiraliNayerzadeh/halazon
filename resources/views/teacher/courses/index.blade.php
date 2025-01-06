@component('.teacher.layout.master')
    @section('content')

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست دوره ها</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('teachers.courses.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد دوره جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @if(count($courses))

                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>نوع</th>
                                <th>وضعیت</th>
                                <th>زمان ایجاد</th>
                                <th>ویرایش</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>

                            <tbody>

                                @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            @if(!is_null($course->image))
                                                <img src="{{$course->image}}" class="avatar avatar-md me-3"
                                                     alt="{{$course->name}}">
                                            @else
                                                <img src="/assets/user-avatar.png" class="avatar avatar-md me-3"
                                                     alt="{{$course->name}}">
                                            @endif
                                        </td>

                                        <td>{{$course->title}}</td>

                                        <td>{{$course->type == "offline" ?  "آفلاین" : "آنلاین"}}</td>

                                        <td>
                                            @if($course->is_draft == 1)
                                                <bdi class="bdi rounded bg-warning">پیش نویس</bdi>
                                            @else
                                                <bdi class="bdi rounded bg-success">منتشر شده</bdi>
                                            @endif
                                        </td>


                                        <td>{{jdate($course->created_at)->toDateString()}}</td>

                                        <td><a class="btn btn-warning" href="{{route('teachers.courses.edit' , $course)}}">ویرایش</a>
                                        </td>

                                        <td>
                                            @if($course->status == 1)
                                                <a class="btn btn-primary" href="">مشاهده</a>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                        @else
                            <div class="text-center">
                                هنوز دوره ای توسط شما ایجاد نشده است.

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcomponent