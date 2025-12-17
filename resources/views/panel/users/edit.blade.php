<x-panel.layout page_title="ویرایش کاربر">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="">کاربران</a></li>
            <li><a href="" class="is-active">ویرایش کاربران</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ویرایش کاربر</p>
                <form action="{{ route('users.update', $user->id) }}" class="padding-30" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" value="{{ old('name') ?? $user->name  }}"  name="name" class="text"
                           placeholder="نام">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <input type="email"value="{{ old('email') ?? $user->email}}"  name="email" class="text"
                           placeholder="ایمیل">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <input type="text" value="{{ old('mobile') ?? $user->mobile }}" name="mobile" class="text"
                           placeholder="شماره موبایل">
                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />

                    <select name="role" id="" class="select">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>کاربر عادی</option>
                        <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>نویسنده</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدیر</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />

                    <button class="btn btn-webamooz_net">ذخیره</button>
                </form>

            </div>
        </div>
    </div>
</x-panel.layout>
