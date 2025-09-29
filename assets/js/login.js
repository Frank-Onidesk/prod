
// login.js
// Importa função do button.js
import { setActive } from './button.js';

document.addEventListener("DOMContentLoaded", () => {
	let isActive = false;
	const btn = document.getElementById('loginBtn');
	if (!btn) return;

	// Atualiza o botão no início
	setActive(btn, isActive);

	// Alterna estado ao clicar
	btn.addEventListener('click', () => {
		isActive = !isActive;
		setActive(btn, isActive);
	});

});