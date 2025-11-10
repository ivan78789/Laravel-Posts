<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            Просмотр поста
        </h2>
    </x-slot>

    <div class="min-h-screen flex items-start justify-center py-10 px-4">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 space-y-6">

            <div>
                <a href="{{ route('posts.index') }}"
                    class="inline-block px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Назад
                </a>
            </div>

<h3 class="text-3xl max-w-auto font-bold text-gray-900 dark:text-gray-100 break-words">
    Название поста: {{ $post->title }}
</h3>

<p class="text-gray-700 max-w-auto dark:text-gray-300 text-lg leading-relaxed break-words">
    Описание: 
    {{ $post->content }}
</p>

            <!-- Действия автора -->
@if(Auth::id() === $post->user_id)
    <div class="flex items-center gap-4 mt-4">
        <a href="{{ route('posts.edit', $post) }}"
            class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
            Редактировать
        </a>

        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Вы уверены?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                Удалить
            </button>
        </form>
    </div>
@endif


        </div>
    </div>
</x-app-layout>