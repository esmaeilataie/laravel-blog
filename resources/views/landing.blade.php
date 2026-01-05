<x-layout page_title="خانه">
    <main>
        <article class="container article">
            <div class="articles">
                @forelse($posts as $post)
                    <div class="articles__item">
                        <a href="{{ route('post.show', $post->slug) }}" class="articles__link">
                            <div class="articles__img">
                                <img src="{{ $post->getPostBannerUrl() }}" class="articles__img-src">
                            </div>
                            <div class="articles__title">
                                <h2>{{ $post->title }} </h2>
                            </div>
                            <div class="articles__desc">
                                ساعاتی قبل شیائومی از جدیدترین ساعت هوشمند خود رونمایی کرد که قرار است با نام می واچ
                                لایت راهی
                                بازار ...
                                ساعاتی قبل شیائومی از جدیدترین ساعت هوشمند خود رونمایی کرد که قرار است با نام می واچ
                                لایت راهی
                                بازار ...
                            </div>
                            <div class="articles__details">
                                <div class="articles__author">نویسنده : {{$post->user->name}}</div>
                                <div class="articles__date">تاریخ : {{$post->getCreatedAtInJalai()}}</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>هیچ مقاله ای یافت نشد</p>

                @endforelse
            </div>
        </article>
        <div class="pagination">
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </main>
</x-layout>
