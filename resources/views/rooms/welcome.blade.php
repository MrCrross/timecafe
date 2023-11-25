<x-welcome-layout>
    <x-slot name="header">
        <x-room-header welcome="true"/>
    </x-slot>
    <div
        id="room"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <form method="GET" action="{{route('rooms.welcome')}}#room" class="rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4">
                <div class="py-4">
                    <x-input-label
                        for="name"
                        :value="__('Название')"
                    />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-1 block w-full"
                    />
                </div>
                <div
                    class="flex items-center gap-4"
                >
                    <x-primary-button>
                        {{ __('Найти') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-transparent shadow-xl sm:rounded-lg">
                @foreach($rooms->items() as $room)
                    <x-room-card :room="$room" welcome="true"></x-room-card>
                @endforeach
            </div>
            <x-paginate :paginator="$rooms" tag="#room"></x-paginate>
        </div>
    </div>
</x-welcome-layout>
