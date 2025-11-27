CREATE DATABASE IF NOT EXISTS `juegos_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `juegos_db`;

-- Tabla de categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `nombre_usuario` VARCHAR(100) NOT NULL UNIQUE,
  `nombre_completo` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de juegos (se usan los id definidos originalmente en productos.php)
CREATE TABLE IF NOT EXISTS `juegos` (
  `id` INT PRIMARY KEY,
  `nombre` VARCHAR(255) NOT NULL,
  `id_categoria` INT NOT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  `publicacion` VARCHAR(100) DEFAULT NULL,
  `empresa` VARCHAR(255) DEFAULT NULL,
  `jugabilidad` VARCHAR(100) DEFAULT NULL,
  `multijugador` VARCHAR(100) DEFAULT NULL,
  `plataforma1` VARCHAR(100) DEFAULT NULL,
  `plataforma2` VARCHAR(100) DEFAULT NULL,
  `plataforma3` VARCHAR(100) DEFAULT NULL,
  `plataforma4` VARCHAR(100) DEFAULT NULL,
  `bajada` TEXT,
  `portada` VARCHAR(255) DEFAULT NULL,
  `precio` VARCHAR(100) DEFAULT NULL,
  CONSTRAINT `fk_juegos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias`(`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `juego_id` INT NOT NULL,
  `usuario_id` INT DEFAULT NULL,
  `contenido` TEXT NOT NULL,
  `creado_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  CONSTRAINT `fk_comentarios_juego` FOREIGN KEY (`juego_id`) REFERENCES `juegos`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_comentarios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Índices recomendados
CREATE INDEX IF NOT EXISTS idx_juegos_nombre ON `juegos` (`nombre`);
CREATE INDEX IF NOT EXISTS idx_usuarios_email ON `usuarios` (`email`);

-- ========================================
-- DATOS INICIALES
-- ========================================

-- Categorías
INSERT INTO `categorias` (`id`,`nombre`) VALUES
(1,'terror'),
(2,'arcade'),
(3,'aventura')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre);

-- Juegos (se respetan los ids originales del catálogo)
INSERT INTO `juegos` (`id`,`nombre`,`id_categoria`,`link`,`publicacion`,`empresa`,`jugabilidad`,`multijugador`,`plataforma1`,`plataforma2`,`plataforma3`,`plataforma4`,`bajada`,`portada`,`precio`) VALUES
(1,'Resident Evil',1,'7m80hA5bRk0','22 de marzo de 1996','PlayStation','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','El primer Resident Evil es considerado uno de los títulos más influyentes del género survival horror. Fue un parteaguas para los juegos de terror de supervivencia y es conocido por sus innovaciones en mecánicas de juego y narración.  El juego sigue a un grupo de élite de policía, S.T.A.R.S. (Special Tactics and Rescue Service), quienes investigan extraños sucesos en la mansión Arklay, cerca de Raccoon City. Después de un aterrizaje forzoso, los miembros del equipo, incluyendo a los protagonistas Chris Redfield y Jill Valentine, descubren que la mansión está llena de monstruos, zombis y otros horrores, resultado de experimentos secretos realizados por Umbrella Corporation con el T-Virus.','resident-evil1.jpg','pago.png'),
(2,'Silent Hill',1,'zX20XMcX-zk','31 de enero de 1999','Playstation','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Silent Hill es uno de los pilares del horror psicológico en los videojuegos. A diferencia de Resident Evil, que se centraba más en el terror de supervivencia y criaturas físicas, Silent Hill introdujo un enfoque más psicológico y surrealista, con un ambiente mucho más inquietante y perturbador. La historia sigue a Harry Mason, quien busca a su hija adoptiva Cheryl después de que ella desaparece en el pueblo de Silent Hill. Al llegar, Harry descubre que el pueblo está envuelto en una niebla espesa y está plagado de monstruos extraños, símbolos esotéricos y una atmósfera opresiva.','silent-hill2.jpg','pago.png'),
(3,'Alone in the Dark',1,'2zWK0o5WDLc','1992','Atari','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Alone in the Dark es uno de los primeros juegos de survival horror, precediendo a títulos como Resident Evil y Silent Hill. Su enfoque en el terror psicológico, la exploración y la resolución de acertijos lo convierte en una pieza clave dentro de la historia de los videojuegos de terror. La trama se desarrolla en Derceto Mansion, una mansión en Nueva Inglaterra, y sigue a Edward Carnby, un investigador privado, y a Emily Hartwood, la sobrina de un anciano que se suicida en circunstancias misteriosas. Ambos personajes son atraídos a la mansión, que está plagada de monstruos, horrores sobrenaturales y secretos oscuros.','alone-dark3.jpg','pago.png'),
(4,'Clock Tower',1,'XxfOL0RIx1o','1995','Human Entertainment','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Jennifer Simpson, una huérfana recién adoptada, llega a una mansión misteriosa donde sus compañeras desaparecen. Deberá explorar el lugar, resolver acertijos y escapar del aterrador asesino conocido como \"Scissorman\", todo sin armas y con un estilo de juego basado en la tensión, el sigilo y la toma de decisiones.','clock-tower4.png','gratis.jpg'),
(5,'Sweet Home',1,'qO5xXRHMwEA','1989','Capcom','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Un equipo de documentalistas entra en una mansión abandonada para investigar pinturas, pero quedan atrapados con fuerzas sobrenaturales. Controlás a cinco personajes únicos, cada uno con habilidades especiales. El juego mezcla exploración, gestión de recursos, combates por turnos, resolución de acertijos y una historia oscura, que luego inspiraría directamente a Resident Evil.','sweet-home5.jpg','gratis.jpg'),
(6,'Pacman',2,'Ej87dG_urFo','22 de mayo de 1980','Bandai Namcon','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','¿Quién no conoce a esta bolita amarilla devoradora de píxeles? Pac-Man es el clásico de clásicos, nacido en los años 80 y todavía vigente hoy. La premisa es simple, pero adictiva: recorrer un laberinto comiendo puntos mientras escapás de cuatro fantasmas con personalidades propias. Pero cuando agarrás una de esas \"power pellets\", el cazador se convierte en presa... ¡y es tu turno de comértelos! No necesitás gráficos 3D ni una historia compleja para disfrutarlo. Solo vos, tu velocidad mental y tu pulgar bien entrenado.','pacman1.webp','gratis.png'),
(7,'Final Fight',2,'obf82hsc4O8','1989','Capcom','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Final Fight es puro músculo pixelado, una joya de los fichines de los 90 donde la violencia callejera se resuelve a piña limpia. Elegís entre tres personajes: el exluchador y alcalde Haggar, el ágil Cody o el veloz Guy. Juntos se enfrentan a la banda Mad Gear, que tiene secuestrada a la hija del alcalde (sí, ¡como en las pelis viejas!). Golpes, combos, enemigos por todos lados y esa música noventera que te activa el pulso. Si creciste con un joystick en la mano, seguramente más de una vez perdiste monedas en esta máquina. Y si no lo jugaste, hoy sigue siendo una experiencia brutal y divertidísima, sobre todo en modo cooperativo.','finalfight3.webp','pago.png'),
(8,'Tron',2,'XEp8G2HtDJM','julio de 1982','Bally Midway','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Antes de que los mundos virtuales fueran una moda, Tron ya los había imaginado en los 80. Este juego de arcade fue lanzado junto a la icónica película de Disney y es una verdadera cápsula del tiempo digital. Lo más loco es que Tron no es un solo juego, ¡son cuatro minijuegos en uno! Vas desde pilotar la famosa Light Cycle (esas motos que dejan una estela letal), hasta disparar contra enemigos digitales o infiltrarte en el núcleo del sistema. Con gráficos vectoriales, sonidos electrónicos y una estética neón inolvidable, Tron fue uno de los primeros juegos en hacerte sentir dentro de una computadora. Es desafiante, raro, adictivo y puro 1982. Si amás el arte retro digital, este es un clásico que tenés que probar al menos una vez.','tron 5.jpg','pago.png'),
(9,'Space Invaders',2,'MU4psw3ccUI','Junio de 1978','Taito','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Si alguna vez quisiste sentirte como el defensor de la Tierra ante una invasión alienígena, Space Invaders es tu billete al pasado. Este clásico de 1978 es uno de los videojuegos que sentaron las bases de todo el género shooter. La idea es simple: disparás contra filas de extraterrestres que van bajando lentamente mientras esquivás sus ataques. Cada vez que eliminas una fila, el juego se pone más rápido y más difícil, haciendo que tus reflejos sean tu mejor arma. Con su icónica música y efectos de sonido, Space Invaders no solo fue un fenómeno en los salones arcade, sino que también cambió la cultura pop para siempre. Más de 40 años después, sigue siendo divertido y desafiante, un verdadero viaje retro que no pasa de moda.','spaceivanders4.webp','gratis.png'),
(10,'Tetris',2,'-FAzHyXZPm0&t','6 de junio de 1984','The Tretis Company','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Tetris es uno de esos juegos que parece simple, pero es una auténtica obra maestra del diseño. Nacido en la Unión Soviética a finales de los 80, el juego te pone a encajar bloques de distintas formas llamadas "tetriminos" para completar líneas horizontales y que desaparezcan. El ritmo va aumentando y el desafío crece hasta que inevitablemente te quedás sin espacio. ¿Por qué es tan adictivo? Porque desafía tu mente, coordinación y paciencia al mismo tiempo. Es perfecto para una partida rápida o para engancharte horas seguidas intentando superar tu récord. Y lo mejor: Tetris nunca pasa de moda, siempre hay una versión nueva o clásica para jugar, solo o con amigos.','tetris2.webp','gratis.png'),
(11,'Minecraft',3,'0vKS0FOYNok','17 de mayo de 2009','Mojang Studios','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Pocos juegos marcaron una generación como lo hizo Minecraft. Es el universo donde la única regla es tu imaginación: podés construir ciudades, explorar cuevas infinitas, domar animales, combatir dragones o simplemente relajarte y ver el atardecer desde tu cabaña de madera. Todo empieza con tus manos vacías y un mundo hecho de bloques. A partir de ahí, recolectás recursos, construís herramientas, enfrentás criaturas nocturnas o te dedicás al arte puro con el modo creativo. Lo mejor es que no hay un solo "modo correcto" de jugarlo. Ya sea que lo disfrutes solo, en servidores con amigos o con mods que cambian todo el juego, Minecraft es ese lugar digital que nunca se termina.','minecraft1.png','pago.png'),
(12,'Terraria',3,'w7uOhFTrrq0','16 de mayo de 2011','Re-Logic','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Si Minecraft es un mundo abierto en 3D donde todo es construcción, Terraria es su contraparte 2D llena de acción, magia, jefes y aventuras épicas. Al principio estás solo, con un pico y un hacha, pero en poco tiempo te ves enfrentando monstruos enormes, creando espadas mágicas, explorando el infierno y hasta el espacio. Lo que engancha de Terraria es su mezcla de exploración con un sistema de progresión super profundo: más de 5.000 objetos, decenas de biomas, NPCs que se mudan a tu base, jefes únicos, eventos especiales y hasta modo experto. ¿Querés relajarte construyendo? ¿Prefierís pelear contra jefes gigantes? ¿O bucear en cavernas con trampas y tesoros? Terraria te da todo eso y más, con gráficos pixelados que le dan un encanto retro hermoso.','terraria5.webp','pago.png'),
(13,'The Last of Us',3,'gM1C42wzGAM','14 de junio de 2013','Naughty Dog','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Hay juegos que se juegan... y hay otros que se sienten. The Last of Us es de esos. Ambientado en un mundo post-apocalíptico donde una infección convirtió a la humanidad en criaturas salvajes, la historia se centra en Joel, un tipo endurecido por la vida, y Ellie, una chica inmune al virus. Pero esto no es solo un juego de zombis: es una experiencia emocional, cruda, y con una narrativa que te rompe el alma. Vas a explorar ciudades en ruinas, enfrentarte a enemigos humanos y monstruosos, craftear armas, y sobre todo, vas a encariñarte. Porque sí: lo que de verdad importa acá es la relación entre los personajes. Tiene momentos de acción intensa, sigilo tenso, y pausas que te dejan pensando. Con gráficos que para su época eran revolucionarios, una banda sonora inolvidable y una historia que marcó a millones, The Last of Us no es solo un videojuego... es una historia que deja huella.','thelastofus4.webp','pago.png'),
(14,'The Elder Scrolls V: Skyrim',3,'QWoF8S_F3Bo','11 de noviembre de 2011','Bethesda Game Studios','Un jugador','1player.jpg','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Skyrim es el juego que todos los fanáticos del rol alguna vez soñaron: un mundo gigantesco, lleno de montañas, dragones, magia, ruinas antiguas, ciudades vivas y decisiones que cambian todo. Sos el Dovahkiin, el \"Sangre de Dragón\", y tu destino es enfrentarte al dragón Alduin, devorador del mundo. Pero la verdad es que podés olvidarte de la misión principal durante horas... y simplemente pescar, unirte a la Hermandad Oscura, convertirte en mago, ladrón, vampiro, casar a tu personaje, adoptar niños, hacer pociones o incluso cazar mariposas. El juego tiene esa magia de hacerte sentir parte de un universo vivo, donde cada rincón guarda secretos y cada elección tiene peso. Con mods, encima, se vuelve infinito. Skyrim no es solo un juego: es una segunda vida, pixelada, pero épica.','skyrim2.webp','pago.png'),
(15,'Tomb Raider',3,'I5IlY3HrMz8','5 de marzo de 2013','Crystal Dynamics','Multijugador','2players.webp','fa-brands fa-playstation','fa-solid fa-desktop','fa-brands fa-xbox','fa-brands fa-android','Acá no hay la clásica Lara Croft con lentes de sol y duales automáticas. En Tomb Raider (2013) vemos el origen crudo y humano de la heroína, cuando aún no era la cazadora de tumbas que todos conocíamos. Después de un naufragio, Lara queda atrapada en una isla misteriosa llena de ruinas, secretos oscuros y enemigos peligrosos. Lo increíble de este juego es cómo mezcla el drama, el survival y la acción a la perfección. Vas a explorar tumbas antiguas, resolver acertijos, escalar acantilados, craftear equipo y pelear por tu vida en una historia intensa y cinematográfica. Si te gustan los juegos con narrativa fuerte, paisajes épicos y mecánicas bien pulidas, este reboot de Tomb Raider te engancha desde el primer grito de Lara hasta el último disparo.','tombraider3.webp','pago.png')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), id_categoria=VALUES(id_categoria);