<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-6">

            <form method="POST" action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <x-input-label for="title" :value="'Title'" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                  :value="old('title', $post->title ?? '')" required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="'Description'" />
                    <textarea name="description" rows="4"
                              class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">{{ old('description', $post->description ?? '') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="type" :value="'Type'" />
                    <select name="type" id="type" class="w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-white">
                        @foreach(['Request', 'Complaint', 'Improvement'] as $type)
                            <option value="{{ $type }}" @selected(old('type', $post->type ?? '') === $type)>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>
                        {{ isset($post) ? 'Update' : 'Create' }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
