<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Erro - Página não encontrada</title>
  <!-- Seus estilos CSS podem ser incluídos aqui -->
</head>

<body>
  <h1>Erro!</h1>
  <?php
  if (isset($error) && !empty($error)) {
    echo '<p>' . $error . '</p>';
  } else {
    echo '<p>Ocorreu um erro desconhecido.</p>';
  }
  ?>
  <!-- Seus outros elementos HTML podem ser adicionados aqui -->

  <!-- Seus scripts JavaScript podem ser incluídos aqui -->
</body>

</html>
