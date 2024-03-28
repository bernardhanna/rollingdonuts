@php
$video_thumbnail = get_sub_field('video_thumbnail');
$image_id = $video_thumbnail ? $video_thumbnail['ID'] : null;
$video_title = get_sub_field('video_title');
$image_url_default = $image_id ? wp_get_attachment_image_url($image_id, 'full') : '';
$youtube_video_id = get_sub_field('youtube_video_id');
@endphp

<section class="py-8 flexi-video relative w-full px-4 m-auto flex flex-col items-center gap-10 rounded-video">
    <div x-data="{ videoPlaying: false, videoSrc: '' }" class="relative w-full max-w-max-1359">
        <div class="aspect-ratio-16/9 relative w-full h-0 pb-[56.25%] rounded-video overflow-hidden drop-shadow_one">
            <img x-show="!videoPlaying" class="video-thumbnail absolute top-0 left-0 w-full h-full object-cover rounded-video" src="{{ $image_url_default }}" alt="{{ $video_title }}">
            <div @click="videoPlaying = true; videoSrc = 'https://www.youtube-nocookie.com/embed/{{ $youtube_video_id }}?autoplay=1&controls=0&mute=0';" x-show="!videoPlaying" class="play-button absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120px] h-[120px] bg-[url('/images/play-logo.svg')] bg-no-repeat bg-center cursor-pointer"></div>
            <iframe x-show="videoPlaying" :src="videoSrc" class="absolute top-0 left-0 w-full h-full rounded-video" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</section>
