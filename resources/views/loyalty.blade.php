<x-welcome-layout>
    <x-slot name="header">
    </x-slot>
    <div
        id="loyalty"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto p-6 space-y-2 bg-white bg-opacity-80 rounded text-xl font-sans">
            <h2 class="mb-6 tm-text-green text-4xl font-medium w-full text-center">Программа лояльности в Time Cafe</h2>
            <div class="trix-content trix-editor">
                {!! $content !!}
            </div>
        </div>
    </div>
</x-welcome-layout>
