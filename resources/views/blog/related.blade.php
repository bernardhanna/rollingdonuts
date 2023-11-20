@php
$current_post_id = get_the_ID();
$current_post_categories = get_the_category($current_post_id);
$category_ids = [];

foreach ($current_post_categories as $category) {
    $category_ids[] = $category->term_id;
}

$related_args = [
    'post_type' => 'post',
    'posts_per_page' => 3,
    'category__in' => $category_ids,
    'post__not_in' => [$current_post_id],
    'orderby' => 'rand', // Randomize the posts
];

$related_posts = new WP_Query($related_args);
@endphp

<aside>
    <h3 class="text-lg-font black-primary-full font-reg420 lg:pb-16">Related Articles</h3>
    @if ($related_posts->have_posts())
        <ul class="p-0 flex flex-col gap-8">
          @while ($related_posts->have_posts())
          @php($related_posts->the_post())
          <li class="border-2 boxshadow-three border-solid border-black-full rounded-sm-10 p-4">
              <a href="{{ get_permalink() }}" class="related-post">
                  @if(has_post_thumbnail())
                      @php($post_thumbnail_id = get_post_thumbnail_id())
                      @php($post_image_srcset = wp_get_attachment_image_srcset($post_thumbnail_id, 'full'))
                      <img class="rounded-sm-10 w-full h-[300px] object-cover" src="{{ get_the_post_thumbnail_url() }}" srcset="{{ $post_image_srcset }}" sizes="(max-width: 267px) 100vw, 267px" alt="{{ get_the_title() }}" />
                  @endif
                  <div class="flex flex-row flex-wrap justify-between items-center py-4">
                      @php($categories = get_the_category())
                      @if(!empty($categories))
                          @php($categories_string = implode(', ', wp_list_pluck($categories, 'name')))
                          <span class="post-categories text-sm-font text-black-full font-regular">{{ $categories_string }}</span>
                      @endif
                      <span class="post-date text-sm-font text-black-full font-regular">{{ get_the_date('j, F Y') }}</span>
                  </div>
                  <h2 class="post-title text-black-full text-base-font font-reg420 pb-6">{{ get_the_title() }}</h2>
                  <span class="reading-time text-sm-font text-black-full font-regular">{{ reading_time(get_the_content()) }} min read</span>
              </a>
          </li>
      @endwhile
      @php(wp_reset_postdata())
        </ul>
    @else
        <p>No related articles found.</p>
    @endif
</aside>
