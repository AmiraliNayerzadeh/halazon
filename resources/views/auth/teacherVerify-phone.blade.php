@extends('.home.layouts.just-header.master')
@section('content')

    <div class="grid grid-cols-12 h-full ">

        <div class="col-span-12 sm:col-span-12">
            <div class="flex flex-col sm:justify-center items-center h-full">

                <h1 class="text-main font-extrabold text-3xl my-5">{{session()->get('type') == 'register' ? 'تایید ثبت نام معلمین ' : ' تایید ورود معلمین'}}</h1>
                <p>کُد ارسال شده را وارد نمایید.</p>
                <div class="sm:w-1/3 p-5 sm:px-0">
                    <form method="post" action="{{ route('doVerifyPhone') }}">
                        @method('post')
                        @csrf
                        <div class="py-2 flex justify-around items-center rounded-2xl border border-l-gray-500">
                            <div class="otp-container flex space-x-reverse " style="direction: ltr">
                                <input name="otp1" type="text" maxlength="1" class="otp-input mr-2 w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-0 focus:ring-main-500 num" id="otp-1" inputmode="numeric" pattern="[0-9]*" />
                                <input name="otp2" type="text" maxlength="1" class="otp-input mr-2 w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-0 focus:ring-main-500 num" id="otp-2" inputmode="numeric" pattern="[0-9]*" />
                                <input name="otp3" type="text" maxlength="1" class="otp-input mr-2 w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-0 focus:ring-main-500 num" id="otp-3" inputmode="numeric" pattern="[0-9]*" />
                                <input name="otp4" type="text" maxlength="1" class="otp-input mr-2 w-12 h-12 text-center text-xl border border-gray-300 rounded-md focus:outline-none focus:ring-0 focus:ring-main-500 num" id="otp-4" inputmode="numeric" pattern="[0-9]*" />
                            </div>
                        </div>
                        <input type="hidden" name="otp" id="otp-hidden" />
                        <button type="submit" class="my-5 py-4 border bg-primary hover:bg-primary100 duration-500 rounded-2xl w-full text-lg font-extrabold text-white" >{{session()->get('type') == 'register' ? ' ثبت نام' : 'ورود'}}</button>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const inputs = document.querySelectorAll('.otp-input');
            const hiddenInput = document.getElementById('otp-hidden');
            const form = document.getElementById('otp-form');

            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1) {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0) {
                        if (index > 0) {
                            inputs[index - 1].focus();
                        }
                    }
                });
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let otpValue = '';
                inputs.forEach(input => {
                    otpValue += input.value;
                });
                hiddenInput.value = otpValue;
                form.submit();
            });
        });
    </script>

@endsection
