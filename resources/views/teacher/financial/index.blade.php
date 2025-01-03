@component('.teacher.layout.master')
    @section('content')
        <div class="col-12">

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">درامد کلّ:</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($totalRevenue)}} تومان
                                        </h5>


                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">درامد تسویه نشده</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($totalNotSettled)}} تومان

                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-sm-6 mt-sm-0 mt-4">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">تعداد فروش</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format(count($totalQty))}}

                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست آیتم های فروخته شده </h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">


                    @if(count($totalQty))
                        <div class="table-responsive p-0">
                            <table class="table mb-0">

                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>دوره</th>
                                    <th>خریدار</th>
                                    <th>زمان</th>
                                    <th>مبلغ</th>
                                    <th>درصد سهم</th>
                                    <th>مبلغ پرداختی</th>
                                    <th>وضعیت تسویه</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($paidOrders as $order)
                                    @foreach($order->courseOrders as $courseOrder)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $courseOrder->course->title }}</td>
                                            <td>{{ $courseOrder->user->name }} {{ $courseOrder->user->family }}</td>
                                            <td>{{ jdate($order->updated_at)->toDateString() }}</td>
                                            <td>{{ number_format($courseOrder->total) }} <small>تومان</small></td>
                                            <td>{{ $courseOrder->revenue }}%</td>
                                            <td>{{number_format( $courseOrder->total * ($courseOrder->revenue / 100)) }}
                                                <small>تومان</small></td>
                                            <td>
                                                @if($courseOrder->is_settled == 0)
                                                    <span class="text-danger">تسویه نشده</span>
                                                @else
                                                    <span class="text-success">پرداخت شده</span>

                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-light">
                            <p>متاسفانه هنوز فروشی از دوره های منتشر شده نداشتین.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
@endcomponent