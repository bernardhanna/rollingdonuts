@php
$element = $attributes->get('element', 'a');
if ($element === 'a' && !$attributes->has('href')) {
    $element = 'button';
}

$defaultClasses = 'inline-flex border border-black active:bg-black active:text-white ';

$types = [
    'primary' => 'text-white bg-black hover:bg-white hover:text-black',
    'outline' => 'text-black bg-transparent hover:bg-black hover:text-white',
];

$sizes = [
    'xs' => 'px-4 py-2 text-xs',
    'sm' => 'px-4 py-2 text-sm',
    'base' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
];
@endphp

<{{ $element }}
    class="{{ $defaultClasses }} {{ $types[$attributes->get('type', 'primary')] }} {{ $sizes[$attributes->get('size', 'base')] }} {{ $attributes->get('class') }}"

    @foreach ($attributes->except(['class', 'type', 'size', 'element']) as $key => $value)
        {{ $key }}="{{ $value }}"
    @endforeach
>
    {{ $slot }}
</{{ $element }}>
