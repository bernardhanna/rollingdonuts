<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-11 10:01:41
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-26 12:45:56
 */
?>
<form class="flex flex-row justify-center w-full" x-data="{
    submitted: false,
    submitForm() {
        // Perform form submission using AJAX
        fetch('{{ route('newsletter.subscribe') }}', {
            method: 'POST',
            body: new FormData(event.target)
        })
        .then(response => {
            if (response.ok) {
                // Display success message
                this.submitted = true;
            } else {
                // Handle error response
                console.error('Form submission failed');
            }
        })
        .catch(error => {
            // Handle network error
            console.error(error);
        });
    }
}" x-on:submit.prevent="submitForm()" class="newsletter-form">
    @csrf
    <div class="flex flex-col w-full">
    <div class="flex flex-col lg:flex-row w-full justify-between lg:space-x-4">
        <div class="flex flex-col w-full lg:justify-around">
        <label class="hidden lg:block text-white mob-xs-font fonts-reg420" for="name">Name</label>
        <div class="relative mb-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 20 20"><path fill="#484848" d="M9.993 10.573a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9ZM10 0a6 6 0 0 1 3.04 11.174c3.688 1.11 6.458 4.218 6.955 8.078c.047.367-.226.7-.61.745c-.383.045-.733-.215-.78-.582c-.54-4.19-4.169-7.345-8.57-7.345c-4.425 0-8.101 3.161-8.64 7.345c-.047.367-.397.627-.78.582c-.384-.045-.657-.378-.61-.745c.496-3.844 3.281-6.948 6.975-8.068A6 6 0 0 1 10 0Z"/></svg>
              </div>
            <input class="text-field rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-lig pl-11 flex w-full lg:max-w-max-358" name="name" type="text" placeholder="Full Name" required>
        </div>
    </div>
    <div class="flex flex-col w-full lg:justify-around">
        <label class="hidden lg:block text-white mob-xs-font fonts-reg420" for="emailAddress">Email Address</label>
        <div class="relative mb-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32"><path fill="#484848" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2Zm-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z"/></svg>
              </div>
            <input class="rounded-lg-x h-input text-black-secondary
            text-mob-xs-font font-laca font-light pl-11 flex w-full lg:max-w-max-358" name="emailAddress" type="email" placeholder="Email Address" required>
        </div>
    </div>
    <div class="flex flex-col w-full  lg:w-auto">
        <label class="hidden lg:block lg:invisible" for="name">Button</label>
        <input class="btn text-black-full text-mob-lg-font lg:text-sm-md-font font-reg420 py-3 bg-yellow-primary rounded-lg-x w-full lg:w-256 rd-border hover:text-black-full hover:bg-white mb-4" type="submit" value="Get 10% Off">
    </div>
</div>
    <div class="flex flex-col w-full">
        <div class="flex lg:items-center leading-4">
            <input class="bg-white mr-2 h-[20px] w-[20px] rounded-sm" type="checkbox" required>
            <span class="text-white text-sm-font font-light font-laca leading-reg1">By signing to our newsletter, you agree to our <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy</a>.</span>
         </div>
    </div>
        <template x-if="submitted">
         <p class="">Thanks for subscribing, check your inbox for details</p>
       </template>
    </div>
</form>
