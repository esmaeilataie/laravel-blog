<x-panel.layout page_title="مدیریت کاربران">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" >پیشخوان</a></li>
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
                    <th>سطح کاربری</th>
                    <th>تاریخ عضویت</th>
                    <th>وضعیت حساب</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                <tr role="row" class="">
                    <td><a href="">1</a></td>
                    <td><a href="">محمد نیکو</a></td>
                    <td>programming@gmail.com</td>
                    <td>کاربر عادی</td>
                    <td>1399/11/11</td>
                    <td class="text-success">تاییده شده</td>
                    <td>

                        <a href="" class="mlg-15" title="حذف"><i class="fa-solid fa-trash-can"></i></a>
                        <a href="" class="mlg-15" title="تایید"><i class="fa-solid fa-check"></i></a>
                        <a href="" class="mlg-15" title="رد"><i class="fa-solid fa-xmark"></i></a>
                        <a href="edit-user.html" target="_blank" class="mlg-15" title="مشاهده"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('users.edit',1) }}" class=" " title="ویرایش"><i class="fa-regular
                        fa-pen-to-square"></i></a>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-panel.layout>
