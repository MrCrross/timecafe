<x-app-layout>
    <x-slot name="header">
        @include('loyalty.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="max-w-lg flex flex-col justify-center items-center py-4 lg:max-w-none lg:p-6 bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg">
                <h2 class="mb-6 text-gray-800 dark:text-gray-200 text-4xl font-medium w-full text-center">Программа лояльности в Time Cafe</h2>
                <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow p-4 mt-4">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
