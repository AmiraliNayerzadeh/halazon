@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست کاربران</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.users.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد کاربر جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">نام و نام خانوادگی</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نوع کاربر</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">جنسیت</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاریخ ثبت نام</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ویرایش</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">مشاهده</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            @if(!is_null($user->avatar))
                                                <img src="{{$user->avatar}}" class="avatar avatar-sm me-3" alt="{{$user->name}}">
                                            @else
                                                <img src="/assets/user-avatar.png" class="avatar avatar-sm me-3" alt="{{$user->name}}">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$user->name}} {{$user->family}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$user->phone}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($user->is_admin)
                                        <p class="text-xs font-weight-bold mb-0">ادمین</p>
                                    @endif

                                        @if($user->is_teacher)
                                            <p class="text-xs font-weight-bold mb-0">دبیر</p>
                                        @else
                                            <p class="text-xs font-weight-bold mb-0">کاربر معمولی</p>
                                        @endif
                                </td>

                                <td class="align-middle text-center text-sm">
                                    {{$user->gender == 'female' ? 'خانم' : 'آقا'}}
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        {{jdate($user->creted_at)}}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="text-primary text-center" href="{{route('admin.users.edit' , $user)}}"><li class="fa fa-edit"></li></a>
                                </td>

                                <td class="align-middle text-center">
                                    <a class="text-secondary text-center" href="{{route('admin.users.show' , $user)}}"><li class="fa fa-eye"></li></a>
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