@php
$spacingSettings = get_sub_field('spacing_settings');
$breakpoints = [
  'default' => '',
  'xs' => 'xs:',
  'sm-mob' => 'sm-mob:',
  'mobile' => 'mobile:',
  'sm' => 'sm:',
  'md' => 'md:',
  'tablet-sm' => 'tablet-sm:',
  'lg' => 'lg:',
  'notebook' => 'notebook:',
  'laptop' => 'laptop:',
  'xl' => 'xl:',
  'macbook' => 'macbook:',
  'xxl' => 'xxl:',
  'insta-flow' => 'insta-flow:',
  'one-xl' => 'one-xl:',
  'desktop' => 'desktop:',
  'site' => 'site:',
  'xxxl' => 'xxxl:',
  'xxxxl' => 'xxxxl:',
  'xxxxxl' => 'xxxxxl:',
];

$classNames = 'w-full'; // Start with default classes

foreach ($spacingSettings as $setting) {
    $breakpointKey = $setting['breakpoint'];
    $breakpoint = $breakpoints[$breakpointKey] ?? '';
    if ($setting['padding_top']) {
        $classNames .= " {$breakpoint}pt-{$setting['padding_top']}";
    }
    if ($setting['padding_bottom']) {
        $classNames .= " {$breakpoint}pb-{$setting['padding_bottom']}";
    }
}
@endphp

<div class="{{ $classNames }}">
</div>
