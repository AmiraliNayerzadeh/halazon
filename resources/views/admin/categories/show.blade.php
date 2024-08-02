@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>مشاهده زیر دسته های {{$category->title}}</h6>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.categories.create')}}">
                        <li class="fa fa-plus"></li>
                        ایجاد دسته بندی جدید
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table  mb-0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>آیکون</th>
                                <th>نام</th>
                                <th>نام انگلیسی</th>
                                <th>تعداد زیر دسته</th>
                                <th>#</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->children as $child)
                                <tr>
                                    <th>{{$child->id}}</th>
                                    <th>
                                        <img src="{{!is_null($child->image) ? $child->image : '/assets/default-image.jpg'}}" alt="{{$category->title}}" class="avatar avatar-md me-3">
                                    </th>
                                    <td>{{$child->title}}</td>
                                    <td>{{$child->title_en}}</td>



                                    <td>{{count($child->children)}}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{route('admin.categories.edit' , $child)}}">ویرایش</a>

                                        @if(count($child->children) > 0)
                                            <a class="btn btn-primary" href="{{route('admin.categories.show' , $child)}}">مشاهده زیر دسته ها</a>
                                        @else
                                            <button type="disable" class="btn  btn-outline-danger" >فاقد زیر دسته</button>

                                        @endif
                                    </td>

                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <li class="fa fa-trash"></li>
                                        </button>


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">حدف {{$category->title}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">آیا از حذف دسته بندی {{$category->title}} مطمئن هستید؟ </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">پشیمان شدن</button>
                                                        <form action="{{route('admin.categories.destroy' , $child)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit">
                                                                حذف شه بره!
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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