document.querySelectorAll('.atletas__filtro').forEach(boton => {
  boton.addEventListener('click', () => {
    document.querySelectorAll('.atletas__filtro').forEach(b => {
      b.classList.remove('atletas__filtro--activo');
      b.setAttribute('aria-selected', 'false');
    });
    boton.classList.add('atletas__filtro--activo');
    boton.setAttribute('aria-selected', 'true');

    const categoria = boton.dataset.categoria;
    document.querySelectorAll('.card-atleta').forEach(card => {
      const coincide = categoria === 'todos' || card.dataset.categoria === categoria;
      card.style.display = coincide ? '' : 'none';
    });
  });
});
(() => {
  const btn = document.querySelector('.encabezado__menu-btn');
  const panel = document.getElementById('menu-panel');
  if (!btn || !panel) return;

  const alternar = (abrir) => {
    btn.setAttribute('aria-expanded', String(abrir));
    btn.setAttribute('aria-label', abrir ? 'Cerrar menú' : 'Abrir menú');
    panel.hidden = !abrir;
  };

  btn.addEventListener('click', (e) => {
    e.stopPropagation();
    alternar(btn.getAttribute('aria-expanded') !== 'true');
  });
  document.addEventListener('click', (e) => {
    if (!panel.hidden && !panel.contains(e.target)) alternar(false);
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !panel.hidden) { alternar(false); btn.focus(); }
  });
})();