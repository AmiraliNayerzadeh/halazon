@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>ایجاد کاربر جدید</h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{route('admin.users.index')}}">کاربران</a></li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">ایجاد</li>
                    </ol>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{route('admin.users.update' , $user)}}" method="post" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="name">نام:</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                               placeholder="نام را وارد کنید."
                                               value="{{old('name') ? old('name') : $user->name }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="family">نام خانوداگی:</label>
                                        <input class="form-control" type="text" name="family" id="family"
                                               placeholder="نام خانوادگی را وارد کنید."
                                               value="{{old('family') ? old('family') : $user->family }}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="gender">جنسیت:</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}  value="male">
                                                آقا
                                            </option>
                                            <option {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}  value="female">
                                                خانم
                                            </option>
                                            <option {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }} {{$user->gender == 'other' ? 'selected' : ''}}  value="other">
                                                نا مشحخص
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="phone">شماره تلفن:</label>
                                        <input class="form-control" type="number" name="phone" id="phone"
                                               placeholder=".شماره تلفن معتبر کاربر را وارد کنید"
                                               value="{{old('phone') ? old('phone') : $user->phone }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="email">ایمیل:</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="ایمیل را وارد کنید" value="{{old('email') ? old('email') : $user->email }}" autocomplete="new-main">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="birthday">تاریخ تولد:</label>
                                        <input data-jdp type="text" class="form-control" id="birthday" name="birthday" value="{{!is_null($user->birthday) ? str_replace('-', '/', jdate($user->birthday)->toDateString()) : old('birthday')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="nationalCode">کُد ملی:</label>
                                        <input name="nationalCode" type="number" id="nationalCode" class="form-control"
                                               value="{{old('nationalCode') ? old('nationalCode') : $user->nationalCode }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="address">آدرس:</label>
                                        <input name="address" type="text" id="address" class="form-control"
                                               value="{{old('address') ? old('address') : $user->address }}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="postalCode">کد پُستی:</label>
                                        <input name="postalCode" type="number" id="postalCode" class="form-control"
                                               value="{{old('postalCode') ? old('postalCode') : $user->postalCode }}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="password">رمز عبور:</label>
                                        <input name="password" type="password" id="password" class="form-control"
                                               value="{{old('password')}}"/>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="password">تصویر:</label>

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="avatar"
                                                   value="{{old('avatar') ? old('avatar') : $user->avatar }}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="id_card">کارت ملی:</label>

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm-id-card" data-input="thumbnail" data-preview="holder"
                                                class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="id_card"
                                                   value="{{old('id_card') ? old('id_card') : $user->id_card }}">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="password">ویدیو:</label>

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm-video" data-input="video" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-video-camera"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                            <input id="video" class="form-control" type="text" name="video" value="{{old('video') ? old('video') : $user->video }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="is_verify">نوع: (فقط برای معلمین اجباری است)</label>
                                        <select class="form-control" name="is_verify" id="is_verify">
                                            <option>نامشخص</option>
                                            <option {{ old('is_verify', $user->is_verify) == '0' ? 'selected' : '' }} value="0">تایید نشده</option>
                                            <option {{ old('is_verify', $user->is_verify) == '1' ? 'selected' : '' }} value="1">تایید شده</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="type">وضعیت:</label>
                                        <select class="form-control" name="is_teacher" id="type">
                                            <option {{ old('is_teacher', $user->is_teacher) == '0' ? 'selected' : '' }} value="0">کاربر</option>
                                            <option {{ old('is_teacher', $user->is_teacher) == '1' ? 'selected' : '' }} value="1">دبیر</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="is_admin">دسترسی ادمین:</label>
                                        <select class="form-control" name="is_admin" id="is_admin">
                                            <option {{ $user->is_admin == '0' ? 'selected' : '' }} value="0">
                                                ندارد
                                            </option>
                                            <option {{ $user->is_admin == '1' ? 'selected' : '' }} value="1">
                                                دارد
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="my-2">
                                        <label class="form-label" for="categories">دسته بندی:</label>
                                        <select class="form-control select2" name="categories[]" id="categories" multiple>
                                            @foreach(\App\Models\Category::all() as $category)
                                                <option {{in_array($category->id , $user->categories->pluck('id')->toArray()) ? 'selected ' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <label class="form-label" for="description">توضیحات </label>
                                    <textarea name="description" id="editor" cols="30" rows="10">{{old('description') ? old('description') : $user->description }}</textarea>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">بروزرسانی</button>
                        </div>
                    </form>

                </div>
            </div>


            <div class="card">
                <div class="card-header">موارد بارگذاری شده:</div>
                <div class="card-body">
                    <div class="row">

                        @if(!is_null($user->avatar))
                        <div class="col-lg-3">
                            <div class="card h-100 border shadow">
                                <div class="card-header bg-secondary text-white">تصویر پروفایل</div>
                                <div class="card-body">
                                    <img src="{{$user->avatar}}" class="img-fluid ">
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-sm btn-secondary" href="{{$user->avatar}}">مشاهده</a>
                                </div>
                            </div>
                        </div>
                        @endif


                            @if(!is_null($user->id_card))
                                <div class="col-lg-3">
                                    <div class="card h-100 border shadow">
                                        <div class="card-header bg-secondary text-white">کارت ملی</div>
                                        <div class="card-body">
                                            <img src="{{$user->id_card}}" class="img-fluid ">
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-sm btn-secondary" href="{{$user->id_card}}">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if(!is_null($user->last_certificate))
                                <div class="col-lg-3">
                                    <div class="card h-100 border shadow">
                                        <div class="card-header bg-secondary text-white">آخرین مدرک تحصیلی</div>
                                        <div class="card-body">
                                            <img src="{{$user->last_certificate}}" class="img-fluid ">
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-sm btn-secondary" href="{{$user->last_certificate}}">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(!is_null($user->resume))
                                <div class="col-lg-3">
                                    <div class="card h-100 border shadow">
                                        <div class="card-header bg-secondary text-white">رزومه</div>
                                        <div class="card-body">
                                            <img src="{{$user->resume}}" class="img-fluid ">
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-sm btn-secondary" href="{{$user->resume}}">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            @endif




                    </div>
                </div>
            </div>

        </div>

        @section('script')

            <script>
                jalaliDatepicker.startWatch();
            </script>

            <script>
                $('#lfm').filemanager('image');
                $('#lfm-video').filemanager('image');
                $('#lfm-id-card').filemanager('image');

            </script>

            <script>
                $(document).ready(function () {

                    $('.select2').select2({
                        theme: 'bootstrap-5'
                    });
                });
            </script>

        @endsection

    @endsection
@endcomponent
