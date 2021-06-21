// Add your JS customizations here
jQuery(function($) {
    $('.home-slider, .home-planner').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1,
                height:400
            }
        }
    });
    $('.testimoni-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            768: {
                item:2
            },
            1200: {
                item:3
            },
        }
    });
});