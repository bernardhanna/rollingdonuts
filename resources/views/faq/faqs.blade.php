<section class="faq-section w-full my-8">
  <div class="flex flex-col lg:flex-row lg:max-w-max-1514 mx-auto">
      <div class="content boxshadow-two rounded-3xs border-2 border-black-full border-solid flex flex-col justify-between lg:bg-white w-full p-12 lg:w-full">
          <div class="top">
              <h4 class="pt-10 pb-4 lg:pt-0 lg:p-0 lg:text-lg-font text-sm-md-font font-reg420 lg:text-leading-10">FAQs</h4>
              <div id="accordion-open" data-accordion="open">
                  @php
                      $faqs = new WP_Query(['post_type' => 'faq', 'posts_per_page' => -1]);
                  @endphp
                  @while ($faqs->have_posts())
                      @php $faqs->the_post(); @endphp
                      <div class="border-b-2 border-black-full lg:bg-white" x-data="{ open: false }">
                          <div id="accordion-open-heading-<?php the_ID(); ?>">
                              <button type="button" class="flex items-center justify-between w-full font-medium text-left py-3" @click="open = !open" :aria-expanded="open.toString()" aria-controls="accordion-open-body-<?php the_ID(); ?>">
                                  <span class="flex items-center text-black-full text-sm-font lg:text-reg-font font-medium">{{ the_title() }}</span>
                                  <span x-show="!open">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <rect x="0.5" y="0.5" width="23" height="23" rx="11.5" fill="#FFED56"/>
                                          <path d="M8.12021 9.29055L12.0002 13.1705L15.8802 9.29055C16.2702 8.90055 16.9002 8.90055 17.2902 9.29055C17.6802 9.68055 17.6802 10.3105 17.2902 10.7005L12.7002 15.2905C12.3102 15.6805 11.6802 15.6805 11.2902 15.2905L6.70021 10.7005C6.31021 10.3105 6.31021 9.68055 6.70021 9.29055C7.09021 8.91055 7.73021 8.90055 8.12021 9.29055Z" fill="black"/>
                                          <rect x="0.5" y="0.5" width="23" height="23" rx="11.5" stroke="black"/>
                                      </svg>
                                  </span>
                                  <span x-show="open">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <rect x="23.5" y="23.5" width="23" height="23" rx="11.5" transform="rotate(180 23.5 23.5)" fill="#FFED56"/>
                                          <path d="M15.8798 14.7095L11.9998 10.8295L8.11979 14.7095C7.72978 15.0995 7.09978 15.0995 6.70978 14.7095C6.31978 14.3195 6.31978 13.6895 6.70978 13.2995L11.2998 8.70945C11.6898 8.31945 12.3198 8.31945 12.7098 8.70945L17.2998 13.2995C17.6898 13.6895 17.6898 14.3195 17.2998 14.7095C16.9098 15.0895 16.2698 15.0995 15.8798 14.7095Z" fill="black"/>
                                          <rect x="23.5" y="23.5" width="23" height="23" rx="11.5" transform="rotate(180 23.5 23.5)" stroke="black"/>
                                      </svg>
                                  </span>
                              </button>
                          </div>
                          <div id="accordion-open-body-<?php the_ID(); ?>" x-show="open" x-cloak aria-labelledby="accordion-open-heading-<?php the_ID(); ?>">
                              <div class="pt-5 pb-5 leading-tight text-sm-font font-light font-laca">
                                  {!! the_content() !!}
                              </div>
                          </div>
                      </div>
                  @endwhile
                  @php wp_reset_postdata(); @endphp
              </div>
          </div>
      </div>
  </div>
</section>