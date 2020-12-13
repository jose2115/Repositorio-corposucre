-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-12-2020 a las 05:11:08
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `corposucre`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `asignar_rol_usuario` (IN `id_rol` INT(20), IN `ruta_model` VARCHAR(20), IN `id_user` INT(20))  NO SQL
INSERT INTO model_has_roles

(role_id, model_type, model_id) 

VALUES (id_rol, ruta_model, id_user)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_recurso` (IN `recurso` VARCHAR(30), IN `descripcion` VARCHAR(30), IN `facultad` VARCHAR(30), IN `programa` VARCHAR(30), IN `tipo` VARCHAR(30))  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id

and (r.tema like CONCAT('%',recurso, '%') 
OR r.descripcion LIKE CONCAT('%', descripcion, '%')
OR f.facutad LIKE CONCAT('%', facultad, '%')
OR p.nombre LIKE CONCAT('%', programa, '%')
OR a.tipo LIKE CONCAT('%', tipo, '%'))

and r.id = v.id_recurso

GROUP by v.id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `consulta_programa_usuario` (IN `usuario` INT(30))  NO SQL
SELECT u.id_programa FROM users as u

join programas as p on u.id_programa = p.id

WHERE u.id = usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_like` (IN `id` INT(20), IN `recurso` INT(20))  NO SQL
DELETE from gustos WHERE  id_user = id and id_recurso = recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_like_recurso` (IN `recurso` INT(12))  NO SQL
DELETE FROM gustos WHERE gustos.id_recurso = recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_rol_usuario` (IN `id_model` INT(12))  NO SQL
DELETE FROM model_has_roles  WHERE model_id = id_model$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_vistas_recurso` (IN `recurso` INT(12))  NO SQL
DELETE FROM vistos WHERE vistos.id_recurso= recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `evaluar_rol` (IN `model` INT(12))  NO SQL
SELECT role_id FROM model_has_roles WHERE model_id =  model$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `existe_like` (IN `id_user` INT(20), IN `id_recurso` INT(20))  NO SQL
SELECT id FROM gustos as g WHERE g.id_user = id_user and g.id_recurso = id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `historia` ()  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v,
users as u

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id AND v.id_user=u.id
AND u.id=59

and r.id = v.id_recurso

GROUP by v.id_recurso ORDER BY r.id DESC LIMIT 8$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `id_recurso` (IN `id` INT(30))  NO SQL
SELECT r.id, r.tema, r.descripcion, r.institucion, r.año, r.url, r.autores, r.archivo, a.tipo , r.id_programa FROM recursos as r, 
programas as p,
facultades as f,
archivos as a


WHERE r.id_tipo_archivo=a.id

and r.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_personas` (IN `primer_n` VARCHAR(30), IN `segundo_n` VARCHAR(30), IN `primer_a` VARCHAR(30), IN `segundo_a` VARCHAR(30))  NO SQL
INSERT INTO personas  (primer_nombre,segundo_nombre,primer_apellido,segundo_apellido) VALUES (primer_n,segundo_n,primer_a,segundo_a)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuarios` (IN `name` VARCHAR(30), IN `correo` VARCHAR(30), IN `password` VARCHAR(255), IN `id_persona` INT(10), IN `id_programa` INT(10), IN `semestre` INT(10), IN `foto` VARCHAR(191), IN `fecha_actual` TIMESTAMP)  NO SQL
INSERT INTO users

(name,email,email_verified_at,password,id_persona,id_programa,semestre,foto, created_at) VALUES (name, correo, fecha_actual, password, id_persona, id_programa, semestre, foto, fecha_actual)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `like_de_recurso` (IN `id_recurso` INT(12))  NO SQL
SELECT COUNT(g.id_recurso) as gusto FROM gustos as g WHERE g.id_recurso=id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `max_id_personas` ()  SELECT max(id) as id from personas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `numero_like` ()  NO SQL
SELECT DISTINCT r.id, r.tema, r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(g.id_recurso) as likes FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
gustos as g

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id and r.id=g.id_recurso 

GROUP by  g.id_recurso

ORDER by likes DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `prueba_recomendacion` (IN `programa` INT(12), IN `usuario` INT(20))  NO SQL
SELECT r.tema, r.descripcion, r.foto, g.id_recurso, COUNT(g.id_recurso) as likes from gustos as g 

join users as u on g.id_user = u.id
join recursos as r on g.id_recurso = r.id

WHERE r.id_programa = programa
and u.id not in(usuario)

GROUP BY g.id_recurso

ORDER by likes DESC LIMIT 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recomendacion_recurso` (IN `programa` INT(30), IN `usuario` INT(20), IN `recurso` INT(20))  NO SQL
SELECT r.id, r.tema, r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
gustos as g,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id and r.id=g.id_recurso and r.id = v.id_recurso 
and r.id_programa=programa  
and g.id_user not in (usuario)
and r.id not in (recurso)
GROUP by  v.id_recurso
ORDER by vistas DESC LIMIT 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recomendacion_recurso2` (IN `programa` INT(20), IN `usuario` INT(20))  NO SQL
SELECT  r.id, r.tema, r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(g.id_recurso) as likes FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
gustos as g,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id and r.id=g.id_recurso
and r.id_programa=programa  
and g.id_user not in (usuario)

GROUP by  g.id_recurso

ORDER by likes DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recursos` ()  NO SQL
SELECT r.id, r.tema, f.facutad, p.nombre, a.tipo, r.autores FROM recursos as r, 
programas as p,
facultades as f,
archivos as a

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recursos_estudiantes` (IN `programa` INT(30))  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id and r.id_programa = programa

and r.id = v.id_recurso

GROUP by v.id_recurso ORDER BY r.id DESC LIMIT 8$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recursos_populares` ()  NO SQL
SELECT r.id, r.tema, r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id 

and r.id = v.id_recurso

GROUP by v.id_recurso

ORDER by vistas DESC LIMIT 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recurso_comunicacion` ()  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id

and r.id = v.id_recurso and p.id = 3

GROUP by v.id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recurso_contador` ()  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id

and r.id = v.id_recurso and p.id = 2

GROUP by v.id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recurso_historial` (IN `usuario` INT(30))  SELECT DISTINCT r.id, r.tema, r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id 

and r.id = v.id_recurso and v.id_user=usuario

GROUP by v.id_recurso

ORDER by r.id DESC LIMIT 4$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recurso_ingenieria` ()  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id

