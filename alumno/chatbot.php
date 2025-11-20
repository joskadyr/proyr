<?php
include __DIR__ . "/includes/header.php";
?>

<div class="row justify-content-center">
  <div class="col-lg-9 col-xl-8">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <div class="fw-bold">Asistente virtual</div>
            <small class="text-white-50">Resuelve dudas frecuentes sobre pagos, cursos y certificados</small>
          </div>
          <div class="badge text-bg-light text-primary">Beta</div>
        </div>
      </div>
      <div class="card-body">
        <div id="chatWindow" class="border rounded p-3 bg-body-secondary" style="min-height: 320px; max-height: 480px; overflow-y: auto;"></div>
        <form id="chatForm" class="mt-3">
          <label class="form-label" for="chatInput">Pregunta algo:</label>
          <div class="input-group">
            <input id="chatInput" name="mensaje" class="form-control" placeholder="Ej. ¿Cómo descargo mis materiales?" autocomplete="off" required>
            <button class="btn btn-primary" type="submit">Enviar</button>
          </div>
          <div class="form-text text-secondary">El bot usa respuestas predefinidas, evita compartir datos sensibles.</div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  const chatWindow = document.getElementById('chatWindow');
  const chatForm = document.getElementById('chatForm');
  const chatInput = document.getElementById('chatInput');

  const knowledge = [
    {
      keywords: ['pago', 'pagos', 'cuota', 'qr', 'pagar'],
      response: 'Puedes revisar tus pagos en el panel de administración si tienes permisos. Para nuevos pagos, solicita el QR al administrador o revisa la sección de pagos en el campus.'
    },
    {
      keywords: ['curso', 'aula', 'contenido', 'clase'],
      response: 'Ingresa a «Aula» y elige tu curso inscrito para ver unidades y materiales. Si no ves tu curso, confirma tu inscripción con soporte.'
    },
    {
      keywords: ['material', 'descargar', 'apuntes'],
      response: 'Dentro de cada curso ve a la lista de materiales y usa el botón "Descargar". Si el archivo no abre, intenta con otro navegador o contacta al docente.'
    },
    {
      keywords: ['certificado', 'certificados', 'diploma'],
      response: 'Tus certificados completados aparecen en «Mis certificados». Asegúrate de haber aprobado las evaluaciones requeridas antes de descargar.'
    },
    {
      keywords: ['evaluacion', 'examen', 'quiz'],
      response: 'Las evaluaciones están en la sección «Evaluación». Revisa la fecha límite y asegúrate de contar con conexión estable antes de iniciar.'
    },
    {
      keywords: ['horario', 'cronograma', 'clases'],
      response: 'Los horarios se comunican por el docente o coordinador. Si cambió alguna sesión, revisa tu correo institucional o el aula del curso.'
    },
    {
      keywords: ['perfil', 'contraseña', 'password', 'correo'],
      response: 'Puedes actualizar tus datos y contraseña desde la sección «Perfil». Usa una clave segura y guarda los cambios antes de salir.'
    },
    {
      keywords: ['contacto', 'soporte', 'ayuda', 'problema'],
      response: 'Escribe a soporte@aulaandina.edu o contacta a tu administrador para ayuda personalizada. Describe el problema y adjunta capturas si es posible.'
    }
  ];

  function appendMessage(text, role) {
    const wrapper = document.createElement('div');
    wrapper.className = role === 'user' ? 'text-end mb-3' : 'text-start mb-3';
    const bubble = document.createElement('div');
    bubble.className = 'd-inline-block px-3 py-2 rounded-3 ' + (role === 'user' ? 'bg-primary text-white' : 'bg-light text-dark border');
    bubble.textContent = text;
    wrapper.appendChild(bubble);
    chatWindow.appendChild(wrapper);
    chatWindow.scrollTop = chatWindow.scrollHeight;
  }

  function findAnswer(message) {
    const normalized = message.toLowerCase();
    for (const item of knowledge) {
      if (item.keywords.some(k => normalized.includes(k))) {
        return item.response;
      }
    }
    return 'Soy tu asistente virtual. Puedo guiarte sobre pagos, certificados, evaluaciones y materiales. ¿Cómo puedo ayudarte?';
  }

  chatForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const text = chatInput.value.trim();
    if (!text) return;

    appendMessage(text, 'user');
    chatInput.value = '';

    setTimeout(() => {
      const answer = findAnswer(text);
      appendMessage(answer, 'bot');
    }, 250);
  });

  // Mensaje inicial
  appendMessage('Hola <?php echo htmlspecialchars($_SESSION['nombre']); ?>, soy el asistente del campus. Pregunta sobre pagos, cursos o certificados y te guiaré.', 'bot');
})();
</script>

<?php include __DIR__ . "/includes/footer.php"; ?>
