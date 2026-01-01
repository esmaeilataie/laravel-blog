<x-panel.layout page_title="مدیریت کامنت ها">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('comments.index') }}" class="is-active">کامنت ها</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="comments.html"> همه نظرات</a>
                <a class="tab__item " href="comments.html">نظرات تاییده نشده</a>
                <a class="tab__item " href="comments.html">نظرات تاییده شده</a>
            </div>
        </div>


        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>تاریخ</th>
                    <th>تعداد پاسخ ها</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr role="row">
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->getCreatedAtInJalai() }}</td>
                        <td>{{ $comment->replies_count }}</td>
                        <td class="{{ $comment->is_approved ? 'text-success' : 'text-error' }}">
                            {{ $comment->getApprovedStatusInParsi() }}
                        </td>
                        <td>
                            <a href="" class="" title="حذف">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            <a href="show-comment.html" class="" title="رد">
                                <i class="fa-solid fa-remove"></i>
                            </a>
                            <a href="show-comment.html" target="_blank" class="" title="مشاهده">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="show-comment.html" class="" title="تایید">
                                <i class="fa-solid fa-check"></i>
                            </a>
                            <a href="edit-comment.html" class="" title="ویرایش">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $comments->links('vendor.pagination.bootstrap-4') }}
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
