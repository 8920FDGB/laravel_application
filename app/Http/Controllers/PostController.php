<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 投稿一覧画面表示
    public function index()
    {
        // モデルから投稿を全権取得して表示する
        $posts = Post::all();

        // 取得したデータをビューに変数として渡す
        return view('posts.index', ['posts' => $posts]);
    }

    // 登録（投稿）画面表示
    public function create()
    {
        // Q11コントローラーの処理が通っているかの確認
        dd('投稿画面だよ！！');

        // create.blade.phpを表示する
        return view('posts.create');
    }

    // 登録（投稿）処理
    public function store(PostRequest $request)
    {
        // Postモデルのインスタンスを生成
        $post = new Post;

        // ユーザーが入力したリクエストの情報を格納していく
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id(); // Auth::id()でログインユーザーのIDが取得できる

        $post->save(); // インスタンスをDBのレコードとして保存

        // 投稿一覧画面にリダイレクトさせる
        return redirect()->route('post.index');
    }

    //詳細表示処理
    public function show($id)
    {
        // 投稿データのIDでモデルから投稿を１件取得
        $post = Post::findOrFail($id);

        // show.blade.phpを表示する
        return view('posts.show', ['post' => $post]);
    }

    // 編集画面表示処理
    public function edit($id)
    {
        // 投稿データのIDでモデルから投稿を１件取得
        $post = Post::findOrFail($id);

        // Q11コントローラーの処理が通っているかの確認
        dd($post);

        // 投稿者以外の編集を防ぐ
        if ($post->user_id !== Auth::id()) {
            return redirect('/');
        }

        // edit.blade.phpを表示する
        return view('posts.edit', ['post' => $post]);
    }

    // 編集更新処理
    public function update(PostRequest $request, $id)
    {
        // 投稿データのIDでモデルから東欧を１件取得
        $post = Post::findOrFail($id);

        // 投稿者以外の編集を防ぐ
        if ($post->user_id !== Auth::id()) {
            return redirect('/');
        }

        // 投稿画面から受け取ったデータをインスタンスに反映
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save(); // DBのレコードを更新

        return redirect('/');
    }

    // 削除処理
    public function delete($id)
    {
        // 投稿データのIDでモデルから投稿を１件取得
        $post = Post::findOrFail($id);

        // 投稿者以外の削除を防ぐ
        if ($post->user_id !== Auth::id()) {
            return redirect('/');
        }

        $post->delete(); // DBのレコードを削除

        return redirect('/');
    }
}
