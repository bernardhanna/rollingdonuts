<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-10 15:25:16
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-10 16:06:57
 */
?>
<section class="story-slider" x-data="{ currentIndex: 0 }">
    <div class="carousel" data-carousel="slide" x-ref="carousel">
        @php
        $slides = get_field('slides');
        @endphp

        @if ($slides)
            @foreach ($slides as $index => $slide)
                <div class="slide hidden duration-700 ease-in-out" data-carousel-item x-show="currentIndex === {{ $index }}">
                    <img src="{{ $slide['image']['url'] }}" alt="{{ $slide['image']['alt'] }}">
                    <div class="text">{!! $slide['text'] !!}</div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="carousel-controls">
        <button class="carousel-control prev" @click="currentIndex = (currentIndex - 1 + {{ count($slides) }}) % {{ count($slides) }}">
            <span class="arrow-left"></span>
        </button>
        <button class="carousel-control next" @click="currentIndex = (currentIndex + 1) % {{ count($slides) }}">
            <span class="arrow-right"></span>
        </button>
    </div>
</section>
