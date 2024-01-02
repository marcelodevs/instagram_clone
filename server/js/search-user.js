$(document).ready(function () {
  $('#searchInput').keyup(function () {
    let query = $(this).val();

    $.ajax({
      url: 'http://localhost/dashboard/Instagram/server/php/search-user.php',
      method: 'POST',
      data: { query: query },
      success: function (data) {
        displayResults(data);
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Exibe detalhes do erro no console
      }
    });
  });

  function displayResults(data) {
    $('#searchResults').empty();

    data.forEach(function (username) {
      let userElement = $('<div class="search-result">' + username + '</div>');

      userElement.on('click', function () {
        window.location.href = '../../assets/pages/perfil-user.php?name=' + username;
      });

      $('#searchResults').append(userElement);
    });
  }
});
