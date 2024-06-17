<!-- login_view.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="icon" href="../../public/img/icon.PNG" type="image/png">
</head>
<body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="form-container">
            <h2 class="text-center">Iniciar sesión</h2>
            <form method="post" action="../controllers/login_c.php">
              <div class="form-group text-center">
                <label>Tipo de usuario:</label><br>
                <label class="img-opcion">
                  <p style="color: gray;">Director</p>
                  <input type="radio" name="usertype" value="admin">
                  <img src="../../public/img/colegio.png" alt="centro-educativo">
                </label>
  
                <label class="img-opcion">
                  <p style="color: gray;">Educador</p>
                  <input type="radio" name="usertype" value="educador">
                  <img src="../../public/img/educador.png" alt="educador">
                </label>
  
                <label class="img-opcion">
                  <p style="color: gray;">Familias</p>
                  <input type="radio" name="usertype" value="padre" checked>
                  <img src="../../public/img/familia.png" alt="familiar">
                </label>
              </div>
  
              <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
  
              <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
  
              <div class="form-group text-center">
                <input type="submit" value="Iniciar sesión" class="btn">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Bootstrap JS (opcional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
