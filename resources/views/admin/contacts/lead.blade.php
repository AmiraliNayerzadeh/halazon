@component('.admin.layout.master')
    @section('content')
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>لیست مخاطبان جذب شده از کمپین ها </h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table mb-0">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره تماس</th>
                                <th>مقطع</th>
                                <th>سن</th>
                                <th>ایمیل</th>
                                <th>توضیحات</th>
{{--                                <th>حذف/ تغیر وضعیت</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leads as $contact)
                                <tr>
                                    <th>{{$contact->id}}</th>
                                    <th>{{$contact->name}}</th>
                                    <td>{{$contact->phone}}</td>
                                    <td>{{$contact->degree}}</td>
                                    <td>{{$contact->age}}</td>
                                    <td>{{$contact->email}}</td>

                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#contact_{{$contact->id}}">
                                            <i class="fa fa-file-text"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="contact_{{$contact->id}}" tabindex="-1"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            درخواست: {{$contact->name}} </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if(!is_null($contact->description))
                                                            {!! $contact->description !!}
                                                        @else
                                                            <span class="text-danger">کاربر توضیحی برای درخواست تماس خود ثبت نکرده است.</span>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
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

            {{$leads->links('vendor.pagination.bootstrap-5')}}

        </div>
    @endsection
@endcomponent
