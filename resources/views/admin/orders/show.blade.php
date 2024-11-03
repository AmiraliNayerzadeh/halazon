@component('.admin.layout.master')
    @section('content')

        <div class="row">
            <div class="card">
                <div class="card-header"> جزئیات سفارش #{{$order->id}}</div>
                <div class="card-body">
                    <div class="col-12 my-2">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary pb-0 d-flex justify-content-between align-items-center">
                                <h6>آیتم های سفارش</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>تصویر</th>
                                            <th>نام دوره</th>
                                            <th>زمان بندی</th>
                                            <th>زمان ثبت</th>
                                            <th>قیمت آیتم در زمان ثبت</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->courseOrders as $items)
                                            <tr>

                                                <td>
                                                    <img class="img-fluid rounded-full" style="height: 3rem" src="{{$items->course->image}}" alt="">
                                                </td>

                                                <td>
                                                    <a href="{{route('admin.courses.show' , $items->course)}}">{{$items->course->title}}</a>
                                                </td>


                                                <td>
                                                    {{!is_null($items->part) ? $items->part->title : 'دوره آفلاین'}}
                                                </td>


                                                <td>{{jdate($items->created_at)}}</td>

                                                <td>{{number_format($items->total)}} تومان </td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 my-2">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary pb-0 d-flex justify-content-between align-items-center">
                                <h6>وضعیت پرداخت</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>مبلغ قابل پرداخت</th>
                                            <th>شماره کارت</th>
                                            <th>شماره پیگیری</th>
                                            <th>پیام درگاه</th>
                                            <th>کُد وضعیت درگاه</th>
                                            <th>کارمزد</th>
                                            <th>زمان ثبت</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->payments as $pay)
                                            <tr>

                                                <td>{{number_format($pay->amount)}}</td>

                                                <td>
                                                    @if($pay->card_number)
                                                        {{$pay->card_number}}
                                                    @else
                                                        <span class="bg-danger text-white rounded p-1">وجود ندارد</span>
                                                    @endif
                                                </td>


                                                <td>
                                                    @if($pay->traceNumber)
                                                        {{$pay->traceNumber}}
                                                    @else
                                                        <span class="bg-danger text-white rounded p-1">وجود ندارد</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($pay->message)
                                                        {{$pay->message}}
                                                    @else
                                                        <span class="bg-danger text-white rounded p-1">وجود ندارد</span>
                                                    @endif
                                                </td>


                                                <td>
                                                    @if($pay->code)
                                                        {{$pay->code}}
                                                    @else
                                                        <span class="bg-danger text-white rounded p-1">وجود ندارد</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($pay->fee)
                                                        {{number_format($pay->fee)}}
                                                    @else
                                                        <span class="bg-danger text-white rounded p-1">وجود ندارد</span>
                                                    @endif
                                                </td>



                                                <td>{{jdate($pay->created_at)}}</td>



                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    @endsection
@endcomponent