<x-panel.layout page_title="ویرایش مقاله">
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('dashboard') }}">پیشخوان</a></li>
            <li><a href="{{ route('posts.index') }}" class="">مقالات</a></li>
            <li><a href="" class="is-active">ویرایش مقاله</a></li>
        </ul>
    </div>

    <div class="main-content padding-0">
        <p class="box__title">ویرایش مقاله</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" class="text" placeholder="عنوان مقاله" value="{{ $post->title }}">
                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>

                    <p>دسته بندی مقاله</p>
                    <ul class="tags">
                        @foreach($post->categories as $category)
                            <li class="addedTag">{{$category->name}}<span class="tagRemove" onclick="$(this).parent()
                        .remove();
                        ">x</span>
                                <input type="hidden" value="{{$category->name}}" name="categories[]">
                            </li>
                        @endforeach
                        <li class="tagAdd taglist">
                            <input type="text" id="search-field">
                        </li>
                    </ul>
                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />

                    <div class="file-upload">
                        <div class="i-file-upload">
                            <span>آپلود بنر دوره</span>
                            <input type="file" class="file-upload" id="files" name="banner" accept="image/*"/>
                        </div>
                        <span class="filesize"></span>
                        <span class="selectedFiles">فایلی انتخاب نشده است</span>
                    </div>
                    <x-input-error :messages="$errors->get('banner')" class="mt-2" />

                    <textarea placeholder="متن مقاله" class="text" name="content">{!! $post->content !!}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />

                    <button class="btn btn-webamooz_net">آپدیت مقاله</button>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'content' ,{
                language : 'fa',
                filebrowserUploadUrl : '{{ route("editor-upload", ["_token" => csrf_token()]) }}',
                filebrowserUploadMethod : 'form',
            });
        </script>
        <script src="{{ asset('blog/panel/js/tagsInput.js') }}"></script>
    </x-slot>
</x-panel.layout>
