<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro | VANGWEAR</title>
  <!-- ✅ Agregados -->
   <!-- Tailwind CSS para el diseño moderno y responsivo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style/style.css">
   
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style/style.css" />
  <link rel="stylesheet" href="style/registro.css" />
</head>

<body>
  <?php include_once 'header.php' ?>
  <main class="registro-shell">
    <section class="registro-card">
      <article class="registro-visual">
        <div class="badge">VANGWEAR</div>
        <h1>Únete a la colección que define tu estilo</h1>
        <p>Regístrate para recibir novedades, promociones exclusivas y una experiencia de compra más rápida.</p>
        <ul class="benefits-list">
          <li>Acceso anticipado a nuevas colecciones</li>
          <li>Ofertas especiales en ropa y accesorios</li>
          <li>Seguimiento de tu pedido en un solo lugar</li>
        </ul>
      </article>

      <article class="registro-form-panel">
        <div class="form-header">
          <p class="eyebrow">Crea tu cuenta</p>
          <h2>Registro</h2>
          <p class="subtitle">Completa tus datos y empieza a comprar con estilo.</p>
        </div>

        <form class="registro-form" id="registro-form">
          <label>
            Nombre completo
            <input type="text" name="name" placeholder="Tu nombre" id="nameReg" required />
          </label>

          <label>
            Correo electrónico
            <input type="email" name="email" placeholder="usuario@ejemplo.com" id="emailReg" required />
          </label>

          <label>
            Contraseña
            <input type="password" name="password" placeholder="Mínimo 6 caracteres" id="passwordReg" required />
          </label>

          <label>
            Confirmar contraseña
            <input type="password" name="confirmPassword" id="confirmPass" placeholder="Repite tu contraseña" required />
          </label>
          <strong class="msg-reg"></strong>
          <button type="submit" class="btn-register">Crear cuenta</button>
        </form>

        <p class="footer-form">¿Ya tienes cuenta? <a href="indexlogin.php">Inicia sesión</a></p>
      </article>
    </section>
  </main>
</body>
<script src="src/register.js" type="module"></script>

<script src="src/changeTheme.js"></script>

</html>