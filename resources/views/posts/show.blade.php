@extends('layouts.app')

@section('title', 'Post Details')

@section('content')
<div class="container">
    <!-- Post Details -->
    <div class="post">
        <h1 class="text-2xl font-bold">Post Content: </h1>
        <p> {{ $post->post_content }}</p>
        <p class="text-gray-600">
            Posted by <a href="{{ route('profiles.show', $post->user->id) }}" class="text-blue-500 hover:underline">{{ $post->user->name }}</a>
        </p>
    </div>

    <!-- Comments Section -->
    <div class="comments mt-6">
        <h2 class="text-xl font-semibold">Comments:</h2>

        <!-- Display Existing Comments -->
        <div class="mt-4">
            @forelse($post->comments as $comment)
                <div class="comment border-b border-gray-300 py-2">
                    <p>{{ $comment->commenting }}</p>
                    <p class="text-gray-600">
                        Commented by <a href="{{ route('profiles.show', $comment->user->id) }}" class="text-blue-500 hover:underline">{{ $comment->user->name }}</a>
                    </p>
                </div>
            @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>

        <!-- Add Comment Form -->
        <div class="mt-4">
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <textarea name="commenting" placeholder="Write a comment..." class="w-full p-2 border border-gray-300 rounded"></textarea>
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 hover:bg-blue-700">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Post Form -->
    @if(Auth::check() && Auth::user()->id === $post->user_id) 
        <div class="mt-6">
            <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
                    onclick="return confirm('Are you sure you want to delete this post?')">
                    Delete Post
                </button>
            </form>
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="text-blue-500 hover:underline">Back to Posts</a>
    </div>
</div>
@endsection
