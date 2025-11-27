<style>
.form-hero {
  background: linear-gradient(135deg, rgba(108, 92, 231, 0.1), rgba(162, 155, 254, 0.1));
  border-radius: 25px;
  padding: 60px 40px;
  margin: 40px 0;
  text-align: center;
  box-shadow: 0 25px 50px rgba(0,0,0,0.3);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  position: relative;
  overflow: hidden;
}



.form-title {
  font-size: 3rem;
  font-weight: bold;
  background: linear-gradient(45deg, #fff, #ff6b9d, #c44569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 20px;
  position: relative;
  z-index: 2;
}

.form-subtitle {
  font-size: 1.3rem;
  color: rgba(255,255,255,0.9);
  position: relative;
  z-index: 2;
}

.form-container {
  background: rgba(255,255,255,0.05);
  border-radius: 25px;
  padding: 50px;
  margin: 40px 0;
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.form-input {
  background: rgba(255,255,255,0.1) !important;
  border: 2px solid rgba(255,255,255,0.2) !important;
  border-radius: 15px !important;
  color: white !important;
  padding: 18px !important;
  font-size: 1.1rem !important;
  transition: all 0.3s ease !important;
}

.form-input:focus {
  background: rgba(255,255,255,0.15) !important;
  border-color: #ff6b9d !important;
  box-shadow: 0 0 0 0.2rem rgba(255, 107, 157, 0.25) !important;
  color: white !important;
  transform: translateY(-2px);
}

.form-input::placeholder {
  color: rgba(255,255,255,0.6) !important;
}

.form-label {
  color: #ff6b9d !important;
  font-weight: bold !important;
  font-size: 1.1rem !important;
  margin-bottom: 10px !important;
}

.form-textarea {
  min-height: 120px !important;
  resize: vertical !important;
}

.submit-btn {
  background: linear-gradient(135deg, #ff6b9d, #c44569) !important;
  border: none !important;
  border-radius: 20px !important;
  padding: 15px 40px !important;
  font-size: 1.3rem !important;
  font-weight: bold !important;
  color: white !important;
  transition: all 0.3s ease !important;
  box-shadow: 0 10px 30px rgba(255, 107, 157, 0.4) !important;
  text-transform: uppercase !important;
  letter-spacing: 1px !important;
}

.submit-btn:hover {
  transform: translateY(-5px) scale(1.05) !important;
  box-shadow: 0 20px 50px rgba(255, 107, 157, 0.6) !important;
  color: white !important;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  margin-bottom: 30px;
}

.form-full {
  grid-column: 1 / -1;
}

.contact-info {
  background: rgba(255,255,255,0.03);
  border-radius: 20px;
  padding: 30px;
  margin: 30px 0;
  border: 1px solid rgba(255,255,255,0.1);
}

.contact-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  color: rgba(255,255,255,0.9);
}

.contact-icon {
  font-size: 1.5rem;
  color: #ff6b9d;
  margin-right: 15px;
  width: 30px;
}

@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
}

.success-message {
  background: linear-gradient(135deg, rgba(144, 180, 148, 0.9), rgba(143, 188, 143, 0.7));
  border: 2px solid #90B494;
  border-radius: 20px;
  padding: 40px;
  text-align: center;
  color: white;
  margin: 20px 0;
  box-shadow: 0 15px 35px rgba(0,0,0,0.3);
  backdrop-filter: blur(10px);
  animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.success-icon {
  font-size: 4rem;
  margin-bottom: 20px;
  animation: bounce 1s ease-in-out;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

.hidden {
  display: none;
}
</style>

<div class="form-hero">
  <h1 class="form-title">📝 Contáctanos</h1>
  <p class="form-subtitle vt323-regular">
    ¿Tenés alguna pregunta sobre juegos retro? ¡Estamos aquí para ayudarte!
  </p>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Mensaje de éxito -->
      <div id="success-message" class="success-message hidden">
        <div class="success-icon">✅</div>
        <h3>¡Mensaje Enviado Exitosamente!</h3>
        <p>Gracias por contactarnos. Hemos recibido tu mensaje y te responderemos pronto.</p>
        <small>El equipo de RETROCODE 🎮</small>
      </div>
      
      <div id="form-container" class="form-container">
        <form id="contact-form">
          <div class="form-grid">
            <div>
              <label for="nombre" class="form-label">👤 Nombre y Apellido</label>
              <input class="form-control form-input" type="text" name="nombre" id="nombre" placeholder="Tu nombre completo" required>
            </div>
            
            <div>
              <label for="correo" class="form-label">📧 Email</label>
              <input class="form-control form-input" type="email" name="correo" id="correo" placeholder="tu@email.com" required>
            </div>
            
            <div class="form-full">
              <label for="mensaje" class="form-label">💬 Mensaje</label>
              <textarea required class="form-control form-input form-textarea" name="mensaje" id="mensaje" placeholder="Contános sobre tu consulta, sugerencia o simplemente saluda..."></textarea>
            </div>
          </div>
          
          <div class="text-center">
            <button type="submit" class="btn submit-btn" id="submit-btn">
              🚀 Enviar Mensaje
            </button>
          </div>
        </form>
      </div>
      
      <div class="contact-info">
        <h4 class="text-center mb-4" style="color: #ff6b9d;">🎮 ¿Por qué contactarnos?</h4>
        <div class="contact-item">
          <span class="contact-icon"></span>
          <span>Recomendaciones de juegos clásicos personalizadas</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon"></span>
          <span>Ayuda para encontrar juegos retro difíciles de conseguir</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon"></span>
          <span>Charlas sobre nostalgia gamer y recuerdos</span>
        </div>
        <div class="contact-item">
          <span class="contact-icon"></span>
          <span>Sugerencias para mejorar RETROCODE</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Obtener los datos del formulario
    const formData = new FormData(this);
    const nombre = formData.get('nombre');
    const correo = formData.get('correo');
    const mensaje = formData.get('mensaje');
    
    // Cambiar el botón a estado de carga
    const submitBtn = document.getElementById('submit-btn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '⏳ Enviando...';
    submitBtn.disabled = true;
    
    // Simular envío (puedes reemplazar esto con una llamada AJAX real)
    setTimeout(() => {
        // Ocultar el formulario
        document.getElementById('form-container').style.display = 'none';
        
        // Mostrar mensaje de éxito
        document.getElementById('success-message').classList.remove('hidden');
        
        // Limpiar el formulario
        document.getElementById('contact-form').reset();
        
        // Restaurar el botón después de 3 segundos y mostrar el formulario de nuevo
        setTimeout(() => {
            document.getElementById('success-message').classList.add('hidden');
            document.getElementById('form-container').style.display = 'block';
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 4000);
        
    }, 1500); // Simula 1.5 segundos de procesamiento
});
</script>
