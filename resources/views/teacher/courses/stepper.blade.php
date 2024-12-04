<div class="container mt-5">
    <div class="stepper">
        <!-- Step 1 -->
        <div class="step  {{\Illuminate\Support\Facades\Route::currentRouteName() == 'teachers.courses.edit' ? 'active' : ''}}">
            <a href="{{route('teachers.courses.edit' , $course)}}">
                <div class="circle">1</div>
                <div class="label">اطلاعات دوره</div>
            </a>
        </div>
        <!-- Step 2 -->


        <div class="step {{\Illuminate\Support\Facades\Route::currentRouteName() == 'teachers.schedules.index' ? 'active' : ''}}">
            <a href="{{route('teachers.schedules.index', $course)}}">
                <div class="circle">2</div>
                <div class="label">زمان بندی</div>
            </a>
        </div>
        <!-- Step 3 -->
        <div class="step {{\Illuminate\Support\Facades\Route::currentRouteName() == 'teachers.headline.index' ? 'active' : ''}}">
            <a href="{{route('teachers.headline.index', $course)}}">
                <div class="circle">3</div>
                <div class="label">سرفصل ها</div>
            </a>
        </div>
    </div>
</div>


<style>
    .stepper {
        display: flex;
        justify-content: space-between;
        position: relative;
    }

    .stepper::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 4px;
        background-color: #ddd;
        z-index: 0;
        transform: translateY(-50%);
    }

    .step {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .step .circle {
        width: 40px;
        height: 40px;
        background-color: #ddd;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-weight: bold;
    }

    .step.active .circle {
        background-color: #fbcf33;
    }

    .step .label {
        margin-top: 10px;
        font-size: 14px;
        color: #555;
    }

    .step.active .label {
        color: #fbcf33;
    }
</style>