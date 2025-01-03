@component('.admin.layout.master')
    @section('content')

        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                 style="background-image: url('/assets/admin/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{$user->avatar}}" alt="profile_image"
                                 class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{$user->name}} {{$user->family}}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                @if($user->is_teacher == 1)
                                    معلم
                                    |
                                    <b>وضعیت:</b>
                                    @if($user->is_verify == 1)
                                        <span class="text-success">تایید شده</span>
                                    @elseif($user->is_verify == 0)
                                        <span class="text-danger">تایید شده</span>
                                    @else
                                        <span class="text-danger">نامشخص</span>
                                    @endif
                                @else
                                    کاربر
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid py-4">
            <div class="row mt-3">

                <div class="col-12 col-md-6 col-xl-12 mt-md-0 my-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">مشخصات کاربری</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="{{route('admin.users.edit' , $user)}}">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                           data-bs-placement="top" title="Edit Profile"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                {!! $user->description !!}
                            </p>
                            <hr class="horizontal gray-light my-4">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">شماره
                                        تماس:</strong>
                                    <a href="tel:+98{{$user->phone}}">{{$user->phone}}</a>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">پست
                                        الکترونیک:</strong>
                                    {{!is_null($user->email) ? $user->email : 'وارد نشده است.'}}
                                </li>

                                <li class="list-group-item border-0 ps-0 text-sm"><strong
                                            class="text-dark">آدرس:</strong>
                                    {{!is_null($user->address) ? $user->address : 'وارد نشده است.'}}
                                </li>

                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">تاریخ
                                        تولد:</strong>
                                    {{!is_null($user->birthday) ? jdate($user->birthday)->toDateString() : 'وارد نشده است.'}}
                                </li>

                                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">زمان ثبت نام:</strong>
                                    {{jdate($user->created_at)}}
                                    <span class="mx-1 text-info">({{jdate($user->created_at)->ago()}})</span>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-xl-12 mt-xl-0 my-9">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">
                                سفارش های ثبت شده

                                <span class="text-info">
                                    ({{count($user->orders)}})
                                </span>
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @if(count($user->orders))
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>شماره</th>
                                            <th>سفارش دهنده</th>
                                            <th>درگاه</th>
                                            <th>وضعیت</th>
                                            <th>تعداد آیتم ها</th>
                                            <th>مبلغ بدون تخفیف</th>
                                            <th>تخفیف</th>
                                            <th>مبلغ نهایی</th>
                                            <th>زمان ایجاد</th>
                                            <th>آیتم ها</th>
                                            <th>مشاهده</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->orders as $order)
                                            <tr>

                                                <td>#{{$order->id}}</td>

                                                <td>
                                                    <a href="{{route('admin.users.show' , $order->user)}}">{{$order->user->name}} {{$order->user->family}}</a>
                                                </td>


                                                <td>
                                                    @if($order->method == 'ZarinPal')
                                                        <img class="img-fluid" src="/assets/admin/zplogo.png" alt="ZarinPall"
                                                             title="درگاه پرداخت زرین پال" style="height: 4rem">
                                                    @endif
                                                </td>


                                                <td>{{$order->status}}</td>

                                                <td>{{$order->qty}}</td>


                                                <td>{{number_format($order->total_pure_price)}} تومان</td>

                                                <td>{{number_format($order->total_discount_price)}} تومان</td>

                                                <td>{{number_format($order->total)}} تومان</td>


                                                <td>{{jdate($order->created_at)}}</td>


                                                <td>{{jdate($order->created_at)}}</td>


                                                <td>
                                                    <a class="btn btn-primary"
                                                       href="{{route('admin.orders.show' , $order)}}">مشاهده</a>
                                                </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>


                                @else
                                    <span>کاربر سفارشی ثبت نکرده است.</span>
                                @endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    @endsection
@endcomponent