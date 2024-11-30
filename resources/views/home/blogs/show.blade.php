@extends('home.layouts.main.master')


@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Article",
          "headline": "{{$blog->title}}",
          "description": "{{$blog->meta_description ?? ''}}",
          "author": {
            "@type": "Person",
            "name": "{{$blog->user->name}} {{$blog->user->family}}"
          },
          "datePublished": "{{$blog->created_at->toISOString()}}",
          "dateModified": "{{$blog->updated_at->toISOString()}}",
          "publisher": {
            "@type": "Organization",
            "name": "پلتفرم آموزشی حلزون",
            "logo": {
              "@type": "ImageObject",
              "url": "https://halazoon.org/assets/logo.png"
            }
          },
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{url()->current()}}"
          },
          "image": {
            "@type": "ImageObject",
            "url": "{{$blog->image}}",
            "height": 602,
            "width": 800
          }
        }
    </script>


    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "صفحه اصلی",
            "item": "{{ url('/') }}"
          },{
            "@type": "ListItem",
            "position": 2,
            "name": "مجله",
            "item": "{{route('blog.index')}}"
          },{
            "@type": "ListItem",
            "position": 3,
                "name": "{{ $blog->categories[0]->title ?? 'بدون دسته‌بندی' }}",
            "item": "{{route('blog.category' , $blog->categories[0])}}"
          },
          {
            "@type": "ListItem",
            "position": 4,
            "name": "{{$blog->title}}"
          }]
        }
    </script>
@endsection

