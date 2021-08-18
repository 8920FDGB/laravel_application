@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">タイトル</label>
                    <input type="text" name="title" class="form-control" placeholder="ここにタイトルを入力してください">
                </div>
                <div class="form-group">
                    <label for="">本文</label>
                    <textarea name="body" id="" rows="5" class="form-control" placeholder="ここに本文を入力してください"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">投稿する</button>
            </form>
        </div>
    </div>
</div>
@endsection
