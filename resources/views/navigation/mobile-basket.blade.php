<div class="fixed bottom-0 left-0 right-0 z-50 p-4 bg-transparent laptop:hidden">
    <div class="flex justify-between items-center w-full mobile:w-8/12 lg:w-1/2 m-auto">
    <a href="{{ wc_get_cart_url() }}" class="m-4 border-2 border-black-full border-solid flex items-center justify-center bg-red-500 text-black-full bg-white hover:bg-yellow-primary w-[270px] py-2 rounded-lg-x relative">
      <span class="mr-2 text-black-full text-mob-md-font font-reg420">Checkout</span>
      <span class="iconify" data-icon="grommet-icons:basket" data-width="24" data-height="24"></span>
      <span class="text-tiny font-reg420 bg-red-critical w-[14px] h-[14px] flex items-center justify-center rounded-full border-2 border-black- border-solid p-2 basket-detail">{{ WC()->cart->get_cart_contents_count() }}</span>
    </a>
    @php $telephone = get_field('office_telephone', 'option');  @endphp
    <a class="m-4 border-2 border-black-full hover:bg-yellow-primary border-solid rounded-full" href="tel:{{ $telephone }}">
        <svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="24.5" cy="24.9509" r="24" fill="white"/>
            <path d="M34.4976 30.4976V34.7069C34.4977 35.0083 34.3836 35.2985 34.1781 35.519C33.9726 35.7395 33.6912 35.8739 33.3906 35.895C32.8704 35.9307 32.4454 35.9497 32.1169 35.9497C21.5978 35.9497 13.0713 27.4228 13.0713 16.9031C13.0713 16.5745 13.0891 16.1495 13.126 15.6293C13.1471 15.3287 13.2815 15.0472 13.502 14.8417C13.7224 14.6363 14.0126 14.5221 14.314 14.5222H18.5231C18.6707 14.5221 18.8132 14.5768 18.9227 14.6758C19.0323 14.7748 19.1011 14.911 19.1159 15.0579C19.1433 15.3317 19.1683 15.5495 19.1921 15.715C19.4286 17.366 19.9134 18.9718 20.63 20.4779C20.7431 20.716 20.6693 21.0005 20.455 21.1528L17.8863 22.9885C19.4569 26.6483 22.3733 29.565 26.033 31.1357L27.8662 28.5715C27.9411 28.4668 28.0504 28.3916 28.175 28.3592C28.2997 28.3268 28.4318 28.3392 28.5482 28.3941C30.054 29.1094 31.6593 29.593 33.3096 29.8286C33.4751 29.8524 33.6929 29.8786 33.9643 29.9048C34.111 29.9198 34.2469 29.9888 34.3456 30.0983C34.4444 30.2078 34.499 30.3501 34.4988 30.4976H34.4976Z" stroke="black" stroke-width="1.5"/>
        </svg>                
        </a>
    </div>
  </div>
