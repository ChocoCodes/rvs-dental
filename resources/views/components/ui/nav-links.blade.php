@props([
    'url' => '',
    'name' => '',
    'variant' => '',
])

@php
    $baseClasses = 'hover:cursor-pointer inline-flex items-center justify-center px-4 py-2 font-sans text-sm border transition-colors duration-200 focus:outline-none focus:ring-1 disabled:opacity-50 disabled:cursor-not-allowed';

    $variantClasses = match ($variant) {
        'primary' => 'bg-primary border-tertiary text-white hover:bg-primary/90 focus:ring-primary',
        'secondary' => 'bg-secondary border-tertiary text-primary hover:bg-secondary/60 focus:ring-secondary',
        'danger' => 'bg-danger-muted border-danger text-black hover:bg-red-100 focus:ring-red-400',
    };
@endphp

<a
    href="{{ url($url) }}"
    {{ $attributes->merge(['class' => "$baseClasses $variantClasses"]) }}
>
    {{ $name }}
</a>
