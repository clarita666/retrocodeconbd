<?php
session_start();
require_once 'functions/autoload.php';

echo "<h2>Test de Login</h2>";

// Probar autenticación
$auth = new Autenticacion();

echo "<h3>Credenciales correctas:</h3>";
echo "Email: admin@retrocode.com<br>";
echo "Password: admin123<br><br>";

// Test con credenciales correctas
$result = $auth->login('admin@retrocode.com', 'admin123');
echo "Resultado del login: " . ($result ? 'ÉXITO' : 'FALLO') . "<br>";

echo "<h3>Estado de la sesión:</h3>";
echo "loggedIn: " . (isset($_SESSION['loggedIn']) ? ($_SESSION['loggedIn'] ? 'true' : 'false') : 'no definido') . "<br>";
echo "user_email: " . ($_SESSION['user_email'] ?? 'no definido') . "<br>";
echo "user_name: " . ($_SESSION['user_name'] ?? 'no definido') . "<br>";

echo "<h3>Verificación isLoggedIn():</h3>";
echo "isLoggedIn(): " . ($auth->isLoggedIn() ? 'true' : 'false') . "<br>";

echo "<br><a href='admin/'>Ir al admin</a>";
?>