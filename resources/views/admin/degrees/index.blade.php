@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست مقاطع </h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.degrees.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد مقاطع  جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>آیکون</th>
                                <th>نام</th>
                                <th>اسلاگ</th>
                                <th>تعداد دروس</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($degrees as $degree)
                                <tr>
                                    <th>{{$degree->id}}</th>
                                    <th>
                                        <img src="{{!is_null($degree->image) ? $degree->image : '/assets/default-image.jpg'}}" alt="{{$degree->title}}" class="avatar avatar-md me-3">
                                    </th>
                                    <td>{{$degree->title}}</td>
                                    <td>{{$degree->slug}}</td>
                                    <td>{{count($degree->courses)}}</td>

                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin.degrees.edit' , $degree)}}">ویرایش</a>
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