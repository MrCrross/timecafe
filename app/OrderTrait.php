<?php

namespace App;

trait OrderTrait
{
    private static array $orderDefault = [
        [
            'label' => 'Не сортировать',
            'value' => 0
        ],
        [
            'label' => 'По возрастанию',
            'value' => 1
        ],
        [
            'label' => 'По убыванию',
            'value' => 2
        ],
    ];

    public static function getOrderDefault(): array
    {
        $orderDefault = [];
        foreach (self::$orderDefault as $value) {
            $orderDefault[] = (object)$value;
        }
        return $orderDefault;
    }
}