@component('.admin.layout.master')
    @section('content')

        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{$support->user->avatar}}" alt="profile_image"
                                 class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{$support->user->name}}  {{$support->user->family}}
                            </h5>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3 p-4">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    <a class=" mb-0 px-0 py-1  ">
                                        <span class="ms-1"></span>
                                        زمان ایجاد:
                                        {{jdate($support->created_at)}}
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a class=" mb-0 px-0 py-1  ">
                                        <span class="ms-1"></span>
                                        وضعیت فعلی:
                                        {{$support->status_translated}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-4">
                    <div class="card blur shadow-blur max-height-vh-70 overflow-auto overflow-x-hidden mb-5 mb-lg-0">

                        <div class="card-body p-2">
                            <form class="d-grid" action="" method="post">
                                <h5>
                                    وضعیت تیکت:
                                </h5>
                                <p>پس از ثبت پاسخ وضعیت تیکت به طور خودکار به پاسخ داده شده تغیر پیدا میکند.</p>

                                <button class="btn btn-success grid my-2" name="status" value="closed" type="submit">
                                    بستن
                                </button>

                                <button class="btn btn-info grid my-2" name="status" value="in-progress" type="submit">
                                    در حال انجام
                                </button>
                            </form>
                        </div>


                        <div class="card-body p-2">
                            <hr>

                            @if($support->supportable_type == "App\Models\User")
                                <form class="d-grid" action="" method="post">
                                    برای بررسی و یا ویرایش کاربر میتوانید از این دکمه استفاده کنید.
                                    <a class="btn btn-warning" href="{{route('admin.users.edit' , $support->supportable)}}">ویرایش کاربر</a>
                                </form>
                            @endif

                            @if($support->supportable_type == "App\Models\Course")
                                <form class="d-grid" action="" method="post">
                                    برای بررسی و یا ویرایش این دوره میتوانید از این دکمه استفاده کنید.
                                    <a class="btn btn-warning" href="{{route('admin.courses.edit' , $support->supportable)}}">مشاهده و ویرایش دوره</a>
                                </form>
                            @endif

                        </div>


                    </div>
                </div>
                <div class="col-8">
                    <div class="card blur shadow-blur max-height-vh-70">
                        <div class="card-header shadow-lg">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <h6 class="mb-0 d-block">
                                                عنوان تیکت:
                                                {{$support->title}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body overflow-auto overflow-x-hidden">

                            <div class="row justify-content-start mb-4">
                                <div class="col-auto">
                                    <div class="card ">
                                        <div class="card-body py-2 px-3">
                                            <p class="mb-1">
                                                {{$support->message}}
                                            </p>
                                            <div class="d-flex align-items-center text-sm opacity-6">
                                                <i class="ni ni-check-bold text-sm me-1"></i>
                                                <small>{{jdate($support->created_at)->ago()}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @if(count($support->children) != 0)

                                @foreach($support->children as $child)
                                    <div class="row justify-content-end text-right mb-4">
                                        <div class="col-auto">
                                            <div class="card bg-gray-200">
                                                <div class="card-body py-2 px-3">
                                                    <p class="mb-1">
                                                        {{$child->message}}
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-end text-sm opacity-6">
                                                        <i class="ni ni-check-bold text-sm me-1"></i>
                                                        <small>{{jdate($child->created_at)->ago()}}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif


                        </div>
                        <div class="card-footer d-block">
                            <form method="post" class="align-items-center"
                                  action="{{route('admin.supports.update' , $support)}}">
                                @csrf
                                @method('PUT')
                                <div class="d-flex">
                                    <div class="input-group">
                                        <input type="hidden" name="parent_id" value="{{$support->id}}">
                                        <input name="message" type="text" class="form-control"
                                               placeholder="پاسخ خود را اینجا بنویسید."
                                               aria-label="Message example input">
                                    </div>
                                    <button type="submit" class="btn bg-gradient-primary mb-0 ms-2">
                                        <i class="ni ni-send"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
@endcomponent