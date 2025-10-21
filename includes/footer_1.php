<?php
function footer_1() {
    return '
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="../assets/imag/logo-blanco.png" style="width: 13vw; margin-left: -4vw;" alt="Logo Syry">
            </div>
            <div class="footer-section about">
                <h4>Sobre Nosotros</h4>
                <p>Somos tu destino principal para productos de calidad. Explora nuestro catálogo y encuentra lo que necesitas.</p>
            </div>
            <div class="footer-section links">
                <h4>Enlaces Rápidos</h4>
                <ul>
                    <li><a href="catalogo.php">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>  
                </ul>
            </div>
            <div class="footer-section contact">
                <h4>Contáctanos</h4>
                <p><i class="fas fa-map-marker-alt"></i> La Chorrera, Panamá Oeste, Panamá</p>
                <p><i class="fas fa-phone"></i> +507 6XX-XXXX</p>
                <p><i class="fas fa-envelope"></i> calleweb@gmail.com</p>
            </div>
            <div class="footer-section social">
                <h4>Síguenos</h4>
                <div class="social-icons">
                    <a href="https://www.instagram.com/elcallejonnata?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener">Instagram</a>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            &copy; '.date('Y').' CalleWeb. Todos los derechos reservados.
        </div>
    </footer>
    ';
}
?>