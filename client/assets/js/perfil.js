document.addEventListener("DOMContentLoaded", function () {
  const mudarBtnAccounts = document.querySelector(".name");

  const modalAccounts = document.querySelector(".modal-accounts");

  const fecharBtnAccounts = document.querySelector(".fechar-btn");

  mudarBtnAccounts.addEventListener("click", function () {
    modalAccounts.style.display = "flex";
    document.body.classList.add('action-clickk');
  });

  fecharBtnAccounts.addEventListener("click", function () {
    modalAccounts.style.display = "none";
    document.body.classList.remove('action-clickk');
  });

  const mudarBtnSettings = document.querySelector(".click");

  const modalSettings = document.querySelector(".modal-settings");

  const fecharBtnSettings = document.querySelectorAll(".fechar-btn")[1];

  mudarBtnSettings.addEventListener("click", function () {
    modalSettings.style.display = "flex";
    document.body.classList.add('action-clickk');
  });

  fecharBtnSettings.addEventListener("click", function () {
    modalSettings.style.display = "none";
    document.body.classList.remove('action-clickk');
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
