<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Отображение всех постов.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }


    /**
     * Форма создания поста.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Сохранение нового поста.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Пост успешно создан!');
    }

    /**
     * Отображение конкретного поста.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }



    /**
     * Форма редактирования поста.
     */
    public function edit(Post $post)
    {
        $this->authorizeUser($post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Обновление поста.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorizeUser($post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Пост успешно обновлён!');
    }

    /**
     * Удаление поста.
     */
    public function destroy(Post $post)
    {
        $this->authorizeUser($post);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Пост успешно удалён!');
    }

    /**
     * Проверка авторства поста.
     */
    private function authorizeUser(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Вы не можете редактировать этот пост.');
        }
    }
}
