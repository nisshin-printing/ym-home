import '../vendor/slick';

/*
 * トップスライダー
 */

$('#js--top-slider').slick({
    slide: '.slick-slide',
    autoplay: true,
    fade: true,
    appendArrows: $('#slide--button'),
    prevArrow: '<button class="slide--button-button -prev"><</button>',
    nextArrow: '<button class="slide--button-button -next">></button>'
});
/*
 * メンバーカルーセル
 */
$('#cta-member-carousel').slick({
    slide: '.slick-slide',
    autoplay: true,
    slidesToShow: 3,
    responsive: [{
        breakpoint: 500,
        settings: {
            slidesToShow: 2
        }
    }]
});
/*
 * LPの時計
 */
$('#js-clock').slick({
    slide: '.slick-slide',
    autoplay: true,
    autoplaySpeed: 2000,
    fade: true,
    arrows: false,
    lazyLoad: 'progressive',
    mobileFirst: true,
    slidesToShow: 1,
});
if ($('#js-clock')) {
    let count = 0;
    const hour = $('#js-clock .hour-hand');
    const minute = $('#js-clock .minute-hand');
    $('#js-clock').on('afterChange', () => {
        // 分針
        minute.css({
            '-webkit-transform': `rotate(${(count + 1) * 90}deg)`,
            '-ms-transform': `rotate(${(count + 1) * 90}deg)`,
            transform: `rotate(${(count + 1) * 90}deg)`
        });
        // 時針
        if (0 === (count % 4) && 0 !== count) {
            hour.css({
                '-webkit-transform': `rotate(${(count / 4 + 1) * 90}deg)`,
                '-ms-transform': `rotate(${(count / 4 + 1) * 90}deg)`,
                transform: `rotate(${(count / 4 + 1) * 90}deg)`
            });
        }
        count++;
    });
}
