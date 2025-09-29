// button.js
// Função para atualizar o estado do botão
export function setActive(btn, state) {
  if (state) {
    btn.classList.add('active');
    btn.textContent = "Ativo";
  } else {
    btn.classList.remove('active');
    btn.textContent = "Inativo";
  }
  console.log("Estado ativo:", state);
}