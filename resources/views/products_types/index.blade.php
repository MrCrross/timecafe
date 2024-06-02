<x-app-layout>
    <x-slot name="header">
        @include('products_types.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @if ($message = Session::get('error'))
                    <div class="w-full px-10 py-5 bg-red-500">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @foreach($types as $type)
                    <x-product-type-card :type="$type"></x-product-type-card>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
