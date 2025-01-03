<div class="row">

    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-label" for="title">عنوان سرفصل:</label>
            <input class="form-control" type="text" name="title" id="title"
                   value="{{ old('title') }}"
                   placeholder="مثال: آشنایی با تاریخچه ی ... ">
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="link">لینک ورود به جلسه:</label>

        <small class="text-warning">در صورت اینکه لینک آماده ای ندارید، میتوانید این
            فیلد را خالی رها کنید.</small>
        <input class="form-control" type="text" name="link" id="link"
               value="{{ old('link') }}"
               placeholder="لینک ورود به جلسه انلاین را وارد کنید.">
    </div>




    <div class="col-lg-12 mt-2">
        <div class="form-group">
            <label class="form-label" for="description">توضیحات سرفصل (اختیاری):</label>
            <textarea class="form-control" name="description" id="description" cols="30"
                      rows="4">{{ old('description') }}</textarea>
        </div>
    </div>
</div>
