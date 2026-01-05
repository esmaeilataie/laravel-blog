<x-layout page_title="{{$post->title}}">
    <main>
        <div class="container article">
            <article class="single-page">
                <div class="breadcrumb">
                    <ul class="breadcrumb__ul">
                        <li class="breadcrumb__item">
                            <a href="{{ route('home') }}"
                               class="breadcrumb__link" title="خانه">بخش مقالات</a>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="{{ route('post.show', $post->slug) }}" class="breadcrumb__link">{{ $post->title
                            }}</a></li>
                    </ul>
                </div>
                <div class="single-page__title">
                    <h1 class="single-page__h1">{{ $post->title }}</h1>
                    @auth
                        <span class="single-page__like @if($post->if_user_liked) single-page__like--is-active
                    @endauth
                    @endif"></span>

                </div>
                <div class="single-page__details">
                    <div class="single-page__author">نویسنده : {{$post->user->name}}</div>
                    <div class="single-page__date">تاریخ : {{$post->getCreatedAtInJalai()}}</div>
                </div>
                <div class="single-page__img">
                    <img class="single-page__img-src" src="{{ $post->getPostBannerUrl() }}" alt="">
                </div>
                <div class="single-page__content">
                    {!! $post->content !!}
                </div>
                <div class="single-page__tags">
                    <ul class="single-page__tags-ul">
                        @foreach($post->categories as $category)
                            <li class="single-page__tags-li">
                                <a href="" class="single-page__tags-link">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </article>
        </div>
        <div class="container">
            <div class="comments" id="comments">
                @auth
                    <div class="comments__send">
                        <div class="comments__title">
                            <h3 class="comments__h3"> دیدگاه خود را بنویسید </h3>
                            <span class="comments__count">  نظرات ( {{$post->comments_count}} ) </span>
                        </div>
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="comment_id" value="" id="reply-input">
                            <textarea class="comments__textarea" name="content" placeholder="بنویسید"></textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
                            <button class="btn btn--blue btn--shadow-blue">ارسال نظر</button>
                        </form>
                    </div>
                @else
                    <p style="display: inline-block; margin-left: 15px;">برای نظر دادن باید وارد سایت شوید</p>
                    <a href="{{ route('login') }}" class="btn btn--blue btn--shadow-blue">ورود</a>
                @endauth
                <div class="comments__list">
                    @foreach($post->comments as $comment)
                        @include('comments.comment', ['comment' => $comment])
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <x-slot name="scripts">
        <script>
            function setReplyValue(id) {
                document.getElementById('reply-input').value = id
            }

            $(".single-page__like").on("click", function () {
                fetch('{{route("like.post",$post->slug)}}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    $(this).toggleClass("single-page__like--is-active");
                })
            })

        </script>
    </x-slot>

</x-layout>
