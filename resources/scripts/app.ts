/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-12-11 11:30:50
 */
import Alpine from 'alpinejs';
import 'flowbite/dist/flowbite.js';
import '@iconify/iconify';
import Splide from '@splidejs/splide';

Object.assign(window, { Alpine: Alpine }).Alpine.start();

import.meta.webpackHot?.accept(console.error);

// Function declarations moved to the root level
function updateSlideCounts(currentSlide: number) {
    const slideCountElements = document.querySelectorAll('.slide-count');
    slideCountElements.forEach(el => {
        const spanElement = el.querySelector('.start-count');
        if (spanElement) {
            spanElement.textContent = `${currentSlide}`;
        }
    });
}

function initializeServiceSplide() {
    if (window.location.pathname === '/' && window.innerWidth <= 1084) {
        return new Splide('.service-splide', {
            type: 'fade',
            perPage: 1,
            pagination: false,
            arrows: true,
        }).mount();
    }
    return null;
}

function handleResize(serviceSplide: Splide | null) {
    if (window.innerWidth <= 1084 && !serviceSplide) {
        return new Splide('.service-splide', {
            type: 'loop',
            perPage: 1,
            pagination: false,
            arrows: true,
        }).mount();
    } else if (window.innerWidth > 1084 && serviceSplide) {
        serviceSplide.destroy();
        return null;
    }
    return serviceSplide;
}

// DOMContentLoaded Event Listener
document.addEventListener('DOMContentLoaded', function () {
    let serviceSplide = initializeServiceSplide();

    window.addEventListener('resize', () => {
        serviceSplide = handleResize(serviceSplide);
    });

    // FEATURED DONUT SLIDER
    if (window.location.pathname === '/') {
        const featuredSplide = new Splide('#featured-slider', {
            type: 'fade',
            perPage: 1,
            arrows: true,
        });

        featuredSplide.on('moved', () => {
            const currentSlide = featuredSplide.index + 1;
            updateSlideCounts(currentSlide);
        });

        featuredSplide.mount();

        const donutThumbnailSlider = new Splide('#donut-thumb-slider', {
            cover: false,
            isNavigation: true,
            focus: 'center',
            pagination: false,
            arrows: false,
        }).mount();

        featuredSplide.sync(donutThumbnailSlider);
        updateSlideCounts(1);
    }

//Best Sellers Slider
if (window.location.pathname === '/') {
  new Splide('.bestseller-splide', {
    type: 'slide',
    perPage: 3,
    pagination: false,
    gap: '1.5rem',  // Add this line
    breakpoints: {
        1084: {
            perPage: 1,
        },
    },
    arrows: true,
  }).mount();
}


 // PRODUCT PAGE SLIDERS
  const mainSliderElement = document.getElementById('main-slider');
  if (mainSliderElement !== null) {
    const slides = mainSliderElement.querySelectorAll('.splide__slide');
    const mainSlider = new Splide('#main-slider', {
      type: 'loop',
      perPage: 1,
      pagination: false,
      arrows: slides.length > 1,
    }).mount();

    if (slides.length <= 1) {
      const arrowElements = document.querySelectorAll('.splide__arrows');
      arrowElements.forEach(function (arrow) {
        arrow.classList.add('hidden');
      });
    }

    const thumbnailSliderElement = document.getElementById('thumbnail-slider');
    if (thumbnailSliderElement !== null) {
      const thumbnailSlides = thumbnailSliderElement.querySelectorAll('.splide__slide');
      if (thumbnailSlides.length > 1) {
        const thumbnailSlider = new Splide('#thumbnail-slider', {
          isNavigation: true,
          pagination: false,
          perPage: 3,
          arrows: false,
        }).mount();

        mainSlider.sync(thumbnailSlider);
      }
    }

    const anchors = document.querySelectorAll('#thumbnail-slider .splide__slide a');
    if (anchors.length > 0) {
      anchors.forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const index = Array.from(anchor.closest('.splide__list').children).indexOf(anchor.closest('.splide__slide'));
          mainSlider.go(index);
        });
      });
    }
  }
});

