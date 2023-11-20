<article @php(post_class('h-entry'))>
    <header>
        <h1 class="p-name font-bold text-4xl mb-6">
            {!! $title !!}
        </h1>

        @include('partials.entry-meta')
    </header>

    <div class="e-content mb-8">
        @php(the_content())
    </div>

    <footer>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'rollingdonuts'), 'after' => '</p></nav>']) !!}
    </footer>
</article>
