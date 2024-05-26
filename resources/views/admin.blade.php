<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Панель администратора') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <p class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
                Добро пожаловать в Панель администратора TimeCafe!
            </p>
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full text-xl text-gray-800 dark:text-gold">
                <p>
                    Здесь вы можете управлять нашим уютным пространством, контролировать работу персонала, следить за
                    бронированием столиков и регистрацией гостей. Эффективное администрирование – залог его
                    успешного функционирования и приятного времяпрепровождения посетителей.
                </p>
                <p>
                    В вашем распоряжении инструменты для управления комнатами, сотрудниками, заказами, тарифами и бронированием.
                    Обеспечьте высокий уровень сервиса и станьте лидером в TimeCafe.
                    @TimeCafe
                </p>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-full font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
                <p class="mb-4">Администрирование</p>
                <div class="flex flex-row items-center justify-between m-2">
                    <x-nav-link :href="route('rules.index')">
                        {{__('Правила')}}
                    </x-nav-link>
                    <x-nav-link :href="route('loyalty.index')">
                        {{__('Программа лояльности')}}
                    </x-nav-link>
                    @if(Auth::user()->params()->hasAny(['reports_attendance', 'reports_profits']))
                        <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.index')">
                            {{ __('Отчетность') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::user()->params()->has('stocks_view'))
                        <x-nav-link :href="route('stocks.index')" :active="request()->routeIs('stocks.index')">
                            {{ __('Акции') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
