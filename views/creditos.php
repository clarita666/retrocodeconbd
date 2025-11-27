<style>
.creditos-hero {
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('img/banner03.jpg');
    background-size: cover;
    background-position: center;
    padding: 4rem 0;
    margin-bottom: 3rem;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.creditos-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.creditos-hero h1, .creditos-hero h2 {
    position: relative;
    z-index: 2;
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
}

.creditos-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.creditos-hero h2 {
    font-size: 1.5rem;
    font-weight: 500;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.member-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    text-align: center;
}

.member-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.member-card h3 {
    color: #6c5ce7;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.member-card .role {
    color: #636e72;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.member-card .email {
    color: #6c5ce7;
    text-decoration: none;
    font-weight: 500;
}

.member-card .email:hover {
    color: #5f3dc4;
    text-decoration: underline;
}

.tech-section {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    padding: 3rem;
    margin-bottom: 3rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.tech-section h3 {
    color: #2d3436;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
}

.tech-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.tech-category {
    background: rgba(108, 92, 231, 0.1);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(108, 92, 231, 0.2);
}

.tech-category h4 {
    color: #6c5ce7;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.tech-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tech-list li {
    color: #2d3436;
    padding: 0.3rem 0;
    font-weight: 500;
    border-bottom: 1px solid rgba(108, 92, 231, 0.1);
}

.tech-list li:last-child {
    border-bottom: none;
}

.conclusion-section {
    background: linear-gradient(135deg, rgba(108, 92, 231, 0.9), rgba(162, 155, 254, 0.9));
    border-radius: 20px;
    padding: 3rem;
    color: white;
    backdrop-filter: blur(10px);
}

.conclusion-section h3 {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.conclusion-section p {
    font-size: 1.1rem;
    line-height: 1.8;
    text-align: justify;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
    .creditos-hero h1 {
        font-size: 2rem;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
    }
    
    .tech-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="creditos-hero">
    <div class="container text-center">
        <h1>Créditos del Proyecto</h1>
        <h2>Catálogo de Juegos - <span style="color: #ffeaa7;">"Noobs con Código"</span></h2>
    </div>
</div>

<div class="container">
    <div class="team-grid">
        <div class="member-card">
            <h3>Clara Iriarte</h3>
            <div class="role">Desarrolladora Frontend</div>
            <a href="mailto:clarairiarte555@gmail.com" class="email">clarairiarte555@gmail.com</a>
        </div>
        
        <div class="member-card">
            <h3>Lara</h3>
            <div class="role">Desarrolladora Backend</div>
            <div class="email">Colaboradora del proyecto</div>
        </div>
        
        <div class="member-card">
            <h3>Miguel Escobar</h3>
            <div class="role">Desarrollador Full Stack</div>
            <div class="email">Colaborador del proyecto</div>
        </div>
        
        <div class="member-card">
            <h3>Profesor Damián</h3>
            <div class="role">Mentor y Guía</div>
            <div class="email">Instructor del curso</div>
        </div>
    </div>
    
    <div class="tech-section">
        <h3>Tecnologías Utilizadas</h3>
        <div class="tech-grid">
            <div class="tech-category">
                <h4>Backend</h4>
                <ul class="tech-list">
                    <li>PHP 8.x</li>
                    <li>MySQL</li>
                    <li>PDO</li>
                    <li>MVC Architecture</li>
                    <li>REST API</li>
                </ul>
            </div>
            
            <div class="tech-category">
                <h4>Frontend</h4>
                <ul class="tech-list">
                    <li>HTML5</li>
                    <li>CSS3</li>
                    <li>JavaScript ES6+</li>
                    <li>Bootstrap 5</li>
                    <li>AJAX/Fetch API</li>
                </ul>
            </div>
            
            <div class="tech-category">
                <h4>Diseño</h4>
                <ul class="tech-list">
                    <li>CSS Grid</li>
                    <li>Flexbox</li>
                    <li>Glassmorphism</li>
                    <li>Responsive Design</li>
                    <li>Hover Effects</li>
                </ul>
            </div>
            
            <div class="tech-category">
                <h4>Herramientas</h4>
                <ul class="tech-list">
                    <li>XAMPP</li>
                    <li>Git</li>
                    <li>VS Code</li>
                    <li>Netlify</li>
                    <li>Environment Variables</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="conclusion-section">
        <h3>Reflexión Final</h3>
        <p>
            Este proyecto representa la culminación de nuestro aprendizaje en desarrollo web. Comenzamos con conceptos básicos de PHP y HTML, y evolucionamos hacia la implementación de una arquitectura MVC completa con base de datos MySQL, APIs REST y efectos visuales modernos.
        </p>
        <p>
            El catálogo de juegos no solo demuestra nuestras habilidades técnicas, sino también nuestra capacidad para trabajar en equipo, resolver problemas complejos y crear una experiencia de usuario atractiva. Cada línea de código refleja horas de dedicación y aprendizaje continuo.
        </p>
        <p>
            Agradecemos especialmente a nuestro profesor Damián por su guía constante, y a todos los miembros del equipo por su compromiso y creatividad. Este proyecto marca el inicio de nuestro camino como desarrolladores web profesionales.
        </p>
    </div>
</div>
