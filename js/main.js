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