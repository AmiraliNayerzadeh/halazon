@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست دسته بندی ها</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.categories.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد دسته بندی  جدید
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
                                <th>نام انگلیسی</th>
                                <th>تعداد زیر دسته</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th>{{$category->id}}</th>
                                    <th>
                                        <img src="{{!is_null($category->image) ? $category->image : '/assets/default-image.jpg'}}" alt="{{$category->title}}" class="avatar avatar-md me-3">
                                    </th>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->title_en}}</td>


                                    <td>{{count($category->children)}}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin.categories.edit' , $category)}}">ویرایش</a>
                                        @if(count($category->children) > 0)
                                            <a class="btn btn-primary" href="{{route('admin.categories.show' , $category)}}">مشاهده زیر دسته ها</a>
                                        @else
                                            <button type="disable" class="btn  btn-outline-danger" >فاقد زیر دسته</button>

                                        @endif
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