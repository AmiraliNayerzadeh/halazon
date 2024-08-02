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
                                        <input class="form-control" type="email" name="email" id="email"
                                               placeholder=".ایمیل را وارد کنید"
                                               value="{{old('email') ? old('email') : $user->email }}"
                                               autocomplete="off">
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


                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="type">نوع:</label>
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


                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">بروزرسانی</button>
                        </div>
                    </form>

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

        @endsection

    @endsection
@endcomponent