<x-panel.layout page_title="ویرایش دسته بندی">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{ route('categories.index') }}" class="">دسبته بندی ها</a></li>
            <li><a href="" class="is-active">ویرایش دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ویرایش دسته بندی</p>
                <form action="{{ route('categories.update', $category->id) }}" class="padding-30" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" value="{{ old('name') ?? $category->name  }}"  name="name" class="text">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    <select class="select" name="category_id" id="">
                        <option value="">ندارد</option>
                        @foreach($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}"
                                {{ $parentCategory->id == $category->category_id ? 'selected' : ''}}>
                                {{$parentCategory->name }}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-webamooz_net">آپدیت</button>
                </form>

            </div>
        </div>
    </div>
</x-panel.layout>
