<x-panel.layout page_title="مدیریت دسته بندی ها">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">برنامه نویسی</a></td>
                            <td>programming</td>
                            <td>ندارد</td>
                            <td>
                                <a href="" class="mlg-15" title="حذف">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <a href="edit-category.html" class="" title="ویرایش">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{ route('categories.store') }}" method="POST" class="padding-30">
                    @csrf
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="نام دسته بندی" class="text">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="نام انگلیسی دسته بندی"
                           class="text">
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />

                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select class="select" name="category_id" id="">
                        <option value="">ندارد</option>
                        @foreach($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function deleteUser(event, id) {
                event.preventDefault();

                Swal.fire({
                    title: "آیا مطمئن هستید؟",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "بله،حذفش کن!",
                    cancelButtonText: 'منصرف شدم'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-user-form-${id}`).submit()
                    }
                });

            }
        </script>
    </x-slot>
</x-panel.layout>
