<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <div>
                    <h5 class="modal-title" id="exampleModalLabel">ایجاد پارت زمانی
                        جدید</h5>
                </div>
                <div>
                    <button type="button" class="btn-close text-dark"
                            data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{route('admin.schedules.store', $course)}}" method="post">
                @method('POST')
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="title">عنوان زمان بندی:</label>
                                <input class="form-control" type="title" name="title" id="title"
                                       value="{{old('title')}}" placeholder="زمان بندی 1">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="title">تاریخ شروع:</label>
                                <input data-jdp type="text" class="form-control" id="start_course"
                                       name="start_course" value="{{old('start_course')}}"
                                       autocomplete="off">

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="title">زمان شروع:</label>
                                <input type="time" class="form-control" id="time_course"
                                       name="time_course" value="{{old('time_course')}}"
                                       autocomplete="off">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="day">روز های برگذاری:</label>
                            @foreach(\App\Models\Day::all() as $day)
                                <div class="btn-group" role="group"
                                     aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="{{$day['id']}}"
                                           autocomplete="off" name="days[]"
                                           value="{{$day['id']}}" {{ in_array($day->id, old('days', [])) ? 'checked' : '' }} >
                                    <label class="btn btn-outline-primary"
                                           for="{{$day['id']}}">{{$day['day_farsi']}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer border d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">ثبت</button>
                </div>
            </form>

        </div>
    </div>
</div>