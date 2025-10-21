
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calle-Web - Iniciar Sesión</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/footer_1.css">
</head>
<body>
    <div class="login-bg">
        <div class="login-card">
            <h1 class="login-title">Iniciar sesión en </h1>
            <h2 class="login-title-cursive">El Callejón</h2>
            <form method="POST" action="validacion.php" class="login-form">
                <div class="input-group">
                    <input type="text" id="user" name="user" placeholder="@nombre" required class="input-field">
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required class="input-field">
                </div>
                <button class="login-btn" type="submit">Iniciar sesión</button>
                 
                <?php
                if (isset($_GET['message'])) {
                    echo '<div class="login-alert">';
                    switch ($_GET['message']) {
                        case 'ok':
                            echo 'Por favor, revisa tu correo';
                            break;
                        case 'success_password':
                            echo "<script>alert('Inicia sesión con tu nueva contraseña');</script>";
                            break;
                        case 'error':
                        case 'invalid_data':
                        case 'error_password':
                            echo "<script>alert('Error de contraseña');</script>";
                            break;
                        case 'fallido':
                            echo "<script>alert('Inicio de sesión fallido');</script>";
                            break;
                        case 'error_user_domain':
                            echo "<script>
                                    alert('Inicio de sesión fallido: formato de correo electrónico inválido');
                                    window.location.href = '../login-php/loging.php';
                                  </script>";
                            break;
                        default:
                            echo "<script>alert('El correo no existe, intenta ingresar un correo válido');</script>";
                            break;
                    }
                    echo '</div>';
                }
                ?>
            </form>
        </div>
         <div class="login-logo">
                <img src="../assets/imag/logo-color.png" alt="Logo Syry">
            </div>
    </div>
    <?php 
            include '../includes/footer_1.php'; 
            echo footer_1();
        ?>
</body>
</html>