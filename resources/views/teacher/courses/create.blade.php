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

                    <div class="container mt-5">
                        <div class="stepper">
                            <!-- Step 1 -->
                            <div class="step active">
                                <div class="circle">1</div>
                                <div class="label">اطلاعات دوره</div>
                            </div>
                            <!-- Step 2 -->
                            <div class="step">
                                <div class="circle">2</div>
                                <div class="label">زمان بندی</div>
                            </div>
                            <!-- Step 3 -->
                            <div class="step">
                                <div class="circle">3</div>
                                <div class="label">سرفصل ها</div>
                            </div>
                        </div>
                    </div>

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
                                        <a class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                           title="از وارد کردن عنوان‌های تکراری که بر روی سایت وجود دارد خودداری کنید. برای جلوگیری از این کار می‌توانید به عنوان کلاس خود مخاطبین هدف (شامل سن و یا پایه تحصیلی آنها)، مشخص کردن دوره آنلاین و یا آفلاین بودن و یا تعداد جلسات تشکیل‌دهنده را اضافه کنید (مثال: دوره آفلاین 21 جلسه‌ای برای گروه سنی 3 تا 5 سال).">
                                            <i class="fa fa-circle-info text-info"></i>
                                        </a>
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
                                               placeholder="به لاتین وارد شود." value="{{old('capacity')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="price">قیمت دوره (تومان):</label>
                                        <a class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                           title="پایین بودن قیمت کلاس موجب جذب بیشتر دانش‌آموزان می‌شود. با توجه به درصد قرارداد، مبلغ مربوطه به طور خودکار کم می‌شود.">
                                            <i class="fa fa-circle-info text-info"></i>
                                        </a>
                                        <input type="number" name="price" id="price" class="form-control"
                                               placeholder="قیمت دوره را به تومان وارد کنید" value="{{ old('price') }}">
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
                                                <option value="{{$degree->id}}"
                                                        @if(in_array($degree->id, old('degrees', []))) selected @endif>
                                                    {{$degree->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="category">دسته بندی:</label>
                                        <a class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                           title="در صورتی که دسته بندی مورد نظر شما در لیست موجود نمی باشد، به بخش حساب کاربری > دسته‌بندی تدریس مراجعه کنید و دسته بندی های مورد نظر خود را اضافه کنید.">
                                            <i class="fa fa-circle-info text-info"></i>
                                        </a>
                                        <select class="form-control " name="category" id="category">
                                            <option>دسته بندی کلاس را انتخاب کنید.</option>
                                            @if(is_null($categories))
                                                <option disabled>دسته بندی برای نمایش وجود ندارد.</option>
                                            @endif
                                            @foreach($categories as $category)
                                                <option {{old('category') == $category->id  ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <label class="form-label" for="thumbnail">عکس پروفایل کلاس:</label>
                                    <a class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="این عکس باید از طریق برنامه Canva طراحی شود، که توضیحات آن در کانال آمده است. اگر شما در کلاستان مطالبی را آموزش می‌دهید که شامل یک محصول نهایی است (مثل پخت یک غذا یا نقاشی)، از تصویر محصول نهایی خود در پروفایل استفاده کنید. اگر تصویر شما کیفیت مناسبی نداشته باشد، کارشناسان حلزون آن را بازطراحی خواهند کرد.">
                                        <i class="fa fa-circle-info text-info"></i>
                                    </a>


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
                                    <a class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="در این ویدیو حداکثر در 90 ثانیه به دانش‌آموزان توضیح دهید که از کلاس شما چه مطالبی یاد می‌گیرند. همچنین می‌توانید مواردی که قبل از شروع کلاس باید تهیه کنند را نشان دهید تا با آمادگی کامل وارد کلاس شوند. توجه: از پوشیدن لباس مشکی و مقنعه خودداری کنید. از بک‌گراند مناسب استفاده کنید و با انرژی، صمیمانه و پرنشاط با دانش‌آموزان صحبت کنید.">
                                        <i class="fa fa-circle-info text-info"></i>
                                    </a>

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
                            <div class="col-lg-12 d-flex flex-wrap  align-items-center mt-4">
                                <bdi>این کلاس مناسب بازه سنی</bdi>
                                <input type="number" name="age_from" id="age_from" class="form-control w-100 w-md-auto mx-2 my-2"
                                       placeholder=" بازه شروع به لاتین" value="{{old('age_from')}}">
                                <bdi>تا</bdi>
                                <input type="number" name="age_to" id="age_to" class="form-control w-100 w-md-auto mx-2 my-2"
                                       placeholder=" بازه پایان به لاتین" value="{{old('age_to')}}">
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


                            <div class="col-lg-12 d-flex flex-wrap align-items-center mt-4">
                                <span class="mx-2">این کلاس در </span>
                                <input type="number" name="class_duration" id="class_duration"
                                       class="form-control w-100 w-md-auto my-2" placeholder="تعداد جلسات به لاتین"
                                       value="{{old('class_duration')}}">
                                <span class="mx-2"> جلسه و در هفته</span>
                                <input type="number" name="weeks" id="weeks" class="form-control w-100 w-md-auto my-2"
                                       placeholder="تعداد هفته به لاتین" value="{{old('weeks')}}">
                                <span class="mx-2">بار برگذار میشود که مدّت هر جلسه  </span>
                                <input type="number" name="minutes" id="minutes" class="form-control w-100 w-md-auto my-2"
                                       placeholder="(به لاتین) مثال 30 " value="{{old('minutes')}}">
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


                    <div class="card position-sticky  fixed-top">
                        <div class="card-header bg-success">
                            <h5>
                                <li class="mx-2 fa fa-save mx-2"></li>
                                انتشار
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button class="btn btn-warning w-100" name="is_draft" value="1" type="submit">مرحله بعد</button>
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
            <style>
                .stepper {
                    display: flex;
                    justify-content: space-between;
                    position: relative;
                }
                .stepper::before {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background-color: #ddd;
                    z-index: 0;
                    transform: translateY(-50%);
                }
                .step {
                    text-align: center;
                    position: relative;
                    z-index: 1;
                }
                .step .circle {
                    width: 40px;
                    height: 40px;
                    background-color: #ddd;
                    color: white;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto;
                    font-weight: bold;
                }
                .step.active .circle {
                    background-color: #fbcf33;
                }
                .step .label {
                    margin-top: 10px;
                    font-size: 14px;
                    color: #555;
                }
                .step.active .label {
                    color: #fbcf33;
                }
            </style>

        @endsection

    @endsection
@endcomponent
