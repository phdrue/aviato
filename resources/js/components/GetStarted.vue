<template>
<div>
    <div class="container row justify-content-center mb-2">

            <div class="banner-getstarted col-lg-8 col-md-12">
               <h2 class="banner-header">Система электронной очереди</h2>
               <p class="banner-text">Внедрение QR-кодов в здравоохранении необходимо, особенно когда дело доходит до связи и общения с пациентами, учётом очереди в режиме реального времени.</p>

        </div>
        <div class="overview-hero-banner__image-container col-lg-4 col-md-12"><img alt="picture" src="image/web/home_image.png"/></div>
    </div>
     <div class="container row">
       <div class="overview-hero-banner__image-container col-lg-6 col-md-6"><img alt="picture" src="image/web/qr2.png"/></div>

            <div class="rel col-lg-6 col-md-6">
               <h2 class="banner-header">Проект <span style="">ра</span>зработан на основе <span style="">we</span>b и android прило<span style="">жен</span>ий</h2>
               <p class="banner-text"></p>

              <!-- <span class="days day-green" v-for="item in 5" v-bind:key="item">{{item}}</span> -->
        </div>
        </div>
</div>

</template>

<script>
    export default {
        data() {
 return {numbers: [ 1, 2, 3, 4, 5 ]}
},
        mounted() {
            console.log('GetStarted')
        }
    }
</script>
