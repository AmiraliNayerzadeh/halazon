@extends('.home.profile.master')

@section('content')

    <h1 class="text-2xl font-extrabold text-main my-4"><i class="fa fa-comment-alt mx-1"></i>دیدگاه و سوالات شما</h1>

    <div class="grid grid-cols-12">
        @if(count($comments) != 0  )
            @foreach($comments as $comment)
                <div class="col-span-12 sm:col-span-6 m-2">
                    <div class="bg-gray-100 rounded-3xl p-3 mb-2 h-full shadow-md border">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="rounded-3xl h-16 ml-2" src="{{$comment->commentable->image}}"
                                     alt="{{$comment->commentable->title}}">
                                {{$comment->commentable->title != null ? $comment->commentable->title : $comment->commentable->name.' '.$comment->commentable->family}}
                            </div>
                            <div class="hidden sm:block">
                                <i class="fa fa-calendar"></i>
                                {{jdate($comment->created_at)}}
                            </div>
                        </div>

                        <div class="bg-gray-50 mt-5 p-4 rounded-3xl">
                            <b class="text-main"><i class="fa fa-comment mx-2"></i>متن نظر شما </b>
                            <div class="mt-2">
                                {!! $comment->comment !!}
                            </div>
                        </div>

                        @if(count($comment->childs) > 0)
                            @foreach($comment->childs as $child)
                                <div class="flex items-center">
                                    <div><i class="fa fa-reply text-2xl mx-2"></i></div>
                                    <div class="bg-gray-50 mr-1 mt-5 p-4 rounded-3xl w-full">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <img class="rounded-3xl h-16" src="{{$child->user->avatar}}"
                                                     alt="{{$child->user->name}} {{$child->user->family}}">
                                                <b class="text-main mx-3">
                                                    {{$child->user->name}}
                                                    {{$child->user->family}}
                                                    <sm class="text-gray-500 text-sm">
                                                        (در پاسخ به نظر شما)
                                                    </sm>
                                                </b>
                                            </div>
                                            <div class="hidden sm:block">
                                                <i class="fa fa-calendar"></i>
                                                {{jdate($child->created_at)}}
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            {!! $child->comment !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            @endforeach
        @else
            <p class="mx-3">هنوز دیدگاه یا پرسشی ایجاد نشده است.</p>
        @endif
    </div>

@endsection
