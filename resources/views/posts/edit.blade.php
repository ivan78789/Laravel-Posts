<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Редактирование
        </h2>
    </x-slot>
@if(session('success'))
    <p class="text-green-600">{{ session('success') }}</p>
@endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700 dark:text-gray-300">Заголовок</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700 dark:text-gray-300">Содержание</label>
            <textarea id="content" name="content" rows="5"
                class="w-full border rounded p-2">{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Сохранить
        </button>
    </form>
</x-app-layout>