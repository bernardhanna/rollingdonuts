<style>
    .centerX {
      position: absolute;
      left: 50%;
      -webkit-transform: translateX(-50%);
      -ms-transform: translateX(-50%);
      transform: translateX(-50%);
    }
    .centerY {
      position: absolute;
      top: 50%;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }
    .centerXY {
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
    }
    ul.cards li {
      position: absolute;
      width: calc(100% - 40px);
      height: calc(100% - 40px);
      max-width: 658.515px;
      max-height: 426.499px;
      padding: 15px 15px 100px;
      z-index: 3;
      opacity: 0;
      color: #444;
      text-align: center;
      font-weight: 900;
      font-size: 2em;
      box-sizing: border-box;
      overflow: hidden;
      display: -webkit-box;
      display: -moz-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-flow: column wrap;
      -ms-flex-flow: column wrap;
      flex-flow: column wrap;
      -webkit-box-align: center;
      -moz-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
      -webkit-box-pack: center;
      -moz-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-transform: translateX(-100%) rotate(3deg) scale(0.98);
      -ms-transform: translateX(-100%) rotate(3deg) scale(0.98);
      transform: translateX(-100%) rotate(3deg) scale(0.98);
      -webkit-transition: 0.75s all cubic-bezier(1, -0.5, 0.2, 1.4);
      transition: 0.75s all cubic-bezier(1, -0.5, 0.2, 1.4);
    }

    ul.cards li.clean {
      padding: 0 40px;
    }
    ul.cards li.current {
      z-index: 2;
      -webkit-transform: translateX(0) rotate(1deg);
      -ms-transform: translateX(0) rotate(1deg);
      transform: translateX(0) rotate(1deg);
    }
    ul.cards li.current,
    ul.cards li.current ~ li {
      opacity: 1;
    }
    ul.cards li.current + li {
      z-index: 1;
      -webkit-transform: translateX(0) rotate(13deg);
      -ms-transform: translateX(0) rotate(13deg);
      transform: translateX(0) rotate(13deg);
    }

    ul.cards li.current + li img {
        border-color: #ffed56;
    }

    ul.cards li.current + li ~ li {
      z-index: 0;
      -webkit-transform: translateX(0) rotate(-26deg);
      -ms-transform: translateX(0) rotate(-26deg);
      transform: translateX(0) rotate(-26deg);
    }

    ul.cards li.current + li ~ li img {
        border-color: #ffed56;
    }

    ul.cards li i {
      font-style: normal;
      font-size: 96px;
    }
    .text-content {
      display: none; /* Hide all text content by default */
    }
    .text-content.active {
        align-items: center;
        justify-content: center;
        z-index: 99999999;
        position: relative;
        display: flex;
    }
    </style>
