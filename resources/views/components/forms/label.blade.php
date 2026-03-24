@props(['for' => '', 'value' => ''])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'font-mono']) }}>
    {{ $value }}
</label>
