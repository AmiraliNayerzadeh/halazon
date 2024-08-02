@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>مشاهده کاربر
                    <span class="text-primary">{{$user->name}} {{$user->family}}</span>
                    </h6>

                    <ol class="breadcrumb  mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5" href="{{route('admin.users.index')}}">کاربران</a></li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">مشاهده</li>
                        <li class="breadcrumb-item text-sm active" aria-current="page">{{$user->name}} {{$user->family}}</li>
                    </ol>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <p>
                        در این قسمت اطالاعات مربوط به کاربر مورد نیاز نمایش داده خواهد شد.

                    </p>
                </div>
            </div>
        </div>

        @section('script')

            <script>
                jalaliDatepicker.startWatch();
            </script>

            <script>
                $('#lfm').filemanager('image');
            </script>

        @endsection

    @endsection
@endcomponent