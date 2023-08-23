/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-23 17:27:27
 */
import Alpine from 'alpinejs';
import 'flowbite/dist/flowbite.js';
import '@iconify/iconify';
import Glide from '@glidejs/glide';
import Splide from '@splidejs/splide';
console.log(Splide);

Object.assign(window, { Alpine: Alpine }).Alpine.start();

import.meta.webpackHot?.accept(console.error);

// Service Glide Slider
let glide;

function initializeGlide() {
    if (window.innerWidth <= 1084) {
        if (!glide) {
            glide = new Glide('.service-glide', {
                type: 'carousel',
                perView: 1,
                bound: true,
            });
            glide.mount();
            document.querySelector('.glide__arrows').classList.remove('hidden');
        }
    } else {
        if (glide) {
            glide.destroy();
            glide = null;
            document.querySelector('.glide__arrows').classList.add('hidden');
        }
    }
}

// Call the initializeGlide function when the document is fully loaded
document.addEventListener('DOMContentLoaded', initializeGlide);

// Update on resize
window.addEventListener('resize', initializeGlide);

// Call the function immediately to ensure it runs on initial page load
initializeGlide();

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', initializeGlide);

// Update on resize
window.addEventListener('resize', initializeGlide);

// Best Sellers Glide Slider
document.addEventListener('DOMContentLoaded', function () {
  let bestSellersGlide;
  function initializeBestSellersGlide() {
    if (window.innerWidth < 768) {
      if (!bestSellersGlide) {
        bestSellersGlide = new Glide('.bestseller-glide', {
          type: 'carousel',
          perView: 1,
          autoplay: true, // Enable auto-play
          time: 5000, // Set the time between slide transitions to 5000 milliseconds (3 seconds)
          bound: false,
        });
        bestSellersGlide.mount();
      }
    } else if (window.innerWidth < 1083) {
      if (!bestSellersGlide || bestSellersGlide.settings.perView !== 2) {
        if (bestSellersGlide) {
          bestSellersGlide.destroy();
          bestSellersGlide = null;
        }
        bestSellersGlide = new Glide('.bestseller-glide', {
          type: 'carousel',
          perView: 2,
          autoplay: true, // Enable auto-play
          time: 5000, // Set the time between slide transitions to 5000 milliseconds (3 seconds)
          bound: true,
        });
        bestSellersGlide.mount();
      }
    } else {
      if (!bestSellersGlide || bestSellersGlide.settings.perView !== 3) {
        if (bestSellersGlide) {
          bestSellersGlide.destroy();
          bestSellersGlide = null;
        }
        bestSellersGlide = new Glide('.bestseller-glide', {
          type: 'carousel',
          perView: 3,
          autoplay: true, // Enable auto-play
          time: 5000, // Set the time between slide transitions to 5000 milliseconds (3 seconds)
          bound: false,
          gap: 0,
        });
        bestSellersGlide.mount();
      }
    }
  }

  initializeBestSellersGlide();

  window.addEventListener('resize', initializeBestSellersGlide);
});
// SPLIDES
document.addEventListener('DOMContentLoaded', function () {
  const featuredSplide = new Splide('#featured-slider', {
      type: 'loop',
      perPage: 1,
      pagination: false,
      arrows: true,
  });

  featuredSplide.on('moved', () => {
      const currentSlide = featuredSplide.index + 1;
      updateSlideCounts(currentSlide);
      updateSectionBackgroundColor();
  });

  featuredSplide.mount();

  const thumbnailSlider = new Splide('#thumbnail-slider', {
      cover:  false,
      isNavigation: true,
      focus: 'center',
      pagination: false,
      arrows: false,
  }).mount();

  featuredSplide.sync(thumbnailSlider);

  function updateSlideCounts(currentSlide) {
      const slideCountElements = document.querySelectorAll('.slide-count');
      slideCountElements.forEach(el => {
          const spanElement = el.querySelector('.start-count');
          if (spanElement) {
              spanElement.textContent = currentSlide;
          }
      });
  }

  function updateSectionBackgroundColor() {
      const currentSlide = featuredSplide.Components.Elements.slides[featuredSplide.index];
      const currentSlideBgColor = currentSlide.querySelector('.left-feature').style.backgroundColor;

      // Update the section's background color
      document.querySelector('.featured-donuts').style.backgroundColor = currentSlideBgColor;
  }

  updateSlideCounts(1);
  updateSectionBackgroundColor(); // Calling this function here ensures the correct background color is set when the page loads
});

// Product Gallery Slider
document.addEventListener('DOMContentLoaded', function () {
  const mainSliderElement = document.getElementById('main-slider');
  const slides = mainSliderElement.querySelectorAll('.splide__slide');

  // Initialize main slider
  const mainSlider = new Splide('#main-slider', {
    type: 'loop',
    perPage: 1,
    pagination: false,
    arrows: slides.length > 1, // Show arrows only if more than one slide
  }).mount();

  // Hide arrows if only one slide
  if (slides.length <= 1) {
    const arrowElements = document.querySelectorAll('.splide__arrows');
    arrowElements.forEach(function(arrow) {
      arrow.classList.add('hidden');
    });
  }

  // Initialize thumbnail slider
  const thumbnailSliderElement = document.getElementById('thumbnail-slider');
  const thumbnailSlides = thumbnailSliderElement.querySelectorAll('.splide__slide');
  if (thumbnailSlides.length > 1) {
    const thumbnailSlider = new Splide('#thumbnail-slider', {
      isNavigation: true,
      focus: 'center',
      pagination: false,
      perPage: 3,
      arrows: false,
    }).mount();

    // Sync main slider with thumbnail slider
    mainSlider.sync(thumbnailSlider);
  }

  // Prevent default click behavior on thumbnail images and navigate the main slider
  document.querySelectorAll('#thumbnail-slider .splide__slide a').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const index = Array.from(anchor.closest('.splide__list').children).indexOf(anchor.closest('.splide__slide'));
      mainSlider.go(index);
    });
  });
});

