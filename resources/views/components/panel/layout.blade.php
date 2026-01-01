@props(['page_title'])

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>پنل وبلاگ - {{ $page_title ?? '' }}</title>
    <link rel="stylesheet" href="{{ asset('blog/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('blog/panel/css/all.min.css') }}">
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <div class="profile__info border cursor-pointer text-center" style="margin-bottom: 80px">
        <div class="avatar__img"><img src="{{ asset('blog/panel/img/pro.jpg') }}" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name" style="font-size: 14px"> {{auth()->user()->name}}</span>
        <span class="profile__name" style="font-size: 14px">{{auth()->user()->getRoleByPersian()}}</span>
    </div>

    <ul>
        <li class="{{request()->routeIs('dashboard') ? 'is-active' : ''}}">
            <a href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-line"></i>پیشخوان</a>
        </li>
        @if(auth()->user()->role === 'admin')
            <li class="{{request()->routeIs('users.*') ? 'is-active' : ''}}">
                <a href="{{ route('users.index') }}"><i class="fa-solid fa-user"></i> کاربران </a>
            </li>
            <li class="{{request()->routeIs('categories.*') ? 'is-active' : ''}}">
                <a href="{{ route('categories.index') }}">
                    <i class="fa-solid fa-pen-ruler"></i>دسته بندی ها</a>
            </li>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
            <li class="{{request()->routeIs('posts.*') ? 'is-active' : ''}}">
                <a href="{{ route('posts.index') }}">
                    <i class="fa-solid fa-newspaper"></i>مقالات</a>
            </li>
        @endif
        @if(auth()->user()->role === 'admin')
            <li class="{{request()->routeIs('comments.*') ? 'is-active' : ''}}">
                <a href="{{ route('comments.index') }}"><i class="fa-solid fa-comments"></i> نظرات</a>
            </li>
        @endif
        <li class=""><a href="user-information.html"><i class="fa-solid fa-list-check"></i>اطلاعات کاربری</a></li>
    </ul>

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="header__logo" href="https://webamooz.net"></a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2" style="cursor: pointer">

            <a href="#" title="خروج" onclick="logOut(event)"><i class="fa-solid fa-right-from-bracket"></i></a>
            <form action="{{route('logout')}}" method="POST" id="logout_form">
                @csrf
            </form>
        </div>
    </div>
    {{ $slot }}
</div>
</body>
<script src="{{ asset('blog/panel/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('blog/panel/js/js.js') }}"></script>
<script src="{{ asset('blog/panel/js/all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('status'))
    <script>
        {{--Swal.fire({--}}
        {{--    title: "{{session('status')}}",--}}
        {{--    confirmButtonText: "تایید",--}}
        {{--    icon: "success"--}}
        {{--});--}}

        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-end",
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "{{session('status')}}"
        });

    </script>
@endif
<script>
    function logOut(e) {
        e.preventDefault();
        document.getElementById('logout_form').submit();
    }
</script>
{{ $scripts ?? '' }}
</html>
