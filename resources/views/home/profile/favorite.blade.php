@extends('.home.profile.master')

@section('content')

    <h1 class="text-2xl font-extrabold text-main my-4">دیدگاه و سوالات شما</h1>


    <div class="mt-7 bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="grid grid-cols-12">
                @foreach($favorites as $favorite)
                    <div class="col-span-12 sm:col-span-3 rounded-2xl p-2 border shadow my-3 mx-4">
                        <div class="p-1">
                            <div><a href="{{route('course.show' , $favorite->favoriteable)}}"><img class="rounded-2xl" src="{{$favorite->favoriteable->image}}" alt="{{$favorite->favoriteable->title}}"></a>
                            </div>

                            <h5 class="mt-4 font-extrabold text-lg hover:text-main duration-500"><a
                                    href="{{route('course.show' , $favorite->favoriteable)}}">{{$favorite->favoriteable->title}}</a></h5>



                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>




@endsection
