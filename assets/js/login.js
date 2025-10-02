const pwd = document.getElementById('password');
const togglePwd = document.getElementById('togglePwd');

// mostrar/ocultar senha
togglePwd.addEventListener('click', () => {
  if (pwd.type === 'password') {
    pwd.type = 'text';
    togglePwd.textContent = '🙈';
  } else {
    pwd.type = 'password';
    togglePwd.textContent = '👁️';
  }
});

// validação de email
document.querySelector('form').addEventListener('submit', (e) => {
  const email = document.getElementById('email').value.trim();
  if (!email || !email.includes('@')) {
    e.preventDefault();
    alert('Por favor, introduza um e-mail válido.');
  }
});
