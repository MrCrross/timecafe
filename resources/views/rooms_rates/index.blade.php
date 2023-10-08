<x-app-layout>
    <x-slot name="header">
        @include('rooms_rates.partials.header')
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @foreach($rates as $rate)
                    <x-rooms-rate-card :rate="$rate"></x-rooms-rate-card>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
