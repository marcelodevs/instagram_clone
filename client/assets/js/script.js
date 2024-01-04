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

function seguir(username, currentuser) {
  $.ajax({
    type: 'POST',
    url: 'http://localhost/dashboard/Instagram/server/controllers/followController.php',
    data: { username: username, currentuser: currentuser },
    success: function (response) {
      console.log(response);
      if (response)
      {
        $('#btn_' + username).text('Seguindo');
      } else
      {
        $('#btn_' + username).text('Seguir');
      }
    },
    error: function (xhr, status, error) {
      console.error('Erro ao seguir ' + username);
    }
  });
}

