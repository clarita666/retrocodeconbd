<style>
.parent {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: repeat(5, 1fr);
  grid-column-gap: 15px;
  grid-row-gap: 15px;
  height: 80vh;
  margin: 20px 0;
}

.grid-item {
  background: rgba(255,255,255,0.05);
  border-radius: 20px;
  padding: 25px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.grid-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.div1 { 
  grid-area: 1 / 1 / 2 / 3;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.9), rgba(0, 0, 0, 0.8));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.div2 { 
  grid-area: 2 / 1 / 4 / 2;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.div3 { 
  grid-area: 2 / 2 / 4 / 3;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.div4 { 
  grid-area: 1 / 3 / 3 / 6;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.div5 { 
  grid-area: 4 / 1 / 6 / 3;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.div6 { 
  grid-area: 3 / 3 / 6 / 6;
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border: 2px solid rgba(132, 64, 172, 0.5);
}

.grid-title {
  font-size: 2rem;
  font-weight: bold;
  background: linear-gradient(45deg, #fff, #ff6b9d, #c44569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 10px;
}

.grid-subtitle {
  font-size: 1rem;
  color: rgba(255,255,255,0.8);
  margin-bottom: 15px;
}

.grid-text {
  color: rgba(255,255,255,0.9);
  font-size: 0.9rem;
  line-height: 1.4;
}

.grid-icon {
  font-size: 3rem;
  margin-bottom: 15px;
}

.grid-button {
  background: linear-gradient(135deg, #ff6b9d, #c44569);
  border: none;
  border-radius: 15px;
  padding: 12px 25px;
  font-weight: bold;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
  margin-top: 15px;
}

.grid-button:hover {
  transform: scale(1.05);
  color: white;
}

.sorteo-button {
  background: linear-gradient(135deg, #ffd700, #ffa500);
  border: none;
  border-radius: 15px;
  padding: 15px 30px;
  font-weight: bold;
  color: #000;
  text-decoration: none;
  transition: all 0.3s ease;
  margin-top: 15px;
}

.sorteo-button:hover {
  transform: scale(1.05);
  color: #000;
}

@keyframes rotate {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.div1::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  animation: rotate 20s linear infinite;
}

.div6::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
  animation: rotate 15s linear infinite;
}

.grid-content {
  position: relative;
  z-index: 2;
}

.sorteo-section {
  background: linear-gradient(135deg, rgba(132, 64, 172, 0.3), rgba(132, 64, 172, 0.5));
  border-radius: 25px;
  padding: 40px;
  margin: 40px 0;
  text-align: center;
  border: 2px solid rgba(132, 64, 172, 0.5);
  backdrop-filter: blur(10px);
  position: relative;
  overflow: hidden;
}

.sorteo-section::before {
  content: '';
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(132, 64, 172, 0.1) 0%, transparent 70%);
  animation: rotate 15s linear infinite;
}

.sorteo-content {
  position: relative;
  z-index: 2;
}

.sorteo-title-big {
  font-size: 2.5rem;
  font-weight: bold;
  background: linear-gradient(45deg, #fff, #ff6b9d, #c44569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 20px;
}

.sorteo-button-big {
  background: linear-gradient(135deg, #ff6b9d, #c44569);
  border: none;
  border-radius: 20px;
  padding: 20px 40px;
  font-size: 1.3rem;
  font-weight: bold;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
  margin-top: 20px;
  display: inline-block;
}

.sorteo-button-big:hover {
  transform: translateY(-3px) scale(1.05);
  color: white;
}
</style>

<div class="parent">
  <div class="div1 grid-item">
    <div class="grid-content">
      <h1 class="grid-title">🎮 RETROCODE</h1>
      <p class="grid-subtitle vt323-regular">Tu comunidad definitiva para videojuegos clásicos</p>
    </div>
  </div>
  
  <div class="div2 grid-item">
    <div class="grid-content">
      <div class="grid-icon">🎯</div>
      <h3 class="text-light mb-2">Entretener</h3>
      <p class="grid-text">Contenido divertido y nostálgico que te hace revivir momentos épicos</p>
    </div>
  </div>
  
  <div class="div3 grid-item">
    <div class="grid-content">
      <div class="grid-icon">🤝</div>
      <h3 class="text-light mb-2">Conectar</h3>
      <p class="grid-text">Comunidad donde los amantes de retro games comparten su pasión</p>
    </div>
  </div>
  
  <div class="div4 grid-item">
    <div class="grid-content">
      <div class="grid-icon">🕹️</div>
      <h2 class="text-light mb-3">¿Quiénes Somos?</h2>
      <p class="grid-text">Somos un grupo de apasionados gamers que creemos que los videojuegos clásicos nunca pasan de moda. En RETROCODE, celebramos la rica historia de los videojuegos, desde los primeros arcades hasta las consolas que marcaron generaciones. Nuestra misión es informar, entretener y conectar a la comunidad retro gamer.</p>
    </div>
  </div>
  
  <div class="div5 grid-item">
    <div class="grid-content">
      <div class="grid-icon">📚</div>
      <h3 class="text-light mb-2">Informar</h3>
      <p class="grid-text">Las mejores reseñas, análisis y curiosidades sobre juegos que marcaron la historia</p>
    </div>
  </div>
  
  <div class="div6 grid-item">
    <div class="grid-content">
      <div class="grid-icon">📝</div>
      <h2 class="text-light mb-3">Formulario</h2>
      <p class="grid-text mb-3">¿Listo para sumergirte en el mundo de los videojuegos clásicos? Contáctanos y sé parte de la comunidad.</p>
      <a href="index.php?sec=formularios" class="grid-button">🚀 CONECTAR</a>
    </div>
  </div>
</div>

<div class="sorteo-section">
  <div class="sorteo-content">
    <h2 class="sorteo-title-big">🎉 ¡SORTEO ÉPICO! 🎉</h2>
    <p class="text-light fs-5 mb-4 vt323-regular">
      ¡Atención Gamers! La espera terminó. Ha llegado el momento de poner a prueba tu suerte 
      y llevarte a casa premios increíbles de nuestro blog RETROCODE.
    </p>
    
    <div class="row align-items-center">
      <div class="col-md-6">
        <p class="text-light fs-6 mb-4">
          🎮 Participa en nuestro sorteo épico<br>
          🏆 Gana premios exclusivos de gaming<br>
          ⚡ ¡Solo tienes que hacer clic y participar!
        </p>
        <a href="index.php?sec=formularios" class="sorteo-button-big">
          🚀 PARTICIPAR AHORA
        </a>
      </div>
      <div class="col-md-6">
        <img class="d-block mx-auto" src="img/sorteo-png.png" alt="Sorteo RETROCODE" style="max-width: 250px; border-radius: 15px;">
      </div>
    </div>
    
    <p class="text-light fs-6 mt-4 opacity-75">
      ¡No pierdas esta oportunidad única! El sorteo es completamente gratuito.
    </p>
  </div>
</div>
