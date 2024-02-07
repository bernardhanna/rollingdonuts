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
      let initialLoad = true;

      const featuredSplide = new Splide('#featured-slider', {
        type: 'fade', // Default to fade
        perPage: 1,
        arrows: true,
        pagination: true,
      }).mount();
        featuredSplide.on('moved', () => {
            const currentSlide = featuredSplide.index + 1;
            updateSlideCounts(currentSlide);
            if (!initialLoad) { // Check if it's not the initial load
              animateFeaturedImages('down');
           }
        });

        setTimeout(() => {
          initialLoad = false;
       }, 5000);

       document.querySelectorAll('.splide__arrow').forEach(button => {
        button.addEventListener('click', () => {
            animateFeaturedImages('up');
        });
      });
      /* eslint-disable no-inner-declarations */
      function animateFeaturedImages(direction) {
       // Check if the viewport width is below 1200px
          if (window.innerWidth < 1200) {
            return; // Exit the function early if under 1200px
        }

        document.querySelectorAll('.featured-image').forEach((img) => {
            img.classList.remove('animate-up', 'animate-down');
            if (direction === 'up') {
                img.classList.add('animate-up');
            } else if (direction === 'down') {
                img.classList.add('animate-down');
            }
            // Remove the animation classes after a delay to allow the animation to play out
            setTimeout(() => {
                img.classList.remove('animate-up', 'animate-down');
            }, 300);
        });
     }
    /* eslint-enable no-inner-declarations */
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


document.addEventListener('DOMContentLoaded', function() {
  // Continue with your current JS for 'current' class
  const currentPages = document.querySelectorAll('.page-link.current');
  currentPages.forEach(function(page) {
      page.closest('.page-item').classList.add('current-item');
  });

  // New JS for adding classes to 'prev' and 'next' li elements
  const prevLink = document.querySelector('.pagination-prev');
  if (prevLink) {
      prevLink.closest('.page-item').classList.add('prev-page-item');
  }

  const nextLink = document.querySelector('.pagination-next');
  if (nextLink) {
      nextLink.closest('.page-item').classList.add('next-page-item');
  }
});
