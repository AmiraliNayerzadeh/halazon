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
                            <a class="nav-link" href="#">سرفصل ها</a>
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


                            <!-- Button trigger modal -->
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                ایجاد زمان جدید
                            </button>

                            @include('admin.courses.schedule.partCreate')
                        </div>

                        <div class="card-body">
                            @if(count($course->parts) > 0)

                            @else
                                <div class="card border">
                                    <div class="card-header">
                                        <li class="fa fa-file-archive"></li>
                                        ایجاد زمان بندی جدید
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label" for="title">عنوان زمان بندی:</label>
                                                <input class="form-control" type="title" name="title" id="title" value="{{old('title')}}" placeholder="زمان بندی 1">
                                            </div>
                                            <div class="form-group">
                                                <label for="day">روز های برگذاری:</label>
                                                @foreach($days as $day)
                                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                    <input type="checkbox" class="btn-check" id="{{$day['id']}}" autocomplete="off" name="days[]" value="جمعه">
                                                    <label class="btn btn-outline-primary" for="{{$day['id']}}">{{$day['day_farsi']}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">

                    <div class="card mb-3">
                        <img class="img-fluid rounded" src="{{$course->image}}" alt="{{$course->title}}">
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

        @endsection

    @endsection
@endcomponent
