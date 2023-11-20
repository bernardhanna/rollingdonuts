/**
 * @Author: Bernard Hanna
 * @Date:   2023-06-14 16:00:17
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-09-20 13:00:09
 */
import Alpine from 'alpinejs';
import 'flowbite/dist/flowbite.js';
import '@iconify/iconify';
import Splide from '@splidejs/splide';

Object.assign(window, { Alpine: Alpine }).Alpine.start();
import.meta.webpackHot?.accept(console.error);

document.addEventListener('DOMContentLoaded', function () {
  // Services Splide
  const serviceSliderElement = document.querySelector('.service-splide');
  if (serviceSliderElement !== null && window.innerWidth <= 1024) {
    const serviceSlides = serviceSliderElement.querySelectorAll('.splide__slide');
    const serviceSlider = new Splide('.service-splide', {
      type: 'loop',
      perPage: 1,
      pagination: false,
      arrows: serviceSlides.length > 1,
    }).mount();
  }

  // Featured Splide
  const featuredSplide = new Splide('#featured-slider', {
    type: 'loop',
    perPage: 1,
    pagination: false,
    arrows: true,
  }).mount();

  // donut Slider
  const donutThumbnailSlider = new Splide('#donut-thumb-slider', {
    cover: false,
    isNavigation: true,
    focus: 'center',
    pagination: false,
    arrows: false,
  }).mount();

  featuredSplide.sync( donutThumbnailSlider);

  // Main Slider
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
          focus: 'center',
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
