/**
 * Client-side image resize + size gate (300KB–700KB).
 * Auto-binds to admin image file inputs and replaces files before submit.
 */
(function () {
  'use strict';

  var MIN_BYTES = 300 * 1024;
  var MAX_BYTES = 700 * 1024;
  var MAX_EDGE = 1600;

  function formatKb(bytes) {
    return (bytes / 1024).toFixed(0) + 'KB';
  }

    function isImageInput(input) {
    if (!input || input.type !== 'file') return false;
    if (input.hasAttribute('data-ilm-skip')) return false;
    var name = (input.name || '').toLowerCase();
    var accept = (input.accept || '').toLowerCase();
    if (accept.indexOf('image') !== -1) return true;
    return /(image|logo|photo|thumb|cover|gallery|back|header)/.test(name);
  }

  function allowUnderMin(input) {
    return input.getAttribute('data-ilm-allow-small') === '1' ||
      /(logo)/.test((input.name || '').toLowerCase());
  }

  function ensureHint(input) {
    var wrap = input.closest('.ilm-upload-field') || input.parentElement;
    if (!wrap) return;
    var hint = wrap.querySelector('.ilm-upload-hint');
    if (!hint) {
      hint = document.createElement('div');
      hint.className = 'ilm-upload-hint';
      wrap.appendChild(hint);
    }
    var minLabel = allowUnderMin(input) ? 'up to ' + formatKb(MAX_BYTES) : formatKb(MIN_BYTES) + ' – ' + formatKb(MAX_BYTES);
    hint.innerHTML =
      '<strong>Image size:</strong> ' + minLabel +
      '. Photos are resized automatically before upload.' +
      '<span class="ilm-upload-status"></span>';
  }

  function setStatus(input, message, isError) {
    var wrap = input.closest('.ilm-upload-field') || input.parentElement;
    if (!wrap) return;
    var status = wrap.querySelector('.ilm-upload-status');
    if (!status) return;
    status.textContent = message ? ' ' + message : '';
    status.style.color = isError ? '#b42318' : '#1a3a32';
    status.style.fontWeight = isError ? '700' : '600';
  }

  function loadImage(file) {
    return new Promise(function (resolve, reject) {
      var url = URL.createObjectURL(file);
      var img = new Image();
      img.onload = function () {
        URL.revokeObjectURL(url);
        resolve(img);
      };
      img.onerror = function () {
        URL.revokeObjectURL(url);
        reject(new Error('Could not read image.'));
      };
      img.src = url;
    });
  }

  function canvasToBlob(canvas, quality) {
    return new Promise(function (resolve) {
      canvas.toBlob(function (blob) {
        resolve(blob);
      }, 'image/jpeg', quality);
    });
  }

  async function optimizeFile(file, enforceMin) {
    var img = await loadImage(file);
    var scale = Math.min(MAX_EDGE / Math.max(img.width, 1), MAX_EDGE / Math.max(img.height, 1), 1);
    var width = Math.max(1, Math.round(img.width * scale));
    var height = Math.max(1, Math.round(img.height * scale));
    var canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    var ctx = canvas.getContext('2d');
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, width, height);
    ctx.drawImage(img, 0, 0, width, height);

    var qualities = [0.88, 0.82, 0.76, 0.7, 0.64, 0.58, 0.52, 0.46, 0.4];
    var bestUnderMax = null;

    for (var i = 0; i < qualities.length; i++) {
      var blob = await canvasToBlob(canvas, qualities[i]);
      if (!blob) continue;
      if (blob.size <= MAX_BYTES) {
        bestUnderMax = blob;
        if (!enforceMin || blob.size >= MIN_BYTES) {
          return blob;
        }
      }
    }

    if (bestUnderMax) {
      if (enforceMin && bestUnderMax.size < MIN_BYTES) {
        throw new Error('Image is under ' + formatKb(MIN_BYTES) + ' after resize. Use a higher-resolution photo.');
      }
      return bestUnderMax;
    }

    throw new Error('Could not compress under ' + formatKb(MAX_BYTES) + '. Choose a smaller photo.');
  }

  async function handleInputChange(event) {
    var input = event.target;
    if (!isImageInput(input) || !input.files || !input.files.length) return;

    var enforceMin = !allowUnderMin(input);
    var dt = new DataTransfer();
    var messages = [];

    for (var i = 0; i < input.files.length; i++) {
      var file = input.files[i];
      if (!file.type || file.type.indexOf('image/') !== 0) {
        dt.items.add(file);
        continue;
      }

      try {
        setStatus(input, 'Optimizing ' + file.name + '…', false);
        var blob = await optimizeFile(file, enforceMin);
        var newName = file.name.replace(/\.\w+$/, '') + '.jpg';
        var optimized = new File([blob], newName, { type: 'image/jpeg', lastModified: Date.now() });
        dt.items.add(optimized);
        messages.push(file.name + ' → ' + formatKb(optimized.size));
      } catch (err) {
        setStatus(input, err.message || 'Invalid image', true);
        input.value = '';
        return;
      }
    }

    input.files = dt.files;
    setStatus(input, messages.join(' · '), false);
  }

  function bind(input) {
    if (!isImageInput(input) || input.dataset.ilmBound === '1') return;
    input.dataset.ilmBound = '1';
    input.setAttribute('accept', input.getAttribute('accept') || 'image/jpeg,image/png,image/webp,image/gif');
    ensureHint(input);
    input.addEventListener('change', handleInputChange);
  }

  function init(root) {
    (root || document).querySelectorAll('input[type="file"]').forEach(bind);
  }

  document.addEventListener('DOMContentLoaded', function () {
    init(document);
    document.addEventListener('change', function (e) {
      if (e.target && e.target.matches && e.target.matches('input[type="file"]')) {
        bind(e.target);
      }
    }, true);
  });

  window.IlmImageUpload = { init: init, MIN_BYTES: MIN_BYTES, MAX_BYTES: MAX_BYTES };
})();
