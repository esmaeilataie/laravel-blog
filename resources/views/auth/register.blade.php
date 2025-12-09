<x-layout page_title="ثبت نام">
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">ثبت نام در وب‌سایت</h1>

                <form class="sign-page__form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <input name="name" value="{{ old('name') }}" type="text" class="text text--right"
                           placeholder="نام و نام خانوادگی">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="text text--left"
                           placeholder="شماره موبایل">
                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                    <input type="text" name="email" value="{{ old('email') }}" class="text text--left"
                           placeholder="ایمیل">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <input type="password" name="password" class="text text--left" placeholder="رمز عبور">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <input type="password" name="password_confirmation" class="text text--left"
                           placeholder="تکراررمزعبور">


                    <button class="btn btn--blue btn--shadow-blue width-100 mb-10">ثبت نام</button>
                    <div class="sign-page__footer">
                        <span>در سایت عضوید ؟ </span>
                        <a href="{{ route('login') }}" class="color--46b2f0">صفحه ورود</a>

                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>
