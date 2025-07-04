<?php
include 'conexion.php';
// Obtener productos para el carrusel (en_carrusel=1)
$carrusel = $conexion->query("SELECT * FROM productos WHERE en_carrusel=1 ORDER BY ID ASC");
// Obtener todos los productos para la sección de productos
$categoria_filtro = isset($_GET['categoria']) ? $_GET['categoria'] : '';
if ($categoria_filtro && in_array($categoria_filtro, ['combo', 'batida', 'refresco'])) {
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE categoria = ? ORDER BY ID DESC");
    $stmt->bind_param("s", $categoria_filtro);
    $stmt->execute();
    $productos = $stmt->get_result();
} else {
    $productos = $conexion->query("SELECT * FROM productos ORDER BY ID DESC");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Catálogo</title>
  <link rel="stylesheet" href="style.css"> 
  <link rel="stylesheet" href="product-card.css">
  <link rel="stylesheet" href="carousel.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
</head>
<body>
  <header class="main-header">
    <!-- Puedes agregar aquí lógica PHP para el usuario, carrito, etc. -->
  </header>
  <!-- Buscador por categoría -->
<section style="text-align: center; padding: 20px; background: #fff4d9;">
  <form method="GET">
    <label for="categoria" style="font-weight: bold; color: #a1001f; font-size: 1.1em;">Filtrar por categoría:</label>
    <select name="categoria" id="categoria" onchange="this.form.submit()" style="padding: 0.5em 1em; margin-left: 10px; border-radius: 10px; border: 1px solid #e2b100;">
      <option value="">Todas</option>
      <option value="combo" <?= $categoria_filtro === 'combo' ? 'selected' : '' ?>>Combo</option>
      <option value="batido" <?= $categoria_filtro === 'batido' ? 'selected' : '' ?>>Batido</option>
      <option value="refresco" <?= $categoria_filtro === 'refresco' ? 'selected' : '' ?>>Refresco</option>
    </select>
  </form>
</section>

  <section class="hero">
    <div class="overlay"></div>
    <!-- Carrusel de combos -->
    <div class="combo-carousel">
      <div class="carousel-track">
        <?php $i=0; foreach ($carrusel as $combo): ?>
        <div class="carousel-slide<?= $i===0 ? ' active' : '' ?>">
          <div class="carousel-content">
            <div class="carousel-text">
              <h2><?= htmlspecialchars($combo['nombre']) ?></h2>
              <p><?= htmlspecialchars($combo['descripcion']) ?></p>
              <span class="product-price">$<?= number_format($combo['precio'],2) ?></span>
              <button class="combo-btn">PEDIR COMBO</button>
            </div>
            <div class="carousel-img-container">
              <img src="imagenes/<?= htmlspecialchars($combo['imagen']) ?>" alt="<?= htmlspecialchars($combo['nombre']) ?>" class="carousel-img" />
            </div>
          </div>
        </div>
        <?php $i++; endforeach; ?>
      </div>
      <div class="carousel-indicators">
        <?php for($j=0; $j<$i; $j++): ?>
          <span class="indicator<?= $j===0 ? ' active' : '' ?>"></span>
        <?php endfor; ?>
      </div>
      <button class="carousel-arrow left">&#10094;</button>
      <button class="carousel-arrow right">&#10095;</button>
    </div>
  </section>

  <main>
    <h2 class="section-title">Lo más vendido</h2>
    <section class="product-list">
      <?php while($p = $productos->fetch_assoc()): ?>
      <div class="product-card" data-nombre="<?= htmlspecialchars($p['nombre']) ?>" data-precio="<?= number_format($p['precio'],2) ?>" data-desc="<?= htmlspecialchars($p['descripcion']) ?>" data-img="imagenes/<?= htmlspecialchars($p['imagen']) ?>" data-rating="<?= isset($p['calificacion']) ? (int)$p['calificacion'] : 5 ?>">
        <div class="product-card-img-container">
          <img src="imagenes/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="product-card-img" />
        </div>
        <div class="product-info">
          <h3 class="product-name"><?= htmlspecialchars($p['nombre']) ?></h3>
		  <p class="product-category"><?= ucfirst(htmlspecialchars($p['categoria'])) ?></p>

          <span class="product-price">$<?= number_format($p['precio'],2) ?></span>
          <div class="product-rating">
            <?php 
              $rating = 5; 
              for($k=1;$k<=5;$k++) {
                $off = $k > $rating ? ' off' : '';
                echo '<img src="imagenes/muslito.png" alt="Muslito" class="muslito'.$off.'" />';
              }
            ?>
          </div>
		  <div class="product-actions">
  <form action="agregar_carrito.php" method="POST">
    <input type="hidden" name="producto_id" value="<?= $p['ID'] ?>">
    <button type="submit" class="add-to-cart-btn">Agregar al carrito</button>
  </form>
</div>

        </div>
		
      </div>
      <?php endwhile; ?>
    </section>
    <!-- Modal para detalles del producto -->
    <div id="product-modal" class="product-modal-overlay" style="display:none;">
      <div class="product-modal">
        <button class="product-modal-close">&times;</button>
        <img src="" alt="Imagen producto" class="product-modal-img" />
        <h3 class="product-modal-name"></h3>
        <span class="product-modal-price"></span>
		<p class="product-category"><?= ucfirst(htmlspecialchars($p['categoria'])) ?></p>

        <p class="product-modal-desc"></p>
        <div class="product-modal-rating"></div>
      </div>
    </div>
  </main>

  <footer>
    <!--© 2025 Gery. Todos los derechos reservados.-->
  </footer>

  <!-- Carrusel funcionalidad -->
  <script>
    // Carrusel funcionalidad
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    const leftArrow = document.querySelector('.carousel-arrow.left');
    const rightArrow = document.querySelector('.carousel-arrow.right');
    let currentSlide = 0;
    function showSlide(idx) {
      slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === idx);
        if (indicators[i]) indicators[i].classList.toggle('active', i === idx);
      });
      currentSlide = idx;
    }
    function nextSlide() {
      let idx = (currentSlide + 1) % slides.length;
      showSlide(idx);
    }
    function prevSlide() {
      let idx = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(idx);
    }
    if (rightArrow) rightArrow.onclick = nextSlide;
    if (leftArrow) leftArrow.onclick = prevSlide;
    indicators.forEach((ind, i) => {
      ind.onclick = () => showSlide(i);
    });
    // setInterval(nextSlide, 6000);
  </script>
  <script>
    // Modal de producto
    document.querySelectorAll('.product-card').forEach(card => {
      card.addEventListener('click', function() {
        const modal = document.getElementById('product-modal');
        modal.style.display = 'flex';
        modal.querySelector('.product-modal-img').src = this.dataset.img;
        modal.querySelector('.product-modal-name').textContent = this.dataset.nombre;
        modal.querySelector('.product-modal-price').textContent = '$' + this.dataset.precio;
        modal.querySelector('.product-modal-desc').textContent = this.dataset.desc;
        // Calificación en muslitos
        const rating = parseInt(this.dataset.rating || '5');
        let muslitos = '';
        for(let i=1;i<=5;i++) {
          muslitos += `<img src="imagenes/muslito.png" alt="Muslito" style="width:28px;opacity:${i<=rating?1:0.3};margin:0 2px;">`;
        }
        modal.querySelector('.product-modal-rating').innerHTML = muslitos;
      });
    });
    document.querySelector('.product-modal-close').onclick = function() {
      document.getElementById('product-modal').style.display = 'none';
    };
    document.getElementById('product-modal').onclick = function(e) {
      if(e.target === this) this.style.display = 'none';
    };
  </script>
  <script>
    // Parallax y overlay (igual que antes)
    const sectionChanel = document.querySelector('.section-chanel');
    const sectionVictoria = document.querySelector('.section-victoria');
    const sectionBolsos = document.querySelector('.section-bolsos');
    const hero = document.querySelector('.hero');
    const overlay = document.querySelector('.hero .overlay');
    window.addEventListener('scroll', () => {
      const windowHeight = window.innerHeight;
      const scrollTop = window.scrollY;
      const activationPoint = windowHeight * 0.5;
      const maxMovement = 50;
      const startPosition = -150;
      function applyParallax(section) {
        if (!section) return;
        const sectionTop = section.getBoundingClientRect().top;
        const sectionHeight = section.offsetHeight;
        if (sectionTop < activationPoint && (sectionTop + sectionHeight) > 0) {
          const progress = Math.min((activationPoint - sectionTop) / (activationPoint + sectionHeight), 1);
          const moveY = startPosition + (progress * maxMovement);
          section.style.backgroundPosition = `center ${moveY}px`;
        } else if (sectionTop >= activationPoint) {
          section.style.backgroundPosition = `center ${startPosition}px`;
        }
      }
      applyParallax(sectionChanel);
      applyParallax(sectionVictoria);
      applyParallax(sectionBolsos);
      const heroHeight = hero.offsetHeight;
      if (scrollTop < heroHeight) {
        const opacity = Math.min(scrollTop / heroHeight, 0.6);
        overlay.style.opacity = opacity;
      } else {
        overlay.style.opacity = 0.6;
      }
    });
  </script>
</body>
</html>
