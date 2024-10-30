<header class=' border-b shadow shadow-lg bg-white  tracking-wide relative z-50'>
    <div class="container mx-auto">
        <section class='flex  items-center justify-between  py-3 px-2 sm:px-10 min-h-[75px] '>

            <a href="{{route('home')}}" class=""><img src="/assets/logo.png" alt="logo" class='w-[120px]'/></a>

            <div class="flex px-4 w-1/3  rounded-3xl border-2  max-lg:hidden">
                <input type="text" placeholder="جستجو میان دوره های حلزون..."
                       class="w-full py-3 outline-none border-0 text-gray-600 text-sm"/>
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <div class="flex items-center ">

                <a class="p-3 {{\Illuminate\Support\Facades\Request::is('/profile/favorites') ? 'text-primary' : ''}} "
                   href="{{route('profile.favorite')}}">
                    <i class="fa-regular fa-heart  text-lg"></i>
                </a>
                <a class="p-3 {{\Illuminate\Support\Facades\Request::is('cart*') ? 'text-primary' : ''}}"
                   href="{{route('cart.index')}}">
                    <i class="fa-solid fa-cart-shopping text-lg"></i>
                </a>


                @auth
                    <span class='px-4 py-3 rounded-3xl bg-main text-white text-sm'>
                        <a href="{{route('profile.index')}}">
                        @if(!is_null(auth()->user()->name))
                                {{auth()->user()->name}} {{auth()->user()->family}}
                            @else
                                {{auth()->user()->phone}}
                            @endif
                        </a>
                    </span>
                @endauth
                @guest
                    <a href="{{route('login')}}"
                       class='px-4 py-3 rounded-3xl bg-main hover:bg-main100 duration-500 text-white shadow'>ورود/ثبت
                        نام</a>
                @endguest
            </div>

        </section>

        <div class='flex flex-wrap items-start gap-4 px-10 py-4 relative'>

            <nav id="collapseMenu"
                 class='w-full max-lg:hidden lg:!block max-lg:fixed max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50'>
                <button id="toggleClose" class='lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white p-3'>
                    <i class="fa fa-search w-4 fill-black"></i>
                </button>

                <ul class='lg:flex lg:justify-between gap-x-8 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50'>

                    @foreach(\App\Models\Category::where('parent_id' , null)->get() as $main)

                        <li class='group text-[14px] max-lg:border-b max-lg:px-3 max-lg:py-2 '>
                            <div class="flex w-full justify-between">
                            <a href="{{route('category' , $main)}}"
                               class='hover:text-main50  font-bold  block'>{{$main->title}}
                            </a>
                                <span class="fa fa-angle-down sm:mr-2"></span>

                            </div>
                            @if(count($main->children))
                                <div class='absolute w-full left-0 top-auto sm:top-64 lg:top-10  z-50 grid sm:flex shadow-lg bg-white rounded-lg max-h-0 overflow-hidden group-hover:opacity-100 group-hover:max-h-[700px] px-8 group-hover:pb-8 group-hover:pt-6 transition-all duration-500'>
                                    @foreach($main->children as $child)

                                        <div class="lg:min-w-[180px] max-lg:min-w-[140px]">

                                            <h6 class="text-base text-[#007bff]  ">
                                                <a class="text-primary "
                                                   href="{{route('category' , $child)}}">{{$child->title}}</a></h6>
                                            @if(count($child->children))
                                                <ul class=' py-3'>
                                                    @foreach($child->children as $childest)
                                                        <li class='max-lg:border-b py-3 sm:py-1 rounded'><a
                                                                    href="{{route('category' , $childest)}}"
                                                                    class='hover:text-[#007bff] text-gray-500 font-bold text-sm block'>{{$childest->title}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>
                            @endif

                        </li>

                    @endforeach


                </ul>
            </nav>

            <div class='flex ml-auto lg:hidden'>
                <button id="toggleOpen">
                    <i class="fa-solid fa-bars text-2xl text-main"></i>
                </button>
            </div>
        </div>
    </div>
</header>