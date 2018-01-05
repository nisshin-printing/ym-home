import '../vendor/slick';

/*
 * トップスライダー
 */

$('#js--top-slider').slick({
		accessibility: false,
		slide: '.slick-slide',
		doraggable: false,
    autoplay: true,
		fade: true,
		mobileFirst: true,
    appendArrows: $('#slide--button'),
    prevArrow: '<button class="slide--button-button -prev"><</button>',
    nextArrow: '<button class="slide--button-button -next">></button>'
});
