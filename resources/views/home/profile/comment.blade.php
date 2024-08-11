@extends('.home.layouts.just-header.master')
@section('content')

    <div class="container mx-auto md:flex md:flex-row">
        @include('.home.profile.sidebar')

        <div class="flex-1 p-6">
            <div class="container mx-auto">
                this is my test
            </div>
        </div>


    </div>

@endsection