@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>سرفصل های {{$course->title}}</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5"
                                                               href="{{route('admin.courses.index')}}">دوره ها</a></li>
                        <li class="breadcrumb-item text-sm " aria-current="page">ویرایش</li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">{{$course->title}}</li>
                        <li class="breadcrumb-item text-sm " aria-current="page">سرفصل ها</li>

                    </ol>
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills nav-fill bg-transparent">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="{{route('admin.courses.edit' , $course)}}">مشخصات
                                کلّی</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link"
                               href="{{route('admin.schedules.index', $course)}}">زمان بندی کلاس</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-primary text-white "
                               href="{{route('admin.headline.index', $course)}}">سرفصل ها</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6>سر فصل ها</h6>
                        <!-- Button trigger modal -->


                        <!-- Button trigger modal -->
                        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            ایجاد سرفصل جدید
                        </button>

                        {{--                        @include('admin.courses.headlines.create')--}}
                    </div>

                    <div class="card-body">
                        @if(count($course->headlines) > 0)

                            <div class="accordion" id="accordionExample">
                                @foreach($course->headlines as $headline)

                                    <div class="accordion-item bg-light my-2">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <div class="d-flex justify-content-between align-items-center mx-2">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{$headline->id}}"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                    {{$headline->title}}
                                                </button>
                                                <!-- Button trigger modal -->
                                                <button style="height: fit-content" type="button"
                                                        class="btn bg-gradient-info" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{$headline->id}}">
                                                    ویرایش
                                                </button>


                                                <!-- Modal -->
                                                <div class="modal fade" id="modalEdit{{$headline->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-flex justify-content-between">
                                                                <div>
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        ویرایش سر فصل</h5>
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn-close text-dark"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <form action="{{route('admin.headline.update', $headline)}}"
                                                                  method="post">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="card-body">

                                                                    <div class="row">

                                                                        <div class="{{$course->type == 'offline' ? 'col-lg-6' : 'col-lg-12'}}">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="title">عنوان
                                                                                    سرفصل:</label>
                                                                                <input class="form-control" type="title"
                                                                                       name="title" id="title"
                                                                                       value="{{$headline->title}}"
                                                                                       placeholder="مثال: آشنایی با تاریخچه ی ... ">
                                                                            </div>
                                                                        </div>

                                                                        @if($course->type == 'offline')
                                                                            <div class="col-lg-6">
                                                                                <label class="form-label"
                                                                                       for="thumbnail">فایل:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-btn">
                                                                                        <a id="lfm"
                                                                                           data-input="thumbnail"
                                                                                           data-preview="holder"
                                                                                           class="btn btn-primary">
                                                                                            <i class="fa fa-picture-o"></i>انتخاب
                                                                                        </a>
                                                                                    </span>
                                                                                    <input id="thumbnail"
                                                                                           class="form-control"
                                                                                           type="text" name="video"
                                                                                           autocomplete="off"
                                                                                           value="{{$headline->video}}">
                                                                                </div>
                                                                                <div id="holder"
                                                                                     style="margin-top:15px;max-height:100px;"></div>
                                                                            </div>
                                                                        @endif

                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label"
                                                                                       for="description">توضیحات سرفصل
                                                                                    (اختیاری):</label>
                                                                                <textarea class="form-control"
                                                                                          name="description"
                                                                                          id="description" cols="30"
                                                                                          rows="4">{{$headline->description}}</textarea>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="card-footer border d-flex justify-content-end">
                                                                    <button class="btn btn-success" type="submit">بروز
                                                                        رسانی
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </h2>

                                        <div id="collapse{{$headline->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{$headline->description}}
                                                @if(!is_null($headline->video))

                                                    <video class="img-fluid my-2" controls>
                                                        <source src="{{$headline->video}}" type="video/mp4">
                                                        <source src="{{$headline->video}}" type="video/ogg">
                                                        Your browser does not support the video tag.
                                                    </video>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="alert">
                                <i class="fa fa-close"></i>
                                هنوز سرفصلی وارد نشده است. لطفاً اقدام به ایجاد سرفصل کنید.
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


        <div class="row">
            <div class="card">

                <form id="headlineForm" action="{{ route('admin.headline.store', $course) }}" method="post" enctype="multipart/form-data" class="form-control">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="row">
                            <!-- فیلد عنوان سرفصل -->
                            <div class="{{ $course->type == 'offline' ? 'col-lg-6' : 'col-lg-12' }}">
                                <div class="form-group">
                                    <label class="form-label" for="title">عنوان سرفصل:</label>
                                    <input class="form-control" type="text" name="title" id="title"
                                           value="{{ old('title') }}" placeholder="مثال: آشنایی با تاریخچه ی ... ">
                                </div>
                            </div>

                            @if($course->type == 'offline')
                                <div class="col-lg-6">
                                    <label>فایل ویدیو:</label>
                                    <div id="videoDropzone" class="dropzone"></div>
                                </div>
                            @endif

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">توضیحات سرفصل (اختیاری):</label>
                                    <textarea class="form-control" name="description" id="description" cols="30"
                                              rows="4">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">ثبت</button>
                </form>

            </div>

        </div>


        @section('script')

            <script>
                Dropzone.autoDiscover = false;

                // اطمینان از اینکه Dropzone به درستی روی عنصر تنظیم شده است
                let videoDropzone = new Dropzone("#videoDropzone", {
                    url: "{{ route('admin.headline.store', $course) }}", // آدرس مورد نظر برای آپلود
                    autoProcessQueue: false, // جلوگیری از آپلود خودکار
                    addRemoveLinks: true,
                    uploadMultiple: false,
                    parallelUploads: 1,
                    maxFiles: 1, // محدود به یک فایل
                    maxFilesize: 50, // حداکثر 50MB
                    acceptedFiles: '.mp4,.mov,.ogg,.qt',
                    init: function () {
                        let myDropzone = this;

                        document.getElementById("headlineForm").addEventListener("submit", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            // بررسی اینکه آیا ویدیو آپلود شده است یا خیر
                            if ("{{ $course->type }}" == 'offline' && myDropzone.getQueuedFiles().length === 0) {
                                alert('لطفاً ابتدا فایل آموزشی را آپلود کنید.');
                                return;
                            }

                            // اگر فایلی وجود دارد، آن را آپلود کنید و سپس فرم ارسال شود
                            if (myDropzone.getQueuedFiles().length > 0) {
                                myDropzone.processQueue(); // شروع آپلود فایل
                            } else {
                                document.getElementById("headlineForm").submit(); // اگر فایلی نیست، فرم را ارسال کنید
                            }
                        });

                        myDropzone.on("sending", function(file, xhr, formData) {
                            let formDataObj = new FormData(document.getElementById('headlineForm'));
                            for (let [key, value] of formDataObj.entries()) {
                                formData.append(key, value);
                            }
                        });

                        myDropzone.on("success", function (file, response) {
                            let input = document.createElement("input");
                            input.type = "hidden";
                            input.name = "video";
                            input.value = response.filePath; // یا file.name یا response.filePath
                            document.getElementById("headlineForm").appendChild(input);

                            document.getElementById("headlineForm").submit();
                        });

                        myDropzone.on("error", function (file, response) {
                            alert('خطا در آپلود فایل: ' + response);
                        });
                    }
                });
            </script>


        @endsection

    @endsection
@endcomponent