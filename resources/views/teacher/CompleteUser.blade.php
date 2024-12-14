@component('.teacher.layout.master')
    @section('content')

        <div class="container ">

            <div class="row">
                @if($user->is_verify == 0)
                    <div class="col-lg-5">
                        <h4 class="text-center text-warning mb-4">تکمیل ثبت نام</h4>
                        <p class="text-center">برای دسترسی به پنل ابتدا باید اطلاعات کاربری خود را کامل کنید. پس از
                            تکمیل و
                            تایید
                            توسط تیم پشتیبانی، قادر به فعالیت در پنل کاربری خود خواهید بود.</p>

                        <div class="mt-2">

                            @php
                                // بررسی اینکه آیا همه فیلدها تکمیل شده‌اند یا نه
                                $isComplete = !is_null($user->name) && !is_null($user->family) && !is_null($user->email) &&
                                              !is_null($user->nationalCode) && !is_null($user->gender) && !is_null($user->birthday) &&
                                              !is_null($user->description) && !empty($mainCategories) && !empty($subCategories) &&
                                              !is_null($user->avatar) && !is_null($user->id_card);
                            @endphp

                            @if (!$isComplete)
                                <div class="alert alert-light text-center my-3">
                                    <div>
                                        <i class="fa fa-sad-cry text-white  fa-3x"></i>
                                        <h5 class="text-secondary text-center">اطلاعات زیر را وارد کنید:</h5>
                                    </div>

                                    <ul>
                                        @if(is_null($user->name))
                                            <li>فیلد نام را وارد کنید.</li>
                                        @endif

                                        @if(is_null($user->family))
                                            <li>فیلد نام خانوادگی را وارد کنید.</li>
                                        @endif

                                        @if(is_null($user->email))
                                            <li>فیلد پست الکترونیک را وارد کنید.</li>
                                        @endif

                                        @if(is_null($user->nationalCode))
                                            <li>فیلد کد ملی را وارد کنید.</li>
                                        @endif

                                        @if(is_null($user->gender))
                                            <li>فیلد جنسیت را انتخاب کنید.</li>
                                        @endif

                                        @if(is_null($user->birthday))
                                            <li>فیلد تاریخ تولد را وارد کنید.</li>
                                        @endif

                                        @if(is_null($user->description))
                                            <li>فیلد توضیحات را وارد کنید.</li>
                                        @endif

                                        @if(empty($mainCategories))
                                            <li>دسته‌بندی‌های اصلی را انتخاب کنید.</li>
                                        @endif

                                        @if(empty($subCategories))
                                            <li>زیر دسته‌بندی‌ها را انتخاب کنید.</li>
                                        @endif

                                        @if(is_null($user->avatar))
                                            <li>تصویر پروفایل را بارگذاری کنید.</li>
                                        @endif

                                        @if(is_null($user->id_card))
                                            <li>کارت ملی را بارگذاری کنید.</li>
                                        @endif

                                    </ul>
                                </div>
                            @else

                                <div class="alert alert-success text-center  ">
                                    <i class="fa fa-face-smile text-white fa-3x my-2"></i>
                                    <h6>به نظر میرسد شما تمامی اطلاعات را به خوبی تکمیل کرده اید.</h6>
                                    <p>وقتشه که درخواستت رو مکتوب اعلام کنی و بعد از پس از بررسی کارشناسان حلزون، حساب
                                        کاربریتون تایید بشه.</p>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                        <i class="fa fa-user"></i>
                                        درخواست تایید حساب
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade " id="exampleModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                                        <div class="modal-dialog  modal-dialog-centered modal-fullscreen"
                                             role="document">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        درخواست تایید حساب کاربری و تایید قرارداد
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <form class="h-100" style="overflow-y: auto"
                                                      action="{{route('submit.support')}}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="modal-body text-end">
                                                        <input type="hidden" name="id" value="{{$user->id}}">
                                                        <input type="hidden" name="type" value="{{get_class($user)}}">
                                                        <input type="hidden" name="title"
                                                               value="درخواست تایید حساب کاربری">
                                                        <div class="card">
                                                            <div class="card-body text-right">
                                                                <h5>طرفین قرارداد</h5>
                                                                <p>
                                                                    طرف اول (کارفرما): پلتفرم آموزشی حلزون که از این پس
                                                                    <b>کارفرما</b> نامیده می‌شود.
                                                                </p>
                                                                <p>
                                                                    طرف دوم قرارداد (مدرس): آقا/خانم <b
                                                                            class="text-primary">{{ auth()->user()->name }} {{ auth()->user()->family }}</b>
                                                                    با کد ملی <b
                                                                            class="text-primary">{{ $user->nationalCode }}</b>،
                                                                    تاریخ تولد <b
                                                                            class="text-primary">{{ jdate($user->birthday)->toDateString() }}</b>،
                                                                    نشانی <b
                                                                            class="text-primary">{{ $user->address }}</b>
                                                                    و تلفن <b
                                                                            class="text-primary">{{ $user->phone }}</b>
                                                                    که از این پس <b>مدرس</b> نامیده می‌شود.
                                                                </p>

                                                                <h5>موضوع قرارداد</h5>
                                                                <p>
                                                                    طرفین قرارداد توافق کرده‌اند که مدرس وظایف زیر را بر
                                                                    عهده داشته باشد:
                                                                </p>
                                                                <ul>
                                                                    <li>آموزش مجازی.</li>
                                                                    <li>پشتیبانی در کانال تلگرامی.</li>
                                                                    <li>تعیین تکالیف، رسیدگی به تکالیف و پاسخ به
                                                                        پرسش‌های دانش‌آموزان.
                                                                    </li>
                                                                </ul>
                                                                <p>
                                                                    همچنین:
                                                                </p>
                                                                <ul>
                                                                    <li>
                                                                        اگر آموزش به صورت آنلاین باشد، مدرس موظف است
                                                                        لینک کلاس خود را قبل از برگزاری کلاس روی سایت در
                                                                        اختیار دانش‌آموزان قرار دهد.
                                                                        مدرس موظف است حتی در صورت ثبت‌نام یک دانش‌آموز،
                                                                        کلاس خود را برگزار کند.
                                                                    </li>
                                                                    <li>
                                                                        اگر آموزش به صورت آفلاین (از طریق ارسال ویدئو)
                                                                        باشد، مدرس موظف است ویدئوهای آموزشی خود را روی
                                                                        سایت بارگذاری کند. در صورتی که ویدئوها آماده
                                                                        نباشند، مدرس باید هر هفته این کار را انجام دهد
                                                                        تا ویدئوها به موقع در اختیار دانش‌آموزان قرار
                                                                        گیرد.
                                                                    </li>
                                                                </ul>

                                                                <h5>تعهدات کارفرما</h5>
                                                                <p>
                                                                    کارفرما موظف است پس از تعیین هزینه کلاس توسط مدرس و
                                                                    ثبت‌نام دانش‌آموزان، ۶۵ درصد از هزینه را در هر زمانی
                                                                    که مدرس تقاضا کند، در اختیار وی قرار دهد.
                                                                </p>

                                                                <h5>مدت قرارداد</h5>
                                                                <p>
                                                                    این قرارداد تا زمانی که دوره‌های مدرس بر روی سایت
                                                                    حلزون وجود دارد دارای اعتبار می‌باشد و پس از آن از
                                                                    درجه اعتبار خارج خواهد شد.
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <textarea name="message" class="form-control"
                                                                  rows="3">اینجانب {{ $user->name }} {{ $user->family }}، با تکمیل اطلاعات و مدارک خواسته شده، به این‌وسیله درخواست تایید حساب کاربری خود را دارم.اینجانب قوانین سایت را مطالعه کرده‌ام و تمام اطلاعات و مدارکی که تکمیل کرده‌ام به درستی وارد شده است. همچنین می‌دانم که مسئولیت هرگونه اشتباه در اطلاعات وارد شده بر عهده خودم خواهد بود.</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                        <button type="submit" class="btn btn-success">ارسال درخواست
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>


                    </div>
                @endif

                <div class=" p-4 rounded {{$user->is_verify == 0 ? "col-lg-7" : "col-lg-12"}}"
                     style="background: linear-gradient(180deg, rgba(81, 46, 136, 0.1) 21%, rgba(251, 137, 49, 0.1) 80%);">

                    <form method="post" action="{{route('teachers.information')}}" id="main_form">
                        @method('PUT')
                        @csrf
                        <!-- اطلاعات فردی -->
                        <div class="bg-white p-4 rounded shadow mb-4">
                            <h5 class="mb-3">اطلاعات فردی</h5>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="name">نام:</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                           value="{{ old('name') ?: $user->name }}" placeholder="نام خود را وارد کنید.">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="family">نام خانوادگی:</label>
                                    <input class="form-control" type="text" name="family" id="family"
                                           value="{{ old('family') ?: $user->family }}"
                                           placeholder="نام خانوادگی خود را وارد کنید.">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="email">پست الکترونیک:</label>
                                    <input class="form-control" type="email" name="email" id="email"
                                           value="{{ old('email') ?: $user->email }}"
                                           placeholder="ایمیل خود را وارد کنید.">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="nationalCode">کد ملی:</label>
                                    <input class="form-control" type="text" name="nationalCode" id="nationalCode"
                                           value="{{ old('nationalCode') ?: $user->nationalCode }}"
                                           placeholder="کد ملی خود را وارد کنید.">
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="gender">جنسیت:</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" selected>انتخاب کنید</option>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                            آقا
                                        </option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                            خانم
                                        </option>
                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>
                                            دیگر
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="birthday">تاریخ تولد:</label>
                                    <input data-jdp type="text" class="form-control" id="birthday" name="birthday"
                                           value="{{ !is_null($user->birthday) ? str_replace('-', '/', jdate($user->birthday)->toDateString()) : old('birthday') }}">

                                </div>
                                <div class="col-12">
                                    <label for="description">توضیحات:</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"
                                              placeholder="توضیحات خود را وارد کنید.">{{ old('description') ?: $user->description }}</textarea>
                                </div>

                            </div>
                            <div class="d-flex justify-content-end w-100 mt-3">
                                <button type="submit" class="btn  btn-success ">ثبت اطلاعات فردی</button>
                            </div>

                        </div>
                    </form>

                    <!-- دسته‌بندی‌ها -->
                    <div class="bg-white p-4 rounded shadow mb-4">
                        <form method="post" action="{{route('teachers.information.category')}}" id="main_form">
                            @method('PUT')
                            @csrf


                            <h5 class="mb-3">دسته‌بندی تدریس</h5>
                            <div class="form-group">
                                <label for="main-categories">دسته‌بندی‌های اصلی:</label>
                                <select name="main-categories[]" id="main-categories" class="form-control" multiple>
                                    <!-- دسته‌بندی‌های مادر به صورت داینامیک بارگذاری می‌شوند -->

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if (in_array($category->id, $mainCategories)) selected @endif>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub-categories">زیر دسته‌بندی‌ها:</label>
                                <select name="sub-categories[]" id="sub-categories" class="form-control" multiple>
                                    <!-- زیر دسته‌بندی‌ها به صورت داینامیک بارگذاری می‌شوند -->

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if (in_array($category->id, $subCategories)) selected @endif>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="d-flex justify-content-end w-100 mt-3">
                                <button type="submit" class="btn  btn-success ">دسته بندی های تدریس</button>
                            </div>
                        </form>
                    </div>



                        <div class="bg-white p-4 rounded shadow mb-4">
                            <form action="{{ route('teachers.files.upload.complete') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf


                                <div class="bg-white p-4 rounded shadow mb-4">
                                    <form action="{{ route('teachers.files.upload.complete') }}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <!-- تصویر پروفایل -->
                                        <div class="mb-4">
                                            <h5 class="mb-3">تصویر پروفایل <span class="text-danger">*</span></h5>
                                            <div class="row">
                                                @if($user->avatar)
                                                    <!-- بررسی اینکه آیا تصویر پروفایل وجود دارد -->
                                                    <div class="col-12 col-md-2">
                                                        <div class="card">
                                                            <img src="{{ $user->avatar }}"
                                                                 class="card-img-top" alt="تصویر پروفایل"
                                                                 style="height: 100px; object-fit: cover;">
                                                            <div class="card-body">
                                                                <a href="{{$user->avatar}}" target="_blank"
                                                                   class="btn btn-primary btn-sm">مشاهده</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" name="avatar" class="form-control"
                                                               placeholder="تصویر جدید را انتخاب کنید">
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <input type="file" name="avatar" class="form-control">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>






                                        @if($user->is_verify == 0)


                                        <!-- کارت ملی -->
                                        <div class="mb-4">
                                            <h5 class="mb-3">کارت ملی <span class="text-danger">*</span></h5>
                                            <div class="row">
                                                @if($user->id_card)
                                                    <!-- بررسی اینکه آیا کارت ملی وجود دارد -->
                                                    <div class="col-12 col-md-2">
                                                        <div class="card">
                                                            <img src="{{ $user->id_card}}"
                                                                 class="card-img-top" alt="کارت ملی"
                                                                 style="height: 100px; object-fit: cover;">
                                                            <div class="card-body">
                                                                <a href="{{$user->id_card}}" target="_blank"
                                                                   class="btn btn-primary btn-sm">مشاهده</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" name="id_card" class="form-control"
                                                               placeholder="کارت ملی جدید را انتخاب کنید">
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <input type="file" name="id_card" class="form-control">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- آخرین مدرک تحصیلی -->
                                        <div class="mb-4">
                                            <h5 class="mb-3">آخرین مدرک تحصیلی</h5>
                                            <div class="row">
                                                @if($user->last_certificate)
                                                    <!-- بررسی اینکه آیا مدرک تحصیلی وجود دارد -->
                                                    <div class="col-12 col-md-2">
                                                        <div class="card">
                                                            <img src="{{ $user->last_certificate}}"
                                                                 class="card-img-top" alt="مدرک تحصیلی"
                                                                 style="height: 100px; object-fit: cover;">
                                                            <div class="card-body">
                                                                <a href="{{$user->last_certificate }}"
                                                                   target="_blank"
                                                                   class="btn btn-primary btn-sm">مشاهده</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" name="last_certificate" class="form-control"
                                                               placeholder="مدرک تحصیلی جدید را انتخاب کنید">
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <input type="file" name="last_certificate" class="form-control">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- رزومه کاری -->
                                        <div class="mb-4">
                                            <h5 class="mb-3">رزومه کاری</h5>
                                            <div class="row">
                                                @if($user->resume)
                                                    <!-- بررسی اینکه آیا رزومه کاری وجود دارد -->
                                                    <div class="col-12 col-md-2">
                                                        <div class="card">
                                                            <img src="{{$user->resume}}"
                                                                 class="card-img-top" alt="رزومه کاری"
                                                                 style="height: 100px; object-fit: cover;">
                                                            <div class="card-body">
                                                                <a href="{{$user->resume}}" target="_blank"
                                                                   class="btn btn-primary btn-sm">مشاهده</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" name="resume" class="form-control"
                                                               placeholder="رزومه جدید را انتخاب کنید">
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <input type="file" name="resume" class="form-control">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @endif


                                        <div class="mb-4">
                                            <h5 class="mb-3">ویدیو معرفی </h5>
                                            <div class="row">
                                                <p>با آپلود ویدیو معرفی خود، پروفایل شما برجسته‌تر از همیشه خواهد شد! این ویدیو در پروفایل عمومی شما نمایش داده می‌شود و به دیگران کمک می‌کند تا بهتر با شما و مهارت‌هایتان آشنا شوند. این کار کاملاً اختیاری است، اما فرصتی عالی برای دیده شدن بیشتر است!</p>

                                                @if($user->video)
                                                    <div class="col-12 col-md-2">
                                                        <div class="card">
                                                            <video class="card-img-top" width="320" height="240" controls>
                                                                <source src="{{ $user->video}}" type="video/mp4">
                                                                <source src="{{ $user->video}}" type="video/ogg">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                            <div class="card-body">
                                                                <a href="{{$user->video}}" target="_blank"
                                                                   class="btn btn-primary btn-sm">مشاهده</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="file" name="video" class="form-control"
                                                               placeholder="فایل ویدیو معرفی خود را وارد کنید.">
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <input type="file" name="video" class="form-control">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>



                                        <div class="d-flex justify-content-end w-100 mt-3">
                                            <button type="submit" class="btn  btn-success ">ثبت مدارک</button>
                                        </div>

                                    </form>
                                </div>


                            </form>
                        </div>


                </div>


                @section('script')
                    <script>
                        $(document).ready(function () {
                            // Initialize Select2 for main categories
                            $('#main-categories').select2({
                                theme: 'bootstrap-5',

                                placeholder: 'دسته‌بندی‌های اصلی را انتخاب کنید',
                                ajax: {
                                    url: "{{ route('teachers.categories.main') }}", // استفاده از نام روت
                                    dataType: 'json',
                                    processResults: function (data) {
                                        return {
                                            results: data.map(function (item) {
                                                return {id: item.id, text: item.title};
                                            })
                                        };
                                    }
                                }
                            });

                            // Initialize Select2 for sub categories
                            $('#sub-categories').select2({
                                theme: 'bootstrap-5',
                                placeholder: 'زیر دسته‌بندی‌های مرتبط را انتخاب کنید',
                                ajax: {
                                    url: "{{ route('teachers.categories.sub') }}", // استفاده از نام روت
                                    type: 'POST',
                                    dataType: 'json',
                                    delay: 250,
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // اضافه کردن CSRF Token
                                    },
                                    data: function () {
                                        // ارسال دسته‌بندی‌های انتخابی از فیلد اول
                                        return {
                                            category_ids: $('#main-categories').val()
                                        };
                                    },
                                    processResults: function (data) {
                                        return {
                                            results: data.map(function (item) {
                                                return {id: item.id, text: item.title};
                                            })
                                        };
                                    }
                                }
                            });

                            // Refresh sub-categories when main categories change
                            $('#main-categories').on('change', function () {

                                $('#sub-categories').val(null).trigger('change'); // Reset sub-categories
                            });
                        });

                    </script>


                    <script>
                        document.getElementById('submit-btn').addEventListener('click', function () {
                            // بررسی فایل‌های آپلود شده برای هر dropzone
                            var avatarDropzone = Dropzone.forElement("#avatar-dropzone");
                            var idCardDropzone = Dropzone.forElement("#id-card-dropzone");
                            var certificateDropzone = Dropzone.forElement("#certificate-dropzone");
                            var resumeDropzone = Dropzone.forElement("#resume-dropzone");

                            // ارسال فایل‌ها با استفاده از Ajax به کنترلر
                            var allFiles = [
                                ...avatarDropzone.files,
                                ...idCardDropzone.files,
                                ...certificateDropzone.files,
                                ...resumeDropzone.files
                            ];

                            if (allFiles.length === 0) {
                                alert("لطفا فایل‌ها را آپلود کنید.");
                                return;
                            }

                            // ارسال درخواست Ajax برای آپلود فایل‌ها
                            var formData = new FormData();
                            allFiles.forEach(function (file) {
                                formData.append('file[]', file);
                            });

                            // ارسال نوع فایل‌ها
                            formData.append('type', 'multiple'); // نوع فایل‌ها (چندگانه)

                            // ارسال داده‌ها به کنترلر
                            fetch("{{ route('teachers.files.upload.complete') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert("فایل‌ها با موفقیت آپلود شدند.");
                                        // اضافه کردن هر چیزی که نیاز دارید برای مدیریت پاسخ
                                    } else {
                                        alert("مشکلی در آپلود فایل‌ها پیش آمده است.");
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert("خطا در ارسال فایل‌ها.");
                                });
                        });

                    </script>
    @endsection


    @endsection
@endcomponent