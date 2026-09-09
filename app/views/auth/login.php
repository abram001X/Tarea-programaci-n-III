<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Iniciar Sesión' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/stylelogin.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>/assets/img/store.png">
</head>

<body class="min-h-screen flex flex-col">
    <?php $hideCart = true; include VIEW_PATH . '/layout/header.php'; ?>
    <section class="contenedor">
        <div class="login-container dynamic-card">
            <div class="login-banner">
                <div class="banner-overlay">
                    <h2>Iniciar Sesión</h2>
                    <p>Descubre las últimas tendencias en moda.</p>
                </div>
            </div>
            <div class="login-body">
                <form id="loginForm" method="POST" action="<?= BASE_URL ?>/login">
                    <div class="input-grupo">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>
                    </div>
                    <div class="input-grupo">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                    </div>
                    <?php if (!empty($error)): ?>
                        <strong class="msg-login"><?= htmlspecialchars($error) ?></strong>
                    <?php endif; ?>
                    <button type="submit" class="btn-login">Ingresar</button>
                </form>
                <p class="footer-form">¿No tienes cuenta? <a href="<?= BASE_URL ?>/registro">Regístrate aquí</a></p>
            </div>
        </div>
    </section>
</body>
<script src="<?= BASE_URL ?>/assets/js/changeTheme.js"></script>

</html>
