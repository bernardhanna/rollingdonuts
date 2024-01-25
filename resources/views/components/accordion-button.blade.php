
    @if ($faqButton)
        <a href="{{ $faqButton['url'] }}" class="faq-button py-4 border-radius-large flex justify-center h-[60px] w-full md:w-[368px] text-sm-md-font font-reg420 bg-black-full text-white hover:bg-yellow-primary hover:text-black-full">{{ $faqButton['title'] }}</a>
    @endif

