<x-panel.layout page_title="پیشخوان">
    <div class="breadcrumb">
        <ul>
            <li><a href="index.html" title="پیشخوان">پیشخوان</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="row no-gutters font-size-13 margin-bottom-10">
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p>تعداد پست ها</p>
                    <p>{{$postsCount}} پست</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p>تعداد نظرات</p>
                    <p>{{ $commentsCount }} نظر</p>
                </div>
            @endif
            @if(auth()->user()->role === 'admin')
                <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                    <p> تعداد کاربران </p>
                    <p>{{ $usersCount }} نفر</p>
                </div>
                <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
                    <p>تعداد دسته بندی ها</p>
                    <p>{{ $categoriesCount }} نظر</p>
                </div>
            @endif
        </div>

    </div>
</x-panel.layout>
