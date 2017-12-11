import '../vendor/foundation.core';
import '../vendor/foundation.util.box';
import '../vendor/foundation.util.keyboard';
import '../vendor/foundation.util.mediaQuery';
import '../vendor/foundation.util.motion';
import '../vendor/foundation.util.nest';
import '../vendor/foundation.util.triggers';
// import '../vendor/foundation.smoothScroll';
// import '../vendor/foundation.abide';
import '../vendor/foundation.accordion';
import '../vendor/foundation.dropdownMenu';
// import '../vendor/foundation.magellan';
import '../vendor/foundation.reveal';
// import '../vendor/foundation.sticky';

// Foundation Settings.
Foundation.Accordion.defaults.allowAllClosed = true; // eslint-disable-line no-undef
Foundation.Accordion.defaults.multiExpand = true; // eslint-disable-line no-undef

// Foundation Initialize.
$(document).foundation();


/**
 * Reveal Modal関連
 *  - お問い合わせページ
 */
if ($('.wpcf7-form')) {
    $('input, textarea, select').on('keyup change', () => {
        $(window).on('beforeunload', () => {
            '他のページヘ移動すると入力データはすべて破棄されます。';
        });
    });
    $('a, input[type="submit"]').on('click', () => {
        $(window).off('beforeunload');
    });
    /**
     * 戻るボタンでモーダルを閉じる
     */
    $('.js-select-modal').on('click', () => {
        location.hash = 'member-select';
    });
    window.onhashchange = () => {
        if ('' === location.hash) {
            $('#select-member').foundation('close');
        }
    };

    /**
     * 弁護士選択のInputクリックでモーダルOpen
     */
    $('.js-select-member').on('click', event => {
        event.preventDefault();
        $('#select-member').foundation('open');
    });
    /**
     * 指名しないボタン
     */
    $('.close-select-members').on('click', event => {
        event.preventDefault();
        $('.js-select-member').val('指名しない');
        $('#select-member .focus').removeClass('focus');
        $('#select-member').foundation('close');
    });
    /**
     * メンバーを指名した場合の値の受け渡し
     */
    $('#select-member .column').on('click', function() {
        let name;
        const el = $(this);
        const area = $('.js-select-member');
        if (!el.hasClass('.focus')) {
            el.parent('.row').children('.focus').removeClass('focus');
            el.addClass('focus');
            name = el.data('name');
        } else {
            el.removeClass('focus');
            name = '指名しない';
        }
        area.val(name);
				el.parents('#select-member').delay(300).foundation('close');
				$('body').removeClass('is-reveal-open');
		});
}
/**
 * RevealのAjax
 */
$('.js--modal-button').on('click', () => {
	const $modal = $('#modal');
	const $url = encodeURIComponent($modal.data('ajax'));
	$.ajax({
		type: 'POST',
		url: ajaxurl,
		dataType: 'json',
		data: {
			action: 'modal_ajax',
			url: $url
		},
		success: res => {
			$modal.html(res);
		},
		error: () => {
			$modal.html('エラー for JS');
		}
	});
});
