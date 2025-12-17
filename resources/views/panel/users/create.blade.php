<x-panel.layout page_title="ساخت کاربر جدید">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="">کاربران</a></li>
            <li><a href="{{ route('users.create') }}" class="is-active">ایجاد کاربر جدید</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters  bg-white">
            <div class="col-12">
                <p class="box__title">ساخت کاربر</p>
                <form action="{{ route('users.store') }}" class="padding-30" method="POST">
                    @csrf
                    <input type="text" value="{{ old('name') }}"  name="name" class="text"
                           placeholder="نام">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <input type="email"value="{{ old('email') }}"  name="email" class="text" placeholder="ایمیل">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <input type="text" value="{{ old('mobile') }}" name="mobile" class="text"
                           placeholder="شماره موبایل">
                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />

                    <select name="role" id="" class="select">
                        <option value="user" selected>کاربر عادی</option>
                        <option value="author">نویسنده</option>
                        <option value="admin">مدیر</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />

                    <button class="btn btn-webamooz_net">ساخت</button>
                </form>

            </div>
        </div>
    </div>
</x-panel.layout>
