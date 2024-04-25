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

document.addEventListener("DOMContentLoaded", function () {
  const notices = document.querySelectorAll("#custom-woocommerce-notice");

  notices.forEach((notice) => {
    // Automatically close after 2 seconds
    setTimeout(
      () => {
        notice.classList.add("fade-out");
        // Wait for animation to complete before removing the element
        setTimeout(() => notice.remove(), 500); // Match the duration of the animation
      },

      2000
    );

    // Close on button click
    notice.querySelector("button").addEventListener("click", function () {
      notice.classList.add("fade-out");
      setTimeout(() => notice.remove(), 500); // Match the duration of the animation
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const errorNotices = document.querySelectorAll(".woocommerce-error");
  errorNotices.forEach((notice) => {
    // Automatically close after 2 seconds
    setTimeout(() => {
      notice.classList.add("fade-out");
      // Wait for animation to complete before removing the element
      setTimeout(() => notice.remove(), 500); // Match the duration of the animation
    }, 2000);

    // Close on button click
    notice.querySelector("button").addEventListener("click", function () {
      notice.classList.add("fade-out");
      setTimeout(() => notice.remove(), 500); // Match the duration of the animation
    });
  });
});

// Function declarations moved to the root level
function updateSlideCounts(currentSlide: number) {
  const slideCountElements = document.querySelectorAll(".slide-count");
  slideCountElements.forEach((el) => {
    const spanElement = el.querySelector(".start-count");
    if (spanElement) {
      spanElement.textContent = `${currentSlide}`;
    }
  });
}

function initializeServiceSplide() {
  if (window.location.pathname === "/" && window.innerWidth <= 1084) {
    return new Splide(".service-splide", {
      type: "fade",
      perPage: 1,
      pagination: false,
      arrows: true,
    }).mount();
  }
  return null;
}

function handleResize(serviceSplide: Splide | null) {
  if (window.innerWidth <= 1084 && !serviceSplide) {
    return new Splide(".service-splide", {
      type: "loop",
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
document.addEventListener("DOMContentLoaded", function () {
  let serviceSplide = initializeServiceSplide();

  window.addEventListener("resize", () => {
    serviceSplide = handleResize(serviceSplide);
  });

  // FEATURED DONUT SLIDER
  if (window.location.pathname === "/") {
    let initialLoad = true;

    const featuredSplide = new Splide("#featured-slider", {
      type: "fade", // Default to fade
      perPage: 1,
      arrows: true,
      pagination: true,
    }).mount();
    featuredSplide.on("moved", () => {
      const currentSlide = featuredSplide.index + 1;
      updateSlideCounts(currentSlide);
      if (!initialLoad) {
        // Check if it's not the initial load
        animateFeaturedImages("down");
      }
    });

    setTimeout(() => {
      initialLoad = false;
    }, 5000);

    document.querySelectorAll(".splide__arrow").forEach((button) => {
      button.addEventListener("click", () => {
        animateFeaturedImages("up");
      });
    });
    /* eslint-disable no-inner-declarations */
    function animateFeaturedImages(direction) {
      // Check if the viewport width is below 1200px
      if (window.innerWidth < 1200) {
        return; // Exit the function early if under 1200px
      }

      document.querySelectorAll(".featured-image").forEach((img) => {
        img.classList.remove("animate-up", "animate-down");
        if (direction === "up") {
          img.classList.add("animate-up");
        } else if (direction === "down") {
          img.classList.add("animate-down");
        }
        // Remove the animation classes after a delay to allow the animation to play out
        setTimeout(() => {
          img.classList.remove("animate-up", "animate-down");
        }, 300);
      });
    }
    /* eslint-enable no-inner-declarations */
    const donutThumbnailSlider = new Splide("#donut-thumb-slider", {
      cover: false,
      isNavigation: true,
      focus: "center",
      pagination: false,
      arrows: false,
      drag: false,
    }).mount();

    featuredSplide.sync(donutThumbnailSlider);
    updateSlideCounts(1);
  }

  //Best Sellers Slider
  if (window.location.pathname === "/") {
    new Splide(".bestseller-splide", {
      type: "slide",
      perPage: 3,
      pagination: false,
      gap: "1.5rem", // Add this line
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
  const mainSliderElement = document.getElementById("main-slider");
  if (mainSliderElement !== null) {
    const slides = mainSliderElement.querySelectorAll(".splide__slide");
    const mainSlider = new Splide("#main-slider", {
      type: "loop",
      perPage: 1,
      pagination: false,
      arrows: slides.length > 1,
    }).mount();

    if (slides.length <= 1) {
      const arrowElements = document.querySelectorAll(".splide__arrows");
      arrowElements.forEach(function (arrow) {
        arrow.classList.add("hidden");
      });
    }

    const thumbnailSliderElement = document.getElementById("thumbnail-slider");
    if (thumbnailSliderElement !== null) {
      const thumbnailSlides =
        thumbnailSliderElement.querySelectorAll(".splide__slide");
      if (thumbnailSlides.length > 1) {
        const thumbnailSlider = new Splide("#thumbnail-slider", {
          isNavigation: true,
          pagination: false,
          perPage: 3,
          arrows: false,
        }).mount();

        mainSlider.sync(thumbnailSlider);
      }
    }

    const anchors = document.querySelectorAll(
      "#thumbnail-slider .splide__slide a"
    );
    if (anchors.length > 0) {
      anchors.forEach(function (anchor) {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const index = Array.from(
            anchor.closest(".splide__list").children
          ).indexOf(anchor.closest(".splide__slide"));
          mainSlider.go(index);
        });
      });
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.includes("/checkout")) {
    // Exit the script early if on the checkout page
    return;
  }
  // Continue with your current JS for 'current' class
  const currentPages = document.querySelectorAll(".page-link.current");
  currentPages.forEach(function (page) {
    page.closest(".page-item").classList.add("current-item");
  });

  // New JS for adding classes to 'prev' and 'next' li elements
  const prevLink = document.querySelector(".pagination-prev");
  if (prevLink) {
    prevLink.closest(".page-item").classList.add("prev-page-item");
  }

  const nextLink = document.querySelector(".pagination-next");
  if (nextLink) {
    nextLink.closest(".page-item").classList.add("next-page-item");
  }
});

//Video Flexi Block
document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.includes("/checkout")) {
    // Exit the script early if on the checkout page
    return;
  }
  const playButtons = document.querySelectorAll(".play-button");

  playButtons.forEach(function (playButton) {
    const videoContainer = playButton.closest(".flexi-video");
    const videoThumbnail = videoContainer.querySelector(".video-thumbnail");
    const videoPlayer = videoContainer.querySelector("iframe");

    playButton.addEventListener("click", function () {
      playButton.classList.add("opacity-0", "invisible");
      videoThumbnail.classList.add("opacity-0", "invisible");
      videoPlayer.classList.remove("hidden"); // Make sure it is not `display: none;`

      setTimeout(() => {
        playButton.classList.add("hidden"); // Hide after transition
        videoThumbnail.classList.add("hidden"); // Hide after transition
      }, 500); // Ensure this matches the transition duration

      // Start playing the video
      videoPlayer.src += "&autoplay=1";
    });

    videoPlayer.addEventListener("ended", function () {
      playButton.classList.remove("opacity-0", "invisible", "hidden");
      videoThumbnail.classList.remove("opacity-0", "invisible", "hidden");
      videoPlayer.classList.add("hidden"); // Hide the player

      // Reset the video player source to stop autoplay
      videoPlayer.src = videoPlayer.src.replace("&autoplay=1", "");
    });
  });
});

//chnage header text on tab click
document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.includes("/checkout")) {
    // Exit the script early if on the checkout page
    return;
  }
  const signInTab = document.getElementById("signInTab");
  const registerTab = document.getElementById("registerTab");

  // Listen for clicks on the Sign In tab
  if (signInTab) {
    signInTab.addEventListener("click", function (event) {
      event.preventDefault();
      window.dispatchEvent(
        new CustomEvent("update-active-tab", { detail: { tab: "sign-in" } })
      );
    });
  }

  // Listen for clicks on the Register tab
  if (registerTab) {
    registerTab.addEventListener("click", function (event) {
      event.preventDefault();
      window.dispatchEvent(
        new CustomEvent("update-active-tab", { detail: { tab: "register" } })
      );
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.includes("/checkout")) {
    // Exit the script early if on the checkout page
    return;
  }
  const prev = document.querySelector(".arrow.prev");
  const next = document.querySelector(".arrow.next");
  const cards = document.querySelectorAll(".cards li");
  const textContents = document.querySelectorAll(".text-content");

  let currentIndex = 0;
  let isSliderEnabled = window.innerWidth > 1250;

  const updateSlider = () => {
    if (!isSliderEnabled) return;

    cards.forEach((card) => card.classList.remove("current"));
    textContents.forEach((textContent) => {
      textContent.style.display = "none"; // Initially hide all text contents
      // Reset animation state by removing the class
      textContent.querySelectorAll("*").forEach((child) => {
        child.classList.remove("animate-fade-in");
      });
    });

    // Show and animate the current text content
    const activeContent = textContents[currentIndex];
    activeContent.style.display = "flex";
    // Add the fade-in animation class to all child elements immediately
    const children = activeContent.querySelectorAll("h3, span, p");
    children.forEach((child) => {
      child.classList.add("animate-fade-in");
    });

    cards[currentIndex].classList.add("current");

    prev.classList.toggle("disabled", currentIndex === 0);
    next.classList.toggle("disabled", currentIndex === cards.length - 1);
  };

  window.addEventListener("resize", () => {
    isSliderEnabled = window.innerWidth > 1250;
    updateSlider();
  });

  prev.addEventListener("click", (event) => {
    event.preventDefault();
    if (!isSliderEnabled) return;
    currentIndex = Math.max(0, currentIndex - 1);
    updateSlider();
  });

  next.addEventListener("click", (event) => {
    event.preventDefault();
    if (!isSliderEnabled) return;
    currentIndex = Math.min(cards.length - 1, currentIndex + 1);
    updateSlider();
  });

  updateSlider(); // Initialize the slider
});

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname.includes("/checkout")) {
    // Exit the script early if on the checkout page
    return;
  }
  new Splide("#testimonial-slider", {
    type: "loop",
    perPage: 2.5,
    perMove: 1,
    gap: "2rem",
    arrows: false,
    pagination: false,
    breakpoints: {
      480: {
        perPage: 1,
      },
      575: {
        perPage: 1.25,
      },
      768: {
        perPage: 1.5,
      },
      1024: {
        perPage: 2.5,
      },
    },
  }).mount();
});
/*
document.addEventListener("DOMContentLoaded", function () {
  const weddingSlider = new Splide("#weddingSlider", {
    type: "slide",
    perPage: 3,
    focus: "center",
    gap: "1rem",
    pagination: false,
    arrows: true, // Adjust based on your preference
    autoWidth: true,
    updateOnMove: true, // Ensure updates occur on move
  }).mount();

  // Add class to the center slide initially and on slide change
  function updateCenterSlideClass(slider) {
    slider.Components.Elements.slides.forEach((slide, i) => {
      slide.classList.toggle("is-center", i === slider.index);
    });
  }

  weddingSlider.on("mounted move", function () {
    updateCenterSlideClass(weddingSlider);
  });

  // Initial class update
  updateCenterSlideClass(weddingSlider);
});
*/
