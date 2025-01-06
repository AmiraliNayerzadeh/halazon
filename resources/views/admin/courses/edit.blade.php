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
                    </ol>
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills nav-fill bg-transparent">
                        <li class="nav-item">
                            <a class="nav-link bg-primary text-white" aria-current="page" href="#">مشخصات کلّی</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link " href="{{route('admin.schedules.index', $course)}}">زمان بندی کلاس</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  " href="{{route('admin.headline.index', $course)}}">سرفصل ها</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>


        <form action="{{route('admin.courses.update' , $course)}}" method="post" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-light"><h4 class="text-primary">
                                <i class="mx-2 fa fa-info"></i>مشخصات کلّی</h4></div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="title">نام دوره</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="عنوان دوره را وارد کنید."
                                               value="{{old('title') ? old('title') : $course->title }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="type">نوع دوره</label>
                                        <select class="form-control" name="type" id="type">
                                            <option {{ old('type', $course->type) == 'online' ? 'selected' : '' }} value="online">
                                                آنلاین
                                            </option>
                                            <option {{ old('type', $course->type) == 'offline' ? 'selected' : '' }} value="offline">
                                                آفلاین
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="teacher_id">دبیر دوره:</label>
                                        <select class="form-control select2" name="teacher_id" id="teacher_id">
                                            <option> مشخص کنید</option>
                                            @foreach(\App\Models\User::where('is_teacher' , 1)->get() as $teacher)
                                                <option {{$course->teacher->id == $teacher->id  ? 'selected' : ''}} value="{{$teacher->id}}">{{$teacher->name}} {{$teacher->family}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="capacity">ظرفیت کلاس </label>
                                        <input type="number" name="capacity" id="capacity" class="form-control"
                                               placeholder="کلاس در چند هفته برگزار میشود؟"
                                               value="{{old('capacity') ? old('capacity') : $course->capacity }}">
                                    </div>
                                </div>


                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="price">قیمت دوره: </label>
                                        <input type="number" name="price" id="price" class="form-control"
                                               placeholder="قیمت دوره را به تومان وارد کنید"
                                               value="{{old('price') ? old('price') : $course->price }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="discount_price">تخفیف (تومان): </label>
                                        <input type="number" name="discount_price" id="discount_price"
                                               class="form-control" placeholder="مبلغ تخفیف را وارد کنید."
                                               value="{{old('discount_price') ? old('discount_price') : $course->discount_price }}">
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4">
                                    <div class="form-group">
                                        <label class="form-label" for="degrees">مقطع:</label>
                                        <select class="form-control select2" name="degrees[]" id="degrees" multiple>
                                            <option> مشخص کنید</option>
                                            @foreach(\App\Models\Degree::all() as $degree)
                                                <option {{in_array($degree->id , $course->degrees->pluck('id')->toArray()) ? 'selected ' : ''}}  value="{{$degree->id}}">{{$degree->title}}</option>
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
                                               value="{{old('image') ? old('image') : $course->image }}">
                                    </div>
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
                                               value="{{old('video') ? old('video') : $course->video }}">
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
                                       placeholder="بازه شروع"
                                       value="{{old('age_from') ? old('age_from') : $course->age_from }}">
                                <bdi>تا</bdi>
                                <input type="number" name="age_to" id="age_to" class="form-control w-auto mx-2"
                                       placeholder="بازه پایان"
                                       value="{{old('age_to') ? old('age_to') : $course->age_to }}">
                                <bdi>می باشد.</bdi>
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
                            <div class="col-lg-12 d-flex align-items-center mt-4">
                                <span class="mx-2">این کلاس در </span>
                                <input type="number" name="class_duration" id="class_duration"
                                       class="form-control w-auto" placeholder="تعداد جلسات "
                                       value="{{old('class_duration') ? old('class_duration') : $course->class_duration }}">
                                <span class="mx-2"> جلسه و در هفته </span>
                                <input type="number" name="weeks" id="weeks" class="form-control w-auto"
                                       placeholder="تعداد هفته"
                                       value="{{old('weeks') ? old('weeks') : $course->weeks }}">
                                <span class="mx-2">بار برگذار میشود که مدّت هر جلسه  </span>
                                <input type="number" name="minutes" id="minutes" class="form-control w-auto"
                                       placeholder="مثال 30 "
                                       value="{{old('minutes') ? old('minutes') : $course->minutes }}">
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
                                            ابتدا مقدمه ای کوتاه درباره درس و با مهارتی که میخواهید تدریس کنید  + مشخص کردن آنلاین و یا آفلاین بودن + تعداد جلسات کلاس + آنچه در نهایت دانش آموزان از کلاس شما یاد میگیرند آورده شود.
                                        </p>
                                    </div>
                                    <label class="form-label" for="description">توضیحات </label>
                                    <textarea name="description" id="editor" cols="30"
                                              rows="10">{!! old('description') ? old('description') : $course->description !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if(count($course->questions))

                        <div class="card my-3">
                            <div class="card-header bg-light">
                                <h4 class="text-primary">
                                    <li class="mx-2 fa fa-question-circle"></li>
                                    سوالات متداول
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    @foreach ($questions as $question)
                                        <div class="mb-4">
                                            <label for="questions[{{ $loop->index }}][answer]"
                                                   class="block text-gray-700">
                                                {{ $question->question }}
                                            </label>
                                            <input type="hidden" name="questions[{{ $loop->index }}][id]" value="{{ $question->id }}">
                                            <textarea id="questions[{{ $loop->index }}][answer]"
                                                      name="questions[{{ $loop->index }}][answer]"
                                                      class="form-control w-full">{{ old("questions.$loop->index.answer", $question->answer) }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    @endif


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
                                               type="checkbox"
                                               id="{{$parent->id}}" {{in_array($parent->id , $course->categories->pluck('id')->toArray()) ? 'checked ' : ''}}>
                                        <label class="form-check-label fw-bold"
                                               for="{{$parent->id}}">{{$parent->title}}</label>
                                    </div>
                                    @foreach($parent->children as $child)
                                        <div class="form-check  me-3">
                                            <input name="category[]" value="{{$child->id}}" class="form-check-input"
                                                   type="checkbox"
                                                   id="{{$child->id}}" {{in_array($child->id , $course->categories->pluck('id')->toArray()) ? 'checked ' : ''}}>
                                            <label class="form-check-label"
                                                   for="{{$child->id}}">{{$child->title}}</label>
                                        </div>

                                        @foreach($child->children as $child2)
                                            <div class="form-check mb-2 me-5">
                                                <input name="category[]" value="{{$child2->id}}"
                                                       class="form-check-input" type="checkbox"
                                                       id="{{$child2->id}}" {{in_array($child2->id , $course->categories->pluck('id')->toArray()) ? 'checked ' : ''}}>
                                                <label class="form-check-label"
                                                       for="{{$child2->id}}">{{$child2->title}}</label>
                                            </div>
                                        @endforeach

                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3 ">
                        <div class="card-header bg-light">
                            <h5 class="text-primary fw-bold">
                                <li class="mx-2 fa fa-search mx-2"></li>
                                موتور های جستجو
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="my-3">
                                <label class="form-label" for="slug">اسلاگ (نامک):</label>
                                <input class="form-control" type="text" name="slug" id="slug"
                                       value="{{old('slug') ? old('slug') : $course->slug}}"
                                       placeholder="آدرس  صفحه ی دسته بندی را وارد کنید...">
                            </div>


                            <div class="my-3">
                                <label class="form-label" for="meta_title">مِتا تایل:</label>
                                <input class="form-control" type="text" name="meta_title"
                                       id="meta_title"
                                       value="{{old('meta_title') ? old('meta_title') : $course->meta_title}}"
                                       placeholder="متا تایتل صفحه ی دسته بندی را وارد کنید...">
                            </div>

                            <div class="my-3">
                                <label class="form-label" for="meta_keywords">کلمات کلیدی:</label>
                                <input class="form-control" type="text" name="meta_keywords"
                                       id="meta_keywords"
                                       value="{{old('meta_keywords') ? old('meta_keywords') : $course->meta_keywords}}"
                                       placeholder="با استفاده از , جدا کنید.">
                            </div>

                            <div class="my-3">
                                <label class="form-label" for="meta_description">مِتا دیسکرپشن:</label>
                                <textarea class="form-control" name="meta_description"
                                          id="meta_description"
                                          cols="30"
                                          rows="3">{{old('meta_description') ? old('meta_description') : $course->meta_description}}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="card position-sticky fixed-top">
                        <div class="card-header bg-light">
                            <h5>
                                <li class="mx-2 fa fa-money-bills mx-2"></li>
                                درصد مشارکت
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="alert alert-light">
                                            <b>درصد ها به طور معمول به شرح زیر است:</b>
                                            <ul>
                                                <li>دوره آنلاین: 65%</li>
                                                <li>دوره هیبرید: 70%</li>
                                                <li>دوره آنلاین: 75%</li>
                                            </ul>
                                        </div>
                                        <label for="revenue">درصد سهم معلّم:</label>
                                        <input class="form-control" type="number" name="revenue" id="revenue" value="{{old('revenue') ? old('revenue') : $course->revenue}}" max="100">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>




                    <div class="card position-sticky fixed-top mt-3">
                        <div class="card-header bg-success">
                            <h5>
                                <li class="mx-2 fa fa-save mx-2"></li>
                                انتشار
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-warning w-100" name="is_draft" value="1" type="submit">ذخیره
                                        پیش نویس
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-success w-100" name="is_draft" value="0" type="submit">انتشار
                                        دوره
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

        @endsection

    @endsection
@endcomponent