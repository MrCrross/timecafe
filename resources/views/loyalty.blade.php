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
            <p>Выгодная бонусная система для постоянных гостей Time Cafe.</p>
            <p>При регистрации в Антикафе Time Cafe, Вы получаете возможность видеть свою историю бронирований мест.</p>
            <p>Также за каждые 10 часов посещений, стоимость часа посещения снижается на 1%. Максимум до 15%.</p>
        </div>
    </div>
</x-welcome-layout>
