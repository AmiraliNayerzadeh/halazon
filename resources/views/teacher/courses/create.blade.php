@component('.teacher.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ایجاد دوره جدید</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5"
                                                               href="{{route('teachers.courses.index')}}">دوره ها</a>
                        </li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">ایجاد</li>
                    </ol>
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills nav-fill bg-transparent">
                        <li class="nav-item">
                            <a class="nav-link bg-primary text-white" aria-current="page" href="#">مشخصات کلّی</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link disabled text-light" href="#">زمان بندی کلاس</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled text-light" href="#">سرفصل ها</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


        <form action="{{route('teachers.courses.store')}}" method="post" autocomplete="off">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="text-primary">
                                <li class="mx-2 fa fa-info"></li>
                                مشخصات کلّی
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="title">نام دوره</label>
                                        <span class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                              title="از وارد کردن عنوان‌های تکراری که بر روی سایت وجود دارد خودداری کنید. برای جلوگیری از این کار می‌توانید به عنوان کلاس خود مخاطبین هدف (شامل سن و یا پایه تحصیلی آنها)، مشخص کردن دوره آنلاین و یا آفلاین بودن و یا تعداد جلسات تشکیل‌دهنده را اضافه کنید (مثال: دوره آفلاین 21 جلسه‌ای برای گروه سنی 3 تا 5 سال).">
            <i class="fa fa-circle-info text-info"></i>
        </span>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="عنوان دوره را وارد کنید." value="{{ old('title') }}">
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="type">نوع دوره</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="online">آنلاین</option>
                                            <option value="offline">آفلاین</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="capacity">ظرفیت کلاس
                                            <small>(در صورت آفلاین بودن دوره این گزینه مهم نیست)</small>

                                        </label>
                                        <input type="number" name="capacity" id="capacity" class="form-control"
                                               placeholder="کلاس در چند هفته برگزار میشود؟" value="{{old('capacity')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="price">قیمت دوره(تومان): </label>
                                        <input type="number" name="price" id="price" class="form-control"
                                               placeholder="قیمت دوره را به تومان وارد کنید" value="{{old('price')}}">
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="discount_price">تخفیف (تومان): </label>
                                        <input type="number" name="discount_price" id="discount_price"
                                               class="form-control" placeholder="مبلغ تخفیف را وارد کنید."
                                               value="{{old('discount_price')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="degrees">مقطع:</label>
                                        <select class="form-control select2" name="degrees[]" id="degrees" multiple>
                                            @foreach(\App\Models\Degree::all() as $degree)
                                                <option value="{{$degree->id}}">{{$degree->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <label class="form-label" for="thumbnail">عکس پروفایل کلاس:</label>
                                    <div class="input-group">
                                                       <span class="input-group-btn">
                                                         <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                            class="btn btn-primary">
                                                           <i class="fa fa-image"></i>
                                                             انتخاب
                                                         </a>
                                          </span>
                                        <input id="thumbnail" class="form-control" type="text" name="image"
                                               value="{{old('image')}}">
                                    </div>
                                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <label class="form-label" for="video">ویدیو معرفی کلاس:</label>
                                    <div class="input-group">
                                                       <span class="input-group-btn">
                                                         <a id="lfv" data-input="video" data-preview="holder"
                                                            class="btn btn-primary">
                                                           <i class="fa fa-video"></i>
                                                             انتخاب
                                                         </a>
                                          </span>
                                        <input id="video" class="form-control" type="text" name="video"
                                               value="{{old('video')}}">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header bg-light">
                            <h4 class="text-primary">
                                <li class="mx-2 fa fa-sort-numeric-asc"></li>
                                بازه سنی
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="text-warning">
                                <i class="fa fa-warning"></i>
                                در صورتی که این دوره تنها مختص یک سن خاص است، هر دو مقدار را با همان عدد تکمیل کنید.
                            </div>
                            <div class="col-lg-12 d-flex align-items-center mt-4">
                                <bdi>این کلاس مناسب بازه سنی</bdi>
                                <input type="number" name="age_from" id="age_from" class="form-control w-auto mx-2"
                                       placeholder="بازه شروع" value="{{old('age_from')}}">
                                <bdi>تا</bdi>
                                <input type="number" name="age_to" id="age_to" class="form-control w-auto mx-2"
                                       placeholder="بازه پایان" value="{{old('age_to')}}">
                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header bg-light">
                            <h4 class="text-primary">
                                <li class="mx-2 fa fa-calendar-alt"></li>
                                اطلاعات زمانی
                            </h4>
                        </div>
                        <div class="card-body">

                            <div class="text-warning">
                                <i class="fa fa-warning"></i>
                                در صورتی که دوره شما آفلاین می باشد، این قسمت اهمیتی ندارد.
                            </div>


                            <div class="col-lg-12 d-flex align-items-center mt-4">
                                <span class="mx-2">این کلاس در </span>
                                <input type="number" name="class_duration" id="class_duration"
                                       class="form-control w-auto" placeholder="تعداد جلسات "
                                       value="{{old('class_duration')}}">
                                <span class="mx-2"> جلسه و در هفته</span>
                                <input type="number" name="weeks" id="weeks" class="form-control w-auto"
                                       placeholder="تعداد هفته" value="{{old('weeks')}}">
                                <span class="mx-2">بار برگذار میشود که مدّت هر جلسه  </span>
                                <input type="number" name="minutes" id="minutes" class="form-control w-auto"
                                       placeholder="مثال 30 " value="{{old('minutes')}}">
                                <span class="mx-2"> دقیقه میباشد.  </span>
                            </div>
                        </div>
                    </div>


                    <div class="card my-3">
                        <div class="card-header bg-light">
                            <h4 class="text-primary">
                                <li class="mx-2 fa fa-paragraph"></li>
                                توضیحات دوره
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div>
                                        <p>
                                            ابتدا مقدمه ای کوتاه درباره درس و با مهارتی که میخواهید تدریس کنید + مشخص
                                            کردن آنلاین و یا آفلاین بودن + تعداد جلسات کلاس + آنچه در نهایت دانش آموزان
                                            از کلاس شما یاد میگیرند آورده شود.
                                        </p>
                                    </div>
                                    <label class="form-label" for="description">توضیحات </label>
                                    <textarea name="description" id="editor">{{ old('description') }}</textarea>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card my-3">
                        <div class="card-header bg-light">
                            <h4 class="text-primary">
                                <li class="mx-2 fa fa-question-circle"></li>
                                سوالات متداول
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="questions[learning_goal]">هدف یادگیری این دوره چیست؟</label>
                                    <textarea name="questions[learning_goal]" id="questions_learning_goal"
                                              class="form-control">{{ old('questions.learning_goal') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="questions[assessment_method]">چگونه قصد دارید پیشرفت دانش‌آموزان را
                                        ارزیابی کنید؟</label>
                                    <textarea name="questions[assessment_method]" id="questions_assessment_method"
                                              class="form-control">{{ old('questions.assessment_method') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="questions[requirements]">چه مواردی برای شرکت در این دوره مورد نیاز
                                        است؟</label>
                                    <textarea name="questions[requirements]" id="questions_requirements"
                                              class="form-control">{{ old('questions.requirements') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="questions[duration_needed]">برای مطالعه در هر هفته به چه میزان زمان نیاز
                                        است؟</label>
                                    <input type="text" name="questions[duration_needed]" id="questions_duration_needed"
                                           class="form-control" value="{{ old('questions.duration_needed') }}">
                                </div>

                            </div>
                        </div>
                    </div>


                </div>


                <div class="col-lg-3">
                    <div class="card mb-3 ">
                        <div class="card-header bg-light">
                            <h5 class="text-primary fw-bold">
                                <li class="mx-2 fa fa-network-wired mx-2"></li>
                                دسته بندی
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="my-3" style="height: 18rem ; overflow-x: hidden; overflow-y: scroll">
                                @foreach(\App\Models\Category::where('parent_id' , null)->get() as $parent)
                                    <div class="form-check ">
                                        <input name="category[]" value="{{$parent->id}}" class="form-check-input"
                                               type="checkbox" id="{{$parent->id}}">
                                        <label class="form-check-label fw-bold"
                                               for="{{$parent->id}}">{{$parent->title}}</label>
                                    </div>
                                    @foreach($parent->children as $child)
                                        <div class="form-check  me-3">
                                            <input name="category[]" value="{{$child->id}}" class="form-check-input"
                                                   type="checkbox" id="{{$child->id}}">
                                            <label class="form-check-label"
                                                   for="{{$child->id}}">{{$child->title}}</label>
                                        </div>

                                        @foreach($child->children as $child2)
                                            <div class="form-check mb-2 me-5">
                                                <input name="category[]" value="{{$child2->id}}"
                                                       class="form-check-input" type="checkbox" id="{{$child2->id}}">
                                                <label class="form-check-label"
                                                       for="{{$child2->id}}">{{$child2->title}}</label>
                                            </div>
                                        @endforeach

                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="card position-sticky fixed-top">
                        <div class="card-header bg-success">
                            <h5>
                                <li class="mx-2 fa fa-save mx-2"></li>
                                انتشار
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning w-100" name="is_draft" value="1" type="submit">ذخیره
                                        پیش نویس
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @section('script')


            <script>
                jalaliDatepicker.startWatch();
            </script>

            <script>
                $('#lfm').filemanager('image');

                $('#lfv').filemanager('video');
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
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            </script>

            <style>
                .tooltip-inner {
                    max-width: 400px; /* تنظیم عرض حداکثر */
                    white-space: normal; /* امکان نمایش چند خطی */
                }

            </style>

        @endsection

    @endsection
@endcomponent
