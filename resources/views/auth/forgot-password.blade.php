<x-layout page_title="بازیابی رمز عبور">
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">بازیابی رمز عبور</h1>

                <form class="sign-page__form" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <input type="text" name="email" value="{{ old('email') }}" class="text text--left"
                           placeholder="ایمیل">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <button class="btn btn--blue btn--shadow-blue width-100 ">بازیابی</button>
                    <div class="sign-page__footer">
                        <span>کاربر جدید هستید؟</span>
                        <a href="{{ route('register') }}" class="color--46b2f0">صفحه ثبت نام</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-layout>
