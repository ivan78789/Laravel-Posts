<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Главная
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Привет") }} {{ Auth::user()->name }}! Создай свой пост.
                </div>
            </div>

            <a href="{{ route('posts.create') }}"
                class="mb-4 inline-block px-4 py-2 bg-blue-500 text-white rounded">Создать новый пост</a>

            @if(session('success'))
                <p class="text-green-600">{{ session('success') }}</p>
            @endif

<ul>
    @foreach($posts as $post)
        <li class="mt-2">
            <a href="{{ route('posts.show', $post) }}" class="text-blue-700">
                Название поста: {{ $post->title }}
            </a>
            <br>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-700">
                Описание: {{ $post->content }}
            </a>
            <br>

            | <a href="{{ route('posts.show', $post) }}" class="text-yellow-700">Просмотреть</a>

            <!-- Кнопки редактирования и удаления только автору -->
            @if(Auth::id() === $post->user_id)
                | <a href="{{ route('posts.edit', $post) }}" class="text-yellow-700">Редактировать</a>
                |
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-700">Удалить</button>
                </form>
            @endif
        </li>
    @endforeach
</ul>

        </div>
    </div>

  

</x-app-layout>