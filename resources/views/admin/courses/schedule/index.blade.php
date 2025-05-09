@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ویرایش دوره {{$course->title}}</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5"
                                                               href="{{route('admin.courses.index')}}">دوره ها</a></li>
                        <li class="breadcrumb-item text-sm " aria-current="page">ویرایش</li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">{{$course->title}}</li>
                        <li class="breadcrumb-item text-sm " aria-current="page">زمان بندی</li>

                    </ol>
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills nav-fill bg-transparent">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="{{route('admin.courses.edit' , $course)}}">مشخصات
                                کلّی</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link  bg-primary text-white "
                               href="{{route('admin.schedules.index', $course)}}">زمان بندی کلاس</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.headline.index', $course)}}">سرفصل ها</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6> زمان بندی ها</h6>
                        <!-- Button trigger modal -->

                        @if(count($course->parts) > 0)

                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                ایجاد زمان جدید
                            </button>

                            @include('admin.courses.schedule.partCreate')
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
                                            <div
                                                class="card-header border d-flex justify-content-between align-items-center">
                                                <div><h6 class="text-primary">{{$parts->title}}</h6></div>
                                                <div
                                                    class="badge {{$parts->status == 0 ? 'bg-danger' : 'bg-success' }} ">
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
                                            <div class="card-footer border d-flex justify-content-between">
                                                <div>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn bg-gradient-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#watchSchedule{{$parts->id}}">
                                                        مشاهده کامل زمان بندی
                                                    </button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="watchSchedule{{$parts->id}}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">

                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div
                                                                    class="modal-header d-flex justify-content-between">
                                                                    <div>
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            مشاهده کامل جزئیات {{$parts->title}}</h5>
                                                                    </div>
                                                                    <div>
                                                                        <button type="button"
                                                                                class="btn-close text-dark"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body overflow-y-scroll">
                                                                    <div class="table-responsive p-0">
                                                                        <table class="table mb-0">

                                                                            <thead>
                                                                            <tr>
                                                                                <th>شناسه</th>
                                                                                <th>روز</th>
                                                                                <th>تاریخ</th>
                                                                                <th>ساعت</th>
                                                                                <th>ثبت تغیر</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            @foreach($parts->schedules as $schedules )
                                                                                <tr>
                                                                                    <form id="scheduleUpdateForm-{{$schedules->id}}">
                                                                                        <td>{{$schedules->id}}<input type="hidden" name="schedules_id" value="{{ $schedules->id }}"></td>

                                                                                        <td>
                                                                                            <select name="day_id" class="form-control ">
                                                                                                @foreach(\App\Models\Day::all() as $day)
                                                                                                <option {{$schedules->day_id == $day->id ?'selected' : ''}} value="{{$day->id}}">{{$day->day_farsi}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </td>


                                                                                        <td>
                                                                                            <input data-jdp type="text" class="form-control" id="start_course"
                                                                                                   name="start_date" value="{{jdate()->forge($schedules->start_date)->toDateString()}}"
                                                                                                   autocomplete="off">
                                                                                        </td>

                                                                                        <td>
                                                                                            <input class="form-control" type="time" name="start_time" value="{{$schedules->start_time}}">
                                                                                        </td>


                                                                                        <td>
                                                                                            <button class="btn btn-sm btn-success" type="submit">ذخیره</button>
                                                                                        </td>
                                                                                    </form>
                                                                                    <div id="responseMessage"></div>

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


                                                <div>
                                                    <button type="button" class="btn bg-gradient-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteSchedule{{$parts->id}}">
                                                        <i class="fa fa-trash"></i>
                                                        حذف
                                                    </button>

                                                    <div class="modal fade" id="deleteSchedule{{$parts->id}}"
                                                         tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">

                                                        <div class="modal-dialog modal-dialog-centered"
                                                             role="document">
                                                            <div class="modal-content">
                                                                <div
                                                                    class="modal-header d-flex justify-content-between">
                                                                    <div>
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            حذف زمان بندی: {{$parts->title}}</h5>
                                                                    </div>
                                                                    <div>
                                                                        <button type="button"
                                                                                class="btn-close text-dark"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p>بعد از حذف امکان بازگردانی زمانبندی وجود
                                                                        نداره!</p>
                                                                    <p class="text-danger">آیا از اینکه میخواهید دوره را
                                                                        حذف کنید، اطمینان دارید؟</p>
                                                                </div>

                                                                <div class="card-footer">
                                                                    <form
                                                                        action="{{route('admin.schedules.delete' , $parts)}}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="d-flex justify-content-end">
                                                                            <button class="btn btn-danger"
                                                                                    type="submit">حذف
                                                                            </button>
                                                                        </div>
                                                                    </form>
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
                                <form action="{{route('admin.schedules.store', $course)}}" method="post">
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
                    <div class="card-header bg-light text-primary"><i class="fa fa-image mx-2"></i>تصویر پروفایل کلاس
                    </div>
                    <img class="img-fluid rounded p-3" src="{{$course->image}}" alt="{{$course->title}}">
                </div>


                <div class="card mb-3">
                    <div class="card-header bg-light text-primary"><i class="fa fa-file-video mx-2"></i>ویدیو معرفی کلاس
                    </div>
                    <video class="p-3 rounded" width="100%" controls>
                        <source src="{{ $course->video }}"
                                type="video/mp4">
                        مرورگر شما از تگ ویدیو
                        پشتیبانی
                        نمی‌کند.
                    </video>
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

            <script>
                $.fn.select2.defaults.set("theme", "bootstrap");

                $(document).ready(function () {
                    $('.select2').select2({
                        theme: 'bootstrap-5'
                    });
                });
            </script>


<script>
    $(document).ready(function() {
        $('[id^="scheduleUpdateForm"]').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let formId = $(this).attr('id');
            let partTimeId = formId.split('-')[1];

            $.ajax({
                url: '/admin/courses/schedules/' + partTimeId,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function(response) {
                    $('#responseMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function(key, value) {
                            errorMessages += '<li>' + value[0] + '</li>';
                        });
                        errorMessages += '</ul></div>';
                        $('#responseMessage').html(errorMessages);
                    } else {
                        $('#responseMessage').html('<div class="alert alert-danger">خطایی رخ داده است.</div>');
                    }
                }
            });
        });
    });
</script>


        @endsection

    @endsection
@endcomponent
