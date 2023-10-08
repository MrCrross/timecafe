<x-welcome-layout>
    <x-slot name="header">
        <x-product-header welcome="true"/>
    </x-slot>
    <div
        id="menu"
        data-parallax="scroll"
        class="parallax-window py-12"
        data-image-src="{{asset('/img/welcome/antique-cafe-bg-02.jpg')}}"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-transparent">
            <div class="grid max-w-lg gap-10 lg:grid-cols-3 py-4 lg:max-w-none lg:p-6 bg-transparent shadow-xl sm:rounded-lg">
                @foreach($products->items() as $product)
                    <x-product-card :product="$product" welcome="true"></x-product-card>
                @endforeach
            </div>
            <x-paginate :paginator="$products"></x-paginate>
        </div>
    </div>
</x-welcome-layout>
