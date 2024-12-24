<div class="row">

    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="title">عنوان سرفصل:</label>
            <input class="form-control" type="text" name="title" id="title"
                   value="{{ old('title') }}"
                   placeholder="مثال: آشنایی با تاریخچه ی ... ">
        </div>
    </div>


    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="is_free">این سرفصل رایگان است؟</label>
            <select class="form-control" name="is_free" id="is_free">
                <option {{old('is_free' == 0 ? 'selected' : '')}} value="0">خیر
                </option>
                <option {{old('is_free' == 1 ? 'selected' : '')}} value="1">بله
                </option>
            </select>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="alert alert-info text-white text-sm d-flex align-items-center mt-1"
             role="alert">
            <i class="fas fa-info-circle mx-2"></i>
            <div>
                <ul>
                    <li>
                        با توجه به اینکه معمولاً فایل‌های ویدیویی دارای حجم زیادی می‌باشند، لطفاً تا پایان بارگذاری ویدیو صبور باشید.
                    </li>

                    <li>
                        حجم مجاز تا 400 مگابایت.
                    </li>
                </ul>
            </div>
        </div>


        <label>فایل ویدیو:</label>
        <div id="videoDropzone" class="dropzone"></div>
    </div>


    <div class="col-lg-12 mt-2">
        <div class="form-group">
            <label class="form-label" for="description">توضیحات سرفصل (اختیاری):</label>
            <textarea class="form-control" name="description" id="description" cols="30"
                      rows="4">{{ old('description') }}</textarea>
        </div>
    </div>


</div>
