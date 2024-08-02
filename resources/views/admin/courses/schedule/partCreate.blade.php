<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
            <form action="{{route('admin.time.store', $course)}}" method="post">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="title">عنوان</label>
                        <input class="form-control" value="{{old('title')}}" type="text" name="title" id="title" placeholder="مثال: روز های زوج یا زمان بندی اول">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary"
                            data-bs-dismiss="modal">بستن
                    </button>
                    <button type="submit" class="btn bg-gradient-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
</div>