-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-11-2016 a las 11:15:47
-- Versión del servidor: 5.5.52-0+deb8u1
-- Versión de PHP: 5.6.26-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `osticketdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_api_key`
--

CREATE TABLE IF NOT EXISTS `ost_api_key` (
`id` int(10) unsigned NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `ipaddr` varchar(64) NOT NULL,
  `apikey` varchar(255) NOT NULL,
  `can_create_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_exec_cron` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `notes` text,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_attachment`
--

CREATE TABLE IF NOT EXISTS `ost_attachment` (
  `object_id` int(11) unsigned NOT NULL,
  `type` char(1) NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `inline` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_attachment`
--

INSERT INTO `ost_attachment` (`object_id`, `type`, `file_id`, `inline`) VALUES
(1, 'C', 2, 0),
(8, 'T', 1, 1),
(9, 'T', 1, 1),
(10, 'T', 1, 1),
(11, 'T', 1, 1),
(12, 'T', 1, 1),
(13, 'T', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_canned_response`
--

CREATE TABLE IF NOT EXISTS `ost_canned_response` (
`canned_id` int(10) unsigned NOT NULL,
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `isenabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL DEFAULT '',
  `response` text NOT NULL,
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_canned_response`
--

INSERT INTO `ost_canned_response` (`canned_id`, `dept_id`, `isenabled`, `title`, `response`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 0, 1, '¿Qué es osTicket (ejemplo)?', 'osTicket es un sistema de Tickets de soporte de código abierto ampliamente utilizado, una alternativa atractiva a los sistemas de soporte al cliente más costosos y complejos - simple, ligero, confiable, abierto, basada en web y fácil de configurar y utilizar.', 'en_US', '', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(2, 0, 1, 'Ejemplo (con variables)', 'Hola %{ticket.name.first}, <br /><br /> Su Ticket #%{ticket.number} creado en %{ticket.create_date} está en el departamento %{ticket.dept.name}.', 'en_US', '', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_config`
--

CREATE TABLE IF NOT EXISTS `ost_config` (
`id` int(11) unsigned NOT NULL,
  `namespace` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_config`
--

INSERT INTO `ost_config` (`id`, `namespace`, `key`, `value`, `updated`) VALUES
(1, 'core', 'admin_email', 'miguelgalindez@unicauca.edu.co', '2016-10-27 15:56:28'),
(2, 'core', 'helpdesk_url', 'http://localhost/osticket/', '2016-10-27 15:56:28'),
(3, 'core', 'helpdesk_title', 'HelpDesk System', '2016-10-27 15:56:28'),
(4, 'core', 'schema_signature', 'b26f29a6bb5dbb3510b057632182d138', '2016-10-27 15:56:28'),
(5, 'dept.1', 'assign_members_only', '', '2016-10-27 15:56:27'),
(8, 'sla.1', 'transient', '0', '2016-10-27 15:56:27'),
(9, 'list.1', 'configuration', '{"handler":"TicketStatusList"}', '2016-10-27 15:56:28'),
(10, 'core', 'time_format', 'H:i', '2016-10-27 15:56:28'),
(11, 'core', 'date_format', 'm/d/a', '2016-10-27 15:56:28'),
(12, 'core', 'datetime_format', 'm/d/a g:i a', '2016-10-27 15:56:28'),
(13, 'core', 'daydatetime_format', 'D, j M A H:i', '2016-10-27 15:56:28'),
(14, 'core', 'default_timezone_id', '0', '2016-10-27 15:56:28'),
(15, 'core', 'default_priority_id', '2', '2016-10-27 15:56:28'),
(16, 'core', 'enable_daylight_saving', '0', '2016-10-27 15:56:28'),
(17, 'core', 'reply_separator', '--responder por encima de esta línea--', '2016-10-27 15:56:28'),
(18, 'core', 'allowed_filetypes', '.doc, .pdf, .jpg, .jpeg, .gif, .png, .xls, .docx, .xlsx, .txt', '2016-10-27 15:56:28'),
(19, 'core', 'isonline', '1', '2016-10-27 15:56:28'),
(20, 'core', 'staff_ip_binding', '0', '2016-10-27 15:56:28'),
(21, 'core', 'staff_max_logins', '4', '2016-10-27 15:56:28'),
(22, 'core', 'staff_login_timeout', '2', '2016-10-27 15:56:28'),
(23, 'core', 'staff_session_timeout', '30', '2016-10-27 15:56:28'),
(24, 'core', 'passwd_reset_period', '0', '2016-10-27 15:56:28'),
(25, 'core', 'client_max_logins', '4', '2016-10-27 15:56:28'),
(26, 'core', 'client_login_timeout', '2', '2016-10-27 15:56:28'),
(27, 'core', 'client_session_timeout', '30', '2016-10-27 15:56:28'),
(28, 'core', 'max_page_size', '25', '2016-10-27 15:56:28'),
(29, 'core', 'max_open_tickets', '0', '2016-10-27 15:56:28'),
(30, 'core', 'max_file_size', '1048576', '2016-10-27 15:56:28'),
(31, 'core', 'max_user_file_uploads', '1', '2016-10-27 15:56:28'),
(32, 'core', 'max_staff_file_uploads', '1', '2016-10-27 15:56:28'),
(33, 'core', 'autolock_minutes', '3', '2016-10-27 15:56:28'),
(34, 'core', 'default_smtp_id', '0', '2016-10-27 15:56:28'),
(35, 'core', 'use_email_priority', '0', '2016-10-27 15:56:28'),
(36, 'core', 'enable_kb', '0', '2016-10-27 15:56:28'),
(37, 'core', 'enable_premade', '1', '2016-10-27 15:56:28'),
(38, 'core', 'enable_captcha', '0', '2016-10-27 15:56:28'),
(39, 'core', 'enable_auto_cron', '0', '2016-10-27 15:56:28'),
(40, 'core', 'enable_mail_polling', '0', '2016-10-27 15:56:28'),
(41, 'core', 'send_sys_errors', '1', '2016-10-27 15:56:28'),
(42, 'core', 'send_sql_errors', '1', '2016-10-27 15:56:28'),
(43, 'core', 'send_login_errors', '1', '2016-10-27 15:56:28'),
(44, 'core', 'save_email_headers', '1', '2016-10-27 15:56:28'),
(45, 'core', 'strip_quoted_reply', '1', '2016-10-27 15:56:28'),
(46, 'core', 'ticket_autoresponder', '0', '2016-10-27 15:56:28'),
(47, 'core', 'message_autoresponder', '0', '2016-10-27 15:56:28'),
(48, 'core', 'ticket_notice_active', '1', '2016-10-27 15:56:28'),
(49, 'core', 'ticket_alert_active', '1', '2016-10-27 15:56:28'),
(50, 'core', 'ticket_alert_admin', '1', '2016-10-27 15:56:28'),
(51, 'core', 'ticket_alert_dept_manager', '1', '2016-10-27 15:56:28'),
(52, 'core', 'ticket_alert_dept_members', '0', '2016-10-27 15:56:28'),
(53, 'core', 'message_alert_active', '1', '2016-10-27 15:56:28'),
(54, 'core', 'message_alert_laststaff', '1', '2016-10-27 15:56:28'),
(55, 'core', 'message_alert_assigned', '1', '2016-10-27 15:56:28'),
(56, 'core', 'message_alert_dept_manager', '0', '2016-10-27 15:56:28'),
(57, 'core', 'note_alert_active', '0', '2016-10-27 15:56:28'),
(58, 'core', 'note_alert_laststaff', '1', '2016-10-27 15:56:28'),
(59, 'core', 'note_alert_assigned', '1', '2016-10-27 15:56:28'),
(60, 'core', 'note_alert_dept_manager', '0', '2016-10-27 15:56:28'),
(61, 'core', 'transfer_alert_active', '0', '2016-10-27 15:56:28'),
(62, 'core', 'transfer_alert_assigned', '0', '2016-10-27 15:56:28'),
(63, 'core', 'transfer_alert_dept_manager', '1', '2016-10-27 15:56:28'),
(64, 'core', 'transfer_alert_dept_members', '0', '2016-10-27 15:56:28'),
(65, 'core', 'overdue_alert_active', '1', '2016-10-27 15:56:28'),
(66, 'core', 'overdue_alert_assigned', '1', '2016-10-27 15:56:28'),
(67, 'core', 'overdue_alert_dept_manager', '1', '2016-10-27 15:56:28'),
(68, 'core', 'overdue_alert_dept_members', '0', '2016-10-27 15:56:28'),
(69, 'core', 'assigned_alert_active', '1', '2016-10-27 15:56:28'),
(70, 'core', 'assigned_alert_staff', '1', '2016-10-27 15:56:28'),
(71, 'core', 'assigned_alert_team_lead', '0', '2016-10-27 15:56:28'),
(72, 'core', 'assigned_alert_team_members', '0', '2016-10-27 15:56:28'),
(73, 'core', 'auto_claim_tickets', '1', '2016-10-27 15:56:28'),
(74, 'core', 'show_related_tickets', '0', '2016-11-07 16:13:59'),
(75, 'core', 'show_assigned_tickets', '1', '2016-10-27 15:56:28'),
(76, 'core', 'show_answered_tickets', '0', '2016-10-27 15:56:28'),
(77, 'core', 'hide_staff_name', '0', '2016-10-27 15:56:28'),
(78, 'core', 'overlimit_notice_active', '0', '2016-10-27 15:56:28'),
(79, 'core', 'email_attachments', '1', '2016-10-27 15:56:28'),
(80, 'core', 'number_format', '######', '2016-10-27 15:56:28'),
(81, 'core', 'sequence_id', '1', '2016-11-07 16:13:59'),
(82, 'core', 'log_level', '2', '2016-10-27 15:56:28'),
(83, 'core', 'log_graceperiod', '12', '2016-10-27 15:56:28'),
(84, 'core', 'client_registration', 'public', '2016-10-27 15:56:28'),
(85, 'core', 'landing_page_id', '1', '2016-10-27 15:56:28'),
(86, 'core', 'thank-you_page_id', '2', '2016-10-27 15:56:28'),
(87, 'core', 'offline_page_id', '3', '2016-10-27 15:56:28'),
(88, 'core', 'system_language', 'es_ES', '2016-10-27 15:56:28'),
(89, 'mysqlsearch', 'reindex', '0', '2016-10-27 16:04:21'),
(90, 'core', 'default_email_id', '1', '2016-10-27 15:56:28'),
(91, 'core', 'alert_email_id', '2', '2016-10-27 15:56:28'),
(92, 'core', 'default_dept_id', '1', '2016-10-27 15:56:28'),
(93, 'core', 'default_sla_id', '1', '2016-10-27 15:56:28'),
(94, 'core', 'default_template_id', '1', '2016-10-27 15:56:28'),
(95, 'dept.4', 'assign_members_only', 'on', '2016-10-27 16:21:25'),
(96, 'pwreset', '85FvgRv0Q3KcamqAP2sPZTuEOnp2M16CbQ09BZa858sxaAs1', '2', '2016-10-27 16:53:42'),
(98, 'dept.5', 'assign_members_only', 'on', '2016-10-27 16:58:21'),
(99, 'pwreset', 'ToRRmqtJOWEInG_KrJVDnia1nXwtYlFQNgQzdqR1mtizW2MO', '4', '2016-10-27 16:59:58'),
(100, 'core', 'default_help_topic', '0', '2016-11-07 16:13:59'),
(101, 'core', 'default_ticket_status_id', '1', '2016-11-07 16:13:59'),
(102, 'core', 'enable_html_thread', '1', '2016-11-07 16:13:59'),
(103, 'core', 'allow_client_updates', '0', '2016-11-07 16:13:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_content`
--

CREATE TABLE IF NOT EXISTS `ost_content` (
`id` int(10) unsigned NOT NULL,
  `content_id` int(10) unsigned NOT NULL DEFAULT '0',
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` varchar(32) NOT NULL DEFAULT 'other',
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_content`
--

INSERT INTO `ost_content` (`id`, `content_id`, `isactive`, `type`, `name`, `body`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 1, 1, 'landing', 'Página de inicio', '<h1>¡ Bienvenido al centro de soporte</h1> <p>Con el fin de agilizar las solicitudes de soporte y tener un mejor servicio, utilizamos un sistema de Tickets de soporte. Cada solicitud de soporte se le asigna a un número de Ticket único que se puede utilizar para rastrear el progreso y respuestas en línea. Para su referencia proporcionamos archivos completos y la historia de todas sus peticiones de ayuda. Es necesaria una dirección válida de correo electrónico para presentar Ticket. </p>', 'es_ES', 'La Página de Destino se refiere al contenido de la vista inicial del Portal del Cliente. La plantilla modifica el contenido visto por encima de los dos enlaces <strong>Abrir un Ticket Nuevo</strong> y <strong>Comprobar Estado del Ticket</strong>.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(2, 2, 1, 'thank-you', 'Gracias', '<div>%{ticket.name},\n<br>\n<br>\nGracias por ponerse en contacto con nosotros.\n<br>\n<br><p>Su solicitud de soporte ha sido creado y un representante se pondrá en breve en contacto con usted si es necesario.</p> El Equipo de soporte </div>', 'es_ES', 'La página de agradecimiento se muestra al cliente cuando un usuario crea un nuevo Ticket a través del portal del cliente.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(3, 3, 1, 'offline', 'Fuera de Línea', '<div><h1>\n<span style="font-size: medium">El sistema de Soporte de Tickets está Fuera de Línea</span>\n</h1>\n<p>Gracias por ponerse en contacto con nosotros.</p>\n<p>Nuestro sistema de Soporte está fuera de línea en este momento, por favor, vuelva más tarde.</p>\n</div>', 'es_ES', 'La página de desconexión aparece en el Portal del Cliente cuando el sistema de soporte está desconectado.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(4, 4, 1, 'registration-staff', 'Bienvenido a osTicket', '<h3><strong>Hola %{recipient.name.first},</strong></h3> <div>Hemos creado una cuenta para usted en nuestro sistema de soporte en %{url}.<br /> <br /> por Favor siga el siguiente enlace para confirmar tu cuenta y acceder a tus Tickets. <br /> <br /> <a href="%{link}"> %{link}</a> <br /> <br /> <em style="font-size: small"> su sistema de soporte al cliente amistoso <br /> %{company.name}</em></div>', 'es_ES', 'Esta plantilla define el correo inicial (opcional) enviado a los agentes cuando se crea una cuenta en su nombre.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(5, 5, 1, 'pwreset-staff', 'Reinicio de contraseña del Personal de osTicket', '<h3><strong>Hola %{staff.name.first},</strong></h3>\nSe ha enviado una solicitud de restauración de la contraseña en su nombre en %{url}.\n<br>\n<br>\nsi cree que ha sido enviada por error, simplemente borre este correo. Su cuenta sigue siendo segura y nadie ha accedido a ella. No está bloqueada, y su contraseña no ha sido restaurada. Alguien ha podido introducir su dirección de correo por error.\n<br>\n<br>\nPulse el enlace siguiente para identificarse en el sistema y cambiar su contraseña.\n<br>\n<br>\n<a href="%{reset_link}">%{reset_link}</a>\n<br>\n<br>\n<em style="font-size: small">El equipo de soporte técnico</em>\n<br>\n<img src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" alt="Powered by osTicket"\nwidth="126" height="19" style="width: 126px;">', 'es_ES', 'Esta plantilla define el correo electrónico enviado al personal que seleccione el vínculo<strong>Olvidé mi contraseña</strong> en la página del control de acceso del personal.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(6, 6, 1, 'banner-staff', 'Autenticación Requerida', '', 'es_ES', 'Este es el mensaje inicial y banner que se muestra en la página de registro de personal. El primer campo de entrada se refiere al texto con formato rojo que aparece en la parte superior. El último cuadro de texto es el contenido del banner que debe servir como un descargo de responsabilidad.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(7, 7, 1, 'registration-client', 'Bienvenido a %{company.name}', '<h3><strong>Hola %{recipient.name.first},</strong></h3> <div>Hemos creado una cuenta para usted en nuestro sistema de soporte en %{url}.<br /> <br /> por favor siga el siguiente enlace para confirmar tu cuenta y acceder a sus Tickets. <br /> <br /> <a href="%{link}">%{link}</a> <br /> <br /> <em style="font-size: small"> su sistema de soporte al cliente amistoso <br /> %{company.name}</em></div>', 'es_ES', 'Esta plantilla define el correo electrónico enviado a los clientes cuando su cuenta se ha creado en el Portal del cliente o por un agente en su nombre. Este correo electrónico sirve como una verificación de la dirección de correo electrónico. Por favor utilice %{link} en alguna parte del cuerpo del mensaje.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(8, 8, 1, 'pwreset-client', '%{company.name} Acceso al sistema de soporte', '<h3><strong> Hola %{user.name.first}, </strong> </h3> <div> Una solicitud de restablecimiento de contraseña se ha enviado en su nombre por el sistema de soporte en %{url}. <br /><br /> Si  esto se ha hecho por error, borre este email. Su cuenta sigue siendo segura y nadie ha tenido acceso a la misma. No está cerrada  y la contraseña no se ha restablecido. Alguien podría haber introducido por error su dirección de correo electrónico. <br/> <br/> Siga el enlace de abajo para acceder al panel de ayuda y cambiar su contraseña. <br /> <br /> <A href = "%{link}" >%{link} </a> <br /> <br /> <em style="font-size: small"> Su amigable sistema de servicio al cliente /> <br /> %{company.name} </em> </div>', 'es_ES', 'Esta plantilla define el Email enviado a los clientes que seleccionan el vínculo <strong>Olvidé mi contraseña</strong> en la página de registro del cliente.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(9, 9, 1, 'banner-client', 'Iniciar sesión en %{company.name}', 'Para brindar un mejor servicio, animamos a nuestros clientes a registrar una cuenta.', 'es_ES', 'Esto crea el encabezado de la página Log In del Cliente. Puede ser útil para informar a los Clientes sobre las políticas y el registro.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(10, 10, 1, 'registration-confirm', 'Registro de cuenta', '<div><strong>Gracias por registrarse para una cuenta.</strong> <br/> <br />  te enviamos un correo electrónico a la dirección que indicaste. Por favor siga el enlace en el correo electrónico para confirmar tu cuenta y acceder a tus Tickets. </div>', 'es_ES', 'Estas plantillas definen la página que se muestra a los clientes después de completar el formulario de inscripción. La plantilla debe mencionar que el sistema les envía un enlace de confirmación de correo electrónico y cuál es el próximo paso en el proceso de registro.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(11, 11, 1, 'registration-thanks', 'Cuenta confirmada!', '<div><strong>Gracias por registrarse para una cuenta de.</strong><br /> <br /> has activado exitosamente su cuenta y confirmar tu dirección de correo electrónico. Puede proceder a abrir un nuevo Ticket o administrar Tickets existentes. <br /> <br /> <em>su centro de soporte amistoso</em> <br /> %{company.name}</div>', 'es_ES', 'Esta plantilla define el contenido mostrado después de registro de clientes con éxito confirmando su cuenta. Esta página debe informar al usuario que el registro está completo y que el cliente puede ahora enviar un Ticket o acceder a Tickets existentes.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(12, 12, 1, 'access-link', 'Ticket [#%{ticket.number}] Enlace de Acceso', '<h3><strong>Hi %{recipient.name.first},</strong></h3> <div> Una petición de enlace acceso para Ticket #%{ticket.number} ha sido presentado en su nombre por el departamento de soporte en %{url}.<br /> <br /> Siga el siguiente enlace para verificar el estatus del Ticket #%{ticket.number}.<br /> <br /> <a href="%{recipient.ticket_link}">%{recipient.ticket_link}</a><br /> <br /> Si usted <strong>no</strong> hizo la solicitud, por favor elimine y haga caso omiso a este correo electrónico. Su cuenta aun permanece segura y a nadie se le ha dado acceso al Ticket . Alguien podría haber ingresado su dirección de correo electrónico equivocadamente.<br /> <br /> --<br /> %{company.name} </div>', 'es_ES', 'Esta plantilla define la notificación a los clientes que un enlace de acceso fue enviado a su correo electrónico. El número de Ticket y la dirección de correo electrónico activan el enlace de acceso.', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_department`
--

CREATE TABLE IF NOT EXISTS `ost_department` (
`dept_id` int(11) unsigned NOT NULL,
  `tpl_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email_id` int(10) unsigned NOT NULL DEFAULT '0',
  `autoresp_email_id` int(10) unsigned NOT NULL DEFAULT '0',
  `manager_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_name` varchar(128) NOT NULL DEFAULT '',
  `dept_signature` text NOT NULL,
  `ispublic` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `group_membership` tinyint(1) NOT NULL DEFAULT '0',
  `ticket_auto_response` tinyint(1) NOT NULL DEFAULT '1',
  `message_auto_response` tinyint(1) NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_department`
--

INSERT INTO `ost_department` (`dept_id`, `tpl_id`, `sla_id`, `email_id`, `autoresp_email_id`, `manager_id`, `dept_name`, `dept_signature`, `ispublic`, `group_membership`, `ticket_auto_response`, `message_auto_response`, `updated`, `created`) VALUES
(4, 0, 0, 1, 0, 1, 'División de TIC', '', 1, 0, 1, 1, '2016-10-27 11:21:25', '2016-10-27 11:21:25'),
(5, 0, 0, 1, 0, 1, 'DARCA', '', 1, 0, 1, 1, '2016-10-27 11:58:21', '2016-10-27 11:58:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_draft`
--

CREATE TABLE IF NOT EXISTS `ost_draft` (
`id` int(11) unsigned NOT NULL,
  `staff_id` int(11) unsigned NOT NULL,
  `namespace` varchar(32) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `extra` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_email`
--

CREATE TABLE IF NOT EXISTS `ost_email` (
`email_id` int(11) unsigned NOT NULL,
  `noautoresp` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `priority_id` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `dept_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(11) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `userid` varchar(255) NOT NULL,
  `userpass` varchar(255) CHARACTER SET ascii NOT NULL,
  `mail_active` tinyint(1) NOT NULL DEFAULT '0',
  `mail_host` varchar(255) NOT NULL,
  `mail_protocol` enum('POP','IMAP') NOT NULL DEFAULT 'POP',
  `mail_encryption` enum('NONE','SSL') NOT NULL,
  `mail_port` int(6) DEFAULT NULL,
  `mail_fetchfreq` tinyint(3) NOT NULL DEFAULT '5',
  `mail_fetchmax` tinyint(4) NOT NULL DEFAULT '30',
  `mail_archivefolder` varchar(255) DEFAULT NULL,
  `mail_delete` tinyint(1) NOT NULL DEFAULT '0',
  `mail_errors` tinyint(3) NOT NULL DEFAULT '0',
  `mail_lasterror` datetime DEFAULT NULL,
  `mail_lastfetch` datetime DEFAULT NULL,
  `smtp_active` tinyint(1) DEFAULT '0',
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(6) DEFAULT NULL,
  `smtp_secure` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_auth` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_spoofing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_email_account`
--

CREATE TABLE IF NOT EXISTS `ost_email_account` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `protocol` varchar(64) NOT NULL DEFAULT '',
  `host` varchar(128) NOT NULL DEFAULT '',
  `port` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `options` varchar(512) DEFAULT NULL,
  `errors` int(11) unsigned DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `lastconnect` timestamp NULL DEFAULT NULL,
  `lasterror` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_email_template`
--

CREATE TABLE IF NOT EXISTS `ost_email_template` (
`id` int(11) unsigned NOT NULL,
  `tpl_id` int(11) unsigned NOT NULL,
  `code_name` varchar(32) NOT NULL,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_email_template`
--

INSERT INTO `ost_email_template` (`id`, `tpl_id`, `code_name`, `subject`, `body`, `notes`, `created`, `updated`) VALUES
(1, 1, 'ticket.autoresp', 'Ticket de Soporte Abierto [#%{ticket.number}]', ' <h3><strong>Estimado %{recipient.name.first},</strong></h3> <p>Una solicitud de apoyo ha sido creado y asignado #%{ticket.number}. Un representante contactará con usted tan pronto como sea posible. Puedes <a href="%%7Brecipient.ticket_link%7D"> ver el progreso de este Ticket en línea</a>. </p> <br /><div style="color:rgb(127, 127, 127)"> tu % equipo, %{company.name} <br />%{signature}</div> <hr /> <div style="color:rgb(127, 127, 127);font-size:small"> <em>si desea proporcionar información respecto al tema o comentarios adicionales, por favor, responda a este correo electrónico o <a href="%%7Brecipient.ticket_link%7D"> <span style="color:rgb(84, 141, 212)"> ingresar a tu cuenta</span></a> para un archivo completo de sus solicitudes de soporte.</em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(2, 1, 'ticket.autoreply', 'Re: %{ticket.subject} [#%{ticket.number}]', ' <h3><strong>Dear %{recipient.name.first},</strong></h3> Una solicitud de asistencia ha sido creada y asignado un Ticket <a href="%%7Brecipient.ticket_link%7D"> #%{ticket.number}</a> con la siguiente respuesta automática <br /><br />tema: <strong>%{ticket.topic.name}</strong> <br />tema: <strong>%{ticket.subject}</strong> <br /><br />%{response} <br /><br /><div style="color:rgb(127, 127, 127)"> tu equipo %{company.name} <br />%{signature}</div> <hr /> <div style="color:rgb(127, 127, 127);font-size:small"> <em>esperamos que esta respuesta haya respondido suficientemente a a sus preguntas. Si usted desea proporcionar comentarios adicionales o información, por favor, responda a este correo electrónico o <a href="%%7Brecipient.ticket_link%7D"> <span style="color:rgb(84, 141, 212)"> acceda a su cuenta</span></a> para un archivo completo de sus solicitudes de ayuda.</em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(3, 1, 'message.autoresp', 'Confirmación de mensaje', ' <h3><strong>Estimado(a) %{recipient.name.first},</strong></h3> Su solicitud de soporte <a href="%%7Brecipient.ticket_link%7D">#%{ticket.number}</a> Ha sido actualizada<br /><br /><div style="color:rgb(127, 127, 127)"> Equipo de Soporte %{company.name},<br /> %{signature} </div> <hr /> <div style="color:rgb(127, 127, 127);font-size:small;text-align:center"> <em>Ud puede revisar el avance de su caso <a href="%%7Brecipient.ticket_link%7D">desde este enlace</a></em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(4, 1, 'ticket.notice', '%{ticket.subject} [#%{ticket.number}]', ' <h3><strong>Estimado %{recipient.name.first},</strong></h3> Nuestro equipo de atención al cliente ha creado un Ticket, <a href="%%7Brecipient.ticket_link%7D"> #%{ticket.number}</a> en su nombre, con los siguientes datos y Resumen: <br /><br />tema: <strong>%{ticket.topic.name}</strong> <br />tema: <strong>%{ticket.subject}</strong> <br /><br />%{message} <br /><br />si fuera necesario, un representante contactará con usted tan pronto como sea posible. También puede<a href="%%7Brecipient.ticket_link%7D"> ver el progreso de este Ticket en línea</a>. <br /><br /><div style="color:rgb(127, 127, 127)"> tu % equipo, %{company.name} <br />%{signature}</div> <hr /> <div style="color:rgb(127, 127, 127);font-size:small"> <em>si desea proporcionar información respecto al tema o comentarios adicionales, por favor, responda a este correo electrónico o <a href="%%7Brecipient.ticket_link%7D"> <span style="color:rgb(84, 141, 212)"> acceda a su cuenta</span></a> para un archivo completo de sus solicitudes de soporte.</em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(5, 1, 'ticket.overlimit', 'Se alcanzó el límite de Tickets', ' <h3><strong>Estimado %{ticket.name.first},</strong></h3> Ha alcanzado el número máximo de Tickets abiertos permitido. Para ser capaz de abrir otro Ticket, uno de tus Tickets pendientes debe estar cerrado. Para actualizar o agregar comentarios a un Ticket abierto simplemente <a href="%%7Burl%7D/tickets.php?e=%%7Bticket.email%7D"> ingresa en nuestro servicio de asistencia</a>. <br /><br />Gracias, <br /> sistema de Tickets de soporte', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(6, 1, 'ticket.reply', 'Re: %{ticket.subject} [#%{ticket.number}]', '% <h3><strong>Estimado %{recipient.name},</strong></h3> %{response} <br /><br /><div style="color:rgb(127, 127, 127)"> tu % equipo, %{company.name} <br />%{signature}</div> <hr /> <div style="color:rgb(127, 127, 127);font-size:small;text-align:center"> <em>esperamos que esta respuesta haya contestado a sus preguntas. Si no, por favor no envie otro correo electrónico. Por el contrario, responda a este correo electrónico o <a href="%%7Brecipient.ticket_link%7D" style="color:rgb(84, 141, 212)"> ingresar a tu cuenta</a> para un archivo completo de todas sus solicitudes de asistencia y las respuestas.</em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(7, 1, 'ticket.activity.notice', 'Re: %{ticket.subject} [#%{ticket.number}]', ' <h3><strong>Dear %{recipient.name.first},</strong></h3> <div> <em>%{poster.name}</em> sólo registra un mensaje a un Ticket en el que participas.</div> <br />%{message} <br /><br /><hr /> <div style="color:rgb(127, 127, 127);font-size:small;text-align:center"> <em>estás consiguiendo este correo electrónico porque usted es un colaborador en Ticket <a href="%%7Brecipient.ticket_link%7D" style="color:rgb(84, 141, 212)"> #%{ticket.number}</a>. Para participar, simplemente responde a este correo electrónico o <a href="%%7Brecipient.ticket_link%7D" style="color:rgb(84, 141, 212)"> haga clic aquí</a> para un archivo completo del hilo de Tickets.</em> </div> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(8, 1, 'ticket.alert', 'Aviso de nuevo Ticket', ' <h2>Hola %{recipient},</h2> Nuevo ticket #%{ticket.number} creado <br /><br /><table><tbody> <tr> <td> <strong>De</strong>: </td> <td> %{ticket.name} </td> </tr> <tr> <td> <strong>Departmento</strong>: </td> <td> %{ticket.dept.name} </td> </tr> </tbody></table> <br /> %{message} <br /><br /><hr /> <div>Para ver o responder a este ticket, por favor<a href="%%7Bticket.staff_link%7D">identifiquese</a> en el sistema de administración de tickets</div> <em style="font-size:small">Su sistema de atención al usuario</em> <br /><a href="http://osticket.com/"><img width="126" height="19" style="width:126px" alt="Powered By osTicket" src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" /></a> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(9, 1, 'message.alert', 'Aviso de nuevo mensaje', ' <h3><strong>Hola %{recipient},</strong></h3> Nuevo mensaje añadido al ticket <a href="%%7Bticket.staff_link%7D">#%{ticket.number}</a> <br /><br /><table><tbody> <tr> <td> <strong>De</strong>: </td> <td> %{ticket.name} </td> </tr> <tr> <td> <strong>Departmento</strong>: </td> <td> %{ticket.dept.name} </td> </tr> </tbody></table> <br /> %{message} <br /><br /><hr /> <div>Para ver o responder este ticket, por favor<a href="%%7Bticket.staff_link%7D"><span style="color:rgb(84, 141, 212)">acceda</span></a> al sistema de Soporte Técnico</div> <em style="color:rgb(127,127,127);font-size:small"> Saluda Atte. Equipo de Soporte Técnico</em><br /><img src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" alt="Powered by osTicket" width="126" height="19" style="width:126px" /> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(10, 1, 'note.alert', 'Alerta de nueva actividad interna', ' <h3><strong>Hola %{recipient.name},</strong></h3> Un agente ha registrado actividad en un ticket<a href="%%7Bticket.staff_link%7D">#%{ticket.number}</a> <br /><br /><table><tbody> <tr> <td> <strong>De:</strong>: </td> <td> %{note.poster} </td> </tr> <tr> <td> <strong>Título</strong>: </td> <td> %{note.title} </td> </tr> </tbody></table> <br /> %{note.message} <br /><br /><hr /> Para ver o responder el Ticket, por favor <a href="%%7Bticket.staff_link%7D">inicie sección</a> en el Sistema de Soporte <br /><br /><em style="font-size:small">Att: Tu Servicio de Atención al Cliente</em> <br /><img src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" alt="Powered by osTicket" width="126" height="19" style="width:126px" />}', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(11, 1, 'assigned.alert', 'Ticket asignado a usted', ' <h3><strong>Hola %{assignee.name.first},</strong></h3> el Ticket <a href="%%7Bticket.staff_link%7D">#%{ticket.number}</a> le fue asignado por %{assigner.name.short} <br /><br /><table><tbody> <tr> <td> <strong>De</strong>: </td> <td> %{ticket.name} </td> </tr> <tr> <td> <strong>Asunto</strong>: </td> <td> %{ticket.subject} </td> </tr> </tbody></table> <br /> %{comments} <br /><br /><hr /> <div>Para ver/responder por favor <a href="%%7Bticket.staff_link%7D"><span style="color:rgb(84, 141, 212)">acceder</span></a> al sistema de Soporte técnico</div> <em style="font-size:small">Saluda atte.</em> <br /><em style="font-size:small">Equipo Soporte Técnico</em> <br /><img src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" alt="Powered by osTicket" width="126" height="19" style="width:126px" /> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(12, 1, 'transfer.alert', 'Ticket #%{ticket.number} transferido - %{ticket.dept.name}', ' <h3>Hola %{recipient},</h3> el Ticket <a href="%%7Bticket.staff_link%7D">#%{ticket.number}</a> ha sido transferido al %{ticket.dept.name} departamento por <strong>%{staff.name.short}</strong> <br /><br /><blockquote> %{comments} </blockquote> <hr /> <div>Para ver o responder un Ticket, por favor <a href="%%7Bticket.staff_link%7D">inicie sesión</a> al sistema de Soporte Técnico. </div> <em style="font-size:small">Saluda atte.</em> <br /><em style="font-size:small">Equipo Soporte Técnico</em> <br /><a href="http://osticket.com/"><img width="126" height="19" alt="Powered By osTicket" style="width:126px" src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" /></a> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(13, 1, 'ticket.overdue', 'Alerta de Ticket demorado', ' <h3> <strong>Hola %{recipient.name}</strong>,</h3> El ticket, <a href="%%7Bticket.staff_link%7D">#%{ticket.number}</a> está seriamente demorado. <br /><br /> Debemos trabajar duramente para garantizar que todos los Tickets sean respondidos de manera oportuna. <br /><br /> Firmado,<br /> %{ticket.dept.manager.name} <hr /> <div>Para ver o responder el Ticket, por favor <a href="%%7Bticket.staff_link%7D"><span style="color:rgb(84, 141, 212)">ingresá</span></a> al Sistema de Soporte Ticket. Estás recibiendo esta notificación porque el Ticket está asignado directamente a usted o tu equipo o al departamento del cual eres miembro.</div> <em style="font-size:small">Saluda atte.<span style="font-size:smaller">(although with limited patience)</span> Equipo Soporte Técnico</em><br /><img src="cid:b56944cb4722cc5cda9d1e23a3ea7fbc" height="19" alt="Powered by osTicket" width="126" style="width:126px" /> ', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_email_template_group`
--

CREATE TABLE IF NOT EXISTS `ost_email_template_group` (
`tpl_id` int(11) NOT NULL,
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT '',
  `lang` varchar(16) NOT NULL DEFAULT 'en_US',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_email_template_group`
--

INSERT INTO `ost_email_template_group` (`tpl_id`, `isactive`, `name`, `lang`, `notes`, `created`, `updated`) VALUES
(1, 1, 'Plantilla osTicket por defecto (', 'es_ES', 'Plantillas osTicket por defecto', '2016-10-27 10:56:28', '2016-10-27 15:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_faq`
--

CREATE TABLE IF NOT EXISTS `ost_faq` (
`faq_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ispublished` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `keywords` tinytext,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_faq_category`
--

CREATE TABLE IF NOT EXISTS `ost_faq_category` (
`category_id` int(10) unsigned NOT NULL,
  `ispublic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(125) DEFAULT NULL,
  `description` text NOT NULL,
  `notes` tinytext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_faq_topic`
--

CREATE TABLE IF NOT EXISTS `ost_faq_topic` (
  `faq_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_file`
--

CREATE TABLE IF NOT EXISTS `ost_file` (
`id` int(11) NOT NULL,
  `ft` char(1) NOT NULL DEFAULT 'T',
  `bk` char(1) NOT NULL DEFAULT 'D',
  `type` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `key` varchar(86) CHARACTER SET ascii NOT NULL,
  `signature` varchar(86) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `attrs` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_file`
--

INSERT INTO `ost_file` (`id`, `ft`, `bk`, `type`, `size`, `key`, `signature`, `name`, `attrs`, `created`) VALUES
(1, 'T', 'D', 'image/png', 9452, 'b56944cb4722cc5cda9d1e23a3ea7fbc', 'gjMyblHhAxCQvzLfPBW3EjMUY1AmQQmz', 'powered-by-osticket.png', NULL, '2016-10-27 10:56:28'),
(2, 'T', 'D', 'text/plain', 43, 'jQENn5FggP1Xjh_Gbe57ADvXh-DFhO2E', '5FggP1Xjh_Gbe57AjsKInpEIUUWDUQw3', 'osTicket.txt', NULL, '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_file_chunk`
--

CREATE TABLE IF NOT EXISTS `ost_file_chunk` (
  `file_id` int(11) NOT NULL,
  `chunk_id` int(11) NOT NULL,
  `filedata` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_file_chunk`
--

INSERT INTO `ost_file_chunk` (`file_id`, `chunk_id`, `filedata`) VALUES
(1, 0, 0x89504e470d0a1a0a0000000d49484452000000da0000002808060000009847e4c900000a43694343504943432070726f66696c65000078da9d53775893f7163edff7650f5642d8f0b1976c81002223ac08c81059a21092006184101240c585880a561415119c4855c482d50a489d88e2a028b867418a885a8b555c38ee1fdca7b57d7aefededfbd7fbbce79ce7fcce79cf0f8011122691e6a26a003952853c3ad81f8f4f48c4c9bd80021548e0042010e6cbc26705c50000f00379787e74b03ffc01af6f00020070d52e2412c7e1ff83ba50265700209100e02212e70b01905200c82e54c81400c81800b053b3640a009400006c797c422200aa0d00ecf4493e0500d8a993dc1700d8a21ca908008d0100992847240240bb00605581522c02c0c200a0ac40222e04c0ae018059b632470280bd0500768e58900f4060008099422ccc0020380200431e13cd03204c03a030d2bfe0a95f7085b8480100c0cb95cd974bd23314b895d01a77f2f0e0e221e2c26cb142611729106609e4229c979b231348e7034cce0c00001af9d1c1fe383f90e7e6e4e1e666e76ceff4c5a2fe6bf06f223e21f1dffebc8c020400104ecfefda5fe5e5d60370c701b075bf6ba95b00da560068dff95d33db09a05a0ad07af98b7938fc401e9ea150c83c1d1c0a0b0bed2562a1bd30e38b3eff33e16fe08b7ef6fc401efedb7af000719a4099adc0a383fd71616e76ae528ee7cb0442316ef7e723fec7857ffd8e29d1e234b15c2c158af15889b850224dc779b952914421c995e212e97f32f11f96fd0993770d00ac864fc04eb607b5cb6cc07eee01028b0e58d27600407ef32d8c1a0b91001067343279f7000093bff98f402b0100cd97a4e30000bce8185ca894174cc608000044a0812ab041070cc114acc00e9cc11dbcc01702610644400c24c03c104206e4801c0aa11896411954c03ad804b5b0031aa0119ae110b4c131380de7e0125c81eb70170660189ec218bc86090441c8081361213a8811628ed822ce0817998e04226148349280a420e988145122c5c872a402a9426a915d4823f22d7214398d5c40fa90dbc820328afc8abc47319481b25103d4027540b9a81f1a8ac6a073d174340f5d8096a26bd11ab41e3d80b6a2a7d14be87574007d8a8e6380d1310e668cd9615c8c87456089581a26c71663e55835568f35631d583776151bc09e61ef0824028b8013ec085e8410c26c82909047584c5843a825ec23b412ba085709838431c2272293a84fb4257a12f9c478623ab1905846ac26ee211e219e255e270e135f9348240ec992e44e0a21259032490b496b48db482da453a43ed210699c4c26eb906dc9dee408b280ac209791b7900f904f92fbc9c3e4b7143ac588e24c09a22452a494124a35653fe504a59f324299a0aa51cda99ed408aa883a9f5a496da076502f5387a91334759a25cd9b1643cba42da3d5d09a696769f7682fe974ba09dd831e4597d097d26be807e9e7e983f4770c0d860d83c7486228196b197b19a718b7192f994ca605d39799c85430d7321b9967980f986f55582af62a7c1591ca12953a9556957e95e7aa545573553fd579aa0b54ab550fab5e567da64655b350e3a909d416abd5a91d55bba936aece5277528f50cf515fa3be5ffd82fa630db2868546a08648a35463b7c6198d2116c63265f15842d6725603eb2c6b984d625bb2f9ec4c7605fb1b762f7b4c534373aa66ac6691669de671cd010ec6b1e0f039d99c4ace21ce0dce7b2d032d3f2db1d66aad66ad7ead37da7adabeda62ed72ed16edebdaef75709d409d2c9df53a6d3af77509ba36ba51ba85badb75cfea3ed363eb79e909f5caf50ee9ddd147f56df4a3f517eaefd6efd11f373034083690196c313863f0cc9063e86b9869b8d1f084e1a811cb68ba91c468a3d149a327b826ee8767e33578173e66ac6f1c62ac34de65dc6b3c61626932dba4c4a4c5e4be29cd946b9a66bad1b4d374ccccc82cdcacd8acc9ec8e39d59c6b9e61bed9bcdbfc8d85a5459cc54a8b368bc796da967ccb05964d96f7ac98563e567956f556d7ac49d65ceb2ceb6dd6576c501b579b0c9b3a9bcbb6a8ad9badc4769b6ddf14e2148f29d229f5536eda31ecfcec0aec9aec06ed39f661f625f66df6cf1dcc1c121dd63b743b7c727475cc766c70bceba4e134c3a9c4a9c3e957671b67a1739df33517a64b90cb1297769717536da78aa76e9f7acb95e51aeebad2b5d3f5a39bbb9bdcadd96dd4ddcc3dc57dabfb4d2e9b1bc95dc33def41f4f0f758e271cce39da79ba7c2f390e72f5e765e595efbbd1e4fb39c269ed6306dc8dbc45be0bdcb7b603a3e3d65facee9033ec63e029f7a9f87bea6be22df3dbe237ed67e997e07fc9efb3bfacbfd8ff8bfe179f216f14e056001c101e501bd811a81b3036b031f049904a50735058d05bb062f0c3e15420c090d591f72936fc017f21bf96333dc672c9ad115ca089d155a1bfa30cc264c1ed6118e86cf08df107e6fa6f94ce9ccb60888e0476c88b81f69199917f97d14292a32aa2eea51b453747174f72cd6ace459fb67bd8ef18fa98cb93bdb6ab6727667ac6a6c526c63ec9bb880b8aab8817887f845f1971274132409ed89e4c4d8c43d89e37302e76c9a339ce49a54967463aee5dca2b917e6e9cecb9e773c593559907c3885981297b23fe5832042502f184fe5a76e4d1d13f2849b854f45bea28da251b1b7b84a3c92e69d5695f638dd3b7d43fa68864f4675c633094f522b79911992b923f34d5644d6deaccfd971d92d39949c949ca3520d6996b42bd730b728b74f662b2b930de479e66dca1b9387caf7e423f973f3db156c854cd1a3b452ae500e164c2fa82b785b185b78b848bd485ad433df66feeaf9230b82167cbd90b050b8b0b3d8b87859f1e022bf45bb16238b5317772e315d52ba647869f0d27dcb68cbb296fd50e2585255f26a79dcf28e5283d2a5a5432b82573495a994c9cb6eaef45ab9631561956455ef6a97d55b567f2a17955fac70aca8aef8b046b8e6e2574e5fd57cf5796ddadade4ab7caedeb48eba4eb6eacf759bfaf4abd6a41d5d086f00dad1bf18de51b5f6d4ade74a17a6af58ecdb4cdcacd03356135ed5bccb6acdbf2a136a3f67a9d7f5dcb56fdadabb7bed926dad6bfdd777bf30e831d153bdeef94ecbcb52b78576bbd457df56ed2ee82dd8f1a621bbabfe67eddb847774fc59e8f7ba57b07f645efeb6a746f6cdcafbfbfb2096d52368d1e483a70e59b806fda9bed9a77b5705a2a0ec241e5c127dfa67c7be350e8a1cec3dcc3cddf997fb7f508eb48792bd23abf75ac2da36da03da1bdefe88ca39d1d5e1d47beb7ff7eef31e36375c7358f579ea09d283df1f9e48293e3a764a79e9d4e3f3dd499dc79f74cfc996b5d515dbd6743cf9e3f1774ee4cb75ff7c9f3dee78f5df0bc70f422f762db25b74bad3dae3d477e70fde148af5b6feb65f7cbed573cae74f44deb3bd1efd37ffa6ac0d573d7f8d72e5d9f79bdefc6ec1bb76e26dd1cb825baf5f876f6ed17770aee4cdc5d7a8f78affcbedafdea07fa0fea7fb4feb165c06de0f860c060cfc3590fef0e09879efe94ffd387e1d247cc47d52346238d8f9d1f1f1b0d1abdf264ce93e1a7b2a713cfca7e56ff79eb73abe7dffde2fb4bcf58fcd8f00bf98bcfbfae79a9f372efaba9af3ac723c71fbcce793df1a6fcadcedb7defb8efbadfc7bd1f9928fc40fe50f3d1fa63c7a7d04ff73ee77cfefc2ff784f3fb803925110000001974455874536f6674776172650041646f626520496d616765526561647971c9653c0000032869545874584d4c3a636f6d2e61646f62652e786d7000000000003c3f787061636b657420626567696e3d22efbbbf222069643d2257354d304d7043656869487a7265537a4e54637a6b633964223f3e203c783a786d706d65746120786d6c6e733a783d2261646f62653a6e733a6d6574612f2220783a786d70746b3d2241646f626520584d5020436f726520352e362d633031342037392e3135363739372c20323031342f30382f32302d30393a35333a30322020202020202020223e203c7264663a52444620786d6c6e733a7264663d22687474703a2f2f7777772e77332e6f72672f313939392f30322f32322d7264662d73796e7461782d6e7323223e203c7264663a4465736372697074696f6e207264663a61626f75743d222220786d6c6e733a786d703d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f2220786d6c6e733a786d704d4d3d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f6d6d2f2220786d6c6e733a73745265663d22687474703a2f2f6e732e61646f62652e636f6d2f7861702f312e302f73547970652f5265736f75726365526566232220786d703a43726561746f72546f6f6c3d2241646f62652050686f746f73686f70204343203230313420284d6163696e746f7368292220786d704d4d3a496e7374616e636549443d22786d702e6969643a36453243393544454136373331314534424443444446393146414639344441352220786d704d4d3a446f63756d656e7449443d22786d702e6469643a3645324339354446413637333131453442444344444639314641463934444135223e203c786d704d4d3a4465726976656446726f6d2073745265663a696e7374616e636549443d22786d702e6969643a4346413734453446413637313131453442444344444639314641463934444135222073745265663a646f63756d656e7449443d22786d702e6469643a4346413734453530413637313131453442444344444639314641463934444135222f3e203c2f7264663a4465736372697074696f6e3e203c2f7264663a5244463e203c2f783a786d706d6574613e203c3f787061636b657420656e643d2272223f3e8bfef6ca0000170b4944415478daec5d099c53d5d53f2f7b32c9646680617118905d3637d0cfad282aa82d0af6f3b3b62ef52bd6d685ba206eb54a15c1adf6538b52b4d53a564454a42c0565d132a86c82a0ac82ec8b0233ccc24c9297f7dd9bfc6f73e64e92c90c5071ccf9fd0e249397f7eebbf7fccff99f73efbb31860f1f4e593936a4da74d2d8eeef53b17f2f51c4fd5d6b7e4ba19385ee177a9bd0ed8d3e832534dfa4d2351ebafaad3cb2d92cb219cd636c6d59f3ceca11920b849e27f4c742af68f4b7a342f34c5ab8de4d3f9b12a4b0005d7301991447d63ebed7e2125a283457a85d680d22d2be26463405995d8dfeb63f4a4b44241bfa463e5902642d7d518a5a59a065e5bb29ad849e2a7480d0d384b617ea05e024bb89080d093d287495d0e94267093d90c1b9edf85f82b4a2d19451006dc65617ed2bb3538f76618a449b57c76781f6fd908e42af14fabf42bb65f89dde42af12ba4ce848a10bd21c9b23741803f3bb42c709fd6d4657921015003b74c8205f8ed9ec4096cdd19abf7884de2e74210cbf5b13ce2123e05ca1f7e37cc9e45788921c3af703d80d47b3a049b3b739e989d21c2aca8d36cb81c802adf94a6ba15385fe41e87147c04e1e018dbc00399da49b4542ef4d13b97e2d343fed999d16d57ee3a0498b7dd426b779e56559ead8fce504a16f0aed7584cf7b2e72bbbd426b01b8d6691c763f8a97fa1f4c471bb71db4d194b51e6a17c8022d2bdf1d9151e695a30032253ee47c99caef285ecd1c9b92df0aea58e88fc672b3e654d2cf52c7e62d922af6ff96ae2de3d152a1cb8556b1bfcb4249cb3a47ca54cc23fec93569fe1a0f4522061946f31d946c443be65c5fe470befd736aca64f19193f5427f227487d00e427f29f432e477dfc4efcf8abbf76094e6adf4d0a4955e9ab6d14d6e41218de63cac59cb3e86bc9e11a592eda79019f60aab6b74f54de64a7725f9bb9c3c2eff0fddc2c342bf04555c47f142493f11e7a6935d00cc6fc6d0f4e55e07fdf4a502ba654690262ef791d76191c76135efb1cd9af7b123d2a36f3e14a4903d4c5eabd1fe5d468e9edadf4a854e04008347b9f9e385be56871afaa22171232119c50e96dbe9c036173d58eaa7399b5c541532c8efb2a87bab08990263d1e68db32cd08e297a61086bb36cb4fa4031f5cfdf127b9da104845ea3fd4d4694a1145f62d5e62837fd39a1a312ad11912b274aabd67b68f1976eea901fa1055b5cf468690eb5f34763343127271eb14debfb31b68eb3cf3e3b6be1c7904c9bbf8cdedcdd8bfab7d824dc7cc67ef02c8a97dd95940178df20b66c10dae22834572ed31a416ad58808c2729de2e37372c914579db5c94d0b05d00c579472dd227ab5689eab3eb211ed3b99a75994e7aa8a17452c8f30de8c5cbe5c31ef62ef1f12ba04afe522e12784be91c178cbfcea75d04c59ccc8a37839df29b412f95e5b009b50f45856e70c820e4e58e1a5cdbb9d542822598fb689758bdf57906581760c8add885255d843353541f2d84399d04759363f91bdff40e8abda316b8456537c82399dc849ee0758cae8a3c42a907244ca2280f64ca18384ce8e013d2a401834e9ab3d4eca775a146a19891539be2570c9f6ca2561edf17e8fd079420f6581969598f8edb5b4a2a20d95ecec4bc33b7f4854eb6fe82b8329be1e51c95f11c5b874a1d4eb1489196349ec559ec8b142229456daaac856673e4cca761457a653e2319b7cf258bbb6ee70d1b0c979b4eda09d5a78a37252ad1dc527b723a0b029fd0bc5579a48aa5b20d48df6ca08bab109dd2823f23d4207328afb43a1dbb240cb4a4c2c11481c24cbddb528f11b149f074e29329aa9b027170fbf9be498ae1ab5d42f2acff027725a9f4b44dcfb561e9d2828dfd567098c1db2c59b107b80c650935d6159c720b96adf8a3d42b39d0a22347e6e80566e7752f7b691588e46f155ff72517315ce904a64e4dc041a7abef437147f22e079a13765a963568e8a14b8aae9fdbddde8e4e00eea259442fe5460cb038553f24fd03b5d4e4e79b15819de7a37e2b61e731cb4d17df302f4e4877e6a2fa8dfac0d6eaa0e1bb4b7d246c37ad7d0c80b2a880ec46696db89e6b48c3529d7dc459ee8a1454b7cf4d66a0f15b73415c808f91c01340d492ef2c2969478b6cddbc42e8c6ac0361b88a8474a8e475ff786d39891055a7a31601c4e78e3508ae33c38a6065efec82418369376d40468555911f50aec8d47b6e4f36a72deac2f5eef448ea58ba461dd539aa3db9a496dc2b74c9c951b1afb5e20669d9d5acb0286413336ba636b0f0f08a0e57b2c1a39a052dcb14057b55125a0b05ae464f3b7d718e3576df6866f9e9627724b8a1dc74af68af65530c33759dea7447e26172aaf07d8f2d1ff9587317effe985263d50483a09efc76581d6b0c8817e01b98f7cd46434c59f3ae6d287e2eb0adbe3987b8ed4c5a30254c7b92b68b22cf38b88d6397777aacd7ae4fc5800afbf04fdd2e5062d874b80cc4e2f52dbf0cdcfcccc0ddd332d488581682b9f61150b70796d762bd2ca67c9a7a537b7f24523f3b63ae9ea92022ab9f28004db12ea5a3b78f906d7ce817715c92a89af4b71a83857e05180cc0580c8b63c04f07b589e269dd2a39478505452cf3b50c49120fc239c979b9ab225c2b727ed19c8482fbc648196a22641f179a90ef83f999517a0b2e54c6ac8870b36e1903d22b2391ca174391a5fa8bb32491e24dbf500e94bed2cda2d22d96801b2179ef9672eddfe76b0b038dfbcc9618b3da8d99e5d4d562a17442d7ab263303a7ff27a3779dfc9a347cfaf282f793dbf7cd2a75e5bb9d3bab66361e41671813ed1ba516a8bd0c729be624497afd96b79839f4a40e3fdd66398e5a44b96b7a1a0a36c657f16680d4b84d1c50329a8e341786e19fd761f8d46380d934ab69d4277772a25476c5ecd96cc8b2af944fb4c56dcfe86aa20972951d378c0e631d74e1054f1376fe69dd12edf7cce65a753a256ec3e5e84d1c8fce807422f911a8ed2bdc707cd715345def6c53e3b2ddeee143431fa74aff6a111a66944c5e7938d3855947d271fd11922f44f42cf107a9d9623f19ccdc5de77a2f8960b76383bb984ec1f49ba463ec83a18d4b91011b312e3b080e24f103444e5e5b3729782d606e18cc653dd6df22ea6f814462125a638e48a9b49ac827922faba9386a78be18465db2a1c48e04e45c366a3027435c5e74b1623c1ae4c929b0c42e2e7c54517c13311e3d936500895a0cbfd248a1156373203f6e33b1edce81e50221931fac393c8b9a0f9e0f2c40ca115dab91e83d4055c7913a8d520e42816aa72ff22aa57b23e139d9583aadd7a16fa53f17d1b8b14ea7c3f419fc8364ea3f88a0c79ce8b700e3948ab9200a2ad8a1ec436c2310c8b361fcaa750d41e075a7d69cd220fa78db2523706c512259206de4fdee8c48dfbedd18b1f6b4355216a2f403631e0b27a09ca27f3895b847ea5e577d7a3fa375600715fae2bf67dea986f5e651834221436b6898ebdc2a80ff47384fe1db6f421c5d75c72e2ca6b9e4a4e02ad54f29724409351f74eaabfae53c9f9a0a5e9e6cc241b795a285f16f53aeb7be9c0e4130757012c94a40db7012f8310b975b9041a73d60e7886e7d1b07168e80fd817e682e7abd02e9fde7d099e8a8b1cec6728be625b1ad673f04c37e3fc5246a1e42baf251fa128c1df47c33822f03412a47281ea29da3556c218168236498fd91946f50d3aef200658523e39b1da513b4729dab412efefa6f813c05e96d34cc8b052c6238bccd32e637f1b05e02fc2a0f5c0352f64d4497a6639b92ce79be6087d4f672b3e7b38be06b2be7871ef2aeaeec06bb9825edf5a6035a2ca72b975c0dc751efabacaa016bee81d22924990cd455b7507548b5cb50ad1718cc8df66e5ba2de90ccfb5e2cdba2f49342538b47b30c63722572b6ba01fab01bc54858c47615fe9641302433ab6f6a80632d9c6e1b8df7600dd59ecf3b5c82dbba3df7bc0b6fa30c79f4eec3656fdf1c2e0fb2131fd9a798817019a020040814c469979e8401f3af63a78e6103aac2f2b459fc3ae752e5e0710663d300809b25718c85622628510a64bd01935ac3347a0ed8468741e0cb823c02bc1f5193e3f0bf7e0c7bd3d82f698308e7d309ece1974a0c9bcd710b4750dfe5688b6ca39ac298c6674d1bc7e3bbc9e579f395874c874c68a23290a364578fd3972a2f3e138b8bc1feb5f4b80cc1fa5671704e80e919715e644fb8a9cec06ac9abf2b09c8b8bc0a1b90ece15aadf4fe759aef2d40df47f0dd4ccaf2a9a2dd4d1ac8c2601fd2f15e4ef10d825e461008a5c8ab09c7ddc8decf60202314b8ce624ce54644da7e9478d68e40379f84d31f053ac9dbfe216cf23119c06c1a979527fe394070298b6203e1010650624ee65550aef371ace2acf701040bf1fe7480e838189d92229627aa0d5c2621c2aa05b2b7e3264f4747d78262de0b6e1d66605d0bca3012e7e8064e3d1c6d3f9112cf6bf5c2ebdb1958ef46243f1714b5b1320614fc62500a15b106c1d89570b6309819eb7bf5124541196f68bf8c7caeea64f9591eebb7452cc7716a51659830d7ed5460d2cb4b7c3462662e15e444c9668bf5878cda6fb3e89e4ed444f87fc381aad2fd3d6c2c75d98131b95ca3a48d957614df558b8bbcee50b09a77c042ae475ffb293117a700bb034e9f6fa9b00481a196a51043d8e712c47fc6e726d281fbd8e79781cd3c0150717eff36aaaeb29d636d5a989ec0e6623ec609945c04a35586f104a302ff82272018f879f83e21dcb646bee447b42c0705cd47e408b2ca4d4f16c966200fca017551e7ec0bc0d5e0fd6e78aaa9888aaa48f019724c173cdc348a3f662fe517a07152a683ea124acabf078dc9a41225650522a389c8328e1d73211cd6a78c21a81caf27f37ecbeb700d234a65110fe5b92b523d759dcbfa6d03a35e4abe821155927ca8b2ca46ef6f709343bcf60bfa28685f6f16493399cc5d0e70754234fb2bae712ea2d6431897028db6495bd9494d9b6754116d288bfc0446f287469c672f22ea5896b7ae41fff05d99af003323b0a82949ce3507e3ad72d801acc063d3a87dcaaae347dafb8540a90340511bbe7c00bac2450128884e919ee57794d8cca5150cfe7544ce4b0096fe68d42ae459aa43a5112e8331dbe0557258343c9e79a2c5cc903bb2c8f95f42bf40874431707e166d78de56cbdeaf03e8bb6708b4355a65f22b78d0e3e048b602cc27c3500d44e9beac9feb806c77ad9ffa04f6500719cdcc64f978ec3e5d68f716fcad428bb09bd50f47bcbed447afadf052b7c2887cc8d260fd9ce98f51ec8113ea0276f011a2dbd3a0c00f42bf86432c45eeb688524ff8672a03b5f72f36f2fb39a070aa382103c4ad8ce613ec94afa07122425a0c3435781d4832c5a2072d473aa09949383325a9bed524f1827c998b1b615919db190015013c1edcb4a45abd19c857b39bd80f301bec26aad1e6cf61546ecde055b9d8c3a2d35a749a9d1213a6657008aa1ad8d4690e2345bf998c46a836ce06fde90c2adb07ed5c0be7f36f17bead26482709903dd06336b96d2210c4b636a85710e9c61cdc4a561451530f712aeab2a862a793a62cf3519ba0a99e64b6b17bce34d2f07b72b2b11c08ca7521c6b21fe8d71046a16ea3a62de8b592cc17963761aeed4cadb89183ea376940e37b509e4ce996ae252490c206281dd0f42771fbb063b6800214c31b77609e946040f90c8835180809b40b1065f6c0b0d4e31a97b2c8f239c01566d5a3a19a975625f508aeafa2939d4d2896c3abfa71ce61f0faea7307bedf17f75180e8a8775ecb0c9377d20a1c525a30c7b28b45cd4fe0746e60c587c5e897b86559063dde6d2e15f9f7922706325faafd434e60c6ae8a2821966bc7fb4dd0c48dfb1d34759d9bba251ebc3429b18f48a65b1cf8d02f11aa3b191b01f5fd107d5c8cfe389b152ae458fc8cd4063d4d77680d1a740ad1135c2722dc0ac684ec5a7e1b4d33b513812d39d938da523889a41f0e67865f4075574e7fc0e634bab2ea939acfb99b356235cbf3545e520c63530f10560268a762e03e62002318e48fd8353aa12cfb77cc6354a7a8506d619dd70ff9a2fabc27a620fe0f45096530c35815d48e42498b46785c791dbe95c055ecf522ad38a1728e1fe3f55bfc8445de723a217f0b051d358864494196c768ed275a345774b0b681b6af67ce3413e986b2f676e43cc751fd5d882df4ff5c140706e2d8412812351560116d0e2caf09e79a8cc2899256a81afa5864afd12aa6e750628ef53ca61742252bfb23632e562aa0e911ed14508e1994982c56d59979283a8c00b04623227c4675378699c1aa6c2b0028bf96b4efc580f462f3149fb282cc6078da975052fd1237d59d150f2a29f92e5e5528e85c8ece9c8af73b0186b6e884ab50d0990083790305971e1ac01b0299eac7f1e8fc001c886acb1bec3899a7fd1ac704d01f1ff393dedd7901d9648551e665a99fae1e0c5af309c6454fc0b7fddb68c206752988d0d0eeb5b468bb33b6210e9b5b5355c427a8e15f8c198871fc1ba2f5c7282efd94524f0eaf42d1621cf2ba579b18d1b668efafd48b470dc84e14abd6c0299eceeee90e7c56a61546fc68ffc126445deef4ea453413206b8f12797f366877e2f517a03ddfe0c43f44a9bd279bb3b99575fc622de1547310fb984795b29479ad7988ac07603897a20cdf1dc73c850a612b56c20d68f73209f31f11789aab31d7d1964d41bc817997296cde6b24b8fcb3ac1c1d4891c3799937fc1cfd740da2956acb48f4012f362dd34ac075263c7d22a251c4956e407bb36af04b1ab52e60112d4eb1420605da86e99ad3ab687fb54d2f5e95829d5cdf80111531765302c32f474a509421bd360f23a2bda339b611193a4362fdb10bf6f080e6181e44c48d52dd5fcc398df886430d8bfe53555d5345343bbcf218d0421faa6faf22a228f907f8f7507829278ce503ccb570cab20f03d409de9dd39c7b01885012ef340509fee5302c17403a15d14c958d7f815c6a13d55ff0f96718f930388230ee63068b2221dceb2c783737aef11a0a149df09d64fb227e8168e083e793e7ba19f9de7e50953949b8fd2c4653e7d43b6b6d4046323f0a25fb357a7c3afab83568d044eddb43d87447c254455493e57d2dfecb717a1ce77b0aa5fb6949eeb31051bf330cfe23e6cc6474fe2dc621d91c4457440cd223772365261cb09a1af1c0514e44fb7781950c80dd946aed71b2a2d47b70a4a318061e076b9b08a7a3162bdc8f7b180f675a0bc7ab72d0a56c0cabc122fc6c8e6d246cdb702449123f8031bb603cc9f8cb3a2493ea07ec4269e6629642939d635d9acedd806b38718db0768d43946492579315e87855de0f27b91f799ebfc0a118aca0f05192e90e2e07883d6f0419858133b581568598202596fe7c46f5d73d8a56ca072bad9e18248b45275e391b4ff5374bed01cf4cf51c83e8bdb25a1b850e19e4c8abb349ce3478f88761b0cfc24195e13ecec4679dd08fb7b3b3be00605f0b631c073a1ac1980d46b42844e49d7e184033d1b73329b1be533ab8df205f3f08f0b580935ca84d29e8b4ee1938d67e782f03c6efc1c64621d5506ee97f702f07d8bde502d8250c685b70dd8b5865732cdabec491a20a6965904cd311981fc9440ef7814a4b4b728fd675944198294ac0772202f664b4b1fef2a5785eb618cce257c8fb0a700fd310c9e624b9c60044f728a22d8b5d069d5d14a2d33a86686bb99de76984fc6433febf15aa8ff12bf0ee3bd8df556efe340a4bc9b650280350c768fdebd70a3b5e061ebbc6b2942c075d7c9e018458becbabb105547709569ec6de760004bc10750baabf8fe0be9e625328c114d5d9965a3f3d0c6718607892dad1a135c04d59391a92835c53816c33a8653a59096ae6426ea976a14a3597730306fb7ad27f9d53d0c62e27d4d2259b6a68cc9c80005a3d5ff01aa2f3a598f66801606f06655b9ae2bacb29f123f132a76907b0ec039d9f4dc937d7998e625618f7f515ab844e4074f253fd5f195d8aebfd08ff7766154875cd994865a6e37f0b6dd0e9ffdb486b06205ab544dbbdf8ee2728989d838ab91f4e541ebb15e77c5f3be722b4eb564a4c8dc99469bef1f2cb2ff742688ca0911bb3b838e222a9c62fe12177c2fb7f9aecc0ebca4635e5fc7654212b51c1ad2f4193464f0fd298d21cea10349b439f1a70306a43950a4acc2736b8a3519a7ed40b377644332fd84235a8aad540db5a2070c9e3cbfe5f800100b3e0af98735d4afd0000000049454e44ae426082),
(2, 0, 0xc2a14c6f732061646a756e746f73207072652d6772616261646f7320736f6e206573747570656e646f7321);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_filter`
--

CREATE TABLE IF NOT EXISTS `ost_filter` (
`id` int(11) unsigned NOT NULL,
  `execorder` int(10) unsigned NOT NULL DEFAULT '99',
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `match_all_rules` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stop_onmatch` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `reject_ticket` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `use_replyto_email` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `disable_autoresponder` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `canned_response_id` int(11) unsigned NOT NULL DEFAULT '0',
  `email_id` int(10) unsigned NOT NULL DEFAULT '0',
  `status_id` int(10) unsigned NOT NULL DEFAULT '0',
  `priority_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `form_id` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_id` varchar(11) DEFAULT NULL,
  `target` enum('Any','Web','Email','API') NOT NULL DEFAULT 'Any',
  `name` varchar(32) NOT NULL DEFAULT '',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_filter`
--

INSERT INTO `ost_filter` (`id`, `execorder`, `isactive`, `status`, `match_all_rules`, `stop_onmatch`, `reject_ticket`, `use_replyto_email`, `disable_autoresponder`, `canned_response_id`, `email_id`, `status_id`, `priority_id`, `dept_id`, `staff_id`, `team_id`, `sla_id`, `form_id`, `topic_id`, `ext_id`, `target`, `name`, `notes`, `created`, `updated`) VALUES
(1, 99, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'Email', 'SYSTEM BAN LIST', 'Lista interna de emails bloqueados. No eliminar', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_filter_rule`
--

CREATE TABLE IF NOT EXISTS `ost_filter_rule` (
`id` int(11) unsigned NOT NULL,
  `filter_id` int(10) unsigned NOT NULL DEFAULT '0',
  `what` varchar(32) NOT NULL,
  `how` enum('equal','not_equal','contains','dn_contain','starts','ends','match','not_match') NOT NULL,
  `val` varchar(255) NOT NULL,
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `notes` tinytext NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_filter_rule`
--

INSERT INTO `ost_filter_rule` (`id`, `filter_id`, `what`, `how`, `val`, `isactive`, `notes`, `created`, `updated`) VALUES
(1, 1, 'email', 'equal', 'Test@example.com', 1, '', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_form`
--

CREATE TABLE IF NOT EXISTS `ost_form` (
`id` int(11) unsigned NOT NULL,
  `type` varchar(8) NOT NULL DEFAULT 'G',
  `deletable` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `instructions` varchar(512) DEFAULT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_form`
--

INSERT INTO `ost_form` (`id`, `type`, `deletable`, `title`, `instructions`, `notes`, `created`, `updated`) VALUES
(1, 'U', 1, 'Información de contacto', NULL, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(2, 'T', 1, 'Datos del Ticket', 'Por favor, describa su problema', 'Este formulario se adjuntará a cada ticket, independientemente de su origen. Puede agregar nuevos campos a este formulario y estarán disponibles para todos los tickets y se podrán consultar con búsqueda avanzada y filtros.', '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(3, 'C', 1, 'Informacion de la empresa', 'Más información disponible en plantillas de correo electrónico', NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(4, 'O', 1, 'Información de la organización', 'Detalles sobre la organización del usuario', NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(5, 'L1', 1, 'Propiedades del estado del Ticket', 'Propiedades que pueden establecerse en un estado del Ticket.', NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_form_entry`
--

CREATE TABLE IF NOT EXISTS `ost_form_entry` (
`id` int(11) unsigned NOT NULL,
  `form_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned DEFAULT NULL,
  `object_type` char(1) NOT NULL DEFAULT 'T',
  `sort` int(11) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_form_entry`
--

INSERT INTO `ost_form_entry` (`id`, `form_id`, `object_id`, `object_type`, `sort`, `created`, `updated`) VALUES
(1, 4, 1, 'O', 1, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(2, 3, NULL, 'C', 1, '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_form_entry_values`
--

CREATE TABLE IF NOT EXISTS `ost_form_entry_values` (
  `entry_id` int(11) unsigned NOT NULL,
  `field_id` int(11) unsigned NOT NULL,
  `value` text,
  `value_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_form_entry_values`
--

INSERT INTO `ost_form_entry_values` (`entry_id`, `field_id`, `value`, `value_id`) VALUES
(1, 28, NULL, NULL),
(1, 29, NULL, NULL),
(1, 30, NULL, NULL),
(1, 31, NULL, NULL),
(2, 23, 'HelpDesk System', NULL),
(2, 24, NULL, NULL),
(2, 25, NULL, NULL),
(2, 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_form_field`
--

CREATE TABLE IF NOT EXISTS `ost_form_field` (
`id` int(11) unsigned NOT NULL,
  `form_id` int(11) unsigned NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `edit_mask` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL,
  `configuration` text,
  `sort` int(11) unsigned NOT NULL,
  `hint` varchar(512) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_form_field`
--

INSERT INTO `ost_form_field` (`id`, `form_id`, `type`, `label`, `required`, `private`, `edit_mask`, `name`, `configuration`, `sort`, `hint`, `created`, `updated`) VALUES
(1, 1, 'text', 'Correo Electrónico', 1, 0, 15, 'email', '{"size":40,"length":64,"validator":"email"}', 1, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(2, 1, 'text', 'Nombre completo', 1, 0, 15, 'name', '{"size":40,"length":64}', 2, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(3, 1, 'phone', 'Número de teléfono', 0, 0, 0, 'phone', NULL, 3, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(4, 1, 'memo', 'Notas internas', 0, 1, 0, 'notes', '{"rows":4,"cols":40}', 4, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(20, 2, 'text', 'Resumen del problema', 1, 0, 15, 'subject', '{"size":40,"length":50}', 1, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(21, 2, 'thread', 'Detalles del problema', 1, 0, 15, 'message', NULL, 2, 'Detalles sobre los motivos para la creación del ticket.', '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(22, 2, 'priority', 'Nivel de prioridad', 0, 1, 3, 'priority', NULL, 3, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(23, 3, 'text', 'Nombre de la empresa', 1, 0, 3, 'name', '{"size":40,"length":64}', 1, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(24, 3, 'text', 'Sitio Web', 0, 0, 0, 'website', '{"size":40,"length":64}', 2, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(25, 3, 'phone', 'Número de teléfono', 0, 0, 0, 'phone', '{"ext":false}', 3, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(26, 3, 'memo', 'Dirección', 0, 0, 0, 'address', '{"rows":2,"cols":40,"html":false,"length":100}', 4, NULL, '2016-10-27 10:56:27', '2016-10-27 10:56:27'),
(27, 4, 'text', 'Nombre', 1, 0, 15, 'name', '{"size":40,"length":64}', 1, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(28, 4, 'memo', 'Dirección', 0, 0, 0, 'address', '{"rows":2,"cols":40,"length":100,"html":false}', 2, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(29, 4, 'phone', 'Teléfono', 0, 0, 0, 'phone', NULL, 3, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(30, 4, 'text', 'Sitio Web', 0, 0, 0, 'website', '{"size":40,"length":0}', 4, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(31, 4, 'memo', 'Notas internas', 0, 0, 0, 'notes', '{"rows":4,"cols":40}', 5, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(32, 5, 'state', 'Estado', 1, 0, 63, 'state', '{"prompt":"Estado de unt Ticket"}', 1, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(33, 5, 'memo', 'Descripción', 0, 0, 15, 'description', '{"rows":2,"cols":40,"html":false,"length":100}', 3, NULL, '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_groups`
--

CREATE TABLE IF NOT EXISTS `ost_groups` (
`group_id` int(10) unsigned NOT NULL,
  `group_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `group_name` varchar(50) NOT NULL DEFAULT '',
  `can_create_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_edit_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_post_ticket_reply` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_delete_tickets` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `can_close_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_assign_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_transfer_tickets` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `can_ban_emails` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `can_manage_premade` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `can_manage_faq` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `can_view_staff_stats` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_groups`
--

INSERT INTO `ost_groups` (`group_id`, `group_enabled`, `group_name`, `can_create_tickets`, `can_edit_tickets`, `can_post_ticket_reply`, `can_delete_tickets`, `can_close_tickets`, `can_assign_tickets`, `can_transfer_tickets`, `can_ban_emails`, `can_manage_premade`, `can_manage_faq`, `can_view_staff_stats`, `notes`, `created`, `updated`) VALUES
(1, 1, 'Domadores de Leones', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'Administradores. Estas personas (inicialmente) tienen el control total de todos los departamentos a los que tienen acceso.', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(2, 1, 'Paseadores de Elefantes', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 'Habitantes de la torre de marfil', '2016-10-27 10:56:28', '2016-10-27 10:56:28'),
(3, 1, 'Entrenadores de pulgas', 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 'Miembros del personal', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_group_dept_access`
--

CREATE TABLE IF NOT EXISTS `ost_group_dept_access` (
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_group_dept_access`
--

INSERT INTO `ost_group_dept_access` (`group_id`, `dept_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_help_topic`
--

CREATE TABLE IF NOT EXISTS `ost_help_topic` (
`topic_id` int(11) unsigned NOT NULL,
  `topic_pid` int(10) unsigned NOT NULL DEFAULT '0',
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ispublic` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `noautoresp` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned DEFAULT '0',
  `status_id` int(10) unsigned NOT NULL DEFAULT '0',
  `priority_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `form_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sequence_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `topic` varchar(32) NOT NULL DEFAULT '',
  `number_format` varchar(32) DEFAULT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_help_topic`
--

INSERT INTO `ost_help_topic` (`topic_id`, `topic_pid`, `isactive`, `ispublic`, `noautoresp`, `flags`, `status_id`, `priority_id`, `dept_id`, `staff_id`, `team_id`, `sla_id`, `page_id`, `form_id`, `sequence_id`, `sort`, `topic`, `number_format`, `notes`, `created`, `updated`) VALUES
(1, 0, 1, 1, 0, 0, 1, 2, 4, 0, 3, 0, 0, 4294967295, 0, 3, 'División de TIC', '', '', '2016-10-27 15:11:27', '2016-10-27 15:11:27'),
(2, 1, 1, 1, 0, 0, 1, 0, 4, 0, 2, 0, 0, 4294967295, 0, 5, 'Instalar Squid', '', '', '2016-10-27 15:12:15', '2016-10-27 15:12:15'),
(3, 1, 1, 1, 0, 0, 1, 0, 4, 2, 0, 0, 0, 4294967295, 0, 4, 'Instalar FPL', '', '', '2016-10-27 15:13:03', '2016-10-27 15:13:13'),
(4, 0, 1, 1, 0, 0, 1, 0, 5, 4, 0, 0, 0, 4294967295, 0, 1, 'DARCA', '', '', '2016-10-27 15:13:48', '2016-10-27 15:13:48'),
(5, 4, 1, 1, 0, 0, 1, 2, 5, 4, 0, 0, 0, 4294967295, 0, 2, 'Carnetización', '', '', '2016-10-27 15:51:37', '2016-10-27 15:51:37'),
(6, 0, 1, 0, 0, 0, 1, 4, 0, 0, 3, 0, 0, 4294967295, 0, 6, 'PQRSF', '', '', '2016-11-07 11:14:32', '2016-11-07 11:14:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_list`
--

CREATE TABLE IF NOT EXISTS `ost_list` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_plural` varchar(255) DEFAULT NULL,
  `sort_mode` enum('Alpha','-Alpha','SortCol') NOT NULL DEFAULT 'Alpha',
  `masks` int(11) unsigned NOT NULL DEFAULT '0',
  `type` varchar(16) DEFAULT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_list`
--

INSERT INTO `ost_list` (`id`, `name`, `name_plural`, `sort_mode`, `masks`, `type`, `notes`, `created`, `updated`) VALUES
(1, 'Estado del Ticket', 'Estados del Ticket', 'SortCol', 13, 'ticket-status', 'Estados del Ticket', '2016-10-27 10:56:28', '2016-10-27 10:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_list_items`
--

CREATE TABLE IF NOT EXISTS `ost_list_items` (
`id` int(11) unsigned NOT NULL,
  `list_id` int(11) DEFAULT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '1',
  `value` varchar(255) NOT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `properties` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_note`
--

CREATE TABLE IF NOT EXISTS `ost_note` (
`id` int(11) unsigned NOT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `staff_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_id` varchar(10) DEFAULT NULL,
  `body` text,
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_organization`
--

CREATE TABLE IF NOT EXISTS `ost_organization` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT '',
  `manager` varchar(16) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `domain` varchar(256) NOT NULL DEFAULT '',
  `extra` text,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_organization`
--

INSERT INTO `ost_organization` (`id`, `name`, `manager`, `status`, `domain`, `extra`, `created`, `updated`) VALUES
(1, 'osTicket', '', 0, '', NULL, '2016-10-27 15:56:28', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_plugin`
--

CREATE TABLE IF NOT EXISTS `ost_plugin` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `install_path` varchar(60) NOT NULL,
  `isphar` tinyint(1) NOT NULL DEFAULT '0',
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(64) DEFAULT NULL,
  `installed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_sequence`
--

CREATE TABLE IF NOT EXISTS `ost_sequence` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `flags` int(10) unsigned DEFAULT NULL,
  `next` bigint(20) unsigned NOT NULL DEFAULT '1',
  `increment` int(11) DEFAULT '1',
  `padding` char(1) DEFAULT '0',
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_sequence`
--

INSERT INTO `ost_sequence` (`id`, `name`, `flags`, `next`, `increment`, `padding`, `updated`) VALUES
(1, 'Ticket general', 1, 1, 1, '0', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_session`
--

CREATE TABLE IF NOT EXISTS `ost_session` (
  `session_id` varchar(255) CHARACTER SET ascii NOT NULL DEFAULT '',
  `session_data` blob,
  `session_expire` datetime DEFAULT NULL,
  `session_updated` datetime DEFAULT NULL,
  `user_id` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'osTicket staff/client ID',
  `user_ip` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ost_session`
--

INSERT INTO `ost_session` (`session_id`, `session_data`, `session_expire`, `session_updated`, `user_id`, `user_ip`, `user_agent`) VALUES
('1m0f2faqdqrol3qj6ti7kfqlt5', 0x6366673a636f72657c613a313a7b733a393a22747a5f6f6666736574223b693a303b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2261373233303661623531626236353935343437353939373138353461323834393364383930633263223b733a343a2274696d65223b693a313437383533353330323b7d545a5f4f46465345547c693a303b545a5f4453547c733a313a2230223b6366673a6d7973716c7365617263687c613a303a7b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d, '2016-11-08 11:15:02', '2016-11-07 11:15:02', '0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36'),
('2pdvr6tmkdo01ufkf0mgbraih7', 0x6366673a636f72657c613a323a7b733a393a22747a5f6f6666736574223b693a303b733a31323a2264625f747a5f6f6666736574223b733a373a222d352e30303030223b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238666663663533363831636532646631663566663537353662646238663363303765333239386232223b733a343a2274696d65223b693a313437373630373733303b7d545a5f4f46465345547c4e3b545a5f4453547c623a303b6366673a6d7973716c7365617263687c613a303a7b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a32333a222f6f737469636b65742f7363702f696e6465782e706870223b733a333a226d7367223b733a32363a22417574656e7469666963616369c3b36e20526571756572696461223b7d7d5f617574687c613a323a7b733a353a227374616666223b613a323a7b733a323a226964223b733a313a2231223b733a333a226b6579223b733a32303a226c6f63616c3a6d696775656c67616c696e64657a223b7d733a343a2275736572223b4e3b7d6366673a73746166662e317c613a303a7b7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2233306263623736386666383433393963633433646165366536663536313862363a313437373630373730363a3833376563353735346635303363666161656530393239666434383937346537223b7d73746166663a6c616e677c733a353a2265735f4553223b3a3a517c733a343a226f70656e223b7365617263685f38633231623639623264343863646265346537626164633662313463386532367c733a323037313a2253454c454354207469636b65742e7469636b65745f69642c746c6f636b2e6c6f636b5f69642c7469636b65742e606e756d626572602c7469636b65742e646570745f69642c7469636b65742e73746166665f69642c7469636b65742e7465616d5f696420202c757365722e6e616d65202c656d61696c2e6164647265737320617320656d61696c2c20646570742e646570745f6e616d652c207374617475732e737461746520202c7374617475732e6e616d65206173207374617475732c7469636b65742e736f757263652c7469636b65742e69736f7665726475652c7469636b65742e6973616e7377657265642c7469636b65742e6372656174656420202c4946287469636b65742e64756564617465204953204e554c4c2c494628736c612e6964204953204e554c4c2c204e554c4c2c20444154455f414444287469636b65742e637265617465642c20494e54455256414c20736c612e67726163655f706572696f6420484f555229292c207469636b65742e6475656461746529206173206475656461746520202c434153542847524541544553542849464e554c4c287469636b65742e6c6173746d6573736167652c2030292c2049464e554c4c287469636b65742e636c6f7365642c2030292c2049464e554c4c287469636b65742e72656f70656e65642c2030292c207469636b65742e6372656174656429206173206461746574696d6529206173206566666563746976655f6461746520202c7469636b65742e63726561746564206173207469636b65745f637265617465642c20434f4e4341545f5753282220222c2073746166662e66697273746e616d652c2073746166662e6c6173746e616d65292061732073746166662c207465616d2e6e616d65206173207465616d20202c49462873746166662e73746166665f6964204953204e554c4c2c7465616d2e6e616d652c434f4e4341545f5753282220222c2073746166662e6c6173746e616d652c2073746166662e66697273746e616d6529292061732061737369676e656420202c49462870746f7069632e746f7069635f706964204953204e554c4c2c20746f7069632e746f7069632c20434f4e4341545f57532822202f20222c2070746f7069632e746f7069632c20746f7069632e746f70696329292061732068656c70746f70696320202c63646174612e7072696f72697479206173207072696f726974795f69642c2063646174612e7375626a6563742c207072692e7072696f726974795f646573632c207072692e7072696f726974795f636f6c6f72202046524f4d206f73745f7469636b6574207469636b657420204c454654204a4f494e206f73745f7469636b65745f737461747573207374617475730a2020202020202020202020204f4e20287374617475732e6964203d207469636b65742e7374617475735f69642920204c454654204a4f494e206f73745f757365722075736572204f4e20757365722e6964203d207469636b65742e757365725f6964204c454654204a4f494e206f73745f757365725f656d61696c20656d61696c204f4e20757365722e6964203d20656d61696c2e757365725f6964204c454654204a4f494e206f73745f6465706172746d656e742064657074204f4e207469636b65742e646570745f69643d646570742e646570745f696420204c454654204a4f494e206f73745f7469636b65745f6c6f636b20746c6f636b204f4e20287469636b65742e7469636b65745f69643d746c6f636b2e7469636b65745f696420414e4420746c6f636b2e6578706972653e4e4f5728290a202020202020202020202020202020414e4420746c6f636b2e73746166665f6964213d312920204c454654204a4f494e206f73745f7374616666207374616666204f4e20287469636b65742e73746166665f69643d73746166662e73746166665f69642920204c454654204a4f494e206f73745f7465616d207465616d204f4e20287469636b65742e7465616d5f69643d7465616d2e7465616d5f69642920204c454654204a4f494e206f73745f736c6120736c61204f4e20287469636b65742e736c615f69643d736c612e696420414e4420736c612e69736163746976653d312920204c454654204a4f494e206f73745f68656c705f746f70696320746f706963204f4e20287469636b65742e746f7069635f69643d746f7069632e746f7069635f69642920204c454654204a4f494e206f73745f68656c705f746f7069632070746f706963204f4e202870746f7069632e746f7069635f69643d746f7069632e746f7069635f7069642920204c454654204a4f494e206f73745f7469636b65745f5f6364617461206364617461204f4e202863646174612e7469636b65745f6964203d207469636b65742e7469636b65745f69642920204c454654204a4f494e206f73745f7469636b65745f7072696f7269747920707269204f4e20287072692e7072696f726974795f6964203d2063646174612e7072696f726974792920205748455245202820202028207469636b65742e73746166665f69643d3120414e44207374617475732e73746174653d226f70656e222920204f52207469636b65742e646570745f696420494e2028312c342c3529202920414e44207374617475732e737461746520494e20280a20202020202020202020202020202020276f70656e2720292020414e44207469636b65742e6973616e7377657265643d3020204f52444552204259207072692e7072696f726974795f757267656e6379204153432c206566666563746976655f6461746520444553432c207469636b65742e637265617465642044455343204c494d495420302c3235223b6366673a6c6973742e317c613a303a7b7d6c61737463726f6e63616c6c7c693a313437373630373730373b6366673a646570742e347c613a303a7b7d6366673a73746166662e327c613a303a7b7d6366673a73746166662e337c613a303a7b7d6366673a646570742e357c613a303a7b7d6366673a73746166662e347c613a303a7b7d, '2016-10-28 17:35:30', '2016-10-27 17:35:30', '1', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36'),
('evt7r2t5j4hpieiu9t56cung12', 0x6366673a636f72657c613a323a7b733a393a22747a5f6f6666736574223b693a303b733a31323a2264625f747a5f6f6666736574223b733a373a222d352e30303030223b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2264613139343266613763346365636536316565343162616562346537643335663139376661323033223b733a343a2274696d65223b693a313437373630313439383b7d545a5f4f46465345547c4e3b545a5f4453547c623a303b6366673a6d7973716c7365617263687c613a303a7b7d6366673a6c6973742e317c613a303a7b7d5f617574687c613a323a7b733a343a2275736572223b4e3b733a353a227374616666223b613a323a7b733a323a226964223b733a313a2231223b733a333a226b6579223b733a32303a226c6f63616c3a6d696775656c67616c696e64657a223b7d7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a31343a222f6f737469636b65742f7363702f223b733a333a226d7367223b733a32363a22417574656e7469666963616369c3b36e20526571756572696461223b7d7d6366673a73746166662e317c613a303a7b7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2238663238323335393633353866363133313434626663386235303162363030373a313437373630313439333a3833376563353735346635303363666161656530393239666434383937346537223b7d73746166663a6c616e677c733a353a2265735f4553223b3a3a517c733a343a226f70656e223b7365617263685f38633231623639623264343863646265346537626164633662313463386532367c733a323037313a2253454c454354207469636b65742e7469636b65745f69642c746c6f636b2e6c6f636b5f69642c7469636b65742e606e756d626572602c7469636b65742e646570745f69642c7469636b65742e73746166665f69642c7469636b65742e7465616d5f696420202c757365722e6e616d65202c656d61696c2e6164647265737320617320656d61696c2c20646570742e646570745f6e616d652c207374617475732e737461746520202c7374617475732e6e616d65206173207374617475732c7469636b65742e736f757263652c7469636b65742e69736f7665726475652c7469636b65742e6973616e7377657265642c7469636b65742e6372656174656420202c4946287469636b65742e64756564617465204953204e554c4c2c494628736c612e6964204953204e554c4c2c204e554c4c2c20444154455f414444287469636b65742e637265617465642c20494e54455256414c20736c612e67726163655f706572696f6420484f555229292c207469636b65742e6475656461746529206173206475656461746520202c434153542847524541544553542849464e554c4c287469636b65742e6c6173746d6573736167652c2030292c2049464e554c4c287469636b65742e636c6f7365642c2030292c2049464e554c4c287469636b65742e72656f70656e65642c2030292c207469636b65742e6372656174656429206173206461746574696d6529206173206566666563746976655f6461746520202c7469636b65742e63726561746564206173207469636b65745f637265617465642c20434f4e4341545f5753282220222c2073746166662e66697273746e616d652c2073746166662e6c6173746e616d65292061732073746166662c207465616d2e6e616d65206173207465616d20202c49462873746166662e73746166665f6964204953204e554c4c2c7465616d2e6e616d652c434f4e4341545f5753282220222c2073746166662e6c6173746e616d652c2073746166662e66697273746e616d6529292061732061737369676e656420202c49462870746f7069632e746f7069635f706964204953204e554c4c2c20746f7069632e746f7069632c20434f4e4341545f57532822202f20222c2070746f7069632e746f7069632c20746f7069632e746f70696329292061732068656c70746f70696320202c63646174612e7072696f72697479206173207072696f726974795f69642c2063646174612e7375626a6563742c207072692e7072696f726974795f646573632c207072692e7072696f726974795f636f6c6f72202046524f4d206f73745f7469636b6574207469636b657420204c454654204a4f494e206f73745f7469636b65745f737461747573207374617475730a2020202020202020202020204f4e20287374617475732e6964203d207469636b65742e7374617475735f69642920204c454654204a4f494e206f73745f757365722075736572204f4e20757365722e6964203d207469636b65742e757365725f6964204c454654204a4f494e206f73745f757365725f656d61696c20656d61696c204f4e20757365722e6964203d20656d61696c2e757365725f6964204c454654204a4f494e206f73745f6465706172746d656e742064657074204f4e207469636b65742e646570745f69643d646570742e646570745f696420204c454654204a4f494e206f73745f7469636b65745f6c6f636b20746c6f636b204f4e20287469636b65742e7469636b65745f69643d746c6f636b2e7469636b65745f696420414e4420746c6f636b2e6578706972653e4e4f5728290a202020202020202020202020202020414e4420746c6f636b2e73746166665f6964213d312920204c454654204a4f494e206f73745f7374616666207374616666204f4e20287469636b65742e73746166665f69643d73746166662e73746166665f69642920204c454654204a4f494e206f73745f7465616d207465616d204f4e20287469636b65742e7465616d5f69643d7465616d2e7465616d5f69642920204c454654204a4f494e206f73745f736c6120736c61204f4e20287469636b65742e736c615f69643d736c612e696420414e4420736c612e69736163746976653d312920204c454654204a4f494e206f73745f68656c705f746f70696320746f706963204f4e20287469636b65742e746f7069635f69643d746f7069632e746f7069635f69642920204c454654204a4f494e206f73745f68656c705f746f7069632070746f706963204f4e202870746f7069632e746f7069635f69643d746f7069632e746f7069635f7069642920204c454654204a4f494e206f73745f7469636b65745f5f6364617461206364617461204f4e202863646174612e7469636b65745f6964203d207469636b65742e7469636b65745f69642920204c454654204a4f494e206f73745f7469636b65745f7072696f7269747920707269204f4e20287072692e7072696f726974795f6964203d2063646174612e7072696f726974792920205748455245202820202028207469636b65742e73746166665f69643d3120414e44207374617475732e73746174653d226f70656e222920204f52207469636b65742e646570745f696420494e2028312c342c3529202920414e44207374617475732e737461746520494e20280a20202020202020202020202020202020276f70656e2720292020414e44207469636b65742e6973616e7377657265643d3020204f52444552204259207072692e7072696f726974795f757267656e6379204153432c206566666563746976655f6461746520444553432c207469636b65742e637265617465642044455343204c494d495420302c3235223b6c61737463726f6e63616c6c7c693a313437373630313439383b6366673a646570742e317c613a303a7b7d, '2016-10-28 15:51:38', '2016-10-27 15:51:38', '0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36'),
('g9r50a2f44samngnoepoivv1n4', 0x6366673a636f72657c613a323a7b733a393a22747a5f6f6666736574223b693a303b733a31323a2264625f747a5f6f6666736574223b733a373a222d352e30303030223b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2263323634653338313966306130323635313139316336626534653033383462386432623462396137223b733a343a2274696d65223b693a313437373539393233343b7d545a5f4f46465345547c4e3b545a5f4453547c623a303b6366673a6d7973716c7365617263687c613a303a7b7d5f617574687c613a313a7b733a353a227374616666223b613a323a7b733a323a226964223b733a313a2231223b733a333a226b6579223b733a32303a226c6f63616c3a6d696775656c67616c696e64657a223b7d7d6366673a73746166662e317c613a303a7b7d3a746f6b656e7c613a313a7b733a353a227374616666223b733a37363a2231336162336234646662303039353937653662346662363732623331613436333a313437373539393232383a3833376563353735346635303363666161656530393239666434383937346537223b7d73746166663a6c616e677c733a353a2265735f4553223b3a3a517c733a343a226f70656e223b7365617263685f38633231623639623264343863646265346537626164633662313463386532367c733a323037313a2253454c454354207469636b65742e7469636b65745f69642c746c6f636b2e6c6f636b5f69642c7469636b65742e606e756d626572602c7469636b65742e646570745f69642c7469636b65742e73746166665f69642c7469636b65742e7465616d5f696420202c757365722e6e616d65202c656d61696c2e6164647265737320617320656d61696c2c20646570742e646570745f6e616d652c207374617475732e737461746520202c7374617475732e6e616d65206173207374617475732c7469636b65742e736f757263652c7469636b65742e69736f7665726475652c7469636b65742e6973616e7377657265642c7469636b65742e6372656174656420202c4946287469636b65742e64756564617465204953204e554c4c2c494628736c612e6964204953204e554c4c2c204e554c4c2c20444154455f414444287469636b65742e637265617465642c20494e54455256414c20736c612e67726163655f706572696f6420484f555229292c207469636b65742e6475656461746529206173206475656461746520202c434153542847524541544553542849464e554c4c287469636b65742e6c6173746d6573736167652c2030292c2049464e554c4c287469636b65742e636c6f7365642c2030292c2049464e554c4c287469636b65742e72656f70656e65642c2030292c207469636b65742e6372656174656429206173206461746574696d6529206173206566666563746976655f6461746520202c7469636b65742e63726561746564206173207469636b65745f637265617465642c20434f4e4341545f5753282220222c2073746166662e66697273746e616d652c2073746166662e6c6173746e616d65292061732073746166662c207465616d2e6e616d65206173207465616d20202c49462873746166662e73746166665f6964204953204e554c4c2c7465616d2e6e616d652c434f4e4341545f5753282220222c2073746166662e6c6173746e616d652c2073746166662e66697273746e616d6529292061732061737369676e656420202c49462870746f7069632e746f7069635f706964204953204e554c4c2c20746f7069632e746f7069632c20434f4e4341545f57532822202f20222c2070746f7069632e746f7069632c20746f7069632e746f70696329292061732068656c70746f70696320202c63646174612e7072696f72697479206173207072696f726974795f69642c2063646174612e7375626a6563742c207072692e7072696f726974795f646573632c207072692e7072696f726974795f636f6c6f72202046524f4d206f73745f7469636b6574207469636b657420204c454654204a4f494e206f73745f7469636b65745f737461747573207374617475730a2020202020202020202020204f4e20287374617475732e6964203d207469636b65742e7374617475735f69642920204c454654204a4f494e206f73745f757365722075736572204f4e20757365722e6964203d207469636b65742e757365725f6964204c454654204a4f494e206f73745f757365725f656d61696c20656d61696c204f4e20757365722e6964203d20656d61696c2e757365725f6964204c454654204a4f494e206f73745f6465706172746d656e742064657074204f4e207469636b65742e646570745f69643d646570742e646570745f696420204c454654204a4f494e206f73745f7469636b65745f6c6f636b20746c6f636b204f4e20287469636b65742e7469636b65745f69643d746c6f636b2e7469636b65745f696420414e4420746c6f636b2e6578706972653e4e4f5728290a202020202020202020202020202020414e4420746c6f636b2e73746166665f6964213d312920204c454654204a4f494e206f73745f7374616666207374616666204f4e20287469636b65742e73746166665f69643d73746166662e73746166665f69642920204c454654204a4f494e206f73745f7465616d207465616d204f4e20287469636b65742e7465616d5f69643d7465616d2e7465616d5f69642920204c454654204a4f494e206f73745f736c6120736c61204f4e20287469636b65742e736c615f69643d736c612e696420414e4420736c612e69736163746976653d312920204c454654204a4f494e206f73745f68656c705f746f70696320746f706963204f4e20287469636b65742e746f7069635f69643d746f7069632e746f7069635f69642920204c454654204a4f494e206f73745f68656c705f746f7069632070746f706963204f4e202870746f7069632e746f7069635f69643d746f7069632e746f7069635f7069642920204c454654204a4f494e206f73745f7469636b65745f5f6364617461206364617461204f4e202863646174612e7469636b65745f6964203d207469636b65742e7469636b65745f69642920204c454654204a4f494e206f73745f7469636b65745f7072696f7269747920707269204f4e20287072692e7072696f726974795f6964203d2063646174612e7072696f726974792920205748455245202820202028207469636b65742e73746166665f69643d3120414e44207374617475732e73746174653d226f70656e222920204f52207469636b65742e646570745f696420494e2028312c342c3529202920414e44207374617475732e737461746520494e20280a20202020202020202020202020202020276f70656e2720292020414e44207469636b65742e6973616e7377657265643d3020204f52444552204259207072692e7072696f726974795f757267656e6379204153432c206566666563746976655f6461746520444553432c207469636b65742e637265617465642044455343204c494d495420302c3235223b6366673a6c6973742e317c613a303a7b7d6c61737463726f6e63616c6c7c693a313437373539393233333b6366673a646570742e317c613a303a7b7d, '2016-10-28 15:13:54', '2016-10-27 15:13:54', '1', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36'),
('nebmr0ami4a94i9ls917a0cso0', 0x6366673a636f72657c613a313a7b733a393a22747a5f6f6666736574223b693a303b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2266396463333164383534333037383561353261376265616239303337353935333663393864303431223b733a343a2274696d65223b693a313437373538383036393b7d545a5f4f46465345547c693a303b545a5f4453547c733a313a2230223b6366673a6d7973716c7365617263687c613a303a7b7d5f617574687c613a313a7b733a353a227374616666223b4e3b7d5f73746166667c613a313a7b733a343a2261757468223b613a323a7b733a343a2264657374223b733a36323a222f6f737469636b65742f7363702f6c6f676f75742e7068703f617574683d3636663735633366643733306533306537323163313066663461373830353033223b733a333a226d7367223b733a32363a22417574656e7469666963616369c3b36e20526571756572696461223b7d7d, '2016-10-28 12:07:49', '2016-10-27 12:07:49', '0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36'),
('qb45somes56pgfcgs4mkmklei6', 0x6366673a636f72657c613a313a7b733a393a22747a5f6f6666736574223b693a303b7d637372667c613a323a7b733a353a22746f6b656e223b733a34303a2238626661623764393761353137623031356238353331323237613730313031356334343866333534223b733a343a2274696d65223b693a313437373630313432393b7d545a5f4f46465345547c693a303b545a5f4453547c733a313a2230223b6366673a6d7973716c7365617263687c613a303a7b7d6366673a6c6973742e317c613a303a7b7d, '2016-10-28 15:50:29', '2016-10-27 15:50:29', '0', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_sla`
--

CREATE TABLE IF NOT EXISTS `ost_sla` (
`id` int(11) unsigned NOT NULL,
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_priority_escalation` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `disable_overdue_alerts` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `grace_period` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_sla`
--

INSERT INTO `ost_sla` (`id`, `isactive`, `enable_priority_escalation`, `disable_overdue_alerts`, `grace_period`, `name`, `notes`, `created`, `updated`) VALUES
(1, 1, 1, 0, 48, 'SLA por defecto', '', '2016-10-27 10:56:27', '2016-10-27 10:56:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_staff`
--

CREATE TABLE IF NOT EXISTS `ost_staff` (
`staff_id` int(11) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `timezone_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(32) NOT NULL DEFAULT '',
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `passwd` varchar(128) DEFAULT NULL,
  `backend` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` varchar(24) NOT NULL DEFAULT '',
  `phone_ext` varchar(6) DEFAULT NULL,
  `mobile` varchar(24) NOT NULL DEFAULT '',
  `signature` text NOT NULL,
  `notes` text,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `isvisible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `onvacation` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `assigned_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `show_assigned_tickets` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `daylight_saving` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `change_passwd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `max_page_size` int(11) unsigned NOT NULL DEFAULT '0',
  `auto_refresh_rate` int(10) unsigned NOT NULL DEFAULT '0',
  `default_signature_type` enum('none','mine','dept') NOT NULL DEFAULT 'none',
  `default_paper_size` enum('Letter','Legal','Ledger','A4','A3') NOT NULL DEFAULT 'Letter',
  `created` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `passwdreset` datetime DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_staff`
--

INSERT INTO `ost_staff` (`staff_id`, `group_id`, `dept_id`, `timezone_id`, `username`, `firstname`, `lastname`, `passwd`, `backend`, `email`, `phone`, `phone_ext`, `mobile`, `signature`, `notes`, `isactive`, `isadmin`, `isvisible`, `onvacation`, `assigned_only`, `show_assigned_tickets`, `daylight_saving`, `change_passwd`, `max_page_size`, `auto_refresh_rate`, `default_signature_type`, `default_paper_size`, `created`, `lastlogin`, `passwdreset`, `updated`) VALUES
(1, 1, 4, 8, 'miguelgalindez', 'Miguel Angel', 'Galindez Muñoz', '$2a$08$oRR9z1HGtekObwFF5c5TwOARw5fPnE1qqKa5oXyoI1.vlhcMng32K', NULL, 'miguelgalindez@unicauca.edu.co', '', NULL, '', '', NULL, 1, 1, 1, 0, 0, 0, 0, 0, 25, 0, 'none', 'Letter', '2016-10-27 10:56:28', '2016-11-07 11:12:40', NULL, '0000-00-00 00:00:00'),
(2, 1, 4, 8, 'jhreyes', 'Jhon Holman', 'Reyes Ceron', '40be4e59b9a2a2b5dffb918c0e86b3d7', 'local', 'jhreyes@unicauca.edu.co', '820-9900', '55', '321587415', '', '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'none', 'Letter', '2016-10-27 11:53:42', NULL, NULL, '2016-10-27 11:55:27'),
(3, 1, 4, 8, 'ttoledo123', 'Teresa', 'Toledo', '$2a$08$mdnfqAlJhBZQ4k1jfd7Z4uHmmxpsuB6XoAZ/ttAMcWLl3d3PuylDq', 'local', 'ttoledo123@unicauca.edu.co', '820-9900', '55', '321457894', '', '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'none', 'Letter', '2016-10-27 11:57:05', '2016-10-27 15:08:50', NULL, '2016-10-27 11:57:27'),
(4, 1, 5, 8, 'miryam', 'Miryam', 'Garcia', '40be4e59b9a2a2b5dffb918c0e86b3d7', 'local', 'miryam123@unicauca.edu.co', '820-9900', '55', '324587145', '', '', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 'none', 'Letter', '2016-10-27 11:59:58', NULL, NULL, '2016-10-27 11:59:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_syslog`
--

CREATE TABLE IF NOT EXISTS `ost_syslog` (
`log_id` int(11) unsigned NOT NULL,
  `log_type` enum('Debug','Warning','Error') NOT NULL,
  `title` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `logger` varchar(64) NOT NULL,
  `ip_address` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_team`
--

CREATE TABLE IF NOT EXISTS `ost_team` (
`team_id` int(10) unsigned NOT NULL,
  `lead_id` int(10) unsigned NOT NULL DEFAULT '0',
  `isenabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `noalerts` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(125) NOT NULL DEFAULT '',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_team`
--

INSERT INTO `ost_team` (`team_id`, `lead_id`, `isenabled`, `noalerts`, `name`, `notes`, `created`, `updated`) VALUES
(2, 3, 1, 0, 'Area de soporte', '', '2016-10-27 11:51:12', '2016-10-27 11:57:36'),
(3, 0, 1, 0, 'Contacto 55', '', '2016-10-27 15:10:48', '2016-10-27 15:10:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_team_member`
--

CREATE TABLE IF NOT EXISTS `ost_team_member` (
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_team_member`
--

INSERT INTO `ost_team_member` (`team_id`, `staff_id`, `updated`) VALUES
(2, 2, '2016-10-27 11:53:42'),
(2, 3, '2016-10-27 11:57:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket`
--

CREATE TABLE IF NOT EXISTS `ost_ticket` (
`ticket_id` int(11) unsigned NOT NULL,
  `number` varchar(20) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email_id` int(11) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `source` enum('Web','Email','Phone','API','Other') NOT NULL DEFAULT 'Other',
  `isoverdue` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isanswered` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `duedate` datetime DEFAULT NULL,
  `reopened` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `lastmessage` datetime DEFAULT NULL,
  `lastresponse` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_attachment`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_attachment` (
`attach_id` int(11) unsigned NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ref_id` int(11) unsigned NOT NULL DEFAULT '0',
  `inline` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_collaborator`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_collaborator` (
`id` int(11) unsigned NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `role` char(1) NOT NULL DEFAULT 'M',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_email_info`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_email_info` (
`id` int(11) unsigned NOT NULL,
  `thread_id` int(11) unsigned NOT NULL,
  `email_mid` varchar(255) NOT NULL,
  `headers` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_event`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_event` (
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(11) unsigned NOT NULL,
  `team_id` int(11) unsigned NOT NULL,
  `dept_id` int(11) unsigned NOT NULL,
  `topic_id` int(11) unsigned NOT NULL,
  `state` enum('created','closed','reopened','assigned','transferred','overdue') NOT NULL,
  `staff` varchar(255) NOT NULL DEFAULT 'SYSTEM',
  `annulled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_ticket_event`
--

INSERT INTO `ost_ticket_event` (`ticket_id`, `staff_id`, `team_id`, `dept_id`, `topic_id`, `state`, `staff`, `annulled`, `timestamp`) VALUES
(1, 0, 0, 1, 1, 'created', 'SYSTEM', 0, '2016-10-27 10:56:29'),
(2, 2, 0, 4, 3, 'assigned', 'miguelgalindez', 0, '2016-10-27 17:22:06'),
(2, 2, 0, 4, 3, 'created', 'miguelgalindez', 0, '2016-10-27 17:22:06'),
(3, 4, 0, 5, 5, 'assigned', 'miguelgalindez', 0, '2016-10-27 17:25:15'),
(3, 4, 0, 5, 5, 'created', 'miguelgalindez', 0, '2016-10-27 17:25:15'),
(5, 1, 0, 4, 5, 'overdue', 'SYSTEM', 0, '2016-10-27 17:35:07'),
(1, 0, 0, 1, 0, 'overdue', 'SYSTEM', 0, '2016-11-07 11:12:40'),
(2, 2, 0, 4, 3, 'overdue', 'SYSTEM', 0, '2016-11-07 11:12:40'),
(3, 4, 0, 5, 5, 'overdue', 'SYSTEM', 0, '2016-11-07 11:12:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_lock`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_lock` (
`lock_id` int(11) unsigned NOT NULL,
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `expire` datetime DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_priority`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_priority` (
`priority_id` tinyint(4) NOT NULL,
  `priority` varchar(60) NOT NULL DEFAULT '',
  `priority_desc` varchar(30) NOT NULL DEFAULT '',
  `priority_color` varchar(7) NOT NULL DEFAULT '',
  `priority_urgency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ispublic` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_ticket_priority`
--

INSERT INTO `ost_ticket_priority` (`priority_id`, `priority`, `priority_desc`, `priority_color`, `priority_urgency`, `ispublic`) VALUES
(1, 'low', 'Baja', '#DDFFDD', 4, 1),
(2, 'normal', 'Normal', '#FFFFF0', 3, 1),
(3, 'high', 'Alta', '#FEE7E7', 2, 1),
(4, 'emergency', 'Urgente', '#FEE7E7', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_status`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_status` (
`id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `state` varchar(16) DEFAULT NULL,
  `mode` int(11) unsigned NOT NULL DEFAULT '0',
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `properties` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_ticket_status`
--

INSERT INTO `ost_ticket_status` (`id`, `name`, `state`, `mode`, `flags`, `sort`, `properties`, `created`, `updated`) VALUES
(1, 'Abierto', 'open', 3, 0, 1, '{"description":"Tickets abiertos."}', '2016-10-27 10:56:28', '0000-00-00 00:00:00'),
(2, 'Resuelto', 'resolved', 3, 0, 2, '{"description":"Ticket resueltos est\\u00e1n cerrados, estos pueden ser reabiertos por el usuario final. Esto puede ser \\u00fatil cuando se usa un disparador para cerrar Tickets resueltos con aviso enviado al usuario final."}', '2016-10-27 10:56:28', '0000-00-00 00:00:00'),
(3, 'Cerrado', 'closed', 3, 0, 3, '{"description":"Ticket marcados como cerrado no pueden ser reabiertos por el usuario final. Los Tickets estar\\u00e1n accesibles en los paneles de clientes y personal."}', '2016-10-27 10:56:28', '0000-00-00 00:00:00'),
(4, 'Archivado', 'archived', 3, 0, 4, '{"description":"Tickets s\\u00f3lo disponible  y administrable, pero ya no accesible en las colas de entrada."}', '2016-10-27 10:56:28', '0000-00-00 00:00:00'),
(5, 'Borrado', 'deleted', 3, 0, 5, '{"description":"Tickets en cola para su eliminaci\\u00f3n. No se puede acceder en las colas de entrada."}', '2016-10-27 10:56:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket_thread`
--

CREATE TABLE IF NOT EXISTS `ost_ticket_thread` (
`id` int(11) unsigned NOT NULL,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `thread_type` enum('M','R','N') NOT NULL,
  `poster` varchar(128) NOT NULL DEFAULT '',
  `source` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `body` mediumtext NOT NULL,
  `format` varchar(16) NOT NULL DEFAULT 'html',
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_ticket__cdata`
--

CREATE TABLE IF NOT EXISTS `ost_ticket__cdata` (
  `ticket_id` int(11) unsigned NOT NULL DEFAULT '0',
  `subject` mediumtext,
  `priority` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_timezone`
--

CREATE TABLE IF NOT EXISTS `ost_timezone` (
`id` int(11) unsigned NOT NULL,
  `offset` float(3,1) NOT NULL DEFAULT '0.0',
  `timezone` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ost_timezone`
--

INSERT INTO `ost_timezone` (`id`, `offset`, `timezone`) VALUES
(1, -12.0, 'Eniwetok, Kwajalein'),
(2, -11.0, 'Midway Island, Samoa'),
(3, -10.0, 'Hawaii'),
(4, -9.0, 'Alaska'),
(5, -8.0, 'Pacific Time (US & Canada)'),
(6, -7.0, 'Mountain Time (US & Canada)'),
(7, -6.0, 'Central Time (US & Canada), Mexico City'),
(8, -5.0, 'Eastern Time (US & Canada), Bogota, Lima'),
(9, -4.0, 'Atlantic Time (Canada), Caracas, La Paz'),
(10, -3.5, 'Newfoundland'),
(11, -3.0, 'Brazil, Buenos Aires, Georgetown'),
(12, -2.0, 'Mid-Atlantic'),
(13, -1.0, 'Azores, Cape Verde Islands'),
(14, 0.0, 'Western Europe Time, London, Lisbon, Casablanca'),
(15, 1.0, 'Brussels, Copenhagen, Madrid, Paris'),
(16, 2.0, 'Kaliningrad, South Africa'),
(17, 3.0, 'Baghdad, Riyadh, Moscow, St. Petersburg'),
(18, 3.5, 'Tehran'),
(19, 4.0, 'Abu Dhabi, Muscat, Baku, Tbilisi'),
(20, 4.5, 'Kabul'),
(21, 5.0, 'Ekaterinburg, Islamabad, Karachi, Tashkent'),
(22, 5.5, 'Bombay, Calcutta, Madras, New Delhi'),
(23, 6.0, 'Almaty, Dhaka, Colombo'),
(24, 7.0, 'Bangkok, Hanoi, Jakarta'),
(25, 8.0, 'Beijing, Perth, Singapore, Hong Kong'),
(26, 9.0, 'Tokyo, Seoul, Osaka, Sapporo, Yakutsk'),
(27, 9.5, 'Adelaide, Darwin'),
(28, 10.0, 'Eastern Australia, Guam, Vladivostok'),
(29, 11.0, 'Magadan, Solomon Islands, New Caledonia'),
(30, 12.0, 'Auckland, Wellington, Fiji, Kamchatka');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_user`
--

CREATE TABLE IF NOT EXISTS `ost_user` (
`id` int(10) unsigned NOT NULL,
  `org_id` int(10) unsigned NOT NULL,
  `default_email_id` int(10) NOT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_user_account`
--

CREATE TABLE IF NOT EXISTS `ost_user_account` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `timezone_id` int(11) NOT NULL DEFAULT '0',
  `dst` tinyint(1) NOT NULL DEFAULT '1',
  `lang` varchar(16) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `passwd` varchar(128) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `backend` varchar(32) DEFAULT NULL,
  `registered` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost_user_email`
--

CREATE TABLE IF NOT EXISTS `ost_user_email` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ost__search`
--

CREATE TABLE IF NOT EXISTS `ost__search` (
  `object_type` varchar(8) NOT NULL,
  `object_id` int(11) unsigned NOT NULL,
  `title` text,
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ost_api_key`
--
ALTER TABLE `ost_api_key`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `apikey` (`apikey`), ADD KEY `ipaddr` (`ipaddr`);

--
-- Indices de la tabla `ost_attachment`
--
ALTER TABLE `ost_attachment`
 ADD PRIMARY KEY (`object_id`,`file_id`,`type`);

--
-- Indices de la tabla `ost_canned_response`
--
ALTER TABLE `ost_canned_response`
 ADD PRIMARY KEY (`canned_id`), ADD UNIQUE KEY `title` (`title`), ADD KEY `dept_id` (`dept_id`), ADD KEY `active` (`isenabled`);

--
-- Indices de la tabla `ost_config`
--
ALTER TABLE `ost_config`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `namespace` (`namespace`,`key`);

--
-- Indices de la tabla `ost_content`
--
ALTER TABLE `ost_content`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `ost_department`
--
ALTER TABLE `ost_department`
 ADD PRIMARY KEY (`dept_id`), ADD UNIQUE KEY `dept_name` (`dept_name`), ADD KEY `manager_id` (`manager_id`), ADD KEY `autoresp_email_id` (`autoresp_email_id`), ADD KEY `tpl_id` (`tpl_id`);

--
-- Indices de la tabla `ost_draft`
--
ALTER TABLE `ost_draft`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_email`
--
ALTER TABLE `ost_email`
 ADD PRIMARY KEY (`email_id`), ADD UNIQUE KEY `email` (`email`), ADD KEY `priority_id` (`priority_id`), ADD KEY `dept_id` (`dept_id`);

--
-- Indices de la tabla `ost_email_account`
--
ALTER TABLE `ost_email_account`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_email_template`
--
ALTER TABLE `ost_email_template`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `template_lookup` (`tpl_id`,`code_name`);

--
-- Indices de la tabla `ost_email_template_group`
--
ALTER TABLE `ost_email_template_group`
 ADD PRIMARY KEY (`tpl_id`);

--
-- Indices de la tabla `ost_faq`
--
ALTER TABLE `ost_faq`
 ADD PRIMARY KEY (`faq_id`), ADD UNIQUE KEY `question` (`question`), ADD KEY `category_id` (`category_id`), ADD KEY `ispublished` (`ispublished`);

--
-- Indices de la tabla `ost_faq_category`
--
ALTER TABLE `ost_faq_category`
 ADD PRIMARY KEY (`category_id`), ADD KEY `ispublic` (`ispublic`);

--
-- Indices de la tabla `ost_faq_topic`
--
ALTER TABLE `ost_faq_topic`
 ADD PRIMARY KEY (`faq_id`,`topic_id`);

--
-- Indices de la tabla `ost_file`
--
ALTER TABLE `ost_file`
 ADD PRIMARY KEY (`id`), ADD KEY `ft` (`ft`), ADD KEY `key` (`key`), ADD KEY `signature` (`signature`);

--
-- Indices de la tabla `ost_file_chunk`
--
ALTER TABLE `ost_file_chunk`
 ADD PRIMARY KEY (`file_id`,`chunk_id`);

--
-- Indices de la tabla `ost_filter`
--
ALTER TABLE `ost_filter`
 ADD PRIMARY KEY (`id`), ADD KEY `target` (`target`), ADD KEY `email_id` (`email_id`);

--
-- Indices de la tabla `ost_filter_rule`
--
ALTER TABLE `ost_filter_rule`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `filter` (`filter_id`,`what`,`how`,`val`), ADD KEY `filter_id` (`filter_id`);

--
-- Indices de la tabla `ost_form`
--
ALTER TABLE `ost_form`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_form_entry`
--
ALTER TABLE `ost_form_entry`
 ADD PRIMARY KEY (`id`), ADD KEY `entry_lookup` (`object_type`,`object_id`);

--
-- Indices de la tabla `ost_form_entry_values`
--
ALTER TABLE `ost_form_entry_values`
 ADD PRIMARY KEY (`entry_id`,`field_id`);

--
-- Indices de la tabla `ost_form_field`
--
ALTER TABLE `ost_form_field`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_groups`
--
ALTER TABLE `ost_groups`
 ADD PRIMARY KEY (`group_id`), ADD KEY `group_active` (`group_enabled`);

--
-- Indices de la tabla `ost_group_dept_access`
--
ALTER TABLE `ost_group_dept_access`
 ADD UNIQUE KEY `group_dept` (`group_id`,`dept_id`), ADD KEY `dept_id` (`dept_id`);

--
-- Indices de la tabla `ost_help_topic`
--
ALTER TABLE `ost_help_topic`
 ADD PRIMARY KEY (`topic_id`), ADD UNIQUE KEY `topic` (`topic`,`topic_pid`), ADD KEY `topic_pid` (`topic_pid`), ADD KEY `priority_id` (`priority_id`), ADD KEY `dept_id` (`dept_id`), ADD KEY `staff_id` (`staff_id`,`team_id`), ADD KEY `sla_id` (`sla_id`), ADD KEY `page_id` (`page_id`);

--
-- Indices de la tabla `ost_list`
--
ALTER TABLE `ost_list`
 ADD PRIMARY KEY (`id`), ADD KEY `type` (`type`);

--
-- Indices de la tabla `ost_list_items`
--
ALTER TABLE `ost_list_items`
 ADD PRIMARY KEY (`id`), ADD KEY `list_item_lookup` (`list_id`);

--
-- Indices de la tabla `ost_note`
--
ALTER TABLE `ost_note`
 ADD PRIMARY KEY (`id`), ADD KEY `ext_id` (`ext_id`);

--
-- Indices de la tabla `ost_organization`
--
ALTER TABLE `ost_organization`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_plugin`
--
ALTER TABLE `ost_plugin`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_sequence`
--
ALTER TABLE `ost_sequence`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_session`
--
ALTER TABLE `ost_session`
 ADD PRIMARY KEY (`session_id`), ADD KEY `updated` (`session_updated`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ost_sla`
--
ALTER TABLE `ost_sla`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `ost_staff`
--
ALTER TABLE `ost_staff`
 ADD PRIMARY KEY (`staff_id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `dept_id` (`dept_id`), ADD KEY `issuperuser` (`isadmin`), ADD KEY `group_id` (`group_id`,`staff_id`);

--
-- Indices de la tabla `ost_syslog`
--
ALTER TABLE `ost_syslog`
 ADD PRIMARY KEY (`log_id`), ADD KEY `log_type` (`log_type`);

--
-- Indices de la tabla `ost_team`
--
ALTER TABLE `ost_team`
 ADD PRIMARY KEY (`team_id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `isnabled` (`isenabled`), ADD KEY `lead_id` (`lead_id`);

--
-- Indices de la tabla `ost_team_member`
--
ALTER TABLE `ost_team_member`
 ADD PRIMARY KEY (`team_id`,`staff_id`);

--
-- Indices de la tabla `ost_ticket`
--
ALTER TABLE `ost_ticket`
 ADD PRIMARY KEY (`ticket_id`), ADD KEY `user_id` (`user_id`), ADD KEY `dept_id` (`dept_id`), ADD KEY `staff_id` (`staff_id`), ADD KEY `team_id` (`team_id`), ADD KEY `status_id` (`status_id`), ADD KEY `created` (`created`), ADD KEY `closed` (`closed`), ADD KEY `duedate` (`duedate`), ADD KEY `topic_id` (`topic_id`), ADD KEY `sla_id` (`sla_id`);

--
-- Indices de la tabla `ost_ticket_attachment`
--
ALTER TABLE `ost_ticket_attachment`
 ADD PRIMARY KEY (`attach_id`), ADD KEY `ticket_id` (`ticket_id`), ADD KEY `ref_id` (`ref_id`), ADD KEY `file_id` (`file_id`);

--
-- Indices de la tabla `ost_ticket_collaborator`
--
ALTER TABLE `ost_ticket_collaborator`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `collab` (`ticket_id`,`user_id`);

--
-- Indices de la tabla `ost_ticket_email_info`
--
ALTER TABLE `ost_ticket_email_info`
 ADD PRIMARY KEY (`id`), ADD KEY `email_mid` (`email_mid`);

--
-- Indices de la tabla `ost_ticket_event`
--
ALTER TABLE `ost_ticket_event`
 ADD KEY `ticket_state` (`ticket_id`,`state`,`timestamp`), ADD KEY `ticket_stats` (`timestamp`,`state`);

--
-- Indices de la tabla `ost_ticket_lock`
--
ALTER TABLE `ost_ticket_lock`
 ADD PRIMARY KEY (`lock_id`), ADD UNIQUE KEY `ticket_id` (`ticket_id`), ADD KEY `staff_id` (`staff_id`);

--
-- Indices de la tabla `ost_ticket_priority`
--
ALTER TABLE `ost_ticket_priority`
 ADD PRIMARY KEY (`priority_id`), ADD UNIQUE KEY `priority` (`priority`), ADD KEY `priority_urgency` (`priority_urgency`), ADD KEY `ispublic` (`ispublic`);

--
-- Indices de la tabla `ost_ticket_status`
--
ALTER TABLE `ost_ticket_status`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `state` (`state`);

--
-- Indices de la tabla `ost_ticket_thread`
--
ALTER TABLE `ost_ticket_thread`
 ADD PRIMARY KEY (`id`), ADD KEY `ticket_id` (`ticket_id`), ADD KEY `staff_id` (`staff_id`), ADD KEY `pid` (`pid`);

--
-- Indices de la tabla `ost_ticket__cdata`
--
ALTER TABLE `ost_ticket__cdata`
 ADD PRIMARY KEY (`ticket_id`);

--
-- Indices de la tabla `ost_timezone`
--
ALTER TABLE `ost_timezone`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ost_user`
--
ALTER TABLE `ost_user`
 ADD PRIMARY KEY (`id`), ADD KEY `org_id` (`org_id`);

--
-- Indices de la tabla `ost_user_account`
--
ALTER TABLE `ost_user_account`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ost_user_email`
--
ALTER TABLE `ost_user_email`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `address` (`address`), ADD KEY `user_email_lookup` (`user_id`);

--
-- Indices de la tabla `ost__search`
--
ALTER TABLE `ost__search`
 ADD PRIMARY KEY (`object_type`,`object_id`), ADD FULLTEXT KEY `search` (`title`,`content`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ost_api_key`
--
ALTER TABLE `ost_api_key`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_canned_response`
--
ALTER TABLE `ost_canned_response`
MODIFY `canned_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ost_config`
--
ALTER TABLE `ost_config`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT de la tabla `ost_content`
--
ALTER TABLE `ost_content`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ost_department`
--
ALTER TABLE `ost_department`
MODIFY `dept_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ost_draft`
--
ALTER TABLE `ost_draft`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ost_email`
--
ALTER TABLE `ost_email`
MODIFY `email_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ost_email_account`
--
ALTER TABLE `ost_email_account`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_email_template`
--
ALTER TABLE `ost_email_template`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `ost_email_template_group`
--
ALTER TABLE `ost_email_template_group`
MODIFY `tpl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_faq`
--
ALTER TABLE `ost_faq`
MODIFY `faq_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_faq_category`
--
ALTER TABLE `ost_faq_category`
MODIFY `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_file`
--
ALTER TABLE `ost_file`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ost_filter`
--
ALTER TABLE `ost_filter`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_filter_rule`
--
ALTER TABLE `ost_filter_rule`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_form`
--
ALTER TABLE `ost_form`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ost_form_entry`
--
ALTER TABLE `ost_form_entry`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `ost_form_field`
--
ALTER TABLE `ost_form_field`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `ost_groups`
--
ALTER TABLE `ost_groups`
MODIFY `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ost_help_topic`
--
ALTER TABLE `ost_help_topic`
MODIFY `topic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `ost_list`
--
ALTER TABLE `ost_list`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_list_items`
--
ALTER TABLE `ost_list_items`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_note`
--
ALTER TABLE `ost_note`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_organization`
--
ALTER TABLE `ost_organization`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_plugin`
--
ALTER TABLE `ost_plugin`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_sequence`
--
ALTER TABLE `ost_sequence`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_sla`
--
ALTER TABLE `ost_sla`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ost_staff`
--
ALTER TABLE `ost_staff`
MODIFY `staff_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ost_syslog`
--
ALTER TABLE `ost_syslog`
MODIFY `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ost_team`
--
ALTER TABLE `ost_team`
MODIFY `team_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ost_ticket`
--
ALTER TABLE `ost_ticket`
MODIFY `ticket_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_attachment`
--
ALTER TABLE `ost_ticket_attachment`
MODIFY `attach_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_collaborator`
--
ALTER TABLE `ost_ticket_collaborator`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_email_info`
--
ALTER TABLE `ost_ticket_email_info`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_lock`
--
ALTER TABLE `ost_ticket_lock`
MODIFY `lock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_priority`
--
ALTER TABLE `ost_ticket_priority`
MODIFY `priority_id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_status`
--
ALTER TABLE `ost_ticket_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `ost_ticket_thread`
--
ALTER TABLE `ost_ticket_thread`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `ost_timezone`
--
ALTER TABLE `ost_timezone`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `ost_user`
--
ALTER TABLE `ost_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ost_user_account`
--
ALTER TABLE `ost_user_account`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ost_user_email`
--
ALTER TABLE `ost_user_email`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
