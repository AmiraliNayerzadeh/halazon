@extends('.home.profile.master')

@section('content')

    <h1 class="text-2xl font-extrabold text-main my-4"><i class="fa fa-heart mx-1"></i>علاقه مندی ها</h1>


    @if(count($favorites->where('favoriteable_type' , 'App\Models\Course')) > 0)
        <div class="mt-7 bg-gray-100 rounded-3xl">
            <div class="container mx-auto py-4">
                <h3 class="text-lg mr-3 font-extrabold  my-2">دوره های مورد علاقه</h3>

                <div class="grid grid-cols-12">
                    @foreach($favorites->where('favoriteable_type' , 'App\Models\Course') as $favorite)
                        <div class="col-span-12 sm:col-span-3 rounded-2xl p-2 border shadow my-3 mx-4">
                            <div class="p-1">
                                <div><a href="{{route('course.show' , $favorite->favoriteable)}}"><img
                                            class="rounded-2xl" src="{{$favorite->favoriteable->image}}"
                                            alt="{{$favorite->favoriteable->title}}"></a>
                                </div>

                                <h5 class="mt-4  text-lg hover:text-main duration-500"><a
                                        href="{{route('course.show' , $favorite->favoriteable)}}">{{$favorite->favoriteable->title}}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif


    @if(count($favorites->where('favoriteable_type' , 'App\Models\Blog')) > 0)
        <div class="mt-7 bg-gray-100 rounded-3xl">
            <div class="container mx-auto py-4">
                <h3 class="text-lg mr-3 font-extrabold  my-2">مقاله های مورد علاقه</h3>

                <div class="grid grid-cols-12">
                    @foreach($favorites->where('favoriteable_type' , 'App\Models\Blog') as $blog)
                        <div class="col-span-12 sm:col-span-3 rounded-2xl p-2 border shadow my-3 mx-4">
                            <div class="p-1">
                                <div><a href="{{route('blog.show' , ['category' => $blog->favoriteable->categories->first() , 'blog' => $blog->favoriteable->slug ])}}"><img
                                            class="rounded-2xl" src="{{$blog->favoriteable->image}}"
                                            alt="{{$blog->favoriteable->title}}"></a>
                                </div>

                                <h5 class="mt-4 text-lg hover:text-main duration-500"><a
                                        href="{{route('blog.show' , ['category' => $blog->favoriteable->categories->first() , 'blog' => $blog->favoriteable->slug ])}}">{{$blog->favoriteable->title}}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif



    @if(count($favorites->where('favoriteable_type' , 'App\Models\Blog')) == 0 && count($favorites->where('favoriteable_type' , 'App\Models\Course')) == 0 )
        <div class="mt-7 bg-gray-100 rounded-3xl">
            <div class="container mx-auto py-4">
                <p class="mx-4">هنوز گزینه ای به لیست علاقه مندی های خود اضافه نکرده اید.</p>
            </div>
        </div>

    @endif



@endsection
