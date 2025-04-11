<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Admin Panel - Posts
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                    <h2 class="text-xl font-bold">{{ $post->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Type: {{ $post->type }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-300">By {{ $post->user->name }}</p>
                    <p class="mt-2 text-gray-700 dark:text-gray-200">{{ $post->description }}</p>

                    <p class="mt-2">Votes: <strong>{{ $post->vote_count }}</strong></p>
                    <p>Status: {{ $post->is_hidden ? 'Hidden' : 'Visible' }}</p>

                    <div class="mt-4 flex gap-4">
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                            @csrf 
                            @method('DELETE')
                            <x-danger-button>Delete</x-danger-button>
                        </form>

                        <form method="POST" action="{{ route('admin.posts.hide', $post) }}">
                            @csrf 
                            @method('PATCH')
                            <x-primary-button>
                                {{ $post->is_hidden ? 'Unhide' : 'Hide' }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
