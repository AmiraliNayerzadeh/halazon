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


