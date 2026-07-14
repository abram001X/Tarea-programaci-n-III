<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- ✅ Agregados -->
     <!-- Tailwind CSS para el diseño moderno y responsivo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/stylelogin.css">
</head>
<body class="min-h-screen flex flex-col">
    <?php  include_once 'header.php'?>
    <section class="contenedor">

        <div class="login-container dynamic-card">
            
            <!-- BANNER ESTILO VANGWEAR (Superior) -->
            <div class="login-banner">
                <div class="banner-overlay">
                    <h2>Iniciar Sesión</h2>
                    <p>Descubre las últimas tendencias en moda.</p>
                </div>
            </div>
            
            
            <div class="login-body">
                <form id="loginForm">
                    <div class="input-grupo">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>
                    </div>
                    
                    <div class="input-grupo">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                    </div>
                    <strong class="msg-login"></strong>
                    <button type="submit" class="btn-login">Ingresar</button>
                </form>
                <p class="footer-form">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </div>
            
        </div>
        
    </section>
</body>
<script type="module" src="src/login.js"></script>
<script src="src/changeTheme.js"></script>
</html>

