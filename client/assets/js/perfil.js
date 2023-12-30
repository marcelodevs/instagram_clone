document.addEventListener("DOMContentLoaded", function () {
  const mudarBtn = document.querySelector(".name");

  const modal = document.getElementById("modal");

  const fecharBtn = document.querySelector(".fechar-btn");

  mudarBtn.addEventListener("click", function () {
    modal.style.display = "flex";
  });

  fecharBtn.addEventListener("click", function () {
    modal.style.display = "none";
  });
});
