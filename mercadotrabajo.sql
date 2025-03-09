-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-03-2025 a las 04:52:56
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mercadotrabajo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `awards`
--

CREATE TABLE `awards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `awards`
--

INSERT INTO `awards` (`id`, `user_id`, `title`, `organization`, `year`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'RECONOCIMIENTO UPEL', 'UPEL', '2010', 'RECONOCIMIENTO COMO PONENTE EN EL 2010', '2025-03-04 22:25:16', '2025-03-04 22:25:43'),
(3, 8, 'Mención honorífica trabajo de grado  ', 'UPEL', '2013', 'Mención honorífica del proyecto de trabajo de grado de la upel', '2025-03-05 13:22:29', '2025-03-05 13:22:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidate_cv`
--

CREATE TABLE `candidate_cv` (
  `id` int(11) NOT NULL COMMENT 'Identificador único del CV',
  `user_id` int(11) NOT NULL COMMENT 'ID del usuario asociado al CV',
  `path` varchar(500) NOT NULL COMMENT 'Ruta donde se almacena el archivo',
  `filename` varchar(255) NOT NULL COMMENT 'Nombre original del archivo',
  `file_type` varchar(50) NOT NULL COMMENT 'Tipo de archivo (ejemplo: pdf, docx)',
  `file_size` int(11) NOT NULL COMMENT 'Tamaño del archivo en bytes',
  `status` enum('active','inactive','pending') DEFAULT 'active' COMMENT 'Estado del archivo',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT 'Indica si el archivo fue eliminado lógicamente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creación del registro',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Fecha de última actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Almacena los currículums de los candidatos';

--
-- Volcado de datos para la tabla `candidate_cv`
--

INSERT INTO `candidate_cv` (`id`, `user_id`, `path`, `filename`, `file_type`, `file_size`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(11, 8, 'uploads/resumes/65668c2a5d9e8/cv_67ccb4f5596a13.44520246.pdf', 'invoice_67b66cdac662d.pdf', 'application/pdf', 9746, 'active', 0, '2025-03-08 21:21:57', '2025-03-08 21:21:57'),
(12, 8, 'uploads/resumes/65668c2a5d9e8/cv_67ccb4f9679ac0.72553582.pdf', 'invoice_67b66b9f90ee2.pdf', 'application/pdf', 9366, 'active', 0, '2025-03-08 21:22:01', '2025-03-08 21:22:01'),
(13, 8, 'uploads/resumes/65668c2a5d9e8/cv_67ccb5e2254f15.39915032.pdf', 'John_Doe_Resume.pdf', 'application/pdf', 520069, 'active', 0, '2025-03-08 21:25:54', '2025-03-08 21:25:54'),
(14, 8, 'uploads/resumes/65668c2a5d9e8/cv_67ccfcdc60d7a4.28189541.pdf', 'invoice_67b66a9372256.pdf', 'application/pdf', 11192, 'active', 0, '2025-03-09 02:28:44', '2025-03-09 02:28:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(60) NOT NULL,
  `name_es` char(255) NOT NULL,
  `description_es` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `name_es`, `description_es`) VALUES
(1, 'Accounting / Finance', 'Accounting / Finance', '<i class=\"fa fa-users\" aria-hidden=\"true\"></i>', 'Contabilidad / Finanzas', 'Contabilidad / Finanzas'),
(2, 'Marketing', 'Marketing', '<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>', 'Marketing', 'Marketing'),
(3, 'Design', 'Design', '<i class=\"fa fa-film\" aria-hidden=\"true\"></i>', 'Diseño', 'Diseño'),
(4, 'Developer', 'Development', '<i class=\"fa fa-sitemap\" aria-hidden=\"true\"></i>', 'Desarrollo', 'Desarrollo'),
(5, 'Human Resource', 'Human Resource', '<i class=\"fa fa-users\" aria-hidden=\"true\"></i>', 'Recursos Humanos', 'Recursos humanos'),
(6, 'Automotive Jobs', 'Automotive Jobs', '<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>', 'Automotor', 'Empleos en el sector automotor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`) VALUES
(1, 1, 'Caracas'),
(2, 1, 'El Hatillo'),
(3, 1, 'Chacao'),
(4, 1, 'Baruta'),
(5, 2, 'Maracaibo'),
(6, 2, 'San Francisco'),
(7, 2, 'Cabimas'),
(8, 2, 'Ciudad Ojeda'),
(9, 3, 'Valencia'),
(10, 3, 'Naguanagua'),
(11, 3, 'San Diego'),
(12, 3, 'Guacara'),
(13, 4, 'Los Teques'),
(14, 4, 'Charallave'),
(15, 4, 'Santa Teresa'),
(16, 4, 'Carrizal'),
(17, 5, 'Bogotá'),
(18, 5, 'Chía'),
(19, 5, 'Soacha'),
(20, 5, 'Zipaquirá'),
(21, 6, 'Medellín'),
(22, 6, 'Itagüí'),
(23, 6, 'Bello'),
(24, 6, 'Envigado'),
(25, 7, 'Cali'),
(26, 7, 'Jamundí'),
(27, 7, 'Palmira'),
(28, 7, 'Yumbo'),
(29, 8, 'Barranquilla'),
(30, 8, 'Soledad'),
(31, 8, 'Malambo'),
(32, 8, 'Puerto Colombia'),
(33, 9, 'Miami'),
(34, 9, 'Orlando'),
(35, 9, 'Tampa'),
(36, 9, 'Jacksonville'),
(37, 10, 'Houston'),
(38, 10, 'Dallas'),
(39, 10, 'Austin'),
(40, 10, 'San Antonio'),
(41, 11, 'Los Angeles'),
(42, 11, 'San Diego'),
(43, 11, 'San Francisco'),
(44, 11, 'Sacramento'),
(45, 12, 'New York City'),
(46, 12, 'Buffalo'),
(47, 12, 'Rochester'),
(48, 12, 'Albany');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `Ubicación` char(250) DEFAULT NULL,
  `Phone` char(250) DEFAULT NULL,
  `mail` char(250) DEFAULT NULL,
  `primary_industry` char(250) DEFAULT NULL,
  `company_size` char(250) DEFAULT NULL,
  `social_facebook` char(250) DEFAULT NULL,
  `social_x` char(250) DEFAULT NULL,
  `social_instagram` char(250) DEFAULT NULL,
  `social_linkedin` char(250) DEFAULT NULL,
  `notas` char(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `name`, `description`, `website`, `logo_url`, `Ubicación`, `Phone`, `mail`, `primary_industry`, `company_size`, `social_facebook`, `social_x`, `social_instagram`, `social_linkedin`, `notas`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 2, 'Udemy', '<p>Moody’s Corporation, often referred to as Moody’s, is an American business and financial services company. It is the holding company for Moody’s Investors Service (MIS), an American credit rating agency, and Moody’s Analytics (MA), an American provider of financial analysis software and services.</p>\n\n<p>Moody’s was founded by John Moody in 1909 to produce manuals of statistics related to stocks and bonds and bond ratings. Moody’s was acquired by Dun & Bradstreet in 1962. In 2000, Dun & Bradstreet spun off Moody’s Corporation as a separate company that was listed on the NYSE under MCO. In 2007, Moody’s Corporation was split into two operating divisions, Moody’s Investors Service, the rating agency, and Moody’s Analytics, with all of its other products.</p>\n\n<p>Moody’s Corporation, often referred to as Moody’s, is an American business and financial services company. It is the holding company for Moody’s Investors Service (MIS), an American credit rating agency, and Moody’s Analytics (MA), an American provider of financial analysis software and services.</p>', 'https://www.udemy.com', 'assets/companies/img/company-1.webp', 'San Francisco, USA', '+1 415-555-5555', 'info@udemy.com', 'Educación', '1001-5000 empleados', 'https://facebook.com/udemy', 'https://twitter.com/udemy', 'https://instagram.com/udemy', 'https://linkedin.com/company/udemy', 'Notas sobre Udemy', '2025-02-27 15:40:59', '2025-03-03 15:26:04', 1),
(2, 3, 'Stripe', 'Plataforma de pagos en línea\n\n<p>Moody’s Corporation, often referred to as Moody’s, is an American business and financial services company. It is the holding company for Moody’s Investors Service (MIS), an American credit rating agency, and Moody’s Analytics (MA), an American provider of financial analysis software and services.</p>\n\n<p>Moody’s Corporation, often referred to as Moody’s, is an American business and financial services company. It is the holding company for Moody’s Investors Service (MIS), an American credit rating agency, and Moody’s Analytics (MA), an American provider of financial analysis software and services.</p>\n\n<p>Moody’s Corporation, often referred to as Moody’s, is an American business and financial services company. It is the holding company for Moody’s Investors Service (MIS), an American credit rating agency, and Moody’s Analytics (MA), an American provider of financial analysis software and services.</p>\\', 'https://www.stripe.com', 'assets/companies/img/company-2.webp', 'San Francisco, USA', '+1 415-555-5556', 'info@stripe.com', 'Fintech', '1001-5000 empleados', 'https://facebook.com/stripe', 'https://twitter.com/stripe', 'https://instagram.com/stripe', 'https://linkedin.com/company/stripe', 'Notas sobre Stripe', '2025-02-27 15:40:59', '2025-03-03 14:58:33', 1),
(3, 4, 'Dropbox', 'Servicio de almacenamiento en la nube', 'https://www.dropbox.com', 'assets/companies/img/company-3.webp', 'San Francisco, USA', '+1 415-555-5557', 'info@dropbox.com', 'Tecnología', '1001-5000 empleados', 'https://facebook.com/dropbox', 'https://twitter.com/dropbox', 'https://instagram.com/dropbox', 'https://linkedin.com/company/dropbox', 'Notas sobre Dropbox', '2025-02-27 15:40:59', '2025-02-27 00:00:00', 1),
(4, 5, 'Figma', 'Herramienta de diseño colaborativo', 'https://www.figma.com', 'assets/companies/img/company-4.webp', 'San Francisco, USA', '+1 415-555-5558', 'info@figma.com', 'Diseño', '501-1000 empleados', 'https://facebook.com/figma', 'https://twitter.com/figma', 'https://instagram.com/figma', 'https://linkedin.com/company/figma', 'Notas sobre Figma', '2025-02-27 15:40:59', '2025-02-27 00:00:00', 1),
(5, 6, 'Udemy 2', 'Plataforma de aprendizaje en línea', 'https://www.udemy.com', 'assets/companies/img/company-5.webp', 'San Francisco, USA', '+1 415-555-5559', 'info@udemy2.com', 'Educación', '1001-5000 empleados', 'https://facebook.com/udemy2', 'https://twitter.com/udemy2', 'https://instagram.com/udemy2', 'https://linkedin.com/company/udemy2', 'Notas sobre Udemy 2', '2025-02-27 15:43:16', '2025-02-27 00:00:00', 1),
(6, 7, 'Udemy', 'Plataforma de pagos en línea', 'https://www.stripe.com', 'assets/companies/img/company-6.webp', 'San Francisco, USA', '+1 415-555-5555', 'info@stripe.com', 'Fintech', '1001-5000 empleados', 'https://facebook.com/strype', 'https://twitter.com/strype', 'https://instagram.com/strype', 'https://linkedin.com/company/strype', 'Notas sobre stripe', '2025-02-27 15:40:59', '2025-02-27 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`) VALUES
(1, 'Venezuela', 'VE'),
(2, 'Colombia', 'CO'),
(3, 'Estados Unidos', 'US');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `start_year` varchar(50) NOT NULL,
  `end_year` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `education`
--

INSERT INTO `education` (`id`, `user_id`, `degree`, `institution`, `start_year`, `end_year`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'TECNICO EN INFORMATICA', 'IUFRONT', '1998', '2000', 'Tecnico superior en informatica', '2025-03-04 21:57:10', '2025-03-05 00:36:42'),
(2, 8, 'LICENCIADO EN INFORMATICA', 'UPEL RUBIO', '2010', '2013', 'Título de licenciado en educación mención informática', '2025-03-04 21:57:10', '2025-03-05 00:36:35'),
(3, 8, 'Bachiller en ciencias', 'Escuela Deportiva', '1992', '1997', 'Titulo de bachiller en ciencias', '2025-03-05 00:33:37', '2025-03-06 00:15:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employment_types`
--

CREATE TABLE `employment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_es` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `employment_types`
--

INSERT INTO `employment_types` (`id`, `name`, `name_es`) VALUES
(1, 'Full-time', 'Tiempo completo'),
(2, 'Part-time', 'Medio tiempo'),
(3, 'Contract', 'Contrato'),
(4, 'Freelance', 'Freelance'),
(5, 'Internship', 'Pasantía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `startDate` varchar(50) NOT NULL,
  `endDate` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `experience`
--

INSERT INTO `experience` (`id`, `user_id`, `jobTitle`, `company`, `startDate`, `endDate`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'Senior Developer', 'iCreativa', '2018', '2024', 'Desarrollo de aplicaciones en drupal, wordpress, php, javascript, reactnative, entre otros', '2025-03-05 13:03:13', '2025-03-05 13:03:28'),
(2, 8, 'Docente de informatica', 'Ministerio de educación', '2001', '2014', 'Docente de informatica en bachillerato', '2025-03-05 13:06:19', '2025-03-05 13:06:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `job_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `employment_type_id` int(11) NOT NULL,
  `salary_min` decimal(12,2) DEFAULT NULL,
  `salary_max` decimal(12,2) DEFAULT NULL,
  `external_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `city` varchar(255) DEFAULT NULL,
  `key_responsibilities` text DEFAULT NULL,
  `skills_experience` text DEFAULT NULL,
  `show_salary` tinyint(1) DEFAULT 0,
  `priority` enum('Urgent','High','Normal','Low') DEFAULT 'Normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `title`, `job_description`, `category_id`, `job_type_id`, `employment_type_id`, `salary_min`, `salary_max`, `external_url`, `is_active`, `created_at`, `updated_at`, `city`, `key_responsibilities`, `skills_experience`, `show_salary`, `priority`) VALUES
(1, 1, 'Desarrollador Full Stack', 'Desarrollo de aplicaciones web y móviles utilizando tecnologías modernas como React, Node.js y bases de datos NoSQL. <br><br>El candidato ideal debe ser capaz de trabajar en equipo y colaborar con diseñadores, testers y otros desarrolladores para entregar productos de alta calidad. <br><br>Además, deberá mantenerse actualizado con las últimas tendencias en desarrollo de software y proponer mejoras continuas.', 4, 1, 1, '3000.00', '5000.00', NULL, 0, '2025-02-27 17:28:34', '2025-03-03 04:45:37', 'San Francisco', '<ul><li>Desarrollar nuevas funcionalidades para aplicaciones web y móviles.</li><li>Colaborar con el equipo de diseño para implementar interfaces de usuario.</li><li>Optimizar el rendimiento de las aplicaciones.</li><li>Realizar pruebas unitarias y de integración.</li></ul>', '<ul><li>Experiencia en desarrollo frontend con React y JavaScript.</li><li>Conocimiento de backend con Node.js y Express.</li><li>Familiaridad con bases de datos MongoDB o PostgreSQL.</li><li>Habilidades de resolución de problemas y pensamiento crítico.</li></ul>', 1, 'Normal'),
(2, 1, 'Diseñador UX/UI', 'Diseño de interfaces de usuario atractivas y funcionales para aplicaciones web y móviles. <br><br>El diseñador será responsable de crear prototipos interactivos y asegurarse de que las interfaces sean intuitivas y accesibles. <br><br>También deberá trabajar en estrecha colaboración con el equipo de desarrollo para garantizar que los diseños sean implementados correctamente.', 3, 2, 1, '2500.00', '4000.00', NULL, 1, '2025-02-28 17:26:34', '2025-03-03 17:01:25', 'San Francisco', '<ul><li>Crear prototipos y wireframes para nuevos productos.</li><li>Realizar pruebas de usabilidad y recopilar feedback de los usuarios.</li><li>Colaborar con desarrolladores para implementar diseños.</li><li>Mantener la consistencia visual en todas las plataformas.</li></ul>', '<ul><li>Experiencia en herramientas de diseño como Figma y Adobe XD.</li><li>Conocimiento de principios de diseño UX/UI.</li><li>Familiaridad con HTML, CSS y JavaScript para prototipado básico.</li><li>Habilidades de comunicación y trabajo en equipo.</li></ul>', 1, 'High'),
(3, 1, 'Marketing Digital', 'Gestión de campañas publicitarias digitales para aumentar la visibilidad de la marca y generar leads. <br><br>El especialista en marketing digital será responsable de planificar, ejecutar y optimizar campañas en plataformas como Google Ads, Facebook Ads y LinkedIn. <br><br>También deberá analizar métricas clave y ajustar estrategias según los resultados obtenidos.', 2, 3, 2, '2000.00', '3500.00', NULL, 0, '2025-03-01 17:26:34', '2025-03-06 16:30:37', 'San Francisco', '<ul><li>Planificar y ejecutar campañas de marketing digital.</li><li>Optimizar anuncios para mejorar el ROI.</li><li>Analizar métricas de rendimiento y ajustar estrategias.</li><li>Colaborar con el equipo de contenido para crear materiales atractivos.</li></ul>', '<ul><li>Experiencia en SEO y SEM.</li><li>Conocimiento de herramientas de análisis como Google Analytics.</li><li>Familiaridad con plataformas de publicidad como Google Ads y Facebook Ads.</li><li>Habilidades de gestión de proyectos y organización.</li></ul>', 0, 'Normal'),
(4, 1, 'Analista Financiero', 'Análisis de datos financieros para apoyar la toma de decisiones estratégicas. <br><br>El analista financiero será responsable de preparar informes detallados y proporcionar insights sobre el rendimiento financiero de la empresa. <br><br>También deberá colaborar con otros departamentos para identificar oportunidades de mejora.', 1, 4, 3, '3500.00', '5000.00', NULL, 1, '2025-03-03 11:00:00', '2025-03-03 17:03:56', 'San Francisco', '<ul><li>Preparar informes financieros mensuales y trimestrales.</li><li>Analizar tendencias y patrones en los datos financieros.</li><li>Colaborar con otros departamentos para optimizar costos.</li><li>Proponer estrategias para mejorar la rentabilidad.</li></ul>', '<ul><li>Experiencia en análisis financiero y contabilidad.</li><li>Conocimiento de herramientas como Excel y Power BI.</li><li>Habilidades de comunicación para presentar informes claros.</li><li>Capacidad para trabajar bajo presión y cumplir plazos.</li></ul>', 1, 'Urgent'),
(5, 2, 'Ingeniero de Software', 'Implementación de sistemas de pagos en línea utilizando tecnologías como Python y Java. <br><br>El ingeniero de software será responsable de diseñar, desarrollar y mantener APIs seguras y escalables. <br><br>Además, deberá colaborar con equipos de productos y diseño para garantizar una experiencia de usuario fluida.', 4, 1, 1, '4000.00', '6000.00', NULL, 1, '2025-02-27 18:28:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Desarrollar e implementar APIs de pagos seguras.</li><li>Colaborar con equipos de productos y diseño.</li><li>Optimizar el rendimiento de los sistemas.</li><li>Realizar pruebas unitarias y de integración.</li></ul>', '<ul><li>Experiencia en desarrollo backend con Python y Java.</li><li>Conocimiento de frameworks como Spring Boot o Django.</li><li>Familiaridad con bases de datos PostgreSQL o MySQL.</li><li>Habilidades de resolución de problemas y pensamiento crítico.</li></ul>', 1, 'Normal'),
(6, 2, 'Especialista en Soporte Técnico', 'Soporte técnico a clientes para resolver problemas relacionados con el uso de la plataforma. <br><br>El especialista en soporte técnico será responsable de diagnosticar y solucionar problemas técnicos, así como de proporcionar asistencia remota. <br><br>También deberá documentar los casos y proponer mejoras para reducir incidencias.', 4, 2, 2, '2000.00', '3000.00', NULL, 1, '2025-02-27 15:26:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Resolver problemas técnicos reportados por los clientes.</li><li>Proporcionar asistencia remota a través de chat o llamadas.</li><li>Documentar casos y soluciones en el sistema de tickets.</li><li>Proponer mejoras para reducir incidencias recurrentes.</li></ul>', '<ul><li>Experiencia en soporte técnico o atención al cliente.</li><li>Conocimiento de sistemas operativos Windows y Linux.</li><li>Familiaridad con herramientas de gestión de tickets.</li><li>Habilidades de comunicación y paciencia.</li></ul>', 0, 'Low'),
(7, 2, 'Gerente de Producto', 'Gestión de productos digitales desde la conceptualización hasta el lanzamiento. <br><br>El gerente de producto será responsable de definir la visión del producto, priorizar características y trabajar con equipos multifuncionales. <br><br>Además, deberá analizar métricas clave para medir el éxito del producto.', 4, 3, 1, '5000.00', '7000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Definir la visión y estrategia del producto.</li><li>Priorizar características basadas en necesidades del usuario.</li><li>Colaborar con equipos de desarrollo y diseño.</li><li>Analizar métricas de rendimiento del producto.</li></ul>', '<ul><li>Experiencia en gestión de productos digitales.</li><li>Conocimiento de metodologías ágiles (Scrum, Kanban).</li><li>Familiaridad con herramientas de análisis como Google Analytics.</li><li>Habilidades de liderazgo y toma de decisiones.</li></ul>', 1, 'High'),
(8, 2, 'Analista de Datos', 'Análisis de grandes volúmenes de datos para generar insights accionables. <br><br>El analista de datos será responsable de limpiar, transformar y analizar datos utilizando herramientas como SQL y Python. <br><br>Además, deberá preparar informes claros y concisos para apoyar la toma de decisiones.', 1, 4, 3, '3000.00', '4500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Limpiar y transformar datos para su análisis.</li><li>Generar informes de análisis de datos.</li><li>Identificar patrones y tendencias en los datos.</li><li>Colaborar con otros departamentos para interpretar resultados.</li></ul>', '<ul><li>Experiencia en análisis de datos con SQL y Python.</li><li>Conocimiento de herramientas de visualización como Tableau o Power BI.</li><li>Familiaridad con bases de datos relacionales y no relacionales.</li><li>Habilidades de comunicación para presentar insights.</li></ul>', 1, 'Normal'),
(9, 3, 'Administrador de Base de Datos', 'Administración y optimización de bases de datos para garantizar un rendimiento óptimo. <br><br>El administrador de bases de datos será responsable de realizar copias de seguridad, optimizar consultas y monitorear el rendimiento. <br><br>Además, deberá implementar políticas de seguridad para proteger los datos.', 4, 1, 1, '3500.00', '5000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Realizar copias de seguridad regulares de las bases de datos.</li><li>Optimizar consultas SQL para mejorar el rendimiento.</li><li>Monitorear el rendimiento de las bases de datos.</li><li>Implementar políticas de seguridad para proteger los datos.</li></ul>', '<ul><li>Experiencia en administración de bases de datos MySQL o MongoDB.</li><li>Conocimiento de optimización de consultas SQL.</li><li>Familiaridad con herramientas de monitoreo de bases de datos.</li><li>Habilidades de resolución de problemas y atención al detalle.</li></ul>', 1, 'Normal'),
(10, 3, 'Especialista en Ciberseguridad', 'Protección de datos y sistemas contra amenazas cibernéticas. <br><br>El especialista en ciberseguridad será responsable de identificar vulnerabilidades, implementar medidas de protección y capacitar al personal. <br><br>Además, deberá mantenerse actualizado con las últimas tendencias en seguridad informática.', 4, 2, 1, '4000.00', '6000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:26:18', 'San Francisco', '<ul><li>Identificar vulnerabilidades en sistemas y redes.</li><li>Implementar medidas de protección contra amenazas cibernéticas.</li><li>Capacitar al personal en prácticas de seguridad.</li><li>Mantenerse actualizado con las últimas tendencias en ciberseguridad.</li></ul>', '<ul><li>Certificación en ciberseguridad (CEH, CISSP).</li><li>Experiencia en implementación de firewalls y sistemas de detección de intrusiones.</li><li>Conocimiento de normativas de cumplimiento (GDPR, HIPAA).</li><li>Habilidades de análisis y resolución de problemas.</li></ul>', 1, 'Urgent'),
(11, 3, 'Diseñador Gráfico', 'Diseño gráfico creativo para campañas publicitarias y contenido digital. <br><br>El diseñador gráfico será responsable de crear banners, logotipos y otros materiales visuales atractivos. <br><br>Además, deberá colaborar con el equipo de marketing para asegurar que el diseño cumpla con los objetivos de la marca.', 3, 3, 2, '2500.00', '4000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Diseñar banners y logotipos para campañas digitales.</li><li>Colaborar con el equipo de marketing para alinear diseños con objetivos de marca.</li><li>Optimizar imágenes para su uso en plataformas digitales.</li><li>Mantener una biblioteca de recursos gráficos organizada.</li></ul>', '<ul><li>Experiencia en diseño gráfico con Photoshop e Illustrator.</li><li>Conocimiento de principios de diseño visual y tipografía.</li><li>Familiaridad con herramientas de edición de video como After Effects.</li><li>Habilidades de comunicación y trabajo en equipo.</li></ul>', 0, 'Normal'),
(12, 3, 'Ejecutivo de Ventas', 'Venta de soluciones en la nube a clientes corporativos. <br><br>El ejecutivo de ventas será responsable de identificar oportunidades, contactar clientes potenciales y cerrar acuerdos. <br><br>Además, deberá mantener relaciones sólidas con los clientes existentes para fomentar la retención.', 2, 4, 3, '3000.00', '4500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Contactar clientes potenciales y presentar soluciones en la nube.</li><li>Negociar contratos y cerrar acuerdos con clientes.</li><li>Mantener relaciones con clientes existentes para asegurar la retención.</li><li>Colaborar con el equipo técnico para resolver consultas de clientes.</li></ul>', '<ul><li>Experiencia en ventas B2B o soluciones tecnológicas.</li><li>Conocimiento de servicios en la nube como AWS o Azure.</li><li>Habilidades de negociación y cierre de ventas.</li><li>Orientación a resultados y capacidad para trabajar bajo presión.</li></ul>', 1, 'High'),
(13, 4, 'Diseñador de Interfaces', 'Diseño de interfaces colaborativas para aplicaciones web y móviles. <br><br>El diseñador de interfaces será responsable de crear prototipos interactivos y garantizar que las interfaces sean intuitivas y accesibles. <br><br>Además, deberá trabajar en estrecha colaboración con el equipo de desarrollo para implementar los diseños.', 3, 1, 1, '3000.00', '5000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Crear prototipos interactivos para nuevas aplicaciones.</li><li>Realizar pruebas de usabilidad y recopilar feedback de los usuarios.</li><li>Colaborar con desarrolladores para implementar diseños.</li><li>Mantener la consistencia visual en todas las plataformas.</li></ul>', '<ul><li>Experiencia en diseño de interfaces con Figma y Sketch.</li><li>Conocimiento de principios de diseño UX/UI.</li><li>Familiaridad con HTML, CSS y JavaScript para prototipado básico.</li><li>Habilidades de comunicación y trabajo en equipo.</li></ul>', 1, 'Normal'),
(14, 4, 'Desarrollador Frontend', 'Desarrollo de interfaces web utilizando tecnologías modernas como React y JavaScript. <br><br>El desarrollador frontend será responsable de implementar diseños proporcionados por el equipo de diseño y optimizar el rendimiento de las aplicaciones. <br><br>Además, deberá realizar pruebas unitarias y de integración para garantizar la calidad del código.', 4, 2, 1, '3500.00', '5500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Implementar diseños en HTML/CSS y JavaScript.</li><li>Optimizar el rendimiento de las aplicaciones frontend.</li><li>Realizar pruebas unitarias y de integración.</li><li>Colaborar con el equipo de backend para integrar APIs.</li></ul>', '<ul><li>Experiencia en desarrollo frontend con React y JavaScript.</li><li>Conocimiento de frameworks CSS como Bootstrap o Tailwind.</li><li>Familiaridad con herramientas de control de versiones como Git.</li><li>Habilidades de resolución de problemas y pensamiento crítico.</li></ul>', 1, 'High'),
(15, 4, 'Especialista en Marketing de Contenidos', 'Creación de contenido digital para campañas de marketing y blogs. <br><br>El especialista en marketing de contenidos será responsable de redactar artículos, blogs y otros materiales para atraer y retener a la audiencia. <br><br>Además, deberá optimizar el contenido para mejorar el SEO y aumentar el tráfico orgánico.', 2, 3, 2, '2000.00', '3500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Redactar artículos y blogs para campañas de marketing.</li><li>Optimizar el contenido para mejorar el SEO.</li><li>Colaborar con el equipo de diseño para crear contenido visual.</li><li>Analizar métricas de rendimiento del contenido.</li></ul>', '<ul><li>Experiencia en redacción de contenido y SEO.</li><li>Conocimiento de herramientas de análisis como Google Analytics.</li><li>Familiaridad con plataformas de gestión de contenido como WordPress.</li><li>Habilidades de comunicación escrita y creatividad.</li></ul>', 0, 'Low'),
(16, 4, 'Analista de Recursos Humanos', 'Gestión de talento humano para reclutar y seleccionar personal. <br><br>El analista de recursos humanos será responsable de publicar ofertas de empleo, revisar currículums y coordinar entrevistas. <br><br>Además, deberá mantenerse actualizado con las mejores prácticas en reclutamiento y selección.', 5, 4, 3, '3000.00', '4500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Publicar ofertas de empleo en plataformas de reclutamiento.</li><li>Revisar currículums y evaluar candidatos.</li><li>Coordinar entrevistas con los candidatos seleccionados.</li><li>Mantenerse actualizado con las mejores prácticas en reclutamiento.</li></ul>', '<ul><li>Experiencia en reclutamiento y selección de personal.</li><li>Conocimiento de herramientas de gestión de talento como LinkedIn Recruiter.</li><li>Familiaridad con procesos de onboarding y capacitación.</li><li>Habilidades de comunicación y organización.</li></ul>', 1, 'Urgent'),
(17, 5, 'Instructor de Cursos Online', 'Creación de cursos educativos en línea para plataformas de aprendizaje. <br><br>El instructor será responsable de grabar y editar videos educativos, así como de diseñar planes de estudio atractivos. <br><br>Además, deberá interactuar con los estudiantes para responder preguntas y proporcionar retroalimentación.', 4, 1, 1, '2500.00', '4000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Grabar y editar videos educativos para cursos en línea.</li><li>Diseñar planes de estudio atractivos y estructurados.</li><li>Interactuar con los estudiantes para responder preguntas.</li><li>Proporcionar retroalimentación constructiva sobre los avances de los estudiantes.</li></ul>', '<ul><li>Experiencia en enseñanza o capacitación en línea.</li><li>Conocimiento de herramientas de edición de video como Camtasia o Premiere Pro.</li><li>Familiaridad con plataformas de aprendizaje como Moodle o Teachable.</li><li>Habilidades de comunicación verbal y escrita.</li></ul>', 1, 'Normal'),
(18, 5, 'Diseñador de Cursos', 'Diseño de planes de estudio para programas educativos en línea. <br><br>El diseñador de cursos será responsable de estructurar contenido educativo y asegurarse de que sea claro y atractivo. <br><br>Además, deberá colaborar con instructores y expertos en la materia para desarrollar materiales de alta calidad.', 3, 2, 1, '3000.00', '4500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Estructurar contenido educativo para programas en línea.</li><li>Colaborar con instructores y expertos en la materia.</li><li>Diseñar actividades y evaluaciones para los estudiantes.</li><li>Mantenerse actualizado con las mejores prácticas en diseño educativo.</li></ul>', '<ul><li>Experiencia en diseño educativo o desarrollo de currículum.</li><li>Conocimiento de metodologías de aprendizaje activo y gamificación.</li><li>Familiaridad con herramientas de autoría como Articulate o Captivate.</li><li>Habilidades de organización y atención al detalle.</li></ul>', 1, 'High'),
(19, 5, 'Especialista en Comunidad', 'Gestión de comunidades online para fomentar la participación y el engagement. <br><br>El especialista en comunidad será responsable de moderar foros, redes sociales y otros canales de comunicación. <br><br>Además, deberá analizar métricas clave para medir el éxito de las estrategias comunitarias.', 2, 3, 2, '2000.00', '3500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:35:22', 'San Francisco', '<ul><li>Moderar foros y redes sociales para fomentar la participación.</li><li>Responder preguntas y resolver conflictos en la comunidad.</li><li>Analizar métricas de engagement y ajustar estrategias.</li><li>Colaborar con el equipo de marketing para alinear estrategias comunitarias.</li></ul>', '<ul><li>Experiencia en gestión de comunidades online.</li><li>Conocimiento de plataformas de redes sociales como Facebook, Instagram y LinkedIn.</li><li>Familiaridad con herramientas de análisis de redes sociales.</li><li>Habilidades de comunicación y resolución de conflictos.</li></ul>', 0, 'Normal'),
(20, 5, 'Analista de Datos Educativos', 'Análisis de métricas educativas para medir el rendimiento de los estudiantes y mejorar los programas académicos. <br><br>El analista será responsable de recopilar datos sobre el progreso de los estudiantes, identificar áreas de mejora y generar informes detallados. <br><br>Además, deberá colaborar con instructores y administradores para implementar cambios basados en los resultados obtenidos.', 1, 4, 3, '3500.00', '5000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:36:48', 'San Francisco', '<ul><li>Recopilar y analizar datos sobre el rendimiento de los estudiantes.</li><li>Identificar áreas de mejora en los programas académicos.</li><li>Generar informes detallados sobre métricas educativas.</li><li>Colaborar con instructores para implementar mejoras.</li></ul>', '<ul><li>Experiencia en análisis de datos educativos.</li><li>Conocimiento de herramientas de análisis como Excel y Tableau.</li><li>Familiaridad con sistemas de gestión del aprendizaje (LMS).</li><li>Habilidades de comunicación para presentar insights.</li></ul>', 1, 'Urgent'),
(21, 6, 'Desarrollador Backend', 'Desarrollo de APIs y servicios backend utilizando tecnologías modernas como Node.js y Python. <br><br>El desarrollador backend será responsable de diseñar, implementar y mantener sistemas escalables y seguros. <br><br>Además, deberá trabajar en estrecha colaboración con el equipo frontend para garantizar una integración fluida.', 4, 1, 1, '4000.00', '6000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:36:48', 'San Francisco', '<ul><li>Diseñar e implementar APIs RESTful.</li><li>Optimizar el rendimiento de los servicios backend.</li><li>Colaborar con el equipo frontend para integrar APIs.</li><li>Realizar pruebas unitarias y de integración.</li></ul>', '<ul><li>Experiencia en desarrollo backend con Node.js y Python.</li><li>Conocimiento de frameworks como Express o Django.</li><li>Familiaridad con bases de datos relacionales y no relacionales.</li><li>Habilidades de resolución de problemas y pensamiento crítico.</li></ul>', 1, 'Normal'),
(22, 6, 'Especialista en DevOps', 'Automatización de infraestructura y configuración de pipelines CI/CD para mejorar la eficiencia del desarrollo. <br><br>El especialista en DevOps será responsable de implementar herramientas de automatización, configurar pipelines y monitorear la infraestructura. <br><br>Además, deberá mantenerse actualizado con las últimas tendencias en DevOps y cloud computing.', 4, 2, 1, '4500.00', '6500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:36:48', 'San Francisco', '<ul><li>Configurar pipelines CI/CD para automatización.</li><li>Implementar herramientas de monitoreo y alertas.</li><li>Automatizar la configuración de servidores con herramientas como Ansible o Terraform.</li><li>Mantener la infraestructura en la nube segura y escalable.</li></ul>', '<ul><li>Experiencia en DevOps y automatización de infraestructura.</li><li>Conocimiento de herramientas como Docker, Kubernetes y Jenkins.</li><li>Familiaridad con plataformas cloud como AWS o Azure.</li><li>Habilidades de scripting con Bash o Python.</li></ul>', 1, 'High'),
(23, 6, 'Diseñador de Experiencia de Usuario', 'Diseño de experiencias centradas en el usuario para mejorar la satisfacción y el engagement. <br><br>El diseñador de experiencia de usuario será responsable de realizar investigaciones UX, crear prototipos interactivos y proponer mejoras basadas en feedback. <br><br>Además, deberá colaborar con equipos multifuncionales para garantizar que las soluciones sean implementadas correctamente.', 3, 3, 2, '3000.00', '4500.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:36:48', 'San Francisco', '<ul><li>Realizar investigaciones UX para comprender las necesidades de los usuarios.</li><li>Crear prototipos interactivos para nuevas funcionalidades.</li><li>Proponer mejoras basadas en feedback de los usuarios.</li><li>Colaborar con equipos de desarrollo para implementar soluciones.</li></ul>', '<ul><li>Experiencia en diseño UX/UI y creación de prototipos.</li><li>Conocimiento de herramientas como Figma, Sketch o Adobe XD.</li><li>Familiaridad con metodologías de investigación UX.</li><li>Habilidades de comunicación y trabajo en equipo.</li></ul>', 0, 'Normal'),
(24, 6, 'Ejecutivo de Cuentas', 'Gestión de cuentas corporativas para aumentar las ventas y fomentar relaciones a largo plazo con los clientes. <br><br>El ejecutivo de cuentas será responsable de negociar contratos, resolver consultas de clientes y asegurar la satisfacción del cliente. <br><br>Además, deberá identificar oportunidades de upselling y cross-selling para maximizar el valor del cliente.', 2, 4, 3, '3500.00', '5000.00', NULL, 1, '2025-02-27 17:26:34', '2025-03-02 15:36:48', 'San Francisco', '<ul><li>Negociar contratos con clientes corporativos.</li><li>Resolver consultas y problemas de los clientes.</li><li>Identificar oportunidades de upselling y cross-selling.</li><li>Mantener relaciones sólidas con los clientes existentes.</li></ul>', '<ul><li>Experiencia en gestión de cuentas corporativas.</li><li>Conocimiento de técnicas de negociación y cierre de ventas.</li><li>Familiaridad con CRM como Salesforce o HubSpot.</li><li>Habilidades de comunicación y orientación al cliente.</li></ul>', 1, 'Urgent');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL COMMENT 'ID único de la postulación',
  `job_id` int(11) NOT NULL COMMENT 'ID del trabajo al que se postula (relacionado con la tabla jobs)',
  `user_id` int(11) NOT NULL COMMENT 'ID del usuario que postula (relacionado con la tabla users)',
  `cv_id` int(11) NOT NULL COMMENT 'ID del CV utilizado para la postulación (relacionado con la tabla candidate_cv)',
  `status` enum('aplicado','revisando','entrevista','rechazado','contratado') DEFAULT 'aplicado' COMMENT 'Estado actual de la postulación',
  `cover_letter` text DEFAULT NULL COMMENT 'Carta de presentación adjunta (opcional)',
  `application_method` varchar(50) DEFAULT NULL COMMENT 'Método de postulación (ej: plataforma, correo electrónico, LinkedIn)',
  `interview_date` datetime DEFAULT NULL COMMENT 'Fecha de la entrevista (si aplica)',
  `response_date` datetime DEFAULT NULL COMMENT 'Fecha de respuesta de la empresa (si aplica)',
  `response_notes` text DEFAULT NULL COMMENT 'Notas o comentarios de la empresa sobre la postulación',
  `referral_source` varchar(255) DEFAULT NULL COMMENT 'Fuente de referido (ej: nombre de un contacto interno o plataforma de reclutamiento)',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'Fecha de eliminación lógica (soft delete)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha y hora de la postulación',
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Fecha y hora de actualización'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla para registrar las postulaciones de los candidatos a trabajos';

--
-- Volcado de datos para la tabla `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `user_id`, `cv_id`, `status`, `cover_letter`, `application_method`, `interview_date`, `response_date`, `response_notes`, `referral_source`, `deleted_at`, `created_at`, `update_at`) VALUES
(2, 4, 8, 14, 'aplicado', 'Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas, Pruebas', NULL, NULL, NULL, NULL, NULL, NULL, '2025-03-09 02:53:36', '2025-03-09 02:53:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_types`
--

CREATE TABLE `job_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `name_es` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `name_es`) VALUES
(1, 'Remote', 'Remoto'),
(2, 'On-site', 'Presencial'),
(3, 'Hybrid', 'Híbrido'),
(4, 'Temporary', 'Temporal'),
(5, 'Permanent', 'Permanente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profanity_words`
--

CREATE TABLE `profanity_words` (
  `id` int(11) NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profanity_words`
--

INSERT INTO `profanity_words` (`id`, `word`) VALUES
(617, 'al diablo contigo'),
(1654, 'boba'),
(1656, 'bobas'),
(574, 'bobo'),
(1653, 'bobo'),
(1655, 'bobos'),
(580, 'cabrón'),
(619, 'cabrónazo'),
(632, 'cagada'),
(588, 'cagar'),
(1645, 'cagón'),
(1646, 'cagona'),
(1648, 'cagonas'),
(1647, 'cagones'),
(1682, 'cara e bola'),
(1683, 'cara e bolá'),
(1684, 'cara e bolás'),
(1748, 'carajita'),
(1750, 'carajitas'),
(1747, 'carajito'),
(1749, 'carajitos'),
(1626, 'chimba'),
(1628, 'chimbas'),
(1625, 'chimbo'),
(1627, 'chimbos'),
(591, 'chingada'),
(598, 'chingadazo'),
(599, 'chingadera'),
(600, 'chingadito'),
(592, 'chingado'),
(593, 'chingados'),
(643, 'chingaladas'),
(644, 'chingalado'),
(605, 'chingalados'),
(604, 'chingaleras'),
(642, 'chingalero'),
(603, 'chingaleros'),
(601, 'chingalete'),
(602, 'chingalón'),
(641, 'chingalote'),
(594, 'chingaos'),
(590, 'chingar'),
(596, 'chingón'),
(595, 'chingona'),
(597, 'chingones'),
(1630, 'chiva'),
(1632, 'chivas'),
(1629, 'chivo'),
(1631, 'chivos'),
(1741, 'chupamedias'),
(1742, 'chupamedias'),
(1691, 'comemierda'),
(1692, 'comemierdas'),
(1642, 'coñaza'),
(1644, 'coñazas'),
(1641, 'coñazo'),
(1643, 'coñazos'),
(582, 'coño'),
(587, 'culo'),
(615, 'déjame en paz, idiota'),
(1666, 'desgraciada'),
(1668, 'desgraciadas'),
(1665, 'desgraciado'),
(1667, 'desgraciados'),
(612, 'eres un desgraciado'),
(571, 'estúpido'),
(576, 'gilipollas'),
(623, 'gonorrea'),
(1722, 'güarapa'),
(1724, 'güarapas'),
(1721, 'güarapo'),
(1723, 'güarapos'),
(1657, 'güevón'),
(1658, 'güevona'),
(1660, 'güevonas'),
(1659, 'güevones'),
(1726, 'güevuda'),
(1728, 'güevudas'),
(1725, 'güevudo'),
(1727, 'güevudos'),
(627, 'güey'),
(1717, 'güisqui'),
(1718, 'güisquia'),
(1720, 'güisquias'),
(1719, 'güisquis'),
(581, 'hijo de puta'),
(1669, 'hijueputa'),
(1670, 'hijueputas'),
(1617, 'huevón'),
(1618, 'huevona'),
(1620, 'huevonas'),
(1619, 'huevones'),
(570, 'idiota'),
(572, 'imbécil'),
(583, 'joder'),
(636, 'jodida'),
(635, 'jodido'),
(1700, 'lagarta'),
(1702, 'lagartas'),
(1699, 'lagarto'),
(1701, 'lagartos'),
(1744, 'lamecula'),
(1746, 'lameculas'),
(1743, 'lameculos'),
(1745, 'lameculos'),
(616, 'lárgate, imbécil'),
(1710, 'malandra'),
(1712, 'malandras'),
(1709, 'malandro'),
(1711, 'malandros'),
(1662, 'maldita'),
(1664, 'malditas'),
(1661, 'maldito'),
(1663, 'malditos'),
(1610, 'malparida'),
(1612, 'malparidas'),
(1609, 'malparido'),
(1611, 'malparidos'),
(633, 'mamada'),
(634, 'mamadera'),
(1638, 'mamagueva'),
(1640, 'mamaguevas'),
(1637, 'mamaguevo'),
(1639, 'mamaguevos'),
(1738, 'mamarracha'),
(1740, 'mamarrachas'),
(1737, 'mamarracho'),
(1739, 'mamarrachos'),
(620, 'mamón'),
(621, 'mamona'),
(1689, 'mango bajitá'),
(1690, 'mango bajitás'),
(1688, 'mango bajito'),
(1672, 'marica'),
(1671, 'marico'),
(584, 'maricón'),
(628, 'maricona'),
(629, 'maricones'),
(1673, 'maricones'),
(606, 'me importa un carajo'),
(607, 'me vale verga'),
(577, 'mierda'),
(638, 'mierdosa'),
(637, 'mierdoso'),
(614, 'no me jodas'),
(611, 'no seas tan pendejo'),
(1622, 'pajuera'),
(1624, 'pajueras'),
(1621, 'pajúo'),
(1623, 'pajúos'),
(1687, 'palo e mangás'),
(1685, 'palo e mango'),
(1686, 'palo e mangó'),
(1650, 'pelada'),
(1652, 'peladas'),
(1649, 'pelao'),
(1651, 'pelaos'),
(1752, 'pelotuda'),
(1754, 'pelotudas'),
(1751, 'pelotudo'),
(1753, 'pelotudos'),
(1734, 'pelucha'),
(1736, 'peluchas'),
(1733, 'peluche'),
(1735, 'peluches'),
(1614, 'pendeja'),
(1616, 'pendejas'),
(640, 'pendejete'),
(639, 'pendejez'),
(585, 'pendejo'),
(1613, 'pendejo'),
(1615, 'pendejos'),
(630, 'perra'),
(1678, 'piche'),
(1680, 'piches'),
(1730, 'pichirra'),
(1732, 'pichirras'),
(1729, 'pichirre'),
(1731, 'pichirres'),
(1679, 'pichona'),
(1681, 'pichonas'),
(624, 'pichurria'),
(625, 'pichurro'),
(622, 'pinche'),
(1714, 'pitufa'),
(1716, 'pitufas'),
(1713, 'pitufo'),
(1715, 'pitufo'),
(578, 'puta'),
(618, 'putada'),
(579, 'puto'),
(613, 'qué asco de persona'),
(609, 'que te den'),
(610, 'que te follen'),
(1703, 'rata'),
(1704, 'ratas'),
(1634, 'sapa'),
(1636, 'sapas'),
(1633, 'sapo'),
(1705, 'saporrín'),
(1706, 'saporrina'),
(1708, 'saporrinas'),
(1707, 'saporrines'),
(1635, 'sapos'),
(575, 'tarado'),
(573, 'tonto'),
(1693, 'tragabolá'),
(1694, 'tragabolas'),
(1696, 'tronca'),
(1698, 'troncas'),
(1695, 'tronco'),
(1697, 'troncos'),
(586, 'verga'),
(631, 'vergazo'),
(608, 'vete a la mierda'),
(626, 'wey'),
(1675, 'zarrapastrosa'),
(1677, 'zarrapastrosas'),
(1674, 'zarrapastroso'),
(1676, 'zarrapastrosos'),
(589, 'zorra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(3, 'Company'),
(2, 'Individual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salary_ranges`
--

CREATE TABLE `salary_ranges` (
  `id` int(11) NOT NULL,
  `range_label` varchar(50) NOT NULL,
  `min_value` decimal(10,2) NOT NULL,
  `max_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salary_ranges`
--

INSERT INTO `salary_ranges` (`id`, `range_label`, `min_value`, `max_value`) VALUES
(1, '$0 - $500', '0.00', '500.00'),
(2, '$500 - $1000', '500.00', '1000.00'),
(3, '$1000 - $1500', '1000.00', '1500.00'),
(4, '$1500 - $3000', '1500.00', '3000.00'),
(5, '> $3000', '3000.00', '100000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saved_jobs`
--

CREATE TABLE `saved_jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `saved_jobs`
--

INSERT INTO `saved_jobs` (`id`, `user_id`, `job_id`, `created_at`) VALUES
(5, 8, 18, '2025-03-06 11:41:01'),
(6, 8, 16, '2025-03-06 11:42:29'),
(7, 8, 8, '2025-03-06 11:43:48'),
(14, 8, 9, '2025-03-06 12:02:48'),
(17, 8, 3, '2025-03-06 13:45:36'),
(18, 8, 24, '2025-03-07 23:20:21'),
(23, 8, 2, '2025-03-08 10:10:49'),
(24, 8, 15, '2025-03-08 10:12:24'),
(26, 8, 4, '2025-03-08 23:15:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `search_logs`
--

CREATE TABLE `search_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `query` varchar(255) NOT NULL,
  `ip_address` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `search_logs`
--

INSERT INTO `search_logs` (`id`, `user_id`, `query`, `ip_address`, `created_at`) VALUES
(1, 1, 'desarrollo', '127.0.0.1', '2025-03-03 07:32:57'),
(2, 1, 'desarrollo web', '127.0.0.1', '2025-03-03 07:33:34'),
(3, 1, 'desarrollador', '127.0.0.1', '2025-03-03 07:45:20'),
(4, 1, 'web', '127.0.0.1', '2025-03-03 07:48:24'),
(5, 1, 'desarrollo web', '127.0.0.1', '2025-03-03 07:48:54'),
(6, 1, 'web', '127.0.0.1', '2025-03-03 08:44:57'),
(7, 1, 'desarrollador', '127.0.0.1', '2025-03-03 08:45:12'),
(8, 1, 'php', '127.0.0.1', '2025-03-03 08:45:43'),
(9, 1, 'php', '127.0.0.1', '2025-03-03 08:45:48'),
(10, 1, 'php', '127.0.0.1', '2025-03-03 09:09:06'),
(11, 1, 'php', '127.0.0.1', '2025-03-03 09:09:10'),
(12, 1, 'desarrollo web', '127.0.0.1', '2025-03-03 09:12:19'),
(13, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:12:31'),
(14, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:13:13'),
(15, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:14:28'),
(16, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:14:43'),
(17, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:15:20'),
(18, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:15:50'),
(19, 1, 'desarrollo', '127.0.0.1', '2025-03-03 09:15:57'),
(20, 1, 'web', '127.0.0.1', '2025-03-03 09:16:13'),
(21, 1, 'web', '127.0.0.1', '2025-03-03 09:18:14'),
(22, 1, 'recursos', '127.0.0.1', '2025-03-03 09:18:39'),
(23, 1, 'desarrollador', '127.0.0.1', '2025-03-03 09:19:54'),
(24, 1, 'desarrollador', '127.0.0.1', '2025-03-03 09:20:10'),
(25, 1, 'desarrollador', '127.0.0.1', '2025-03-03 09:20:17'),
(26, 1, 'python', '127.0.0.1', '2025-03-03 09:26:47'),
(27, 1, 'recursos humanos', '127.0.0.1', '2025-03-03 09:43:25'),
(28, 1, 'desarrollo web', '127.0.0.1', '2025-03-06 10:16:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `skills`
--

INSERT INTO `skills` (`id`, `user_id`, `name`, `level`, `created_at`, `updated_at`) VALUES
(1, 8, 'PHP', 90, '2025-03-04 21:58:11', '2025-03-04 21:58:11'),
(2, 8, 'JAVASCRIPT', 97, '2025-03-04 21:58:11', '2025-03-06 00:34:58'),
(3, 8, 'CSS', 97, '2025-03-05 13:27:14', '2025-03-05 13:27:14'),
(5, 8, 'SCSS', 89, '2025-03-06 00:15:43', '2025-03-06 13:13:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `code`) VALUES
(1, 1, 'Distrito Capital', 'DC'),
(2, 1, 'Zulia', 'ZU'),
(3, 1, 'Carabobo', 'CA'),
(4, 1, 'Miranda', 'MI'),
(5, 2, 'Bogotá', 'BO'),
(6, 2, 'Antioquia', 'AN'),
(7, 2, 'Valle del Cauca', 'VC'),
(8, 2, 'Atlántico', 'AT'),
(9, 3, 'Florida', 'FL'),
(10, 3, 'Texas', 'TX'),
(11, 3, 'California', 'CA'),
(12, 3, 'New York', 'NY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `uid`, `role_id`, `email`, `password_hash`, `name`, `created_at`, `updated_at`, `last_login`, `is_active`) VALUES
(1, '65668c2a5d9b7', 1, 'pcontramaestre@gmail.com', '', 'Pablo Contramaestre', '2025-02-27 15:40:59', '2025-03-08 11:31:11', NULL, 1),
(2, '65668c2a5d9be', 3, 'info@udemy.com', '', 'Info Udemy', '2025-02-27 15:40:59', '2025-03-08 11:31:21', NULL, 1),
(3, '65668c2a5d9c5', 3, 'info@stripe.com', '', 'Info Stripe', '2025-02-27 15:40:59', '2025-03-08 11:31:27', NULL, 1),
(4, '65668c2a5d9cc', 3, 'info@dropbox.com', '', 'Info DropBox', '2025-02-27 15:40:59', '2025-03-08 11:31:35', NULL, 1),
(5, '65668c2a5d9d3', 3, 'info@figma.com', '', 'Info Figma', '2025-02-27 15:40:59', '2025-03-08 11:31:41', NULL, 1),
(6, '65668c2a5d9da', 3, 'info@udemy2.com', '', 'Info Udemy 2', '2025-02-27 15:43:16', '2025-03-08 11:31:47', NULL, 1),
(7, '65668c2a5d9e1', 3, 'info@stirpe.com', '', 'Info Stripe 2', '2025-02-27 15:43:16', '2025-03-08 11:31:53', NULL, 1),
(8, '65668c2a5d9e8', 2, 'pablo@icreativadigital.com', '', 'pablo', '2025-03-04 16:34:05', '2025-03-08 11:32:00', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logo_path` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `allow_show_phone` tinyint(1) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `education_levels` text DEFAULT NULL,
  `languages` text DEFAULT NULL,
  `allow_in_search_listing` tinyint(1) DEFAULT NULL,
  `description_profile` text DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `complete_address` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `current_salary_range_id` int(11) DEFAULT NULL,
  `expected_salary_range_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `description`, `created_at`, `updated_at`, `logo_path`, `full_name`, `job_title`, `phone`, `allow_show_phone`, `email_address`, `website`, `experience`, `age`, `education_levels`, `languages`, `allow_in_search_listing`, `description_profile`, `country_id`, `city_id`, `complete_address`, `facebook`, `twitter`, `linkedin`, `current_salary_range_id`, `expected_salary_range_id`) VALUES
(8, 'Esto es otra prueba de guardado', '2025-03-04 20:34:54', '2025-03-06 12:27:37', 'uploads/67c994b929542_candidate-1.webp', 'Pablo Contramaestre ', 'Developer Pablo', '123123123', 1, 'pcontramaestre@gmail.com', 'https://www.mercadotrabajo.com', '10', 21, 'Universitario', 'Español, Ingles', 1, 'Esto es otra prueba de guardado', 1, 1, 'Prueba de direccion 2222', 'www.facebook.com/pcontramaestre', '@pcontramaestre', 'pcontramaestre', 2, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `candidate_cv`
--
ALTER TABLE `candidate_cv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_file` (`user_id`,`filename`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `idx_city_name` (`name`);

--
-- Indices de la tabla `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_company_name` (`name`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indices de la tabla `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `employment_types`
--
ALTER TABLE `employment_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `job_type_id` (`job_type_id`),
  ADD KEY `employment_type_id` (`employment_type_id`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `city` (`city`);
ALTER TABLE `jobs` ADD FULLTEXT KEY `idx_search` (`title`,`job_description`);

--
-- Indices de la tabla `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `cv_id` (`cv_id`),
  ADD KEY `idx_status` (`status`) COMMENT 'Índice para filtrar por estado de la postulación',
  ADD KEY `idx_user_job` (`user_id`,`job_id`) COMMENT 'Índice para buscar postulaciones por usuario y trabajo',
  ADD KEY `idx_application_date` (`created_at`) COMMENT 'Índice para ordenar por fecha de postulación',
  ADD KEY `idx_deleted_at` (`deleted_at`) COMMENT 'Índice para manejar eliminaciones lógicas';

--
-- Indices de la tabla `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `profanity_words`
--
ALTER TABLE `profanity_words`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_word` (`word`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `salary_ranges`
--
ALTER TABLE `salary_ranges`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_job` (`user_id`,`job_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indices de la tabla `search_logs`
--
ALTER TABLE `search_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_query` (`query`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_query_created_at` (`query`,`created_at`);

--
-- Indices de la tabla `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indices de la tabla `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `idx_user_profile_full_name` (`full_name`),
  ADD KEY `idx_user_profile_email_address` (`email_address`),
  ADD KEY `idx_user_profile_country_id` (`country_id`),
  ADD KEY `idx_user_profile_city_id` (`city_id`),
  ADD KEY `idx_user_profile_current_salary_range_id` (`current_salary_range_id`),
  ADD KEY `idx_user_profile_expected_salary_range_id` (`expected_salary_range_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `candidate_cv`
--
ALTER TABLE `candidate_cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del CV', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `employment_types`
--
ALTER TABLE `employment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID único de la postulación', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `profanity_words`
--
ALTER TABLE `profanity_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1755;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salary_ranges`
--
ALTER TABLE `salary_ranges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `saved_jobs`
--
ALTER TABLE `saved_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `search_logs`
--
ALTER TABLE `search_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidate_cv`
--
ALTER TABLE `candidate_cv`
  ADD CONSTRAINT `fk_candidate_cv_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Filtros para la tabla `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `jobs_ibfk_3` FOREIGN KEY (`job_type_id`) REFERENCES `job_types` (`id`),
  ADD CONSTRAINT `jobs_ibfk_4` FOREIGN KEY (`employment_type_id`) REFERENCES `employment_types` (`id`);

--
-- Filtros para la tabla `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_3` FOREIGN KEY (`cv_id`) REFERENCES `candidate_cv` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `saved_jobs`
--
ALTER TABLE `saved_jobs`
  ADD CONSTRAINT `saved_jobs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_jobs_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_current_salary_range` FOREIGN KEY (`current_salary_range_id`) REFERENCES `salary_ranges` (`id`),
  ADD CONSTRAINT `fk_expected_salary_range` FOREIGN KEY (`expected_salary_range_id`) REFERENCES `salary_ranges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
