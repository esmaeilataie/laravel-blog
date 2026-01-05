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
                <a class="tab__item is-active" href="{{ route('comments.index') }}"> همه نظرات</a>
                <a class="tab__item" href="{{ route('comments.index', ['approved' =>
                0]) }}">نظرات تاییده
                    نشده</a>
                <a class="tab__item " href="{{ route('comments.index', ['approved' => 1]) }}">نظرات تاییده شده</a>
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
                            <a href="{{route('comments.destroy', $comment->id)}}" class="" title="حذف"
                               onclick="deleteComment(event,{{$comment->id}})">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                            <a href="show-comment.html" target="_blank" class="" title="مشاهده">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @if($comment->is_approved)
                                <a href="{{route('comments.update', $comment->id)}}" class="" title="رد"
                                   onclick="updateComment(event,{{$comment->id}})">
                                    <i class="fa-solid fa-remove"></i>
                                </a>
                            @else
                                <a href="{{route('comments.update', $comment->id)}}" class="" title="تایید"
                                   onclick="updateComment(event,{{$comment->id}})">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                            @endif
                            <a href="edit-comment.html" class="" title="ویرایش">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST"
                                  id="update-comment-form-{{$comment->id}}">
                                @csrf
                                @method('PUT')
                            </form>

                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                  id="delete-comment-form-{{$comment->id}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $comments->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function deleteComment(event, id) {
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
                        document.getElementById(`delete-comment-form-${id}`).submit()
                    }
                });

            }

            function updateComment(event, id) {
                event.preventDefault();

                document.getElementById(`update-comment-form-${id}`).submit()
            }
        </script>
    </x-slot>
</x-panel.layout>
