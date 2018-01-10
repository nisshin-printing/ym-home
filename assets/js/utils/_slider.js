import '../vendor/slick';

/*
 * トップスライダー
 */

$('#js--top-slider').slick({
		accessibility: false,
		slide: '.slick-slide',
		draggable: false,
    autoplay: true,
		fade: true,
		mobileFirst: true,
		swipe: false,
    appendArrows: $('#slide--button'),
    prevArrow: '<button class="slide--button-button -prev"><</button>',
    nextArrow: '<button class="slide--button-button -next">></button>'
});
