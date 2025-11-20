<?php require_once __DIR__."/config.php"; if(isset($_SESSION['id_usuario'])){ header("Location: " . (is_admin()? "/proyecto2/admin/index.php" : "/proyecto2/alumno/index.php")); exit; } ?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login • AulaAndina2</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body{
  min-height:100vh;
  background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
  color:#e5e7eb;
  overflow-x: hidden;
}
.login-container{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  max-width: 1200px;
  margin: auto;
  padding: 40px 20px;
  align-items: center;
}
.login-card{
  background: linear-gradient(135deg, #1f2937, #111827);
  border: 1px solid #374151;
  border-radius: 15px;
  padding: 40px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.5);
}
.brand{font-weight:800; letter-spacing:.5px; color: #3b82f6;}
.form-control, .form-select{
  background:#0b1220;
  border-color:#374151;
  color:#e5e7eb;
  border-radius: 8px;
}
.form-control:focus{
  background:#0b1220;
  border-color:#3b82f6;
  color:#e5e7eb;
  box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}
.btn-primary{
  background: linear-gradient(135deg, #3b82f6, #0d6efd);
  border: none;
  border-radius: 8px;
  font-weight: 600;
}
.btn-primary:hover{
  background: linear-gradient(135deg, #2563eb, #0a58ca);
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
}
.promo-section{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}
.promo-card{
  background: rgba(59, 130, 246, 0.1);
  border: 1px solid #374151;
  border-radius: 12px;
  padding: 20px;
  transition: all 0.3s;
}
.promo-card:hover{
  background: rgba(59, 130, 246, 0.15);
  transform: translateY(-5px);
  border-color: #3b82f6;
}
.promo-icon{
  font-size: 28px;
  color: #3b82f6;
  margin-bottom: 10px;
}
.promo-title{
  font-weight: 700;
  margin-bottom: 8px;
  color: #e5e7eb;
}
.promo-text{
  font-size: 13px;
  color: #9ca3af;
  line-height: 1.5;
}
.stats{
  display: flex;
  gap: 20px;
  margin-top: 30px;
  padding-top: 30px;
  border-top: 1px solid #374151;
}
.stat-item{
  flex: 1;
  text-align: center;
}
.stat-number{
  font-size: 28px;
  font-weight: 800;
  color: #3b82f6;
}
.stat-label{
  font-size: 12px;
  color: #9ca3af;
  margin-top: 5px;
}
@media (max-width: 768px){
  .login-container{
    grid-template-columns: 1fr;
    gap: 30px;
  }
  .promo-section{
    grid-template-columns: 1fr;
  }
}
</style>
</head>
<body>
<div class="login-container">
  <!-- PANEL IZQUIERDO: LOGIN -->
  <div>
    <div class="login-card">
      <div class="text-center mb-4">
        <div class="brand fs-4">🎓 AulaAndina2</div>
        <div style="color: #9ca3af; font-size: 14px;">Plataforma de Educación en Línea</div>
      </div>
      <form method="post" action="login_check.php" class="vstack gap-3">
        <div>
          <label class="form-label" style="font-weight: 600;">Usuario</label>
          <input name="usuario" class="form-control" placeholder="Ingresa tu usuario" required>
        </div>
        <div>
          <label class="form-label" style="font-weight: 600;">Contraseña</label>
          <input type="password" name="clave" class="form-control" placeholder="Ingresa tu contraseña" required>
        </div>
        <button class="btn btn-primary w-100 py-2" style="font-size: 16px;">🚀 Ingresar</button>
        <?php if(isset($_SESSION['error'])){ echo '<div class="text-danger small mt-2" style="text-align: center;">⚠️ '.htmlspecialchars($_SESSION['error']).'</div>'; unset($_SESSION['error']); } ?>
      </form>
      <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #374151;">
        <div style="color: #9ca3af; font-size: 13px;">¿Primera vez? Contacta con administración</div>
      </div>
    </div>
  </div>

  <!-- PANEL DERECHO: PROPAGANDA Y INFORMACIÓN -->
  <div>
    <div style="margin-bottom: 30px;">
      <h2 style="font-weight: 800; margin-bottom: 10px;">Bienvenido a AulaAndina2</h2>
      <p style="color: #9ca3af; font-size: 15px;">La mejor plataforma de educación virtual de los Andes. Aprende a tu propio ritmo.</p>
    </div>

    <div class="promo-section">
      <!-- Cursos -->
      <div class="promo-card">
        <div class="promo-icon"><i class="fas fa-book"></i></div>
        <div class="promo-title">100+ Cursos</div>
        <div class="promo-text">Acceso a una amplia variedad de cursos en programación, negocios, diseño y más.</div>
      </div>

      <!-- Instructores -->
      <div class="promo-card">
        <div class="promo-icon"><i class="fas fa-chalkboard-user"></i></div>
        <div class="promo-title">Expertos Certificados</div>
        <div class="promo-text">Aprende de profesionales con años de experiencia en sus campos.</div>
      </div>

      <!-- Flexibilidad -->
      <div class="promo-card">
        <div class="promo-icon"><i class="fas fa-clock"></i></div>
        <div class="promo-title">Estudia Cuando Quieras</div>
        <div class="promo-text">Acceso 24/7 a tu propio ritmo. Sin horarios fijos.</div>
      </div>

      <!-- Certificados -->
      <div class="promo-card">
        <div class="promo-icon"><i class="fas fa-certificate"></i></div>
        <div class="promo-title">Certificados Válidos</div>
        <div class="promo-text">Obtén certificados reconocidos al completar los cursos.</div>
      </div>
    </div>

    <!-- INFORMACIÓN ADICIONAL -->
    <div style="background: rgba(59, 130, 246, 0.05); border: 1px solid #374151; border-radius: 12px; padding: 20px; margin-top: 25px;">
      <h5 style="margin-bottom: 15px; font-weight: 700;">📍 Ubicación y Contacto</h5>
      <div style="font-size: 14px; line-height: 1.8;">
        <div style="margin-bottom: 10px;">
          <strong>Dirección:</strong> Calle Principal 123, Edificio Centro<br>
          <span style="color: #9ca3af;">La Paz, Bolivia</span>
        </div>
        <div style="margin-bottom: 10px;">
          <strong>Teléfono:</strong> +591 2 123 4567<br>
          <span style="color: #9ca3af;">Lunes a Viernes 9am - 6pm</span>
        </div>
        <div style="margin-bottom: 15px;">
          <strong>Email:</strong> <a href="mailto:info@aulaandina2.bo" style="color: #3b82f6; text-decoration: none;">info@aulaandina2.bo</a><br>
        </div>
      </div>
      
      <!-- MAPA -->
      <div style="border-radius: 8px; overflow: hidden; height: 200px; margin-top: 15px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.2534753484993!2d-68.13366!3d-16.48923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915ede3d8e5c5c5d%3A0x5c5c5c5c5c5c5c5c!2sLa%20Paz%2C%20Bolivia!5e0!3m2!1ses!2sbo!4v1234567890" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade;"></iframe>
      </div>
    </div>

    <!-- CALENDARIO DE CURSOS -->
    <div style="background: rgba(59, 130, 246, 0.05); border: 1px solid #374151; border-radius: 12px; padding: 20px; margin-top: 20px;">
      <h5 style="margin-bottom: 15px; font-weight: 700;">📅 Próximos Cursos</h5>
      <div style="font-size: 13px;">
        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #374151;">
          <span><strong>Python Avanzado</strong></span>
          <span style="color: #9ca3af;">15 Nov</span>
        </div>
        <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #374151;">
          <span><strong>Desarrollo Web</strong></span>
          <span style="color: #9ca3af;">20 Nov</span>
        </div>
        <div style="display: flex; justify-content: space-between; padding: 8px 0;">
          <span><strong>Marketing Digital</strong></span>
          <span style="color: #9ca3af;">25 Nov</span>
        </div>
      </div>
    </div>

    <!-- PROMOCIONES ESPECIALES -->
    <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(59, 130, 246, 0.15)); border: 2px solid #ef4444; border-radius: 12px; padding: 20px; margin-top: 20px;">
      <h5 style="margin-bottom: 15px; font-weight: 700; color: #fca5a5;">🎁 PROMOCIONES ESPECIALES</h5>
      <div style="font-size: 13px;">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid rgba(239, 68, 68, 0.3);">
          <div>
            <strong style="color: #fca5a5;">Descuento Black Friday</strong><br>
            <span style="color: #9ca3af;">50% en todos los cursos</span>
          </div>
          <span style="background: #ef4444; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700;">-50%</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid rgba(239, 68, 68, 0.3);">
          <div>
            <strong style="color: #fca5a5;">Bono para Nuevos Alumnos</strong><br>
            <span style="color: #9ca3af;">Primer curso gratis</span>
          </div>
          <span style="background: #10b981; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700;">GRATIS</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0;">
          <div>
            <strong style="color: #fca5a5;">Pack Anual</strong><br>
            <span style="color: #9ca3af;">Acceso a 100+ cursos</span>
          </div>
          <span style="background: #f59e0b; color: white; padding: 4px 12px; border-radius: 20px; font-weight: 700;">30% OFF</span>
        </div>
      </div>
    </div>

    <!-- ESTADÍSTICAS -->
    <div class="stats">
      <div class="stat-item">
        <div class="stat-number">5000+</div>
        <div class="stat-label">ESTUDIANTES</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">150+</div>
        <div class="stat-label">CURSOS</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">98%</div>
        <div class="stat-label">SATISFACCIÓN</div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