and r.id = v.id_recurso and p.id = 1

GROUP by v.id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recurso_psicologia` ()  NO SQL
SELECT DISTINCT r.id, r.tema,r.descripcion, f.facutad, p.nombre, a.tipo, r.autores, r.foto, COUNT(v.id_recurso) as vistas FROM recursos as r, 
programas as p,
facultades as f,
archivos as a,
vistos as v

WHERE r.id_programa=p.id AND p.id_facultad=f.id and r.id_tipo_archivo=a.id

and r.id = v.id_recurso and p.id = 4

GROUP by v.id_recurso$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_estudiante` (IN `primer_n` VARCHAR(30), IN `segundo_n` VARCHAR(30), IN `primer_a` VARCHAR(30), IN `segundo_a` VARCHAR(30), IN `name` VARCHAR(20), IN `correo` VARCHAR(40), IN `contraseña` VARCHAR(191), IN `programa` INT(20), IN `semestre` INT(20), IN `foto` VARCHAR(191), IN `id` INT(50))  NO SQL
UPDATE 
users as u, facultades as f, programas as p, personas as pe

SET pe.primer_nombre = primer_n, pe.segundo_nombre = segundo_n,
	pe.primer_apellido = primer_a, pe.segundo_apellido = segundo_a, 
    u.name = name, u.email = correo, u.password = contraseña, 
    u.id_programa = programa, u.semestre = semestre, u.foto = foto

    
WHERE u.id_persona=pe.id and u.id_programa=p.id and

p.id_facultad=f.id

and u.id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_usuario` (IN `id` INT(12), IN `primer_n` VARCHAR(20), IN `segundo_n` VARCHAR(20), IN `primer_a` VARCHAR(20), IN `segundo_a` VARCHAR(20), IN `name` VARCHAR(20), IN `correo` VARCHAR(60), IN `contraseña` VARCHAR(255), IN `programa` INT(20), IN `semestre` INT(20), IN `foto` VARCHAR(191), IN `rol` INT(20))  NO SQL
UPDATE 
users as u, facultades as f, programas as p, personas as pe, model_has_roles as mhr

SET pe.primer_nombre = primer_n, pe.segundo_nombre = segundo_n,
	pe.primer_apellido = primer_a, pe.segundo_apellido = segundo_a, 
    u.name = name, u.email = correo, u.password = contraseña, 
    u.id_programa = programa, u.semestre = semestre, u.foto = foto,
    
    mhr.role_id = rol
    
WHERE u.id_persona=pe.id and u.id_programa=p.id and

p.id_facultad=f.id and 

u.id = mhr.model_id

and u.id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios` ()  NO SQL
SELECT u.id, pe.primer_nombre, pe.primer_apellido, f.facutad, p.nombre, u.semestre, u.email from users as u, facultades as f, programas as p, personas as pe 

WHERE u.id_persona=pe.id and
u.id_programa=p.id and

p.id_facultad=f.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios_id` (IN `id` INT(12))  NO SQL
SELECT 
u.id, pe.primer_nombre, pe.segundo_nombre, pe.primer_apellido, pe.segundo_apellido, f.id as id_facultad, f.facutad, p.id as programa, u.semestre, mhr.role_id, u.email, u.password, u.foto

from users as u, facultades as f, programas as p, personas as pe, model_has_roles as mhr

WHERE u.id_persona=pe.id and u.id_programa=p.id and

p.id_facultad=f.id and 

u.id = mhr.model_id

and u.id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios_parametro` (IN `id_user` INT(12))  SELECT u.id, pe.primer_nombre, f.facutad, p.nombre, u.semestre, u.email from users as u, facultades as f, programas as p, personas as pe 

WHERE u.id_persona=pe.id and
u.id_programa=p.id and

p.id_facultad=f.id
 
