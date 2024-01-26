<div class="flex flex-wrap flex-row justify-between">
    <p class="font-laca text-xs-font">
        <span>{{ __('By', 'rollingdonuts') }}</span>
        <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="p-author h-card">
            {{ get_the_author() }}
        </a>
    </p>
    <time class="dt-published font-laca text-xs-font" datetime="{{ get_post_time('c', true) }}">
        {{ get_the_date() }}
    </time>
</div>
