<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-17 15:03:46
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-18 16:54:43
 */
?>
<button @click="open = !open" class="lg:hidden relative ml-2 mr-4 h-10 w-10 z-100">
    <div :class="{ 'change': open }" class="flex relative z-50">
        <template x-if="!open">
            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="40" viewBox="0 0 43 40" fill="none">
                <rect x="1.64062" y="1" width="39.6" height="38" rx="11" fill="white" stroke="black" stroke-width="2"/>
                <line x1="11.5" y1="11.5" x2="31.38" y2="11.5" stroke="black" stroke-width="3" stroke-linecap="round"/>
                <line x1="11.5" y1="19.5" x2="31.38" y2="19.5" stroke="black" stroke-width="3" stroke-linecap="round"/>
                <line x1="11.5" y1="27.5" x2="31.38" y2="27.5" stroke="black" stroke-width="3" stroke-linecap="round"/>
            </svg>
        </template>
        <template x-if="open">
            <svg xmlns="http://www.w3.org/2000/svg" width="43" height="40" viewBox="0 0 43 40" fill="none">
                <rect x="1.64062" y="1" width="39.6" height="38" rx="11" fill="white" stroke="white" stroke-width="2"/>
                <line x1="1.5" y1="-1.5" x2="20.9443" y2="-1.5" transform="matrix(0.720833 0.693109 -0.720833 0.693109 12.3105 13)" stroke="black" stroke-width="3" stroke-linecap="round"/>
                <line x1="1.5" y1="-1.5" x2="20.9443" y2="-1.5" transform="matrix(0.720833 0.693109 -0.720833 0.693109 12.3105 13)" stroke="black" stroke-width="3" stroke-linecap="round"/>
                <line x1="1.5" y1="-1.5" x2="20.9443" y2="-1.5" transform="matrix(0.720833 -0.693109 0.720833 0.693109 14.1602 28.7783)" stroke="black" stroke-width="3" stroke-linecap="round"/>
            </svg>
        </template>
    </div>
</button>
