@php
    $paddingTop = get_sub_field('padding_top') ?? '0';
    $paddingBottom = get_sub_field('padding_bottom') ?? '0';
@endphp

<section class="editor-flexi w-full px-4" style="
    padding-top: {{ get_sub_field('padding_top') ?? '0' }};
    padding-bottom: {{ get_sub_field('padding_bottom') ?? '0' }};
">
    <div class="max-w-max-1364 m-auto e-content">
        {!! get_sub_field('editor_content') !!}
    </div>
</section>
