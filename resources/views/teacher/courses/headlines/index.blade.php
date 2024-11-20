@component('.teacher.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>سرفصل های {{$course->title}}</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5"
                                                               href="{{route('teachers.courses.index')}}">دوره ها</a></li>
                        <li class="breadcrumb-item text-sm " aria-current="page">ویرایش</li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">{{$course->title}}</li>
                        <li class="breadcrumb-item text-sm " aria-current="page">سرفصل ها</li>

                    </ol>
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills nav-fill bg-transparent">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="{{route('teachers.courses.edit' , $course)}}">مشخصات
                                کلّی</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link"
                               href="{{route('teachers.schedules.index', $course)}}">زمان بندی کلاس</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-primary text-white "
                               href="{{route('teachers.headline.index', $course)}}">سرفصل ها</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">


                <div class="row">
                    <div class="card">

                        <form id="headlineForm" action="{{ route('teachers.headline.store', $course) }}" method="post"
                              enctype="multipart/form-data" class="form-control">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="row">

                                    <div class="{{ $course->type == 'offline' ? 'col-lg-6' : 'col-lg-12' }}">
                                        <div class="form-group">
                                            <label class="form-label" for="title">عنوان سرفصل:</label>
                                            <input class="form-control" type="text" name="title" id="title"
                                                   value="{{ old('title') }}"
                                                   placeholder="مثال: آشنایی با تاریخچه ی ... ">
                                        </div>
                                    </div>

                                    @if($course->type == 'online')
                                        <div class="form-group">
                                            <label class="form-label" for="link">لینک ورود به جلسه:</label>

                                            <small class="text-warning">در صورت اینکه لینک آماده ای ندارید، میتوانید این
                                                فیلد را خالی رها کنید.</small>
                                            <input class="form-control" type="text" name="link" id="link"
                                                   value="{{ old('link') }}"
                                                   placeholder="لینک ورود به جلسه انلاین را وارد کنید.">
                                        </div>
                                    @endif

                                    @if($course->type == 'offline')
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="is_free">این سرفصل رایگان است؟</label>
                                                <select class="form-control" name="is_free" id="is_free">
                                                    <option {{old('is_free' == 0 ? 'selected' : '')}} value="0">خیر
                                                    </option>
                                                    <option {{old('is_free' == 1 ? 'selected' : '')}} value="1">بله
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif


                                    @if($course->type == 'offline')
                                        <div class="col-lg-12">
                                            <div class="alert alert-info text-white text-sm d-flex align-items-center mt-1"
                                                 role="alert">
                                                <i class="fas fa-info-circle mx-2"></i>
                                                <div>
                                                    با توجه به اینکه معمولاً فایل‌های ویدیویی دارای حجم زیادی می‌باشند،
                                                    لطفاً تا پایان بارگذاری ویدیو صبور باشید.
                                                </div>
                                            </div>


                                            <label>فایل ویدیو:</label>
                                            <div id="videoDropzone" class="dropzone"></div>
                                        </div>
                                    @endif

                                    <div class="col-lg-12 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="description">توضیحات سرفصل (اختیاری):</label>
                                            <textarea class="form-control" name="description" id="description" cols="30"
                                                      rows="4">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" id="submit-button" type="submit">ثبت</button>
                        </form>

                    </div>

                </div>


            </div>

            <div class="col-lg-3">

                <div class="card mb-3">
                    <img class="img-fluid rounded" src="{{$course->image}}" alt="{{$course->title}}">
                </div>

            </div>


            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h6>سر فصل های ایجاد شده</h6>
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
                                                        <form id="headlineForm"
                                                              action="{{ route('teachers.headline.update', $headline) }}"
                                                              method="post" class="form-control">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="card-body">
                                                                <div class="row">

                                                                    <div class="{{ $course->type == 'offline' ? 'col-lg-6' : 'col-lg-12' }}">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="title">عنوان
                                                                                سرفصل:</label>
                                                                            <input class="form-control" type="text"
                                                                                   name="title" id="title"
                                                                                   value="{{ old('title', $headline->title) }}"
                                                                                   placeholder="مثال: آشنایی با تاریخچه ی ... ">
                                                                        </div>
                                                                    </div>

                                                                    @if($course->type == 'online')
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="link">لینک
                                                                                ورود به جلسه:</label>

                                                                            <small class="text-warning">در صورت اینکه
                                                                                لینک آماده ای ندارید، میتوانید این فیلد
                                                                                را خالی رها کنید.</small>
                                                                            <input class="form-control" type="text"
                                                                                   name="link" id="link"
                                                                                   value="{{ old('link', $headline->link) }}"
                                                                                   placeholder="لینک ورود به جلسه انلاین را وارد کنید.">
                                                                        </div>
                                                                    @endif


                                                                    @if($course->type == 'offline')
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="is_free">این
                                                                                    سرفصل رایگان است؟</label>
                                                                                <select class="form-control"
                                                                                        name="is_free" id="is_free">
                                                                                    <option {{$headline->is_free == 0 ? 'selected' : ''}} value="0">
                                                                                        خیر
                                                                                    </option>
                                                                                    <option {{$headline->is_free == 1 ? 'selected' : ''}} value="1">
                                                                                        بله
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if($course->type == 'offline')
                                                                        @if($headline->video)
                                                                            <div class="col-lg-12">
                                                                                <div class="alert alert-warning text-white"
                                                                                     role="alert">
                                                                                    امکان تغییر ویدیو وجود ندارد.
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>ویدیو:</label>
                                                                                    <video width="100%" controls>
                                                                                        <source src="{{ $headline->video }}"
                                                                                                type="video/mp4">
                                                                                        مرورگر شما از تگ ویدیو پشتیبانی
                                                                                        نمی‌کند.
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="col-lg-12">
                                                                                <div class="alert alert-danger text-white"
                                                                                     role="alert">
                                                                                    ویدیویی برای این سرفصل وجود ندارد.
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif

                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="description">توضیحات
                                                                                سرفصل (اختیاری):</label>
                                                                            <textarea class="form-control"
                                                                                      name="description"
                                                                                      id="description" cols="30"
                                                                                      rows="4">{{ old('description', $headline->description) }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button id="submit-button" class="btn btn-success"
                                                                    type="submit">به‌روزرسانی
                                                            </button>
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

                                            @if($course->type == 'online')
                                                <div>
                                                    <b>لینک ورود به جلسه: </b>
                                                    @if(!is_null($headline->link))
                                                        <a href="{{$headline->link}}">{{$headline->link}}</a>
                                                    @else
                                                        <a class="text-danger" href="#">هنوز وارد نشده است.</a>
                                                    @endif
                                                </div>
                                            @endif

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




        @section('script')

            <script>
                Dropzone.options.videoDropzone = {
                    url: "{{ route('teachers.video.upload', $course) }}",
                    maxFilesize: 20,
                    acceptedFiles: '.mp4,.mov,.avi',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    dictDefaultMessage: "لطفاً ویدیوی خود را اینجا بکشید و رها کنید",
                    init: function () {
                        let submitButton = document.getElementById("submit-button");
                        submitButton.disabled = true;

                        this.on("sending", function (file, xhr, formData) {
                            submitButton.disabled = true;
                            submitButton.textContent = "در انتظار بارگذاری آپلود ویدیو...";


                            xhr.upload.onprogress = function (event) {
                                if (event.lengthComputable) {
                                    const percent = (event.loaded / event.total) * 100;
                                    file.previewElement.querySelector("[data-dz-uploadprogress]").style.width = percent + "%";
                                    file.previewElement.querySelector("[data-dz-uploadprogress]").textContent = Math.round(percent) + "%";
                                }
                            };
                        });

                        this.on("success", function (file, response) {
                            const videoUrl = response.url;

                            // ذخیره لینک ویدیو در یک فیلد مخفی
                            let videoInput = document.createElement('input');
                            videoInput.type = 'hidden';
                            videoInput.name = 'video_url';
                            videoInput.value = videoUrl;
                            document.getElementById('headlineForm').appendChild(videoInput);

                            submitButton.disabled = false;
                            submitButton.textContent = "ثبت";
                        });

                        this.on("error", function (file, response) {
                            console.error('Error uploading file: ', response);
                            submitButton.disabled = false;
                            submitButton.textContent = "ثبت";
                        });
                    }
                };
            </script>

        @endsection

    @endsection
@endcomponent