@props([
    'type' => 'text',
    'name' => 'input',
    'value' => '',
    'placeholder' => '',
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'font-mono']) }}
/>
