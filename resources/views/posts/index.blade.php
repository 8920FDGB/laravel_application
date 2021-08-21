@extends('layouts.app')

@section('content')
    <div class="col-md-6 mx-auto">
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-md">
            <i class="far fa-create">+新規投稿する</i>
        </a>
        @foreach ($posts as $post)
            <div class="card-wrap">
                <div class="card mt-3">
                    <div class="card-header">
                        {{ $post->user->name }}
                    </div>
                    <div class="card-body">
                        <h3>
                            {{ $post->title }}
                        </h3>
                        <p class="mb-4">
                            {{ $post->body }}
                        </p>
                        <div class="text-right">
                            <a href="{{ route('post.show', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">
                                <i class="far fa-show"></i>詳細
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
