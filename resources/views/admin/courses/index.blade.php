@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست دوره ها</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.courses.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد دوره جدید
                    </a>
                </div>
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-lg-3">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="card">
                                    <div class="card-header">
                                        <img class="img-fluid rounded" src="{{$course->image}}" alt="{{$course->title}}">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="text-primary">{{$course->title}}</h5>
                                        <div class="d-flex align-items-center mt-3">
                                            <img src="{{$course->teacher->avatar}}" alt="{{$course->teacher->name}}" class="avatar avatar-sm ms-2">
                                            <a href="{{route('admin.users.show' , $course->teacher)}}">{{$course->teacher->name}} {{$course->teacher->family}}</a>
                                        </div>

                                        <div class="my-3">
                                            <li class="fa fa-network-wired"></li>
                                            @foreach($course->categories as $category)
                                                {{$category->title}} /
                                            @endforeach
                                        </div>

                                        <div class="my-2">
                                            <b>وضعیت:</b>
                                            <span class="{{$course->status == 'منتشر شده' ? 'text-success' :'text-secondary'}}  " >
                                                {{$course->status}}
                                            </span>
                                            @if($course->is_draft == 1)
                                            <bdi class="badge bg-warning">پیش نویس</bdi>
                                            @endif
                                        </div>

                                        <div class="my-2">
                                            <b>تاریخ آخرین ویرایش:</b>
                                            {{jdate($course->updated_at)}}
                                        </div>


                                    </div>
                                    <div class="card-footer d-flex justify-content-end">
                                        <a class="btn btn-warning" href="{{route('admin.courses.edit' , $course)}}">
                                            <li class="fa fa-pencil-square-o"></li>
                                            ویرایش
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
@endcomponent