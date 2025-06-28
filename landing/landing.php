 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calle-web</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/carrusel.css">
    <link rel="stylesheet" href="../assets/css/header_1.css">
    <link rel="stylesheet" href="../assets/css/footer_1.css">
</head>
<body>
        <?php 
            include '../includes/header_1.php'; 
            echo header_1();
        ?>
    <section class="screen screen1">
        <?php 
            include '../includes/carrusel.php'; 
            echo carrusel();
        ?>
        <img class="decorative-image slide-top" src="../assets/imag/papa.png" alt="papas">
    </section>
    <button type="button" class="button-pedir">VER MENU</button>
    <rb></rb>
    <rb></rb>
    <section class="screen screen2"> 
        <img class="decorative-image slide-top" src="../assets/imag/papa2.png" alt="Papas">   
        <div class="scale-up-center titulos-pequeños titulos">
            <h1>¿AÚN NO SABES </h1>
            <div class="titulos-flex">
                <h1>QUÉ</h1>
                <div class="cursiva">
                    <h2>Pedir?</h2>
                </div>
            </div>
             
        </div>
        <img style="margin-right: 138vw; margin-top: 5vw; width: 48%;" src="../assets/imag/carrusel.png" alt="celular">
    </section>

    <section class="screen screen3">
        <img class="decorative-cel slide-right" src="../assets/imag/cel.png" alt="celular">
        <div class=" titulos-pequeños titulos2 scale-down  ">
            <h1>DESCARGAR NUESTRA</h1>
            <div class="titulos-flex">
                <h1>CALLE-</h1>
                <div class="cursiva">
                    <h2>App</h2>
                </div>
            </div>
            <p class="p2">Ya podrás realizar tus pedidos en nuestra app utilizando tu dispositivo móvil android y ios desde donde este, recuerda activar las notificaciones para aprovechar de todas nuestras promociones.</p>
        </div>
    </section>
    <button type="button" class="button-descargar">DESCARGAR</button>
    <rb></rb>
    <rb></rb>
        <?php 
            include '../includes/footer_1.php'; 
            echo footer_1();
        ?>
</body>
</html>
 