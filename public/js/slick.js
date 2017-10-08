$('.post_slider').slick({
    centerMode: true,
    centerPadding: '1px',
    slidesToShow: 2,
    slidesToScroll:2,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,

    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '1px',
                slidesToShow: 2,
                autoplay: true,
                autoplaySpeed: 4000,
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '1px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                fade: true,
                cssEase: 'linear',
                 infinite: true,
                speed: 500
            }
        }
    ]
});

$('.data_slider').slick({
    centerMode: true,
    centerPadding: '1px',
    slidesToShow: 2,
    slidesToScroll:2,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,

    responsive: [
        {
            breakpoint: 1440,
            settings: "unslick",
        },
        {
            breakpoint: 1024,
            settings: "unslick",
        },
        {
            breakpoint: 768,
            settings: "unslick",
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '1px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                fade: true,
                cssEase: 'linear',
                 infinite: true,
                speed: 500
            }
        }
    ]
});

