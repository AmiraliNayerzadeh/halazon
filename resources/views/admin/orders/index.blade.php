@component('.admin.layout.master')
    @section('content')

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست سفارش ها</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
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
                            @foreach($orders as $order)
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
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endcomponent