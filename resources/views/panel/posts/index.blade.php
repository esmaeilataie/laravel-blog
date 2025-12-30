<x-panel.layout page_title="مدیریت مقاله ها">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="is-active">مقالات</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{ route('posts.index') }}">لیست مقالات</a>
                <a class="tab__item " href="{{ route('posts.create') }}">ایجاد مقاله جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <div type="text" class="text search-input__box font-size-13">جستجوی مقاله
                            <div class="t-header-search-content ">
                                <input type="text" class="text" placeholder="نام مقاله">
                                <btutton class="btn btn-webamooz_net">جستجو</btutton>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box bg-white">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>عنوان</th>
                    <th>نویسنده</th>
                    <th>تاریخ ایجاد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr role="row" class="">
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->getCreatedAtInJalai() }}</td>
                        <td>
                            <a href="{{route('posts.destroy', $post->id)}}" class="mlg-15" title="حذف"
                               onclick="deletePost(event,{{$post->id}})">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            <a href="" target="_blank" class="mlg-15" title="مشاهده">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="" title="ویرایش">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                  id="delete-post-form-{{$post->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function deletePost(event, id) {
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
                        document.getElementById(`delete-post-form-${id}`).submit()
                    }
                });

            }
        </script>
    </x-slot>
</x-panel.layout>
