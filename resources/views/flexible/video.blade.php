@php
$video_thumbnail = get_sub_field('video_thumbnail');
$image_id = $video_thumbnail ? $video_thumbnail['ID'] : null;
$video_title = get_sub_field('video_title');
$sizes = [
    'thumbnail' => '150w',
    'medium' => '300w',
    'large' => '1024w',
    'full' => '2048w',
];
$srcset = [];

if ($image_id) {
    foreach ($sizes as $size => $width) {
        $image_url = wp_get_attachment_image_url($image_id, $size);
        if ($image_url) {
            $srcset[] = "{$image_url} {$width}";
        }
    }
}

$srcset_attribute = implode(', ', $srcset);
$image_url_default = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
$youtube_video_id = get_sub_field('youtube_video_id');
@endphp

<div class="flexi-video relative w-full px-4 m-auto flex flex-col items-center gap-10 rounded-video">
    <div class="relative w-full max-w-max-1359 h-[290px] lg:h-[600px] rounded-video">
        <img class="video-thumbnail w-full h-full object-cover rounded-video" src="{{ $image_url_default }}" srcset="{{ $srcset_attribute }}" sizes="(max-width: 1024px) 100vw, 1024px" alt="{{ $video_title }}">
        <div class="play-button absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120px] h-[120px] bg-[url('/images/play-logo.svg')] bg-no-repeat bg-center cursor-pointer"></div>
    </div>
    <iframe id="video-player" class="w-full rounded-video max-w-max-1359 h-[290px] lg:h-[600px] hidden" src="https://www.youtube-nocookie.com/embed/{{ $youtube_video_id }}?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>
