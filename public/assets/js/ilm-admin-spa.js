/**
 * Re-init admin UI after Livewire SPA navigation.
 */
(function () {
  'use strict';

  window.ilmAdminReinit = function () {
    try {
      if (window.IlmImageUpload && typeof window.IlmImageUpload.init === 'function') {
        window.IlmImageUpload.init(document);
      }
    } catch (e) {}

    try {
      if (window.jQuery && jQuery.fn.summernote) {
        jQuery('textarea.summernote, #summernote, #blogBody, #welcomeNote, #mission, #vision, #values, #background, #aboutus, #description, #donations').each(function () {
          var $el = jQuery(this);
          if ($el.next('.note-editor').length) {
            $el.summernote('destroy');
          }
          $el.summernote({
            placeholder: 'Write here…',
            tabsize: 2,
            height: 200,
          });
        });
      }
    } catch (e) {}

    try {
      var toggle = document.getElementById('sidebarToggle');
      if (toggle && !toggle.dataset.ilmBound) {
        toggle.dataset.ilmBound = '1';
        toggle.addEventListener('click', function (e) {
          e.preventDefault();
          document.body.classList.toggle('sb-sidenav-toggled');
        });
      }
    } catch (e) {}
  };

  document.addEventListener('DOMContentLoaded', window.ilmAdminReinit);
  document.addEventListener('livewire:navigated', window.ilmAdminReinit);
})();
