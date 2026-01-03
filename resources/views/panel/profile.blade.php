<x-panel.layout page_title="
پروفایل کاربر">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('_profile.edit') }}" class="is-active">پروفایل</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="user-info bg-white padding-30 font-size-13">
            <form action="{{ route('_profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="profile__info border cursor-pointer text-center">
                    <div class="avatar__img"><img src="{{ auth()->user()->getProfileAvatarUrl() }}" class="avatar___img">
                        <input type="file" name="profile" accept="image/*" class="hidden avatar-img__input">
                        <div class="v-dialog__container" style="display: block;"></div>
                        <div class="box__camera default__avatar"></div>
                    </div>
                    <span class="profile__name">کاربر : محمد نیکو</span>
                    <p>
                        <x-input-error :messages="$errors->get('profile')" class="mt-2" />
                    </p>
                </div>

                <input class="text" name="name" placeholder="نام کاربری" value="{{auth()->user()->name}}">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                <input class="text" name="mobile" placeholder="موبایل" value="{{auth()->user()->mobile}}">
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />

                <input class="text text-left" name="email" type="email" placeholder="ایمیل" value="{{auth()->user()
                ->email}}">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <input class="text text-left" name="password" type="password" placeholder="رمز عبور">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
                <br>
                <br>
                <button class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>
    </div>


</x-panel.layout>