@section('content')
    <div class="container mx-auto  ">
        <div class="flex h-full w-full  items-center mt-4 ">
            <div>
                <nav aria-label="breadcrumb" class="w-full flex justify-center items-center">
                    <ol class="flex flex-wrap items-center justify-center w-full py-2">
                        <li class="flex items-center  text-sm  text-main50 hover:text-main">
                            <a href="http://127.0.0.1:8000">صفحه اصلی</a>
                        </li>
                        <span class="text-sm mx-2 "><svg class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg><!-- <li class="fa fa-angle-left"></li> --></span>

                        <li class="flex items-center  text-sm  text-main50 hover:text-main ">
                            <a href="{{route('blog.index')}}">مجله</a>
                        </li>

                        <span class="text-sm mx-2 "><svg class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg><!-- <li class="fa fa-angle-left"></li> --></span>

                        <li class="flex items-center  text-sm  text-main50 hover:text-main ">
                            <a href="{{route('blog.category' , $blog->categories[0])}}">{{$blog->categories[0]->title}}</a>
                        </li>

                        <span class="text-sm mx-2 "><svg class="svg-inline--fa fa-angle-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"></path></svg><!-- <li class="fa fa-angle-left"></li> --></span>

                        <li class="flex items-center  text-sm  text-gray-300 hover:text-main font-extrabold truncate ">
                            <a href="#">{{$blog->title}}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-12 sm:col-span-8 p-3 ">
                <div class="container mx-auto">
                    <h1 class="text-main100 font-extrabold text-3xl my-3">{{$blog->title}}</h1>
                    <div class="flex items-center my-1">
                        <div class="flex items-center">
                            <a href="{{route('teacher.show' , $blog->user)}}">
                                <img class="rounded-full h-8 w-8 sm:h-14 sm:w-14 object-cover" src="{{$blog->user->avatar}}"
                                     alt="{{$blog->user->name}} {{$blog->user->family}}">
                            </a>
                            <span class="text-gray-400 mx-1 hidden  sm:inline">نویسنده:</span>
                            <a class="hover:text-primary duration-500 truncate"
                               href="{{route('teacher.show' , $blog->user)}}">{{$blog->user->name}} {{$blog->user->family}}</a>
                        </div>

                        <div class="flex items-center mr-7">
                            <span class="text-gray-400">
                            <i class="fa fa-timer"></i>
                            </span>
                            <div class="mr-1">{{jdate($blog->updated_at)->ago()}}</div>
                        </div>

                    </div>
                    <div class="flex items-center w-full justify-between mt-3">
                        <div class="truncate">
                            @foreach($blog->categories as $category)
                                <a class="text-sm bg-main25 rounded mx-1 p-1"
                                   href="{{route('blog.category' , $category)}}">{{$category->title}}</a>
                            @endforeach
                        </div>

                        @auth
                            @if( !auth()->user()->favorites()->where('favoriteable_type',get_class($blog))->where('favoriteable_id', $blog->id)->exists())
                                <form action="{{route('favorites.store')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="type" value="{{get_class($blog)}}">
                                    <input type="hidden" name="id" value="{{$blog->id}}">
                                    <button class="text-red-400 py-2 px-3 rounded-3xl border border-red-400 text-sm hover:bg-red-600 hover:text-white duration-700 truncate"
                                            type="submit"><i class="fa fa-heart ml-1"></i>افزودن علاقه مندی
                                    </button>
                                </form>

                            @else
                                <form action="{{route('favorites.delete')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="type" value="{{get_class($blog)}}">
                                    <input type="hidden" name="id" value="{{$blog->id}}">
                                    <button class="text-red-400 py-2 px-3 rounded-3xl border border-red-400 text-sm hover:bg-red-600 hover:text-white duration-700"
                                            type="submit"><i class="fa fa-heart-broken ml-1"></i>حذف از علاقه مندی
                                    </button>
                                </form>
                            @endif
                        @endauth
                        @guest
                            <form action="{{route('favorites.store')}}" method="post">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="type" value="{{get_class($blog)}}">
                                <input type="hidden" name="id" value="{{$blog->id}}">
                                <button class="text-red-400 py-2 px-3 rounded-3xl border border-red-400 text-sm hover:bg-red-600 hover:text-white duration-700"
                                        type="submit"><i class="fa fa-heart ml-1"></i>افزودن علاقه مندی
                                </button>
                            </form>
                        @endguest
                    </div>
                    <img class="rounded-3xl w-full my-4 "
                         src="{{!is_null($blog->image) ? $blog->image : '/assets/default-image.jpg'}}"
                         alt="{{$blog->title}}">

                    @if(!is_null($blog->meta_description))
                    <div class="bg-main25 my-7 py-7 px-2 rounded-3xl ">
                        <div class="mb-2 text-main100 font-extrabold">مقدمه:</div>
                        {{$blog->meta_description}}
                    </div>
                    @endif
                </div>


                <article id="course-description"
                         class="prose max-w-none  overflow-hidden relative transition-all duration-300 ease-in-out">
                    {!! $blog->description !!}
                </article>

            </div>


            <div class="col-span-12 sm:col-span-4 mt-3 pt-3  ">


                <div class="rounded-2xl border border-main100 shadow space-y-4 mb-3 sticky top-0 p-3 ">
                    <h5 class="font-extrabold text-main">مقاله های مرتبط:</h5>
                    @foreach($blog->categories[0]->blogs->where('status' , 1)->where('id', '!=' ,$blog->id )->take(5) as $relatedBlog )
                        <div class="flex items-center my-4 border-b border-main pb-3">
                            <img class="h-16 rounded-2xl" src="{{$relatedBlog->image}}" alt="{{$relatedBlog->title}}">
                            <h4 class="mr-2 hover:text-primary duration-500"><a
                                        href="{{route('blog.show' , [ 'category'=>$relatedBlog->categories[0] , 'blog' =>$relatedBlog ])}}">{{$relatedBlog->title}}</a>
                            </h4>
                        </div>
                    @endforeach



                    @if(count($blog->categories[0]->courses->where('is_draft' , 0)->where('status' , 'منتشر شده') ) > 0)

                        <h5 class="font-extrabold text-main">کلاس های مرتبط:</h5>
                        @foreach($blog->categories[0]->courses->where('is_draft' , 0)->where('status' , 'منتشر شده')->take(3) as $course )
                            <div class="flex items-center my-4 border-b border-main pb-3">
                                <img class="h-16 rounded-2xl" src="{{$course->image}}" alt="{{$course->title}}">
                                <h4 class="mr-2 hover:text-primary duration-500"><a
                                            href="{{route('course.show' , $course)}}">{{$course->title}}</a></h4>
                            </div>
                        @endforeach

                    @endif

                </div>


            </div>
        </div>
    </div>


    {{--Comment Section--}}
    <div class="mt-7 bg-gray-100">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <h4 class="font-extrabold text-2xl py-5">
                    <i class="fa fa-comment-alt mx-1"></i>نظرات</h4>
                <button id="comment" class="bg-main50 text-white py-2 px-3 rounded-2xl border border-main hover:bg-main25 hover:text-main100 duration-700"><i class="fa fa-plus mx-1"></i>ایجاد نظر جدید</button>

                <!--Comment Modal -->
                <div id="myModal"
                     class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl w-full">
                        <h2 class="text-xl font-extrabold mb-4 text-main">
                            <i class="fa fa-plus mx-1"></i>ایجاد نظر جدید</h2>

                        <hr class="my-2">

                        @auth
                        <form action="{{route('comment.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="type" value="{{get_class($blog)}}">
                            <input type="hidden" name="id" value="{{$blog->id}}">
                            <div class="max-w-2xl mx-auto ">
                                <!-- Comment -->
                                <div class="mb-4">
                                    <label for="comment" class="block text-gray-700  font-extrabold mb-2">متن نظر:</label>
                                    <textarea id="comment" name="comment" rows="3" class="rounded w-full py-2 px-3 text-gray-700 " required></textarea>
                                </div>

                                <!-- Score -->
                                <div class="mb-2">
                                    <label class="block text-gray-700 font-extrabold ">امتیاز:</label>

                                    <!-- Rating -->
                                    <div class="rating">
                                        <input type="radio" id="star5" name="score" value="5"/>
                                        <label class="star" for="star5" title="Awesome" aria-hidden="true"></label>
                                        <input type="radio" id="star4" name="score" value="4"/>
                                        <label class="star" for="star4" title="Great" aria-hidden="true"></label>
                                        <input type="radio" id="star3" name="score" value="3"/>
                                        <label class="star" for="star3" title="Very good" aria-hidden="true"></label>
                                        <input type="radio" id="star2" name="score" value="2"/>
                                        <label class="star" for="star2" title="Good" aria-hidden="true"></label>
                                        <input type="radio" id="star1" name="score" value="1"/>
                                        <label class="star" for="star1" title="Bad" aria-hidden="true"></label>
                                    </div>
                                    <!-- End Rating -->
                                </div>

                            </div>

                            <hr class="my-3">


                            <div class="flex justify-end ">
                                <button id="closeModalButton" class="px-4 mx-2 py-2 bg-red-500 text-white rounded-lg">بستن</button>

                                <button type="submit" class="bg-green-500 hover:bg-green-700 duration-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ثبت نظر</button>
                            </div>

                        </form>

                        @endauth
                        @guest
                                <div class="mb-5">
                                    <p>برای درج نظر ابتدا باید وارد حساب کاربری خود شوید.</p>
                                </div>
                        <div class="flex justify-end">
                            <a class="bg-green-400 border border-green-500 px-3 py-2 rounded-2xl hover:bg-green-800 dark:hover:text-white duration-700 " href="{{route('login')}}">
                                <i class="fa fa-user mx-1"></i>
                                ورود به حساب کاربری </a>
                        </div>

                        @endguest

                    </div>
                </div>

            </div>
            @if(count($blog->comments->where('status' , 1)->where('parent' , null))> 0)
            <div class="grid grid-cols-12">

                @foreach($blog->comments->where('status' , 1)->where('parent' , null) as $comment)
                <div class="col-span-12 sm:col-span-6 bg-main25 rounded-3xl p-4 m-4">
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center">
                            @if(is_null($comment->user->avatar))
                            <img class="h-16 rounded-2xl" src="/assets/user-avatar.png" alt="{{$comment->user->name}} {{$comment->user->family}}">
                            @else
                                <img class="h-16 rounded-2xl" src="{{$comment->user->avatar}}" alt="{{$comment->user->name}} {{$comment->user->family}}">
                            @endif
                            <div class="mr-3 pt-2">
                                <h5 class=" text-main100 font-extrabold mb-2">{{$comment->user->name}} {{$comment->user->family}}</h5>
                                @if($comment->score != null)
                                <span>امتیاز:</span>
                                <small>({{$comment->score}} / 5)</small>
                                <i class="fa fa-star {{$comment->score >= 1 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                <i class="fa fa-star {{$comment->score >= 2 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                <i class="fa fa-star {{$comment->score >= 3 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                <i class="fa fa-star {{$comment->score >= 4 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                <i class="fa fa-star {{$comment->score == 5 ? 'text-yellow-500':'text-gray-400'}} "></i>
                                @endif
                            </div>

                        </div>
                        <div>
                            <span class="text-gray-500"><i class="fa fa-calendar-day mx-1"></i>{{jdate($comment->created_at)->ago()}}</span>
                        </div>
                    </div>
                    <div class="border-t border-main pt-4">
                        {{$comment->comment}}
                    </div>
                    @if(count($comment->childs))
                        @foreach($comment->childs as $child)

                            <div class="flex items-center">
                                <div>
                                    <i class="fa fa-reply"></i>
                                </div>
                                <div class="bg-gray-200 p-2 rounded-3xl mt-2 mr-2">
                                    <div class="flex items-center justify-between py-3">
                                        <div class="flex items-center">
                                            @if(is_null($child->user->avatar))
                                            <img class="h-16 rounded-2xl" src="/assets/user-avatar.png" alt="{{$child->user->name}} {{$child->user->family}}">
                                            @else
                                                <img class="h-16 rounded-2xl" src="{{$child->user->avatar}}" alt="{{$child->user->name}} {{$child->user->family}}">
                                            @endif
                                            <div class="mr-3 pt-2">
                                                <h5 class=" text-main100 font-extrabold mb-2">{{$child->user->name}} {{$child->user->family}}
                                                    <small class="text-gray-400">
                                                       در پاسخ به  {{$comment->user->name}} {{$comment->user->family}}
                                                    </small>
                                                </h5>
                                            </div>

                                        </div>
                                        <div>
                                            <span class="text-gray-500"><i class="fa fa-calendar-day mx-1"></i>{{jdate($child->created_at)->ago()}}</span>
                                        </div>
                                    </div>

                                    <div class="border-t border-main pt-4">
                                        {!! $child->comment !!}
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
                @endforeach

            </div>
            @else
                <div>
                    <p class="text-gray-400 max-w-none">هنوز دیدگاهی ثبت نشده! اولین نفری باشید که دیدگاه ثبت میکند.</p>
                </div>
            @endif
        </div>
    </div>
    {{--End comment--}}


    @section('script')

        <script>
            // انتخاب دکمه و مدال
            const comment = document.getElementById('comment');
            const closeModalButton = document.getElementById('closeModalButton');
            const modal = document.getElementById('myModal');

            // زمانی که کاربر روی دکمه کلیک می‌کند، مدال باز شود
            comment.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            // زمانی که کاربر روی دکمه بسته شدن کلیک می‌کند، مدال بسته شود
            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // همچنین می‌توانید مدال را با کلیک خارج از آن ببندید
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });

        </script>

        <style>
            .rating {
                border: none;
            }

            .rating > label {
                color: #90A0A3;
            }

            .rating > label:before {
                margin: 5px;
                font-size: 1.5em;
                font-family: "Font Awesome 5 Pro";
                content: "\f005";
                display: inline-block;
            }

            .rating > input {
                display: none;
            }

            .rating > input:checked ~ label,
            .rating:not(:checked) > label:hover,
            .rating:not(:checked) > label:hover ~ label {
                color: #F79426;
            }

            .rating > input:checked + label:hover,
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label,
            .rating > input:checked ~ label:hover ~ label {
                color: #FECE31;
            }
        </style>

    @endsection

@endsection