<section class="our-story relative overflow-hidden bg-black-full h-[700px]">
    <div class="relative h-full mx-auto max-w-7xl flex flex-row items-start justify-center">
        <ul class="cards relative flex justify-start items-center w-full lg:w-6/12 p-5 space-x-5 list-none m-auto h-full">
            <li class="current relative w-full max-w-xs h-full max-h-[400px] p-5 z-30 opacity-100 transform -translate-x-full rotate-3 scale-95 transition-all duration-700 ease-in-out" title="Image 1">
                <img src="https://rollingdonuts.lndo.site/content/uploads/2024/02/storyour-1.png" class="w-full h-full object-cover rounded-[10px] max-w-[658.515px] h-[426.499px] border-8 border-white"/>
            </li>
            <li class="relative w-full max-w-xs h-full max-h-[400px] p-5 z-20 opacity-0 transform -translate-x-full rotate-3 scale-95 transition-all duration-700 ease-in-out" title="Image 2">
                <img src="https://picsum.photos/600/?2" class="w-full h-full object-cover rounded-[10px] max-w-[658.515px] h-[426.499px] border-8 border-white"/>
            </li>
            <li class="relative w-full max-w-xs h-full max-h-[400px] p-5 z-10 opacity-0 transform -translate-x-full rotate-3 scale-95 transition-all duration-700 ease-in-out" title="Image 3">
                <img src="https://picsum.photos/600/?3" class="w-full h-full object-cover rounded-[10px] max-w-[658.515px] h-[426.499px] border-8 border-white"/>
            </li>
        </ul>
        <div class="text-contents w-full lg:w-4/12 relative h-full">
            <div class="text-content active w-full flex flex-col items-center h-full" data-index="0">
                <h3 class="text-mob-xxl-font text-lg font-reg420 text-white pb- w-full flex">Our Story</h3>
                <span class="text-white text-sm-md-font font-medium font-laca pb-2 w-full flex">How we grown over the years</span>
                <span class="text-white text-sm-md-font font-medium font-laca pb-4 w-full flex">The original Rolling Donut was set up by 
                    my father Michael Quinlan in 1978.</span>
                <p class="text-white text-sm-font font-light font-laca w-full flex">My dad began running a donut concession called The Rolling Donut and brought it to concerts, shows and festivals around Ireland in the late 70s. Following that, in 1988 he set up the little donut kiosk on O’Connell Street that most Dubliners know and love! 40 years later it continues to make its mark.</p>
            </div>
            <div class="text-content w-full flex flex-col items-center h-full" data-index="1">
                <h3 class="text-mob-xxl-font text-lg font-reg420 text-white pb- w-full flex">Our Story Two</h3>
                <span class="text-white text-sm-md-font font-medium font-laca pb-2 w-full flex">How we grown over the years</span>
                <span class="text-white text-sm-md-font font-medium font-laca pb-4 w-full flex">The original Rolling Donut was set up by 
                    my father Michael Quinlan in 1978.</span>
                <p class="text-white text-sm-font font-light font-laca w-full flex">My dad began running a donut concession called The Rolling Donut and brought it to concerts, shows and festivals around Ireland in the late 70s. Following that, in 1988 he set up the little donut kiosk on O’Connell Street that most Dubliners know and love! 40 years later it continues to make its mark.</p>
            </div>
            <div class="text-content w-full flex flex-col items-center h-full" data-index="2">
                <h3 class="text-mob-xxl-font text-lg font-reg420 text-white pb- w-full flex">Our Story Three</h3>
                <span class="text-white text-sm-md-font font-medium font-laca pb-2 w-full flex">How we grown over the years</span>
                <span class="text-white text-sm-md-font font-medium font-laca pb-4 w-full flex">The original Rolling Donut was set up by 
                    my father Michael Quinlan in 1978.</span>
                <p class="text-white text-sm-font font-light font-laca w-full flex">My dad began running a donut concession called The Rolling Donut and brought it to concerts, shows and festivals around Ireland in the late 70s. Following that, in 1988 he set up the little donut kiosk on O’Connell Street that most Dubliners know and love! 40 years later it continues to make its mark.</p>
            </div>
            <div class="absolute w-full flex justify-between items-center story-arrows">
                <button class="h-[47px] w-[47px] bg-white hover:bg-yellow-primary arrow prev absolute left-0 top-1/2 transform -translate-y-1/2 text-sm-md-font font-bold z-50 rounded-full cursor-pointer">‹</button>
                <button class="h-[47px] w-[47px] bg-white hover:bg-yellow-primary arrow next absolute right-0 top-1/2 transform -translate-y-1/2 text-sm-md-font font-bold z-50 rounded-full cursor-pointer">›</button>
            </div>  
        </div>
    </div>
    

<script>
const prev = document.querySelector(".arrow.prev");
const next = document.querySelector(".arrow.next");
const cards = document.querySelectorAll(".cards li");
const textContents = document.querySelectorAll(".text-content");

let currentIndex = 0;

const updateSlider = () => {
  cards.forEach((card, index) => {
    card.classList.remove("current");
    textContents[index].classList.remove("active");
  });

  cards[currentIndex].classList.add("current");
  textContents[currentIndex].classList.add("active");

  prev.disabled = currentIndex === 0;
  next.disabled = currentIndex === cards.length - 1;
};

prev.addEventListener("click", () => {
  currentIndex = Math.max(0, currentIndex - 1);
  updateSlider();
});

next.addEventListener("click", () => {
  currentIndex = Math.min(cards.length - 1, currentIndex + 1);
  updateSlider();
});

updateSlider(); // Initialize slider
</script>
</section>
