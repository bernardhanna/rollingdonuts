{{-- resources/views/shortcodes/donut-box-builder.blade.php --}}
<div x-data="donutBoxBuilder()" class="donut-builder-container">
    <div class="donuts-selection">
        <template x-for="donut in availableDonuts" :key="donut.id">
            <div @click="addDonut(donut)">
                <img :src="donut.image" alt="" x-text="donut.name">
            </div>
        </template>
    </div>
    <div class="donut-box">
        <template x-for="(donut, index) in selectedDonuts" :key="index">
            <div @click="removeDonut(index)">
                <img :src="donut.image" alt="" x-text="donut.name">
            </div>
        </template>
    </div>
</div>
