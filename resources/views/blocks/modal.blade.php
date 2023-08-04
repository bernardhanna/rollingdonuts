<x-modal title="{{ $heading }}">
    <x-slot:button>
        {{ $buttonText }}
    </x-slot:button>

    {!! $blockContent !!}
</x-modal>
