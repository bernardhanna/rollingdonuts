<article @php(post_class('h-entry'))>
    <div class="e-content mb-8 laptop:w-85">
        @php(the_content())
    </div>

    <footer>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'rollingdonuts'), 'after' => '</p></nav>']) !!}
    </footer>
</article>
