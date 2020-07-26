require('./uploader');

const vichImage = document.querySelector('.vich-image');

const imageIndex = vichImage.childNodes[3].childNodes[1];

imageIndex.setAttribute('width', '100%');
imageIndex.setAttribute('height', 'auto');

vichImage.childNodes[2].innerHTML = '<h5 class="ml-3">- Affiché actuellement :</h5>';
