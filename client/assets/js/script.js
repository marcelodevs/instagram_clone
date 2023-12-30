document.addEventListener('DOMContentLoaded', function () {
  var profileButton = document.getElementById('profileButton');
  var profileMenu = document.getElementById('profileMenu');

  profileButton.addEventListener('click', function (event) {
    event.stopPropagation(); // Impede que o evento de clique se propague

    if (profileMenu.style.display === 'block')
    {
      profileMenu.style.display = 'none';
    } else
    {
      profileMenu.style.display = 'block';
    }
  });

  document.addEventListener('click', function (event) {
    var isClickInside = profileButton.contains(event.target) || profileMenu.contains(event.target);

    if (!isClickInside)
    {
      profileMenu.style.display = 'none';
    }
  });
});
