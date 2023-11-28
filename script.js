jQuery(document).ready(function ($) {
    var swiper = new Swiper(".swiper", {
        handleElementorBreakpoints: true,

 slidesPerView:4.5,
        slidesPerGroup: 1,
        loop: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            480: {
                slidesPerView: 2,
            
            },
			 0: {
                slidesPerView: 1,
            
            },
            1020: {
               
                spaceBetween: 65
            },
        },

        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        coverflowEffect: {
            rotate: 5,
            stretch: 0,
            depth: 100,
            modifier: 2,
            slideShadows: true
        },
        keyboard: {
            enabled: true
        },
        mousewheel: {
            thresholdDelta: 10
        },
        spaceBetween: 50,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        }
    });
});