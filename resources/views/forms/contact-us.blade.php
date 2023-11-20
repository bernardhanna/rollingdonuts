<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-10-09 17:02:41
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-10-31 11:50:39
 */
?>
<x-html-forms
    :form="$form"
    :messages="['success' => 'Thank you!', 'error' => 'Yikes! Try again.']"
    class="flex flex-col justify-center w-full boxshadow-two rounded-3xs border-2 border-black-full border-solid p-12">
    @csrf
    <div class="flex flex-col w-full">
        <div class="flex flex-row w-full">
            <div class="flex flex-col w-full">
                <label class="hidden lg:block text-black-full mob-xs-font fonts-reg420" for="name">First Name*</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"><path fill="#484848" d="M9.993 10.573a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9ZM10 0a6 6 0 0 1 3.04 11.174c3.688 1.11 6.458 4.218 6.955 8.078c.047.367-.226.7-.61.745c-.383.045-.733-.215-.78-.582c-.54-4.19-4.169-7.345-8.57-7.345c-4.425 0-8.101 3.161-8.64 7.345c-.047.367-.397.627-.78.582c-.384-.045-.657-.378-.61-.745c.496-3.844 3.281-6.948 6.975-8.068A6 6 0 0 1 10 0Z"/></svg>
                    </div>
                    <input class="text-field rounded-lg-x h-input text-black-secondary
                    text-mob-xs-font font-laca font-lig pl-11 flex w-full" name="name" type="text" placeholder="First Name" required>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label class="hidden lg:block text-black-full mob-xs-font fonts-reg420" for="name">Surname*</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"><path fill="#484848" d="M9.993 10.573a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9ZM10 0a6 6 0 0 1 3.04 11.174c3.688 1.11 6.458 4.218 6.955 8.078c.047.367-.226.7-.61.745c-.383.045-.733-.215-.78-.582c-.54-4.19-4.169-7.345-8.57-7.345c-4.425 0-8.101 3.161-8.64 7.345c-.047.367-.397.627-.78.582c-.384-.045-.657-.378-.61-.745c.496-3.844 3.281-6.948 6.975-8.068A6 6 0 0 1 10 0Z"/></svg>
                    </div>
                    <input class="text-field rounded-lg-x h-input text-black-secondary
                    text-mob-xs-font font-laca font-lig pl-11 flex w-full" name="name" type="text" placeholder="Surname" required>
                </div>
            </div>
        </div>
        <div class="flex flex-row w-full">
            <div class="flex flex-col w-full">
                <label class="hidden lg:block text-black-full mob-xs-font fonts-reg420" for="emailAddress">Email Address</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"/></svg>
                    </div>
                    <input class="rounded-lg-x h-input text-black-secondary
                    text-mob-xs-font font-laca font-light pl-11 flex w-full" name="emailAddress" type="email" placeholder="Email Address" required>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label class="hidden lg:block text-black-full mob-xs-font fonts-reg420" for="phone">Telephone*</label>
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path d="M20.999 16.9207V20.4569C20.9991 20.7101 20.9032 20.9539 20.7306 21.1392C20.558 21.3244 20.3216 21.4373 20.0691 21.455C19.6321 21.485 19.2751 21.501 18.9991 21.501C10.1626 21.501 3 14.3376 3 5.50011C3 5.2241 3.015 4.86708 3.046 4.43005C3.06372 4.17748 3.17657 3.94104 3.36178 3.76842C3.547 3.59581 3.79078 3.49989 4.04394 3.5H7.57975C7.70378 3.49987 7.82343 3.54586 7.91546 3.62903C8.00748 3.71219 8.06531 3.8266 8.07772 3.95003C8.10072 4.18004 8.12172 4.36305 8.14171 4.50206C8.34044 5.88906 8.74768 7.23804 9.34965 8.50328C9.44464 8.70329 9.38265 8.9423 9.20266 9.07031L7.04478 10.6124C8.36416 13.687 10.8141 16.1372 13.8884 17.4568L15.4283 15.3027C15.4913 15.2147 15.5831 15.1515 15.6878 15.1243C15.7925 15.0971 15.9034 15.1075 16.0013 15.1536C17.2662 15.7545 18.6147 16.1608 20.0011 16.3587C20.14 16.3787 20.323 16.4007 20.551 16.4227C20.6743 16.4354 20.7884 16.4933 20.8714 16.5853C20.9543 16.6773 21.0002 16.7969 21 16.9207H20.999Z" fill="black" fill-opacity="0.2" stroke="#484848" stroke-width="0.75"/>
                        </svg>
                    </div>
                    <input class="rounded-lg-x h-input text-black-secondary
                    text-mob-xs-font font-laca font-light pl-11 flex w-full" name="phone" type="text" placeholder="Telephone" required>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full">
            <label class="hidden lg:block text-black-full mob-xs-font fonts-reg420" for="phone">Message</label>
            <textarea class="rounded-sm-10 h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full min-h-[140px]" name="message" placeholder="Message" required></textarea>
        </div>     
        <div class="flex flex-col w-full">
            <div class="flex lg:items-center leading-4 pt-8">
                <input class="bg-white mr-2 h-[20px] w-[20px] rounded-sm" type="checkbox" required>
                <span class="text-black text-sm-font font-light font-laca leading-reg1">I agree with the handling of my data in accordance with the company <a href="/privacy-policy/">Privacy Policy</a>.</span>
            </div>
        </div>
        <div class="flex flex-col w-full  lg:w-auto">
            <label class="hidden lg:block lg:invisible" for="name">Button</label>
            <input class="btn mb-4 text-yellow-primary text-mob-lg-font lg:text-sm-md-font font-reg420 py-3 bg-black-full border-2 border-yellow-primary border-solid rounded-lg-x w-full lg:w-256 hover:text-black-full hover:bg-yellow-primary" type="submit" value="Submit">
        </div>
    </div>

    <template x-if="submitted">
        <p class="">Thanks for Your Message we will be in touch ASAP</p>
    </template>
</x-html-forms>
