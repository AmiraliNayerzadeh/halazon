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
                    <form action="{{route('admin.users.store')}}" method="post" autocomplete="off">
                        @csrf
                        @method('POST')
                        <div class="card-body p-4">
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="name">نام:</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                               placeholder="نام را وارد کنید." value="{{old('name')}}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="family">نام خانوداگی:</label>
                                        <input class="form-control" type="text" name="family" id="family"
                                               placeholder="نام خانوادگی را وارد کنید." value="{{old('family')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="gender">جنسیت:</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option disabled selected>جنسیت کاربر را مشخص کنید.</option>
                                            <option {{old('gender') == 'male' ? 'selected' : ''}} value="male">آقا
                                            </option>
                                            <option {{old('gender') == 'female' ? 'selected' : ''}} value="female">خانم
                                            </option>
                                            <option {{old('gender') == 'other' ? 'selected' : ''}} value="other">
                                                نا مشحخص
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="phone">شماره تلفن:</label>
                                        <input class="form-control" type="number" name="phone" id="phone"
                                               placeholder=".شماره تلفن معتبر کاربر را وارد کنید" value="{{old('phone')}}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="email">ایمیل:</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder=".ایمیل را وارد کنید" value="{{old('email')}}" autocomplete="off">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="birthday">تاریخ تولد:</label>
                                        <input data-jdp type="text" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="nationalCode">کُد ملی:</label>
                                        <input name="nationalCode" type="number" id="nationalCode" class="form-control" value="{{old('nationalCode')}}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="address">آدرس:</label>
                                        <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="postalCode">کد پُستی:</label>
                                        <input name="postalCode" type="number" id="postalCode" class="form-control" value="{{old('postalCode')}}">
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="password">رمز عبور:</label>
                                        <input name="password" type="password" id="password" class="form-control"  value="{{old('password')}}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="my-2">
                                        <label class="form-label" for="password">تصویر:</label>

                                        <div class="input-group">
                                           <span class="input-group-btn">
                                             <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i>
                                                 انتخاب
                                             </a>
                                           </span>
                                            <input id="thumbnail" class="form-control" type="text" name="avatar">
                                        </div>
                                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                    </div>
                                </div>


                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="is_teacher">نوع:</label>
                                        <select class="form-control" name="is_teacher" id="is_teacher">
                                            <option {{old('is_teacher') == '0' ? 'selected' : ''}} value="0">کاربر</option>
                                            <option {{old('is_teacher') == '1' ? 'selected' : ''}} value="1">دبیر</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-2">
                                    <div class="my-2">
                                        <label class="form-label" for="is_admin">دسترسی ادمین:</label>
                                        <select class="form-control" name="is_admin" id="is_admin">
                                            <option {{old('is_admin') == '0' ? 'selected' : ''}} value="0">ندارد</option>
                                            <option {{old('is_admin') == '1' ? 'selected' : ''}} value="1">دارد</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">ثبت کاربر</button>
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