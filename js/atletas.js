document.addEventListener('DOMContentLoaded', () => {
  const botones = document.querySelectorAll('.atletas__filtro');
  const tarjetas = document.querySelectorAll('.card-atleta');
  const estado = document.getElementById('atletas-estado');

  botones.forEach((boton) => {
    boton.addEventListener('click', () => {
      const categoria = boton.dataset.categoria;
      let visibles = 0;

      botones.forEach((b) => {
        const activo = b === boton;
        b.classList.toggle('atletas__filtro--activo', activo);
        b.setAttribute('aria-pressed', activo ? 'true' : 'false');
      });

      tarjetas.forEach((tarjeta) => {
        const mostrar = categoria === 'todos' || tarjeta.dataset.categoria === categoria;
        tarjeta.hidden = !mostrar;
        if (mostrar) visibles++;
      });

      estado.textContent = visibles + (visibles === 1 ? ' atleta mostrado' : ' atletas mostrados');
    });
  });
});