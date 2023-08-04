/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-03 12:22:59
 */
import Alpine from 'alpinejs';
import 'flowbite/dist/flowbite.js';
import '@iconify/iconify';
import Glide from '@glidejs/glide';
import Splide from '@splidejs/splide';

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
// Initialize the featured Splide slider
let featuredSplide;

function initializeFeaturedSplide() {
    if (!featuredSplide) {
        featuredSplide = new Splide('#featured-slider', {
            type: 'loop',
            perPage: 1,
            arrows: true,
            pagination: false,
        }).mount();

        updateSlideCounts(1);

        featuredSplide.on('moved', () => {
            const currentSlide = featuredSplide.index + 1;
            updateSlideCounts(currentSlide);
        });
    }
}

function updateSlideCounts(currentSlide) {
  const slideCountElements = document.querySelectorAll('.slide-count');
  slideCountElements.forEach(el => {
      const spanElement = el.querySelector('.start-count');
      if (spanElement) {
          spanElement.textContent = currentSlide;
      }
  });
}

document.addEventListener('DOMContentLoaded', initializeFeaturedSplide);
