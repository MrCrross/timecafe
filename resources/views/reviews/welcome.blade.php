<x-welcome-layout>
    <div
        id="reviews"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 rounded-xl shadow bg-gray-100 dark:bg-gray-800 p-4 flex flex-col">
            <form action="{{ route('reviews.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-row gap-4">
                    <div class="relative mb-4 w-1/4">
                        <x-input-label
                            for="rating"
                            :value="__('Оценка')"
                        />
                        <x-text-input
                            name="rating"
                            type="range" min="0" max="5" step="1" value="0"
                            class="w-full"
                            placeholder="Оценка"
                        ></x-text-input>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-4">0</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/5 -bottom-4">1</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/5 -bottom-4">2</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-3/5 -bottom-4">3</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute start-4/5 -bottom-4">4</span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-4">5</span>
                    </div>
                    <x-textarea name="content" class="w-full" placeholder="Комментарий"></x-textarea>
                </div>
                <x-green-button type="submit" class="w-28">Сохранить</x-green-button>
            </form>
            @foreach($reviews as $review)
                <div class="flex flex-row gap-2 rounded dark:bg-gray-600 bg-gray-200 p-5">
                    <div class="w-1/4 text-gray-700 dark:text-gray-400">
                        {{$review->user->fio}}
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <div class="relative mb-4 w-1/4">
                            <x-input-label
                                for="rating"
                                :value="__('Оценка')"
                            />
                            <x-text-input
                                type="range" min="0" max="5" step="1" value="{{$review->rating}}"
                                disabled
                                class="w-full"
                                placeholder="Оценка"
                            ></x-text-input>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute start-0 -bottom-4">0</span>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute start-1/5 -bottom-4">1</span>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute start-2/5 -bottom-4">2</span>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute start-3/5 -bottom-4">3</span>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute start-4/5 -bottom-4">4</span>
                            <span class="text-sm text-gray-700 dark:text-gray-400 absolute end-0 -bottom-4">5</span>
                        </div>
                        <div class="w-full text-gray-700 dark:text-gray-400">
                            <p>{{$review->content}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-welcome-layout>
