{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"--}}
{{--     aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header d-flex justify-content-between">--}}
{{--                <div>--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">ایجاد پارت زمانی جدید</h5>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <form action="{{ route('admin.headline.store', $course) }}" method="post" enctype="multipart/form-data" class="dropzone" id="video-dropzone">--}}
{{--                @method('POST')--}}
{{--                @csrf--}}
{{--                <div class="card-body">--}}

{{--                    <div class="row">--}}

{{--                        <div class="{{ $course->type == 'offline' ? 'col-lg-6' : 'col-lg-12' }}">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="title">عنوان سرفصل:</label>--}}
{{--                                <input class="form-control" type="title" name="title" id="title"--}}
{{--                                       value="{{ old('title') }}" placeholder="مثال: آشنایی با تاریخچه ی ... ">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        @if($course->type == 'offline')--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <label class="form-label" for="video">فایل ویدیو:</label>--}}
{{--                                <div class="form-group">--}}
{{--                                    <div id="video-upload-area" class="dropzone"></div> <!-- Dropzone area -->--}}
{{--                                    <input type="hidden" name="video" id="video">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <div class="col-lg-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label" for="description">توضیحات سرفصل (اختیاری):</label>--}}
{{--                                <textarea class="form-control" name="description" id="description" cols="30" rows="4">{{ old('description') }}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer border d-flex justify-content-end">--}}
{{--                    <button class="btn btn-success" type="submit">ثبت</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}





