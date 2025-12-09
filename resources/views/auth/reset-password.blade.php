<x-layout page_title="ریست پسورد">
    <main class="bg--white">
        <div class="container">
            <div class="sign-page">
                <h1 class="sign-page__title">ریست کردن پسورد</h1>

                <form class="sign-page__form" method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <input type="text" name="email" value="{{ old('email',$request->email) }}" class="text text--left">
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                    <input type="password" name="password" class="text text--left" placeholder="رمز عبور">
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                    <input type="password" name="password_confirmation" class="text text--left"
                           placeholder="تکرار رمز عبور">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>


                    <button class="btn btn--blue btn--shadow-blue width-100 mb-10">ریست کن</button>
                </form>
            </div>
        </div>
    </main>
</x-layout>
