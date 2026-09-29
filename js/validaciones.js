const form = document.querySelector('.contacto__form');

form.addEventListener('submit', (e) => {
  const nombre = document.getElementById('nombre');
  const email = document.getElementById('email');
  const mensaje = document.getElementById('mensaje');
  let valido = true;

  [nombre, email, mensaje].forEach(campo => campo.setCustomValidity(''));

  if (!nombre.value.trim()) {
    nombre.setCustomValidity('El nombre es obligatorio.');
    valido = false;
  }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
    email.setCustomValidity('Ingresa un correo electrónico válido.');
    valido = false;
  }
  if (!mensaje.value.trim()) {
    mensaje.setCustomValidity('El mensaje no puede estar vacío.');
    valido = false;
  }

  if (!valido) {
    e.preventDefault();
    form.reportValidity();
  }
});