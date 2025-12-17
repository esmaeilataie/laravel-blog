<x-panel.layout page_title="مدیریت کاربران">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('users.index') }}" class="is-active">کاربران</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('users.index') }}">همه کاربران</a>
                <a class="tab__item" href="{{ route('users.create') }}">ایجاد کاربر جدید</a>
            </div>
        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        </div>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل</th>
                    <td>موبایل</td>
                    <th>سطح کاربری</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr role="row" class="">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->getRoleByPersian() }}</td>
                        <td>{{ $user->getCreatedAtInJalai() }}</td>
                        <td>

                            <a href="" class="mlg-15" title="حذف"><i class="fa-solid fa-trash-can"></i></a>
                            <a href="{{ route('users.edit',$user->id) }}" class=" " title="ویرایش"><i class="fa-regular
                        fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-panel.layout>
