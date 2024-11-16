@component('.teacher.layout.master')
    @section('content')
        <div class="row">
            <div class="col-xl-5 ms-auto mt-xl-0 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-gradient-primary">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8 my-auto">
                                        <div class="numbers">
                                            <h5 class="text-white font-weight-bolder mb-0">
                                                خوش آمدی
                                                {{auth()->user()->name}}
                                                عزیز؛
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <h5 class="mb-0 text-white text-end me-1">
                                            {{jdate()->toDateString()}}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="text-gradient text-primary"><span id="status1"
                                                                             countto="{{jdate(auth()->user()->created_at)->ago()}}"></span>{{jdate(auth()->user()->created_at)->ago()}}
                                </h3>
                                <h6 class="mb-0 font-weight-bolder">زمان عضویت</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="text-gradient text-primary"><span id="status2"
                                                                             countto="{{$countCourse}}">{{$countCourse}}</span>
                                </h3>
                                <h6 class="mb-0 font-weight-bolder">تعداد دوره های من</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="text-gradient text-primary"><span id="status3" countto="0">0</span></h3>
                                <h6 class="mb-0 font-weight-bolder">تعداد فروش دوره</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="text-gradient text-primary"><span id="status4" countto="0">0</span></h3>
                                <h6 class="mb-0 font-weight-bolder">درآمد</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7">
                <h4 id="examples">آخرین دوره های من:</h4>

                <div class="card">
                    @if(count(auth()->user()->courses))
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7">عنوان دوره
                                    </th>
                                    <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">وضعیت
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        تعداد
                                        شرکت کننده
                                    </th>
                                    <th class="text-center text-uppercase text-secondary font-weight-bolder opacity-7">
                                        زمان ایجاد
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{$course->image}}"
                                                         class="avatar avatar-md mx-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-1 text-xs">{{$course->title}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$course->type == 'online' ? 'آنلاین' : 'آفلاین'}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$course->status}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            {{count($course->userCourses)}} نفر
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{jdate($course->created_at)->ago()}}</span>
                                        </td>
                                        @if($course->status == "منتشر شده")
                                            <td class="align-middle">
                                                <a target="_blank" href="{{route('course.show' , $course)}}"
                                                   class="text-secondary font-weight-bold text-xs">
                                                    مشاهده
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            <p>هنوز هیج دوره ای ایجاد نکرده اید</p>
                            <a class="text-warning" href="{{route('teachers.courses.create')}}">
                                <i class="fa fa-plus"></i>

                                اولین دوره خود را ایجاد کنید.</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @endsection
@endcomponent