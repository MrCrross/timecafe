@props([
    'label' => '',
    'value' => ''
])
<p
    {{
        $attributes->merge([
            'class' => 'text-gray-800 dark:text-gray-200'
        ])
    }}
>
    <span
        class="font-bold"
    >
        {{$label}}:
    </span>
    {{$value}}
</p>
