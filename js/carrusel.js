const lightbox = document.getElementById('lightbox');
const lightboxImg = lightbox.querySelector('.lightbox__imagen');
const cerrarBtn = lightbox.querySelector('.lightbox__cerrar');

document.querySelectorAll('.galeria__item').forEach(item => {
  item.addEventListener('click', () => {
    lightboxImg.src = item.dataset.src;
    lightboxImg.alt = item.querySelector('img').alt;
    lightbox.hidden = false;
  });
});

function cerrarLightbox() {
  lightbox.hidden = true;
  lightboxImg.src = '';
}

cerrarBtn.addEventListener('click', cerrarLightbox);
lightbox.addEventListener('click', (e) => {
  if (e.target === lightbox) cerrarLightbox();
});
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && !lightbox.hidden) cerrarLightbox();
});