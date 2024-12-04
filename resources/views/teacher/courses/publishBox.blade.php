@if($course->status != "منتشر شده")
    <div class="card position-sticky fixed-top">
        <div class="card-header bg-success">
            <h5>
                <li class="mx-2 fa fa-save mx-2"></li>
                انتشار
            </h5>
        </div>
        <div class="card-body">



            <div class="row p-2">


                <ul>
                    <li>قبل از درخواست انتشار توجه داشته باشید که تغیرات خود را ذخیره کرده باشید.
                    </li>
                    <li>توجه داشته باشید بعد از انتشار، امکان ویرایش مشخصات کلی نمی باشد.</li>

                    <hr>

                    @if(count($course->headlines) == 0 || $course->type== 'online' && count($course->schedules) == 0)
                        <b>ابتدا موارد مشخص شده را کامل کنید.</b>
                    @endif

                    @if(count($course->headlines) == 0)
                        <li class="text-danger">هنوز سرفصلی برای دوره خود ایجاد نکرده اید.</li>
                    @endif

                    @if($course->type== 'online' && count($course->schedules) == 0)
                        <li class="text-danger">برای دوره های آنلاین باید زمان بندی مشخص کنید.</li>
                    @endif



                </ul>


                <div class="my-3">
                    <div class="progress-wrapper">
                        <div class="progress-info">
                            <div class="progress-percentage">
                                <span class="text-sm font-weight-bold">60%</span>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-6">
                    <button class="btn btn-warning w-100" name="is_draft" value="1" type="submit">
                        ذخیره
                        پیش نویس
                    </button>
                </div>
                <div class="col-lg-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        <i class="fa fa-check"></i>
                        درخواست انتشار
                    </button>


                </div>
            </div>
        </div>
    </div>
@else
    <div class="card position-sticky fixed-top">
        <div class="card-header bg-success">
            <h5>
                <li class="mx-2 fa fa-save mx-2"></li>
                دوره منتشر شده است.
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                پس از انتشار دوره، امکان ویرایش دوره وجود ندارد.
            </div>
        </div>
    </div>
@endif


<div class="modal fade " id="exampleModal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    درخواست انتشار  {{$course->title}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            @if(count($course->headlines) == 0 || $course->type== 'online' && count($course->schedules) == 0)
                <ul class="p-5">

                    @if(count($course->headlines) == 0 || $course->type== 'online' && count($course->schedules) == 0)
                        <b>ابتدا موارد مشخص شده را کامل کنید.</b>
                    @endif

                    @if(count($course->headlines) == 0)
                        <li class="text-danger">هنوز سرفصلی برای دوره خود ایجاد نکرده اید.</li>
                    @endif

                    @if($course->type== 'online' && count($course->schedules) == 0)
                        <li class="text-danger">برای دوره های آنلاین باید زمان بندی مشخص کنید.</li>
                    @endif



                </ul>

            @else
            <form action="{{route('submit.support')}}" method="post">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$course->id}}">
                    <input type="hidden" name="type" value="{{get_class($course)}}">
                    <input type="hidden" name="title" value="درخواست تایید دوره {{$course->title}}">
                    <textarea name="message" class="form-control" rows="5">
اینجانب {{ auth()->user()->name }} {{ auth()->user()->family }}، درخواست تایید دوره "{{ $course->title }}" را دارم. اینجانب قوانین سایت را مطالعه کرده‌ام و تمام اطلاعات واردشده مربوط به این دوره را به‌درستی تکمیل کرده‌ام. همچنین تعهد می‌نمایم پس از تایید این دوره، پشتیبانی کامل آن را بر عهده بگیرم.</textarea>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">بستن
                    </button>
                    <button type="submit" class="btn btn-success">ارسال درخواست</button>
                </div>
            </form>

            @endif
        </div>
    </div>
</div>
