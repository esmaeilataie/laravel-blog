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
                <div class="table__box bg-white">
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
                        @foreach($categories as $category)
                            <tr role="row" class="">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->getParentName() }}</td>
                                <td>
                                    <a href="{{ route('categories.destroy', $category->id) }}" class="mlg-15"
                                       title="حذف" onclick="deleteCategory(event,{{$category->id}})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy',$category->id) }}" method="POST"
                                          id="delete-category-form-{{$category->id}}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('categories.edit',$category->id) }}" class="" title="ویرایش">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links('vendor.pagination.bootstrap-4') }}
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
            function deleteCategory(event, id) {
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
                        document.getElementById(`delete-category-form-${id}`).submit()
                    }
                });

            }
        </script>
    </x-slot>
</x-panel.layout>
