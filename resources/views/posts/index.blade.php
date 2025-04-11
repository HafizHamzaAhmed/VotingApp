<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                    + Create Post
                </a>
            </div>

            @foreach($topPosts as $post)
                <div class="p-4 bg-green-100 rounded shadow-sm">
                    <strong>{{ $post->title }}</strong> — {{ $post->vote_count }} votes
                </div>
            @endforeach

            @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h2 class="text-xl font-bold">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Type: {{ $post->type }} | By {{ $post->user->name }}
                    </p>
                    <p class="mt-2 text-gray-800 dark:text-gray-100">{{ $post->description }}</p>

                    <p class="mt-2">Votes: <strong>{{ $post->vote_count }}</strong></p>

                    <div class="mt-4 flex gap-3">
                        @if(!$post->votes->contains('user_id', auth()->id()))
                            <form method="POST" action="{{ route('posts.vote', $post) }}">
                                @csrf
                                <x-primary-button>Vote</x-primary-button>
                            </form>
                        @else
                            <span class="text-green-500 font-semibold">You voted</span>
                        @endif

                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="text-blue-500 hover:underline">Edit</a>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
