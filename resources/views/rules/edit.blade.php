<x-app-layout>
    <x-slot name="header">
        @include('rules.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-lg flex flex-col justify-center items-center py-4 lg:max-w-none lg:p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <h1 class="mb-6 text-gray-800 dark:text-gray-200 text-4xl font-medium w-full text-center">Текстовый редактор правил</h1>
                <form method="POST" action="{{ route('rules.save') }}">
                    @csrf
                    <input id="content" type="hidden" name="content" value="{{ $content }}">
                    <trix-editor input="content" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow p-4 trix-content trix-editor"></trix-editor>
                    <x-primary-button class="mt-2">
                        Сохранить
                    </x-primary-button>
                </form>

                <h2 class="mb-6 text-gray-800 dark:text-gray-200 text-4xl font-medium w-full text-center">Правила в Time Cafe</h2>
                <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow p-4 trix-content trix-editor">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
