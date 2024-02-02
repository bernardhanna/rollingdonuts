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

function initializeFeaturedPostsSplide() {
  return new Splide('.featured-posts-wrapper', {
      type: 'slide',
      perPage: 5,
      loop: true,
      pagination: false,
      arrows: false,
      drag: true,
      breakpoints: {
        1590: {
          perPage: 4,
          gap: '1rem',
        },
        1440: {
          perPage: 3.5,
          gap: '1rem',
        },
        1180: {
            perPage: 2.5,
            gap: '1rem',
        },
        820: {
            perPage: 1.5,
            gap: '1rem',
        },
    },
  }).mount();
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
    let featuredPostsSplide = initializeFeaturedPostsSplide();

    window.addEventListener('resize', () => {
        serviceSplide = handleResize(serviceSplide);
        featuredPostsSplide = handleFeaturedPostsResize(featuredPostsSplide);
    });

    // FEATURED DONUT SLIDER
    if (window.location.pathname === '/') {
        const featuredSplide = new Splide('#featured-slider', {
            type: 'fade',
            perPage: 1,
            arrows: true,
            pagination: true,
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
            drag: false,
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
            perPage: 2,
        },
        768: {
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

function handleFeaturedPostsResize(featuredPostsSplide) {
  if (window.innerWidth <= 1580) {
      if (!featuredPostsSplide) {
          // Initialize the Splide slider when the window width is 1580px or below
          featuredPostsSplide = initializeFeaturedPostsSplide();
      }
  } else {
      if (featuredPostsSplide) {
          // Destroy the Splide slider when the window width exceeds 1580px
          featuredPostsSplide.destroy();
          featuredPostsSplide = null;
      }
  }
  return featuredPostsSplide;
}
