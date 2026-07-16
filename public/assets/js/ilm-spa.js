/**
 * Re-initialize theme scripts after Livewire SPA navigation.
 */
(function () {
  'use strict';

  function safe(fn) {
    try {
      fn();
    } catch (e) {
      // Theme plugins may be absent on some pages.
    }
  }

  window.ilmReinit = function () {
    if (typeof window.jQuery === 'undefined') {
      return;
    }

    var $ = window.jQuery;

    safe(function () {
      if (typeof WOW !== 'undefined') {
        new WOW({ boxClass: 'wow', animateClass: 'animated', offset: 0, mobile: true, live: true }).init();
      }
    });

    safe(function () {
      if ($.fn.meanmenu) {
        $('.mean-bar').remove();
        $('.tp-main-menu-content').meanmenu({
          meanMenuContainer: '.tp-main-menu-mobile',
          meanScreenWidth: '1199',
          meanExpand: ['<i class="fa-regular fa-plus"></i>'],
        });
      }
    });

    safe(function () {
      if ($.fn.slick) {
        $('.slick-initialized').each(function () {
          $(this).slick('unslick');
        });
        if ($('.tp-slider-active').length) {
          $('.tp-slider-active').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            dots: true,
            fade: true,
          });
        }
      }
    });

    safe(function () {
      if ($.fn.magnificPopup) {
        $('.popup-image').magnificPopup({
          type: 'image',
          gallery: { enabled: true },
        });
      }
    });

    safe(function () {
      $('[data-background]').each(function () {
        var bg = $(this).attr('data-background');
        if (bg) {
          $(this).css('background-image', 'url(' + bg + ')');
        }
      });
    });

    safe(function () {
      if (typeof PureCounter !== 'undefined') {
        new PureCounter();
      }
    });
  };

  document.addEventListener('DOMContentLoaded', function () {
    window.ilmReinit();
  });

  document.addEventListener('livewire:navigated', function () {
    window.ilmReinit();
  });
})();
