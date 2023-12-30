document.addEventListener("DOMContentLoaded", function () {
  // Seleciona o botão Mudar
  const mudarBtn = document.querySelector(".mudar-btn");

  // Seleciona o modal
  const modal = document.getElementById("modal");

  // Seleciona o botão Fechar dentro do modal
  const fecharBtn = document.querySelector(".fechar-btn");

  // Mostra o modal ao clicar no botão Mudar
  mudarBtn.addEventListener("click", function () {
    modal.style.display = "flex";
  });

  // Fecha o modal ao clicar no botão Fechar
  fecharBtn.addEventListener("click", function () {
    modal.style.display = "none";
  });
});