and u.id=id_user$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `vistas_recurso` (IN `id_recurso` INT(30))  NO SQL
SELECT  COUNT(v.id_recurso) as vistas FROM vistos as v WHERE v.id_recurso=id_recurso$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'VIDEO', '2020-10-20 20:52:56', '2020-10-20 20:52:56'),
(2, 'AUDIO', '2020-10-20 20:53:23', '2020-10-20 20:53:23'),
(3, 'PDF', '2020-10-20 20:53:23', '2020-10-20 20:53:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE `facultades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facutad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`id`, `facutad`, `created_at`, `updated_at`) VALUES
(1, 'FACULTAD DE CIENCIAS DE LA INGENIERÍA', NULL, NULL),
(2, 'FACULTAD DE CIENCIAS DE LA SALUD', NULL, NULL),
(3, 'FACULTAD DE CIENCIAS ADMINISTRATIVAS, ECONOMICAS Y CONTABLES', NULL, NULL),
(4, 'FACULTAD DE CIENCIAS SOCIALES', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gustos`
--

CREATE TABLE `gustos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_recurso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gustos`
--

INSERT INTO `gustos` (`id`, `id_user`, `id_recurso`, `created_at`, `updated_at`) VALUES
(47, 136, 53, '2020-12-11 12:06:11', '2020-12-11 12:06:11'),
(48, 126, 58, '2020-12-11 12:11:41', '2020-12-11 12:11:41'),
(49, 136, 49, '2020-12-13 01:31:02', '2020-12-13 01:31:02'),
(51, 135, 51, '2020-12-13 01:39:31', '2020-12-13 01:39:31'),
(52, 135, 50, '2020-12-13 01:39:40', '2020-12-13 01:39:40'),
(53, 162, 52, '2020-12-13 03:31:24', '2020-12-13 03:31:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_10_20_054246_create_permission_tables', 1),
(4, '2020_10_20_193017_create_personas_table', 1),
(5, '2020_10_20_193150_create_facultades_table', 1),
(6, '2020_10_20_193306_create_programas_table', 1),
(7, '2020_10_20_193307_create_users_table', 1),
(8, '2020_10_20_193341_create_archivos_table', 1),
(9, '2020_10_20_193406_create_recursos_table', 1),
(10, '2020_10_20_193446_create_vistos_table', 1),
(11, '2020_10_20_193651_create_gustos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 35),
(1, 'App\\Models\\User', 36),
(1, 'App\\Models\\User', 38),
(2, 'App\\Models\\User', 39),
(1, 'App\\Models\\User', 40),
(1, 'App\\Models\\User', 41),
(1, 'App\\Models\\User', 42),
(1, 'App\\Models\\User', 43),
(1, 'App\\Models\\User', 44),
(2, 'App\\Models\\User', 56),
(1, 'App\\Models\\User', 59),
(1, 'App\\Models\\User', 60),
(1, 'App\\Models\\User', 61),
(1, 'App\\Models\\User', 62),
(1, 'App\\Models\\User', 75),
(1, 'App\\Models\\User', 76),
(1, 'App\\Models\\User', 78),
(1, 'App\\Models\\User', 79),
(2, 'App\\Models\\User', 80),
(1, 'App\\Models\\User', 81),
(2, 'App\\Models\\User', 96),
(2, 'App\\Models\\User', 97),
(1, 'App\\Models\\User', 98),
(2, 'App\\Models\\User', 104),
(2, 'App\\Models\\User', 105),
(1, 'App\\Models\\User', 110),
(1, 'App\\Models\\User', 115),
(1, 'App\\Models\\User', 116),
(1, 'App\\Models\\User', 122),
(1, 'App\\Models\\User', 123),
(1, 'App\\Models\\User', 124),
(1, 'App\\Models\\User', 125),
(1, 'App\\Models\\User', 126),
(1, 'App\\Models\\User', 127),
(1, 'App\\Models\\User', 128),
(1, 'App\\Models\\User', 129),
(1, 'App\\Models\\User', 130),
(1, 'App\\Models\\User', 132),
(1, 'App\\Models\\User', 133),
(1, 'App\\Models\\User', 134),
(1, 'App\\Models\\User', 135),
(1, 'App\\Models\\User', 136),
(1, 'App\\Models\\User', 137),
(1, 'App\\Models\\User', 138),
(1, 'App\\Models\\User', 139),
(1, 'App\\Models\\User', 140),
(1, 'App\\Models\\User', 141),
(1, 'App\\Models\\User', 142),
(1, 'App\\Models\\User', 143),
(1, 'App\\Models\\User', 144),
(1, 'App\\Models\\User', 145),
(1, 'App\\Models\\User', 146),
(1, 'App\\Models\\User', 147),
(1, 'App\\Models\\User', 148),
(1, 'App\\Models\\User', 149),
(1, 'App\\Models\\User', 150),
(1, 'App\\Models\\User', 151),
(1, 'App\\Models\\User', 152),
(1, 'App\\Models\\User', 153),
(1, 'App\\Models\\User', 154),
(1, 'App\\Models\\User', 155),
(1, 'App\\Models\\User', 156),
(1, 'App\\Models\\User', 157),
(1, 'App\\Models\\User', 158),
(1, 'App\\Models\\User', 159),
(1, 'App\\Models\\User', 160),
(1, 'App\\Models\\User', 161),
(1, 'App\\Models\\User', 162);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jose@gmail.com', '$2y$10$a60S3eKZaIB6zQ8cLi12TeXAxZyKyhZODGzMN0UJp5SPbbLN3Ob9C', '2020-12-08 22:55:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'crear_recurso', 'web', '2020-10-23 23:31:29', '2020-10-23 23:31:29'),
(2, 'ver_recurso', 'web', '2020-10-23 23:37:13', '2020-10-23 23:37:13'),
(3, 'editar_recurso', 'web', '2020-10-23 23:37:13', '2020-10-23 23:37:13'),
(4, 'eliminar_recurso', 'web', '2020-10-23 23:37:13', '2020-10-23 23:37:13'),
(5, 'crear_usuario', 'web', NULL, NULL),
(6, 'ver_usuario', 'web', '2020-10-23 23:39:55', '2020-10-23 23:39:55'),
(7, 'editar_usuario', 'web', '2020-10-23 23:40:30', '2020-10-23 23:40:30'),
(8, 'eliminar_usuario', 'web', '2020-10-23 23:40:50', '2020-10-23 23:40:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primer_nombre` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_apellido` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `created_at`, `updated_at`) VALUES
(1, 'Jose', 'David', 'Gonzalez', 'Martinez', NULL, NULL),
(74, 'katrina', NULL, 'alquerque', 'perez', '2020-11-14 18:14:02', '2020-11-14 18:14:02'),
(144, 'jaider', ' ', 'reyes', ' ', NULL, NULL),
(150, 'luis', 'daniel', 'lopez', 'martinez', '2020-12-11 04:55:44', NULL),
(151, 'carlos', 'mario', 'perez', 'godinez', NULL, NULL),
(152, 'maria', 'mercedes', 'mondragon', ' ', NULL, NULL),
(153, 'cristian', ' ', 'alvarez', 'gomez', NULL, NULL),
(154, 'esteban', ' ', 'betin', 'alvarez', NULL, NULL),
(155, 'laura', ' ', 'ñesco', 'padilla', NULL, NULL),
(156, 'esilda', ' ', 'morales', 'reyes', NULL, NULL),
(157, 'oscar', ' ', 'benitez', 'bolaño', NULL, NULL),
(158, 'araselis', 'jose', 'oliveras', 'perez', NULL, NULL),
(159, 'cesar', 'tulio', 'salcedo', 'rome', NULL, NULL),
(160, 'yeiner', ' ', 'salcedo', 'rivera', NULL, NULL),
(161, 'willian', ' ', 'herrera', 'viancha', NULL, NULL),
(162, 'vairon', 'joel', 'jaraba', ' ', NULL, NULL),
(163, 'eisleth', 'paola', 'lopez', 'alvarez', NULL, NULL),
(164, 'sofia', 'andrea', 'tirado', 'pedo', NULL, NULL),
(165, 'ladeus', 'patricio', 'arriba', 'plata', NULL, NULL),
(166, 'derian', ' ', 'lorde', 'mirar', NULL, NULL),
(167, 'manual', 'herique', 'paternina', 'eden', NULL, NULL),
(168, 'carlos', 'chen', 'arroyo', 'nieves', NULL, NULL),
(169, 'tilson', ' ', 'baldobino', ' ', NULL, NULL),
(170, 'deila', ' ', 'vitola', ' ', NULL, NULL),
(171, 'katia', ' ', 'gomez', 'correa', NULL, NULL),
(172, 'danis', ' ', 'montes', 'tuiran', NULL, NULL),
(173, 'jose', 'armando', 'hurtado', ' ', NULL, NULL),
(174, 'melisa', ' ', 'sierra', ' ', NULL, NULL),
(175, 'victor', ' ', 'sosa', 'carrascal', NULL, NULL),
(176, 'fernanda', ' ', 'muñoz', 'edith', NULL, NULL),
(177, 'jose', 'fabian', 'montes', 'martinez', NULL, NULL),
(178, 'libardo', ' ', 'romero', ' ', NULL, NULL),
(179, 'julian', ' ', 'baquero', 'borja', NULL, NULL),
(180, 'leonor', ' ', 'martinez', ' ', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_facultad` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre`, `id_facultad`, `created_at`, `updated_at`) VALUES
(1, 'ING. SISTEMAS', 1, NULL, NULL),
(2, 'CONTADURÍA PUBLICA', 3, NULL, NULL),
(3, 'COMUNICACIÓN SOCIAL', 4, NULL, NULL),
(4, 'PSICOLOGIA', 4, NULL, NULL),
(5, 'DERECHO', 4, NULL, NULL),
(6, 'FISIOTERAPIA', 2, '2020-12-11 05:05:10', NULL),
(7, 'SALUD OCUPACIONAL', 2, '2020-12-11 05:05:55', NULL),
(8, 'ING ELECTRONICA', 1, '2020-12-11 05:35:31', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_programa` bigint(20) UNSIGNED NOT NULL,
  `semestre` int(11) NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `año` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo_archivo` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autores` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `tema`, `id_programa`, `semestre`, `descripcion`, `institucion`, `año`, `id_tipo_archivo`, `url`, `autores`, `archivo`, `foto`, `created_at`, `updated_at`) VALUES
(27, 'contaduria publica', 2, 3, 'que es la contabilidad', 'corposucre', '2020', 1, 'https://www.google.com', 'katrina Alquerque', 'que-es-la-contabilidad.mp4', 'caracteristicas-del-contador-publico-importantes-en-colombia.jpg', '2020-12-11 11:06:23', '2020-12-11 11:06:23'),
(28, 'formulas ejemplos', 2, 4, 'ejemplos y ejercicios contabilidad', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'anualidades-formulas-conceptos-y-ejemplos-clase-13-matematicas-financieras.mp4', 'caracteristicas-del-contador-publico-importantes-en-colombia.jpg', '2020-12-11 11:08:26', '2020-12-11 11:08:26'),
(29, 'codigo penal', 5, 5, 'normas y leyes de codigo pennal', 'corposucre', '2020', 3, 'https://www.google.com', 'jose david gonzalez', 'codigo penal.pdf', 'derecho.jpg', '2020-12-11 11:11:04', '2020-12-11 11:11:04'),
(30, 'declaracion derecho', 5, 5, 'declaracion universal de derechos humanos', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'declaracion derechos.pdf', 'derecho.jpg', '2020-12-11 11:12:57', '2020-12-11 11:12:57'),
(31, 'derecho administrativo', 5, 5, 'noción y ramas del derecho', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'Derecho-Administrativo.pdf', 'derecho.jpg', '2020-12-11 11:15:09', '2020-12-11 11:15:09'),
(32, 'derecho civil', 5, 4, 'introducción derecho civil', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', 'derecho-civil-derecho.mp4', 'derecho.jpg', '2020-12-11 11:17:01', '2020-12-11 11:17:01'),
(33, 'desacato al tribunal', 5, 4, 'consecuencias del desacato al tribunal', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'hablando-derecho-desacato-al-tribunal.mp4', 'derecho.jpg', '2020-12-11 11:18:42', '2020-12-11 11:18:42'),
(34, 'que son los derechos humanos', 5, 1, 'introducción a los derechos humanos', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'que-son-los-derechos-humanos-historia-bully-magnets.mp4', 'derecho.jpg', '2020-12-11 11:20:09', '2020-12-11 11:20:09'),
(35, 'razones para estudiar fisioterapia', 6, 3, '4 razones para así estudiar fisioterapia', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', '4 razones para SI estudiar fisioterapia.mp4', '9ee586136af4fb5efbae0f1491fdde3e.png', '2020-12-11 11:22:06', '2020-12-11 11:22:06'),
(36, 'estudiar fisioterapia', 6, 1, '7 razones para estudiar fisioterapia', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', '7 RAZONES PARA ESTUDIAR FISIOTERAPIA.mp4', 'fisioterapia.jpg', '2020-12-11 11:23:28', '2020-12-11 11:23:28'),
(37, 'fisioterapia deportiva', 6, 3, 'lesiones deportivas', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'fisioterapia deportiva.pdf', 'descarga.png', '2020-12-11 11:25:08', '2020-12-11 11:25:08'),
(38, 'manual fisioterapia', 6, 5, 'manual de procesos de fisioterapia', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'MANUAL_FISIOTERAPIA.pdf', '9ee586136af4fb5efbae0f1491fdde3e.png', '2020-12-11 11:26:40', '2020-12-11 11:26:40'),
(39, 'rol fisioterapeuta', 6, 5, 'la fisioterapia en la salud mental', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'Rol_Fisioterapeuta.pdf', '9ee586136af4fb5efbae0f1491fdde3e.png', '2020-12-11 11:28:00', '2020-12-11 11:28:00'),
(40, 'que es la fisioterapia', 6, 2, 'introducción a la fisioterapia', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', '9ee586136af4fb5efbae0f1491fdde3e.png', 'fisioterapia.jpg', '2020-12-11 11:29:47', '2020-12-11 11:29:47'),
(41, 'que hace la electrónica', 8, 1, 'introducción electrónica', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', '¿Qué hace la Electrónica.mp4', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:31:02', '2020-12-11 11:31:02'),
(42, 'un ing electrónico', 8, 1, 'que hace un ingeniero electrónico', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', '¿Qué hace un Ingeniero Electrónico_.mp4', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:33:19', '2020-12-11 11:33:19'),
(43, 'genios electronicos', 8, 2, 'bases de la electronica', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'genios-ingenieria-electrica-gigantes-recuperacion-publicaciones-fundacion-iberdrola.pdf', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:34:42', '2020-12-11 11:34:42'),
(44, 'ing electronica', 8, 2, 'un típico trabajo de un ing electrónico', 'corposucre', '2019', 1, 'http://www.google.com', 'katrina Alquerque', 'Ingeniería Electronica, Un día típico de trabajo en los Estados Unidos!.mp4', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:36:17', '2020-12-11 11:36:17'),
(46, 'ing electronica 2', 8, 1, 'introducción a la electrónica pdf', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'ingenieria-electrica.pdf', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:38:24', '2020-12-11 11:38:24'),
(47, 'máster ing electrónica', 8, 3, 'master de ingeneria electronica', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'Master-ingenieria-electrica.pdf', 'primer-plano-placa-circuito-electronico-cpu-microchip-componentes-electronicos-fondo_1387-819.jpg', '2020-12-11 11:40:06', '2020-12-11 11:40:06'),
(48, 'que hace un ing sistema', 1, 1, 'que hace un ingeniero de sistema', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', '¿Que hace un Ingeniero de sistemas.mp4', 'ing_sistema.jpg', '2020-12-11 11:41:41', '2020-12-11 11:41:41'),
(49, 'novedades sistemas', 1, 1, 'libros de ingeniera de sistemas', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'biblio-novedades-sistemas.pdf', 'cambio-carrera-ingenieria-sistemas-software-1280x720.jpg', '2020-12-11 11:42:56', '2020-12-11 11:42:56'),
(50, 'ing sistemas', 1, 1, 'introducción ing sistemas', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', 'Ingeniería de sistemas.mp4', 'cambio-carrera-ingenieria-sistemas-software-1280x720.jpg', '2020-12-11 11:43:49', '2020-12-11 11:43:49'),
(51, 'mitos de ing sistema', 1, 1, 'mitos sobre la ingeniera de sistemas', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'Mitos sobre la Ingeniería de Sistemas.mp4', 'ing_sistema.jpg', '2020-12-11 11:44:56', '2020-12-11 11:44:56'),
(52, 'redes 1', 1, 1, 'protocolo ospf', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'Protocolo OSPF redes.pdf', 'cambio-carrera-ingenieria-sistemas-software-1280x720.jpg', '2020-12-11 11:46:18', '2020-12-11 11:46:18'),
(53, 'ing en colombia', 1, 1, 'papel del ingeniero en colombia', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'ingeniero en colombia.pdf', 'cambio-carrera-ingenieria-sistemas-software-1280x720.jpg', '2020-12-11 11:47:21', '2020-12-11 11:47:21'),
(54, 'psicología clínica', 4, 1, 'introducción psicología clínica', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'LIBROPsicologiaClinica.pdf', 'Psicologia.jpeg', '2020-12-11 11:48:48', '2020-12-11 11:48:48'),
(55, 'la ciencia de la psicologia', 4, 2, 'la historia y sus ramas', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'psicologia_ciencia.pdf', 'Psicologia.jpeg', '2020-12-11 11:49:54', '2020-12-11 11:49:54'),
(56, 'bases psicologia', 4, 1, 'psicología básica para principiantes', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'psicologia-basica-para-principiantes.mp4', 'Psicologia.jpeg', '2020-12-11 11:51:30', '2020-12-11 11:51:30'),
(57, 'que es la psicologia', 4, 2, 'introduccion a la psicologia', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'que-es-la-psicologia.mp4', 'Psicologia.jpeg', '2020-12-11 11:52:44', '2020-12-11 11:52:44'),
(58, 'técnicas de psicología', 4, 2, 'descripcion de las emociones y cerebrales', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', 'tecnicas-psicologia.mp4', 'Psicologia.jpeg', '2020-12-11 11:54:03', '2020-12-11 11:54:03'),
(59, 'introduccion psicologia', 4, 2, 'introducción a la psicología', 'corposucre', '2020', 3, 'http://www.google.com', 'katrina Alquerque', 'TEMA 1_INTRODUCCION A LA PSICOLOGÍA.pdf', 'Psicologia.jpeg', '2020-12-11 11:55:59', '2020-12-11 11:55:59'),
(60, 'historia salud ocupacional', 7, 2, 'iniciando con salud ocupacional', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'historia de la salud ocupacional.pdf', 'SALUD-2.jpg', '2020-12-11 11:57:22', '2020-12-11 11:57:22'),
(61, 'salud ocupacional', 7, 2, 'introducción salud ocupacional', 'corposucre', '2020', 1, 'http://www.google.com', 'katrina Alquerque', 'Salud Ocupacional.mp4', 'SALUD-2.jpg', '2020-12-11 11:58:33', '2020-12-11 11:58:33'),
(62, 'salud ocupacional 2', 7, 3, 'ramas y tecnicas', 'corposucre', '2020', 3, 'http://www.google.com', 'jose david gonzalez', 'SALUD Y SEGURIDAD.pdf', 'SALUD-2.jpg', '2020-12-11 11:59:32', '2020-12-11 11:59:32'),
(63, 'salud y seguridad', 7, 2, 'salud y seguridad - salud ocupacional', 'corposucre', '2020', 1, 'http://www.google.com', 'jose david gonzalez', 'Seguridad y Salud en el Trabajo (SST).mp4', 'SALUD-2.jpg', '2020-12-11 12:01:03', '2020-12-11 12:01:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'estudiante', 'web', '2020-10-23 23:28:58', '2020-10-23 23:28:58'),
(2, 'admin', 'web', '2020-10-23 23:29:42', '2020-10-23 23:29:42'),
(3, 'invitado', 'web', '2020-10-23 23:29:42', '2020-10-23 23:29:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(2, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_persona` bigint(20) UNSIGNED DEFAULT NULL,
  `id_programa` bigint(20) UNSIGNED DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `foto` varchar(191) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `id_persona`, `id_programa`, `semestre`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jose', 'josedavid@gmail.com', '2020-10-20 20:46:42', '$2y$10$41AziiMpeSzhj8UAqf/nf.Jy2sgv/xwYAa1jCQXl2pvR8bQcKMZ8q', 1, 1, 8, 'La-Evolucion-Frontal.jpg', NULL, NULL, NULL),
(56, 'katrinilla', 'katrina@gmail.com', '2020-11-14 18:15:01', '$2y$10$PoToIJVsRJwFMiCzDzVIPO.yo7PjYkAGzSEsch.dDYwYJGWdPCrqC', 74, 1, 4, 'La-Evolucion-Frontal.jpg', NULL, '2020-11-14 18:15:01', '2020-11-14 18:15:01'),
(126, 'jaider', 'jaider@gmail.com', '2020-12-09 03:27:27', '$2y$10$1nuNovLCInYOkZm2B2DgmOwEoyquWf1P3ZwgzdU5o1FTTFgH0D3.q', 144, 4, 4, 'Koala.jpg', NULL, '2020-12-09 03:27:27', NULL),
(132, 'luis', 'luisdaniel@gmail.com', '2020-12-11 04:56:34', '$2y$10$pu3DJLzePCre0cW5SLAUCuH6wuxTHQOF9RM4ZrzDgP/aQJfphUAzu', 150, 1, 3, NULL, NULL, '2020-12-11 04:56:34', NULL),
(133, 'carlos', 'carlosmario@gmail.com', '2020-12-10 10:00:09', '$2y$10$pu3DJLzePCre0cW5SLAUCuH6wuxTHQOF9RM4ZrzDgP/aQJfphUAzu', 151, 1, 4, 'Koala.jpg', NULL, '2020-12-10 10:00:09', NULL),
(134, 'maria', 'mariamondragon@gmail.com', '2020-12-10 10:02:26', '$2y$10$8eD0wHkgmq5yg.stbZ1Ya.dS3WPfuQ0Xy8/C.CfxQJl1Jqdv8W0H.', 152, 1, 10, 'Koala.jpg', NULL, '2020-12-10 10:02:26', NULL),
(135, 'cristian', 'cristan@gmail.com', '2020-12-10 10:03:33', '$2y$10$q6lflz780yow0sjPCPXfPeexLRihuxjBKyLNa37lw8U7gBFt20roa', 153, 1, 10, 'Jellyfish.jpg', NULL, '2020-12-10 10:03:33', NULL),
(136, 'esteban', 'esteban@gmail.com', '2020-12-10 10:04:41', '$2y$10$L1P5Qz1Oln/iPgOnsG4gqeJvNqJ6PmLx6RHirKbaoqMvlKZFb3DPu', 154, 1, 5, 'Penguins.jpg', NULL, '2020-12-10 10:04:41', NULL),
(137, 'laura', 'laura@gmail.com', '2020-12-10 10:15:36', '$2y$10$EQELkbhZ1BcC1j4fW1W5gunmmsY3DlVX9Sy68726K21afSZ8qE1ii', 155, 6, 5, 'Tulips.jpg', NULL, '2020-12-10 10:15:36', NULL),
(138, 'esilda', 'esildamorales@gmail.com', '2020-12-10 10:16:58', '$2y$10$Pptmmy27rT2YH/dAY6/jVO4jOzgYNgn88GJzKhklIwj6OcSYpm6y2', 156, 6, 4, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:16:58', NULL),
(139, 'oscar', 'oscarbenitez@gmail.com', '2020-12-10 10:18:54', '$2y$10$swyco/1S/Q7lyMNRBI45se3bIHe.cTuimDzAD.67ssjO15LK0Sxgu', 157, 6, 2, 'Penguins.jpg', NULL, '2020-12-10 10:18:54', NULL),
(140, 'araselis', 'araselisjose@gmai.com', '2020-12-10 10:21:00', '$2y$10$S4LBmOnIO0wkv1vrL4ulSez1JShRog9oyyXg0w1Jg/6TtmPo.KqGe', 158, 6, 1, 'Hydrangeas.jpg', NULL, '2020-12-10 10:21:00', NULL),
(141, 'cesar', 'cesartulio@gmail.com', '2020-12-10 10:22:40', '$2y$10$JBAeag/68Ag7vDrsTmkRcepFEP8WdFHTa/Z3HoFuRTWvKCeh2Iuku', 159, 6, 1, 'Desert.jpg', NULL, '2020-12-10 10:22:40', NULL),
(142, 'yeiner', 'yeinersalcedo@gmail.com', '2020-12-10 10:24:13', '$2y$10$MyW9X89/T8JdfPgLSUlhxubVDS2eObEzg3PT/BRKtRKn4OGkxGHw.', 160, 2, 4, 'Jellyfish.jpg', NULL, '2020-12-10 10:24:13', NULL),
(143, 'willian', 'willianherrera@gmai.com', '2020-12-10 10:25:56', '$2y$10$2Ri8CsHfcV46jIlzFbog9.DrwO0pHNLVDcfrbPziBG1WMn3sUlmPi', 161, 2, 4, 'Lighthouse.jpg', NULL, '2020-12-10 10:25:56', NULL),
(144, 'vairon', 'vaironjoel@gmail.com', '2020-12-10 10:27:15', '$2y$10$scs3HIuxiZazhZSFTdp9E.hNGAdZGZq8le9sOYUwIhkyoblCHNhiO', 162, 2, 4, 'Penguins.jpg', NULL, '2020-12-10 10:27:15', NULL),
(145, 'eisleth', 'eislethpaola@gmail.com', '2020-12-10 10:28:32', '$2y$10$B8h.93XngLIaaoOGoc/DYeTsZYm4LTL7nRjCGLWMIB61uWvcC4zLG', 163, 2, 4, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:28:32', NULL),
(146, 'sofia', 'sofiaandrea@gmail.com', '2020-12-10 10:30:13', '$2y$10$ocH/5MsxB4PTkk3YNFWsbeauD4xnUWCiP6iIpYDuql8mM09GrZQ3i', 164, 5, 4, 'Jellyfish.jpg', NULL, '2020-12-10 10:30:13', NULL),
(147, 'ladeus', 'ladeuspatricio@gmail.com', '2020-12-10 10:31:32', '$2y$10$5tjtb8HVJjRaAsCCGIXx0eLt6Kb7b1ZI6Mp15byzSxrebsIUC9FdC', 165, 5, 4, 'Koala.jpg', NULL, '2020-12-10 10:31:32', NULL),
(148, 'derian', 'derianlorde@gmail.com', '2020-12-10 10:32:59', '$2y$10$uC6WwYMstVrdEldUK.Wq5uatb0VQm741SCDBQOC2RsH3lPfruVmcK', 166, 5, 10, 'Hydrangeas.jpg', NULL, '2020-12-10 10:32:59', NULL),
(149, 'manual', 'manuelhenrique@gmail.com', '2020-12-10 10:34:14', '$2y$10$JMmRe3eAhPMQqeQnijmMa.eMOlweI8.He1YCOIzjIRaqixey4zMwq', 167, 5, 4, 'Desert.jpg', NULL, '2020-12-10 10:34:14', NULL),
(150, 'carlos', 'carloschen@gmail.com', '2020-12-10 10:37:22', '$2y$10$nQZ8JAoDgRX..0ZSWDGfHOgzOUaYOn1NzIVkpkvYsLWg98zrxB1ku', 168, 8, 1, 'Hydrangeas.jpg', NULL, '2020-12-10 10:37:22', NULL),
(151, 'tilson', 'tilsonbaldobino@gmail.com', '2020-12-10 10:38:59', '$2y$10$Itl0Ym/x4rxsgxIS15BENO5utdnGtk7ZvbIadBZEzoUucOluY6yP6', 169, 8, 4, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:38:59', NULL),
(152, 'deila', 'deilavitola@gmail.com', '2020-12-10 10:39:55', '$2y$10$3Vqfc/Lk/AOit.00HuN/PeR0UiPzLbIf/NNI26.W1NWd/8u0Wjnfe', 170, 8, 6, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:39:55', NULL),
(153, 'katia', 'katrigomez@gmail.com', '2020-12-10 10:42:05', '$2y$10$HZKRwOlnrl2pOkxK4NKtYOMTLtzjFHit.OKIdiV306qgQSmQAAEQ6', 171, 4, 2, 'Penguins.jpg', NULL, '2020-12-10 10:42:05', NULL),
(154, 'danis', 'danismontes@gmail.com', '2020-12-10 10:44:24', '$2y$10$9sCtD1q7beashoc7ZBSnHeS4pxYfPsKF8BwL.0pAPNoJZHQ/PJPIy', 172, 4, 3, 'Hydrangeas.jpg', NULL, '2020-12-10 10:44:24', NULL),
(155, 'jose', 'josearmando@gmail.com', '2020-12-10 10:46:14', '$2y$10$JeI4Z.38GFTtxNrNn8FEWuAUYHebvu37JnPRZrWoVDsWXRRL0a98e', 173, 4, 5, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:46:14', NULL),
(156, 'melisa', 'melisasierra@gmail.com', '2020-12-10 10:47:11', '$2y$10$uO2B55L74M5do/WgBroFJ.oyG54MzrVkx2T1PCH4EPwrrSnElvPbW', 174, 4, 6, 'Penguins.jpg', NULL, '2020-12-10 10:47:11', NULL),
(157, 'victor', 'victorsosa@gmail.com', '2020-12-10 10:49:06', '$2y$10$RR5ZAxYiDmhxVyflnDWuNOOdWelSQrBABfb4pgT1kD2Kw.iSBZ3iu', 175, 7, 1, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:49:06', NULL),
(158, 'fernanda', 'fernandamunoz@gmail.com', '2020-12-10 10:50:50', '$2y$10$LQJ3Adnnn2WhKZqmDUwGje0IeocRoh6nngnxnQdZtrn5sv8o9EWAq', 176, 7, 2, 'Penguins.jpg', NULL, '2020-12-10 10:50:50', NULL),
(159, 'jose', 'josefabian@gmail.com', '2020-12-10 10:52:56', '$2y$10$dMBNflQfp/pWs9xaSwZEiOkE9q8ONzp3pE1dHnF.yv6SiNKHQoU.y', 177, 7, 3, 'Chrysanthemum.jpg', NULL, '2020-12-10 10:52:56', NULL),
(160, 'libardo', 'liardoromero@gmail.com', '2020-12-10 10:54:10', '$2y$10$mmK/BuO8kdAcquzQHqsbuebZil09y1aMEBBqnP5JP.40Tf5oLpwM6', 178, 7, 4, 'Lighthouse.jpg', NULL, '2020-12-10 10:54:10', NULL),
(161, 'julian', 'julianbaquero@gmail.com', '2020-12-10 10:55:43', '$2y$10$gkqhCEWEuuw3qEYUZHDnDOHTKI9oHzR8GFvb5mZLCfMX4DlrgJ2YG', 179, 7, 5, 'Hydrangeas.jpg', NULL, '2020-12-10 10:55:43', NULL),
(162, 'leonor', 'leonor@gmail.com', '2020-12-12 03:29:57', '$2y$10$uWh9qzQtRHRYhzsGlMdTjuirO.RpGhJyBs6VuzzfwNiJbxu3D0OCS', 180, 1, 3, 'Chrysanthemum.jpg', NULL, '2020-12-12 03:29:57', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistos`
--

CREATE TABLE `vistos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_recurso` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vistos`
--

INSERT INTO `vistos` (`id`, `id_user`, `id_recurso`, `created_at`, `updated_at`) VALUES
(655, 1, 27, '2020-12-11 11:06:23', '2020-12-11 11:06:23'),
(656, 1, 28, '2020-12-11 11:08:26', '2020-12-11 11:08:26'),
(657, 1, 29, '2020-12-11 11:11:04', '2020-12-11 11:11:04'),
(658, 1, 30, '2020-12-11 11:12:57', '2020-12-11 11:12:57'),
(659, 1, 31, '2020-12-11 11:15:09', '2020-12-11 11:15:09'),
(660, 1, 32, '2020-12-11 11:17:01', '2020-12-11 11:17:01'),
(661, 1, 33, '2020-12-11 11:18:42', '2020-12-11 11:18:42'),
(662, 1, 34, '2020-12-11 11:20:09', '2020-12-11 11:20:09'),
(663, 1, 35, '2020-12-11 11:22:06', '2020-12-11 11:22:06'),
(664, 1, 36, '2020-12-11 11:23:28', '2020-12-11 11:23:28'),
(665, 1, 37, '2020-12-11 11:25:08', '2020-12-11 11:25:08'),
(666, 1, 38, '2020-12-11 11:26:40', '2020-12-11 11:26:40'),
(667, 1, 39, '2020-12-11 11:28:00', '2020-12-11 11:28:00'),
(668, 1, 40, '2020-12-11 11:29:47', '2020-12-11 11:29:47'),
(669, 1, 41, '2020-12-11 11:31:02', '2020-12-11 11:31:02'),
(670, 1, 42, '2020-12-11 11:33:20', '2020-12-11 11:33:20'),
(671, 1, 43, '2020-12-11 11:34:42', '2020-12-11 11:34:42'),
(672, 1, 44, '2020-12-11 11:36:17', '2020-12-11 11:36:17'),
(673, 1, 46, '2020-12-11 11:38:24', '2020-12-11 11:38:24'),
(674, 1, 47, '2020-12-11 11:40:06', '2020-12-11 11:40:06'),
(675, 1, 48, '2020-12-11 11:41:41', '2020-12-11 11:41:41'),
(676, 1, 49, '2020-12-11 11:42:56', '2020-12-11 11:42:56'),
(677, 1, 50, '2020-12-11 11:43:49', '2020-12-11 11:43:49'),
(678, 1, 51, '2020-12-11 11:44:56', '2020-12-11 11:44:56'),
(679, 1, 52, '2020-12-11 11:46:18', '2020-12-11 11:46:18'),
(680, 1, 53, '2020-12-11 11:47:21', '2020-12-11 11:47:21'),
(681, 1, 54, '2020-12-11 11:48:49', '2020-12-11 11:48:49'),
(682, 1, 55, '2020-12-11 11:49:54', '2020-12-11 11:49:54'),
(683, 1, 56, '2020-12-11 11:51:30', '2020-12-11 11:51:30'),
(684, 1, 57, '2020-12-11 11:52:44', '2020-12-11 11:52:44'),
(685, 1, 58, '2020-12-11 11:54:04', '2020-12-11 11:54:04'),
(686, 1, 59, '2020-12-11 11:55:59', '2020-12-11 11:55:59'),
(687, 1, 60, '2020-12-11 11:57:22', '2020-12-11 11:57:22'),
(688, 1, 61, '2020-12-11 11:58:33', '2020-12-11 11:58:33'),
(689, 1, 62, '2020-12-11 11:59:32', '2020-12-11 11:59:32'),
(690, 1, 63, '2020-12-11 12:01:03', '2020-12-11 12:01:03'),
(691, 136, 53, '2020-12-11 12:05:31', '2020-12-11 12:05:31'),
(692, 132, 52, '2020-12-11 12:10:01', '2020-12-11 12:10:01'),
(693, 126, 58, '2020-12-11 12:11:26', '2020-12-11 12:11:26'),
(694, 126, 58, '2020-12-11 12:12:20', '2020-12-11 12:12:20'),
(695, 126, 58, '2020-12-11 12:12:27', '2020-12-11 12:12:27'),
(696, 126, 58, '2020-12-11 12:12:38', '2020-12-11 12:12:38'),
(697, 126, 57, '2020-12-11 12:13:16', '2020-12-11 12:13:16'),
(698, 126, 57, '2020-12-11 12:13:25', '2020-12-11 12:13:25'),
(699, 136, 53, '2020-12-13 01:30:40', '2020-12-13 01:30:40'),
(700, 136, 49, '2020-12-13 01:30:55', '2020-12-13 01:30:55'),
(701, 136, 48, '2020-12-13 01:31:51', '2020-12-13 01:31:51'),
(702, 135, 49, '2020-12-13 01:34:18', '2020-12-13 01:34:18'),
(703, 135, 57, '2020-12-13 01:36:13', '2020-12-13 01:36:13'),
(704, 135, 51, '2020-12-13 01:36:30', '2020-12-13 01:36:30'),
(705, 135, 48, '2020-12-13 01:37:07', '2020-12-13 01:37:07'),
(706, 135, 27, '2020-12-13 01:37:40', '2020-12-13 01:37:40'),
(707, 135, 50, '2020-12-13 01:38:26', '2020-12-13 01:38:26'),
(708, 135, 51, '2020-12-13 01:39:28', '2020-12-13 01:39:28'),
(709, 135, 50, '2020-12-13 01:39:37', '2020-12-13 01:39:37'),
(710, 135, 51, '2020-12-13 01:40:57', '2020-12-13 01:40:57'),
(711, 135, 53, '2020-12-13 01:43:10', '2020-12-13 01:43:10'),
(712, 135, 50, '2020-12-13 01:43:45', '2020-12-13 01:43:45'),
(713, 135, 54, '2020-12-13 01:50:28', '2020-12-13 01:50:28'),
(714, 162, 52, '2020-12-13 03:30:48', '2020-12-13 03:30:48'),
(715, 162, 54, '2020-12-13 03:32:34', '2020-12-13 03:32:34'),
(716, 136, 48, '2020-12-13 09:27:46', '2020-12-13 09:27:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `gustos`
--
ALTER TABLE `gustos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gustos_id_user_foreign` (`id_user`),
  ADD KEY `gustos_id_recurso_foreign` (`id_recurso`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programas_id_facultad_foreign` (`id_facultad`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recursos_id_programa_foreign` (`id_programa`),
  ADD KEY `recursos_id_tipo_archivo_foreign` (`id_tipo_archivo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_persona_foreign` (`id_persona`),
  ADD KEY `users_id_programa_foreign` (`id_programa`);

--
-- Indices de la tabla `vistos`
--
ALTER TABLE `vistos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vistos_id_user_foreign` (`id_user`),
  ADD KEY `vistos_id_recurso_foreign` (`id_recurso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gustos`
--
ALTER TABLE `gustos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT de la tabla `vistos`
--
ALTER TABLE `vistos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=717;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gustos`
--
ALTER TABLE `gustos`
  ADD CONSTRAINT `gustos_id_recurso_foreign` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id`),
  ADD CONSTRAINT `gustos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `programas`
--
ALTER TABLE `programas`
  ADD CONSTRAINT `programas_id_facultad_foreign` FOREIGN KEY (`id_facultad`) REFERENCES `facultades` (`id`);

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`),
  ADD CONSTRAINT `recursos_id_tipo_archivo_foreign` FOREIGN KEY (`id_tipo_archivo`) REFERENCES `archivos` (`id`);

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `users_id_programa_foreign` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `vistos`
--
ALTER TABLE `vistos`
  ADD CONSTRAINT `vistos_id_recurso_foreign` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id`),
  ADD CONSTRAINT `vistos_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
