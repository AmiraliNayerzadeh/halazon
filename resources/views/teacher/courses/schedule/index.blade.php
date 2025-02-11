@component('.teacher.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ویرایش دوره {{$course->title}}</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5"
                                                               href="{{route('teachers.courses.index')}}">دوره ها</a></li>
                        <li class="breadcrumb-item text-sm " aria-current="page">ویرایش</li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">{{$course->title}}</li>
                        <li class="breadcrumb-item text-sm " aria-current="page">زمان بندی</li>

                    </ol>
                </div>

                <div class="card-body">
                    @include('.teacher.courses.stepper')
                </div>

            </div>
        </div>

        <div class="row">




            <div class="col-lg-9">

                <div class="alert alert-info text-white" role="alert">
                    <h4 class="alert-heading">راهنمای تنظیم زمان‌بندی برای کلاس‌ها</h4>
                    <p>شما می‌توانید برای هر کلاس آنلاین خود، <strong>چندین زمان‌بندی متفاوت</strong> ایجاد کنید تا دانش‌آموزان بتوانند بر اساس برنامه خود یکی از آنها را انتخاب کنند.</p>
                    <hr>
                    <p class="mb-0"><strong>مثال:</strong></p>
                    <ul>
                        <li><strong>زمان‌بندی اول:</strong> روزهای زوج (شنبه، دوشنبه و چهارشنبه) از ساعت 18:00</li>
                        <li><strong>زمان‌بندی دوم:</strong> روزهای فرد (یکشنبه و سه‌شنبه) از ساعت 16:00</li>
                    </ul>
                    <p class="mb-0">برای جلوگیری از هرگونه تداخل، لطفاً زمان‌بندی‌های خود را با دقت تنظیم کنید.</p>
                </div>


                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6> زمان بندی ها</h6>
                        <!-- Button trigger modal -->

                        @if(count($course->parts) > 0)

                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                    data-bs-target="#newSch">
                                ایجاد زمان جدید
                            </button>

                            @include('teacher.courses.schedule.partCreate')
                        @endif
                    </div>

                    <div class="card-body">
                        @if(count($course->parts) > 0)
                            <div class="row">
                                @foreach($course->parts as $parts)

                                    @php
                                        $uniqueDays = $parts->schedules->pluck('day_id')->unique();
                                        $days = \App\Models\Day::whereIn('id', $uniqueDays)->pluck('day_farsi', 'id');
                                        $parts->uniqueDays = $days;
                                    @endphp



                                    <div class="col-lg-6">
                                        <div class="card border">
                                            <div class="card-header border d-flex justify-content-between align-items-center">
                                                <div><h6 class="text-primary">{{$parts->title}}</h6></div>
                                                <div class="badge {{$parts->status == 0 ? 'bg-danger' : 'bg-success' }} ">
                                                    {{$parts->status == 0 ? 'تایید نشده' : 'تایید شده' }}
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="my-2">
                                                    <b>روز های برگزاری:</b>
                                                    <span>
                                                    {{ implode(', ', $parts->uniqueDays->values()->toArray()) }}
                                                    </span>
                                                </div>
                                                <div class="mt-2">
                                                    <b>تاریخ شروع:</b>
                                                    {{jdate()->forge($parts->schedules->first()->start_date)->toDateString()}}
                                                    <b>ساعت:</b>
                                                    {{$parts->schedules->first()->start_time}}

                                                </div>

                                                <div class="mt-2">
                                                    <b>تاریخ پایان:</b>
                                                    {{jdate()->forge($parts->schedules->last()->start_date)->toDateString()}}
                                                    <b>ساعت:</b>
                                                    {{$parts->schedules->last()->start_time}}
                                                </div>

                                            </div>
                                            <div class="card-footer border">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#watchSchedule{{$parts->id}}">
                                                    مشاهده کامل زمان بندی
                                                </button>


                                                <!-- Modal -->
                                                    <div class="modal fade" id="watchSchedule{{$parts->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex justify-content-between">
                                                                <div>
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        مشاهده کامل جزئیات {{$parts->title}}</h5>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body overflow-auto">
                                                                <div class="table-responsive p-0 ">
                                                                    <table class="table mb-0">

                                                                        <thead>
                                                                        <tr>
                                                                            <th>شناسه</th>
                                                                            <th>روز</th>
                                                                            <th>تاریخ</th>
                                                                            <th>ساعت</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        @foreach($parts->schedules as $schedules )

                                                                            <tr>

                                                                                <td>{{$schedules->id}}</td>
                                                                                <td>{{$schedules->day->day_farsi}}</td>
                                                                                <td>
                                                                                    {{jdate()->forge($schedules->start_date)->toDateString()}}
                                                                                </td>

                                                                                <td>{{$schedules->start_time}}</td>

                                                                            </tr>
                                                                        @endforeach

                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card border">
                                <div class="card-header">
                                    <li class="fa fa-file-archive"></li>
                                    ایجاد زمان بندی جدید
                                </div>
                                <form action="{{route('teachers.schedules.store', $course)}}" method="post">
                                    @method('POST')
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">عنوان زمان بندی:</label>
                                                    <input class="form-control" type="title" name="title" id="title"
                                                           value="{{old('title')}}" placeholder="زمان بندی 1">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">تاریخ شروع:</label>
                                                    <input data-jdp type="text" class="form-control" id="start_course"
                                                           name="start_course" value="{{old('start_course')}}"
                                                           autocomplete="off">

                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">زمان شروع:</label>
                                                    <input type="time" class="form-control" id="time_course"
                                                           name="time_course" value="{{old('time_course')}}"
                                                           autocomplete="off">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="day">روز های برگذاری:</label>
                                                @foreach(\App\Models\Day::all() as $day)
                                                    <div class="btn-group" role="group"
                                                         aria-label="Basic checkbox toggle button group">
                                                        <input type="checkbox" class="btn-check" id="{{$day['id']}}"
                                                               autocomplete="off" name="days[]"
                                                               value="{{$day['id']}}" {{ in_array($day->id, old('days', [])) ? 'checked' : '' }} >
                                                        <label class="btn btn-outline-primary"
                                                               for="{{$day['id']}}">{{$day['day_farsi']}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer border d-flex justify-content-end">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
                                </form>

                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-3">

                <div class="card mb-3">
                    <div class="card-header bg-light text-primary"><i class="fa fa-image mx-2"></i>تصویر پروفایل کلاس</div>
                    <img class="img-fluid rounded p-3" src="{{$course->image}}" alt="{{$course->title}}">
                </div>


                <div class="card mb-3">
                    <div class="card-header bg-light text-primary"><i class="fa fa-file-video mx-2"></i>ویدیو معرفی کلاس</div>
                    <video class="p-3 rounded" width="100%" controls>
                        <source src="{{ $course->video }}"
                                type="video/mp4">
                        مرورگر شما از تگ ویدیو
                        پشتیبانی
                        نمی‌کند.
                    </video>
                </div>

                @include('teacher.courses.publishBox')


            </div>
        </div>
        @section('script')

            <script>
                jalaliDatepicker.startWatch();
            </script>

            <script>
                $('#lfm').filemanager('image');
            </script>

            <script>
                $.fn.select2.defaults.set("theme", "bootstrap");

                $(document).ready(function () {
                    $('.select2').select2({

                        theme: 'bootstrap-5'

                    });
                });
            </script>

        @endsection

        <div class="modal fade " id="exampleModal" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            درخواست انتشار  {{$course->title}}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    @if(count($course->headlines) == 0 || $course->type== 'online' && count($course->schedules) == 0)
                        <ul class="p-5">

                            @if(count($course->headlines) == 0 || $course->type== 'online' && count($course->schedules) == 0)
                                <b>ابتدا موارد مشخص شده را کامل کنید.</b>
                            @endif

                            @if(count($course->headlines) == 0)
                                <li class="text-danger">هنوز سرفصلی برای دوره خود ایجاد نکرده اید.</li>
                            @endif

                            @if($course->type== 'online' && count($course->schedules) == 0)
                                <li class="text-danger">برای دوره های آنلاین باید زمان بندی مشخص کنید.</li>
                            @endif



                        </ul>

                    @else
                        <form action="{{route('submit.support')}}" method="post">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{$course->id}}">
                                <input type="hidden" name="type" value="{{get_class($course)}}">
                                <input type="hidden" name="title" value="درخواست تایید دوره {{$course->title}}">
                                <textarea name="message" class="form-control" rows="5">
اینجانب {{ auth()->user()->name }} {{ auth()->user()->family }}، درخواست تایید دوره "{{ $course->title }}" را دارم. اینجانب قوانین سایت را مطالعه کرده‌ام و تمام اطلاعات واردشده مربوط به این دوره را به‌درستی تکمیل کرده‌ام. همچنین تعهد می‌نمایم پس از تایید این دوره، پشتیبانی کامل آن را بر عهده بگیرم.</textarea>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">بستن
                                </button>
                                <button type="submit" class="btn btn-success">ارسال درخواست</button>
                            </div>
                        </form>

                    @endif
                </div>
            </div>
        </div>


    @endsection
@endcomponent
