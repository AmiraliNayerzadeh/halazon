@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست تیکت های پشتیبانی </h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کاربر درخواست دهنده</th>
                                <th>عنوان درخواست</th>
                                <th>تاریخ درخواست</th>
                                <th>وضعیت</th>
                                <th>تعداد پاسخ</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $support)
                                <tr>
                                    <th>{{$support->id}}</th>
                                    <th>
                                        <a href="{{route('admin.users.show' , $support->user)}}">{{$support->user->name}} {{$support->user->family}}</a>
                                    </th>
                                    <td>
                                        {{$support->title}}
                                    </td>
                                    <td>{{jdate($support->created_at)}}</td>

                                    <td>
                                        {{$support->status_translated}}
                                    </td>

                                    <td>
                                        {{count($support->children)}}
                                    </td>
                                    
                                    <td>
                                        <a class="btn btn-primary" href="{{route('admin.supports.show' , $support)}}"><i class="fa fa-eye"></i></a>
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