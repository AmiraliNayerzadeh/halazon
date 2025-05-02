@component('.admin.layout.master')
    @section('content')

        <div class="col-12">

            <form action="{{route('admin.courses.index')}}">

                <div class="card my-3">
                    <div class="card-header text-primary">
                        <i class="fa fa-search"></i>
                        جستجو
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">عنوان دوره:</label>
                                    <input class="form-control" type="text" name="title" id="title"
                                           value="{{request('title')}}"
                                           placeholder="جستجو بر اساس عنوان">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="teacher">مدرس:</label>
                                    <select class="form-control select2" name="teacher" id="teacher">
                                        <option {{ request('teacher') == null ? 'selected' : '' }} value="">همه</option>
                                        @foreach(\App\Models\User::where('is_teacher' , 1)->where('is_verify' , 1)->get() as $teacher)
                                        <option {{ request('teacher') == $teacher->id ? 'selected' : '' }} value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="type">نوع:</label>
                                    <select class="form-control" name="type" id="type">
                                        <option {{ request('type') == null ? 'selected' : '' }} value="">همه</option>
                                        <option {{ request('type') == "online" ? 'selected' : '' }} value="online">آنلاین</option>
                                        <option {{ request('type') == "offline" ? 'selected' : '' }} value="offline">آفلاین</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-filter"></i>فیلتر</button>
                        </div>
                    </div>
                </div>

            </form>



            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست دوره ها</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.courses.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد دوره جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>نوع</th>
                                <th>سهم معلّم</th>
                                <th>وضعیت</th>
                                <th>معلم</th>
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

                                    <td>{{$course->revenue}}%</td>

                                    <td>
                                        @if($course->is_draft == 1)
                                            <bdi class="bdi rounded bg-warning">پیش نویس</bdi>
                                        @else
                                            <bdi class="bdi rounded bg-success">منتشر شده</bdi>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{route('teacher.show', $course->teacher)}}">{{$course->teacher->name}} {{$course->teacher->family}}</a>
                                    </td>



                                    <td>{{jdate($course->created_at)->toDateString()}}</td>

                                    <td><a class="btn btn-warning" href="{{route('admin.courses.edit' , $course)}}">ویرایش</a>
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
                    </div>
                </div>
            </div>
            {{$courses->links('pagination::bootstrap-5')}}

        </div>

        @section('script')
            <script>
                $(document).ready(function () {
                    $('.select2').select2({
                        theme: 'bootstrap-5'
                    });
                });
            </script>
        @endsection

    @endsection
@endcomponent
