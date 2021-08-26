-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 10:43 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephpadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `logtime` datetime NOT NULL,
  `ipaddress` varbinary(16) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `uid`, `logtime`, `ipaddress`, `flag`) VALUES
(1, 1, '2020-07-09 23:00:23', 0x7f000001, 0),
(2, 0, '2020-07-09 23:53:51', 0x7f000001, 0),
(3, 1, '2020-07-09 23:56:24', 0x7f000001, 0),
(4, 6, '2020-07-10 00:57:05', 0x7f000001, 0),
(5, 6, '2020-07-10 00:57:26', 0x7f000001, 0),
(6, 8, '2020-07-10 00:59:09', 0x7f000001, 0),
(7, 8, '2020-07-10 01:57:46', 0x7f000001, 0),
(8, 8, '2020-07-10 01:58:09', 0x7f000001, 0),
(9, 8, '2020-07-10 01:58:42', 0x7f000001, 0),
(10, 0, '2020-07-10 02:25:17', 0x7f000001, 0),
(11, 0, '2020-07-10 02:25:22', 0x7f000001, 0),
(12, 2, '2021-08-26 13:23:19', 0x7f000001, 0),
(13, 2, '2021-08-26 13:24:00', 0x7f000001, 0),
(14, 1, '2021-08-26 13:57:45', 0x7f000001, 0);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `slug` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_general_mysql500_ci NOT NULL,
  `meta_title` varchar(250) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `cloud_tags` longtext COLLATE utf8_general_mysql500_ci NOT NULL,
  `url` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `header_image` varchar(250) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `slug`, `excerpt`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `cloud_tags`, `url`, `header_image`, `sort_order`, `status`, `created_at`, `modified_at`) VALUES
(1, 1, 'Terms & Condition', NULL, '', '<p>Coming soon...</p>\r\n', '', '', '', '', 'terms-condition', '', 0, 1, '2019-07-11 03:59:29', '2020-05-12 05:22:10'),
(2, 1, 'Privacy Policy', NULL, '', '<p>Coming soon..</p>\r\n', '', '', '', '', 'privacy-policy', '', 0, 1, '2019-07-11 04:00:52', '2020-05-12 05:21:53'),
(3, 1, 'How it Works', NULL, '', '<p>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage.</p>\r\n', '', '', '', '', 'how-it-works', '', 0, 1, '2019-07-11 04:01:42', '2020-06-28 05:30:35'),
(8, 1, 'Teams', 'teams', '', '<p>Teams</p>\r\n', '', '', '', '', 'teams', 'Hire-Drivers-for-all-types.jpg', 0, 1, '2020-06-28 04:16:38', '2020-07-09 02:11:18'),
(5, 1, 'Why Us', 'whyus', '', '<p>Coming Soon....</p>\r\n', '', '', '', '', 'why-us', '', 0, 1, '2019-07-11 04:02:37', '2020-05-12 05:20:19'),
(6, 1, 'About Us', 'about', '', '<p>Coming Soon...</p>\r\n', '', '', '', '', 'about-us', '', 0, 1, '2019-07-11 04:03:30', '2020-05-12 05:19:51'),
(7, 1, 'Sitemap', NULL, '', '<p>Coming Soon...</p>\r\n', '', '', '', '', 'sitemap', '', 0, 1, '2019-07-11 04:06:56', '2020-05-12 05:22:21'),
(9, 1, 'Driving Recruitment Agency', NULL, 'Quality driving recruitment agency', '<p>We wouldn&rsquo;t be doing our job properly if we didn&rsquo;t ensure that you were able to provide your services without problems. Our ethos is to support our clients in the same way as we care about our own team. With this in mind, we have developed a robust screening process that we can be sure covers all bases so you will not have any unexpected surprises from your new team members. As already noted in transport this means we have made careful checks of their driving license documentation, but we do further than that.</p>\r\n\r\n<ul class=\"bulletText  checkBullets cf\">\r\n	<li>Reliable</li>\r\n	<li>Trustworthy</li>\r\n	<li>Honest</li>\r\n	<li>Dedicated</li>\r\n	<li>Compliant</li>\r\n</ul>\r\n', '', '', '', '', 'driving-recruitment-agency-2', 'Driving-Recruitment-Agencies.jpg', 0, 1, '2020-06-28 05:00:05', NULL),
(10, 1, 'Driving Recruitment Checks', NULL, 'In-depth driving recruitment & licencing checks', '<p>We make checks on work history, take up references and ensure that the candidate has the right to work here in the UK. There are many checks we can make, and some do depend on the industry, but we are confident we have covered everything for our transport and logistics clients. If you want to know whether we have made a specific check, please do ask us, and our team will be more than happy to go through the whole process with you.</p>\r\n\r\n<ul class=\"bulletText  checkBullets cf\">\r\n	<li>Qualification checks</li>\r\n	<li>Screening and vetting</li>\r\n	<li>Right to work checks</li>\r\n	<li>Work &amp; personal references obtained</li>\r\n	<li>DBS/CRB checks</li>\r\n</ul>\r\n', '', '', '', '', 'driving-recruitment-checks', 'Administrative-Recruitment-Agencies.jpg', 0, 1, '2020-06-28 05:23:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_images`
--

CREATE TABLE `article_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_id` bigint(20) DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filemime` varchar(100) NOT NULL,
  `filesize` bigint(20) NOT NULL,
  `weight` int(11) DEFAULT 0,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created` int(11) NOT NULL,
  `changed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article_links`
--

CREATE TABLE `article_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) NOT NULL,
  `link_type` varchar(250) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `custom_link` varchar(255) DEFAULT NULL,
  `internal_link` varchar(255) DEFAULT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `redirection` varchar(250) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_links`
--

INSERT INTO `article_links` (`id`, `article_id`, `link_type`, `object_id`, `custom_link`, `internal_link`, `link_title`, `redirection`, `sort_order`, `created`, `updated`) VALUES
(1, 1, 'custom', NULL, '', '', '', 'self', 0, '2019-07-10 23:59:30', '2019-07-10 18:29:30'),
(2, 2, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:00:52', '2019-07-10 18:30:52'),
(3, 3, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:01:42', '2019-07-10 18:31:42'),
(4, 4, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:02:13', '2019-07-10 18:32:13'),
(5, 5, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:02:37', '2019-07-10 18:32:37'),
(6, 6, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:03:30', '2019-07-10 18:33:30'),
(7, 7, 'custom', NULL, '', '', '', 'self', 0, '2019-07-11 00:06:56', '2019-07-10 18:36:56'),
(8, 8, 'custom', NULL, '', '', '', 'self', 0, '2020-07-09 02:11:18', '2020-07-08 20:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `article_translations`
--

CREATE TABLE `article_translations` (
  `id` bigint(20) NOT NULL,
  `article_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `culture` varchar(10) COLLATE utf8_general_mysql500_ci NOT NULL,
  `title` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `slug` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `url` text COLLATE utf8_general_mysql500_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auditrail`
--

CREATE TABLE `auditrail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `controller` varchar(200) NOT NULL,
  `module` varchar(200) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `banner_category_id` int(11) NOT NULL,
  `excerpt` text NOT NULL,
  `banner_type` enum('image','video') NOT NULL,
  `banner_image` varchar(250) DEFAULT NULL,
  `banner_video` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Unpublish,1=>Publish,2=>Draft,3=>Review editor,4=>Review manager',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `banner_category_id`, `excerpt`, `banner_type`, `banner_image`, `banner_video`, `status`, `user_id`, `created`, `updated`) VALUES
(1, 'Home Page Banner', 1, 'Home Page Banner', 'image', 'Startup_haryana_Banner.jpg', NULL, 1, 1, '2019-07-08 20:11:46', '2019-07-08 14:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `banner_categories`
--

CREATE TABLE `banner_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_categories`
--

INSERT INTO `banner_categories` (`id`, `name`, `status`, `created`) VALUES
(1, 'Home', 1, '2018-11-23 06:54:11'),
(2, 'Posts', 1, '2018-11-23 06:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `change_password_logs`
--

CREATE TABLE `change_password_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `password` varchar(250) NOT NULL,
  `change_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `change_password_logs`
--

INSERT INTO `change_password_logs` (`id`, `user_id`, `ip_address`, `password`, `change_time`) VALUES
(1, 14, 0x7f000001, '$2y$10$aP/NuqqJpJoedri7nBvPJ.R.2Ulko4Hoec4b9xlBjw4tCvzWGqzzK', '2020-07-10 02:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(11) DEFAULT NULL,
  `district_id` int(11) NOT NULL,
  `pincode` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CD', 'Democratic Republic of the Congo'),
(50, 'CG', 'Republic of Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GK', 'Guernsey'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'HN', 'Honduras'),
(97, 'HK', 'Hong Kong'),
(98, 'HU', 'Hungary'),
(99, 'IS', 'Iceland'),
(100, 'IN', 'India'),
(101, 'IM', 'Isle of Man'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'CI', 'Ivory Coast'),
(109, 'JE', 'Jersey'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JO', 'Jordan'),
(113, 'KZ', 'Kazakhstan'),
(114, 'KE', 'Kenya'),
(115, 'KI', 'Kiribati'),
(116, 'KP', 'Korea, Democratic People\'s Republic of'),
(117, 'KR', 'Korea, Republic of'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Lao People\'s Democratic Republic'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libyan Arab Jamahiriya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macau'),
(131, 'MK', 'North Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'TY', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia, Federated States of'),
(145, 'MD', 'Moldova, Republic of'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestine'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'KN', 'Saint Kitts and Nevis'),
(186, 'LC', 'Saint Lucia'),
(187, 'VC', 'Saint Vincent and the Grenadines'),
(188, 'WS', 'Samoa'),
(189, 'SM', 'San Marino'),
(190, 'ST', 'Sao Tome and Principe'),
(191, 'SA', 'Saudi Arabia'),
(192, 'SN', 'Senegal'),
(193, 'RS', 'Serbia'),
(194, 'SC', 'Seychelles'),
(195, 'SL', 'Sierra Leone'),
(196, 'SG', 'Singapore'),
(197, 'SK', 'Slovakia'),
(198, 'SI', 'Slovenia'),
(199, 'SB', 'Solomon Islands'),
(200, 'SO', 'Somalia'),
(201, 'ZA', 'South Africa'),
(202, 'GS', 'South Georgia South Sandwich Islands'),
(203, 'SS', 'South Sudan'),
(204, 'ES', 'Spain'),
(205, 'LK', 'Sri Lanka'),
(206, 'SH', 'St. Helena'),
(207, 'PM', 'St. Pierre and Miquelon'),
(208, 'SD', 'Sudan'),
(209, 'SR', 'Suriname'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands'),
(211, 'SZ', 'Swaziland'),
(212, 'SE', 'Sweden'),
(213, 'CH', 'Switzerland'),
(214, 'SY', 'Syrian Arab Republic'),
(215, 'TW', 'Taiwan'),
(216, 'TJ', 'Tajikistan'),
(217, 'TZ', 'Tanzania, United Republic of'),
(218, 'TH', 'Thailand'),
(219, 'TG', 'Togo'),
(220, 'TK', 'Tokelau'),
(221, 'TO', 'Tonga'),
(222, 'TT', 'Trinidad and Tobago'),
(223, 'TN', 'Tunisia'),
(224, 'TR', 'Turkey'),
(225, 'TM', 'Turkmenistan'),
(226, 'TC', 'Turks and Caicos Islands'),
(227, 'TV', 'Tuvalu'),
(228, 'UG', 'Uganda'),
(229, 'UA', 'Ukraine'),
(230, 'AE', 'United Arab Emirates'),
(231, 'GB', 'United Kingdom'),
(232, 'US', 'United States'),
(233, 'UM', 'United States minor outlying islands'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VU', 'Vanuatu'),
(237, 'VA', 'Vatican City State'),
(238, 'VE', 'Venezuela'),
(239, 'VN', 'Vietnam'),
(240, 'VG', 'Virgin Islands (British)'),
(241, 'VI', 'Virgin Islands (U.S.)'),
(242, 'WF', 'Wallis and Futuna Islands'),
(243, 'EH', 'Western Sahara'),
(244, 'YE', 'Yemen'),
(245, 'ZM', 'Zambia'),
(246, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created`) VALUES
(1, 'Unskilled', 1, '2018-01-22 19:44:37'),
(2, 'Semi-Skilled', 1, '2018-01-22 19:44:58'),
(3, 'Skilled', 1, '2018-01-22 19:45:16'),
(4, 'High-Skilled', 1, '2018-01-22 19:45:31'),
(5, 'Other', 1, '2018-01-22 19:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `department_id`, `name`, `status`, `created`) VALUES
(1, 2, 'Trainee Engineer', 1, '2018-01-22 19:46:51'),
(2, 2, 'Software Engineer', 1, '2018-01-22 19:47:07'),
(3, 2, 'System Analyst', 1, '2018-01-22 19:47:23'),
(4, 4, 'Account Manager', 1, '2018-01-22 19:49:37'),
(5, 1, 'Architect', 1, '2018-01-22 19:49:47'),
(6, 5, 'Technical Specialist ', 1, '2018-01-22 19:50:04'),
(7, 1, 'Deliver Manager', 1, '2018-01-22 19:50:15'),
(8, 1, 'Delivery Head', 1, '2018-01-22 19:50:27'),
(9, 1, 'Delivery Partner', 1, '2018-01-22 19:50:37'),
(10, 4, 'Project Lead', 1, '2018-01-22 19:50:48'),
(11, 1, 'Program Manager', 1, '2018-01-22 19:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) UNSIGNED NOT NULL,
  `state_id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `state_id`, `name`, `flag`) VALUES
(1, 1, 'North and Middle Andaman', 1),
(2, 1, 'Nicobar', 1),
(4, 2, 'Anantapur', 1),
(5, 2, 'Chittoor', 1),
(6, 2, 'Cuddapah (Dr.Y.S.Rajasekhara Reddy)', 1),
(7, 2, 'East Godavari', 1),
(8, 2, 'Guntur', 1),
(10, 2, 'Karimnagar', 1),
(11, 2, 'Khammam', 1),
(12, 2, 'Krishna', 1),
(13, 2, 'Kurnool', 1),
(14, 2, 'Mahabubnagar', 1),
(15, 2, 'Medak', 1),
(16, 2, 'Nalgonda', 1),
(17, 2, 'Nellore', 1),
(18, 2, 'Nizamabad', 1),
(19, 2, 'Prakasam', 1),
(21, 2, 'Srikakulam', 1),
(22, 2, 'Visakhapatnam', 1),
(23, 2, 'Vizianagaram', 1),
(24, 2, 'Warangal', 1),
(25, 2, 'West Godavari', 1),
(26, 3, 'Changlang', 1),
(27, 3, 'Lower Dibang Valley', 1),
(28, 3, 'East Kameng', 1),
(29, 3, 'East Siang', 1),
(30, 3, 'Lohit', 1),
(31, 3, 'Lower Subansiri', 1),
(32, 3, 'Papum Pare', 1),
(33, 3, 'Tawang', 1),
(34, 3, 'Tirap', 1),
(35, 3, 'Upper Siang', 1),
(36, 3, 'Upper Subansiri', 1),
(37, 3, 'West Kameng', 1),
(38, 3, 'West Siang', 1),
(39, 3, 'Dibang Valley', 1),
(40, 3, 'Kurung Kumey', 1),
(41, 4, 'Barpeta', 1),
(42, 4, 'Bongaigaon', 1),
(43, 4, 'Cachar', 1),
(44, 4, 'Darrang', 1),
(45, 4, 'Dhemaji', 1),
(46, 4, 'Dhubri', 1),
(47, 4, 'Dibrugarh', 1),
(48, 4, 'Goalpara', 1),
(49, 4, 'Golaghat', 1),
(50, 4, 'Hailakandi', 1),
(51, 4, 'Jorhat', 1),
(52, 4, 'Kamrup', 1),
(53, 4, 'Karbi Anglong', 1),
(54, 4, 'Karimganj', 1),
(55, 4, 'Kokrajhar', 1),
(56, 4, 'Lakhimpur', 1),
(57, 4, 'Morigaon', 1),
(58, 4, 'Nagaon', 1),
(59, 4, 'Nalbari', 1),
(60, 4, 'Dima Hasao (North Cachar Hills)', 1),
(61, 4, 'Sivasagar', 1),
(62, 4, 'Sonitpur', 1),
(63, 4, 'Tinsukia', 1),
(64, 5, 'Araria', 1),
(65, 5, 'Aurangabad', 1),
(66, 5, 'Banka', 1),
(67, 5, 'Begusarai', 1),
(68, 5, 'Bhagalpur', 1),
(69, 5, 'Bhojpur', 1),
(70, 5, 'Buxar', 1),
(71, 5, 'Darbhanga', 1),
(72, 5, 'Gaya', 1),
(73, 5, 'Gopalganj', 1),
(74, 5, 'Jamui', 1),
(75, 5, 'Jehanabad', 1),
(76, 5, 'Kaimur (Bhabua)', 1),
(77, 5, 'Katihar', 1),
(78, 5, 'Khagaria', 1),
(79, 5, 'Kishanganj', 1),
(80, 5, 'Lakhisarai', 1),
(81, 5, 'Madhepura', 1),
(82, 5, 'Madhubani', 1),
(83, 5, 'Munger (Monghyr)', 1),
(84, 5, 'Muzaffarpur', 1),
(85, 5, 'Nalanda', 1),
(86, 5, 'Nawada', 1),
(87, 5, 'West Champaran', 1),
(88, 5, 'Patna', 1),
(89, 5, 'East Champaran (Motihari)', 1),
(90, 5, 'Purnia (Purnea)', 1),
(91, 5, 'Rohtas', 1),
(92, 5, 'Saharsa', 1),
(93, 5, 'Samastipur', 1),
(94, 5, 'Saran', 1),
(95, 5, 'Sheikhpura', 1),
(96, 5, 'Sheohar', 1),
(97, 5, 'Sitamarhi', 1),
(98, 5, 'Siwan', 1),
(99, 5, 'Supaul', 1),
(100, 5, 'Vaishali', 1),
(101, 6, 'Bastar', 1),
(102, 6, 'Bilaspur', 1),
(103, 6, 'Dantewada (South Bastar)', 1),
(104, 6, 'Dhamtari', 1),
(105, 6, 'Durg', 1),
(106, 6, 'Janjgir-Champa', 1),
(107, 6, 'Jashpur', 1),
(108, 6, 'Kanker (North Bastar)', 1),
(109, 6, 'Kabirdham (Kawardha)', 1),
(110, 6, 'Korba', 1),
(111, 6, 'Korea (Koriya)', 1),
(112, 6, 'Mahasamund', 1),
(113, 6, 'Raigarh', 1),
(114, 6, 'Raipur', 1),
(115, 6, 'Rajnandgaon', 1),
(116, 6, 'Surguja', 1),
(117, 7, 'Chandigarh', 1),
(118, 8, 'Daman', 1),
(119, 8, 'Diu', 1),
(120, 9, 'Central Delhi', 1),
(121, 9, 'East Delhi', 1),
(122, 9, 'New Delhi', 1),
(123, 9, 'North Delhi', 1),
(124, 9, 'North East  Delhi', 1),
(125, 9, 'North West  Delhi', 1),
(126, 9, 'South Delhi', 1),
(127, 9, 'South West  Delhi', 1),
(128, 9, 'West Delhi', 1),
(129, 10, 'Dadra &amp; Nagar Haveli', 1),
(130, 11, 'North Goa', 1),
(131, 11, 'South Goa', 1),
(132, 12, 'Ahmedabad', 1),
(133, 12, 'Amreli', 1),
(134, 12, 'Anand', 1),
(135, 12, 'Banaskantha', 1),
(136, 12, 'Bharuch', 1),
(137, 12, 'Bhavnagar', 1),
(138, 12, 'Dahod', 1),
(139, 12, 'Gandhinagar', 1),
(140, 12, 'Jamnagar', 1),
(141, 12, 'Junagadh', 1),
(142, 12, 'Kachchh', 1),
(143, 12, 'Kheda', 1),
(144, 12, 'Mehsana', 1),
(145, 12, 'Narmada', 1),
(146, 12, 'Navsari', 1),
(147, 12, 'Panchmahal', 1),
(148, 12, 'Patan', 1),
(149, 12, 'Porbandar', 1),
(150, 12, 'Rajkot', 1),
(151, 12, 'Sabarkantha', 1),
(152, 12, 'Surat', 1),
(153, 12, 'Surendranagar', 1),
(154, 12, 'Dangs', 1),
(155, 12, 'Vadodara', 1),
(156, 12, 'Valsad', 1),
(157, 13, 'Bilaspur', 1),
(158, 13, 'Chamba', 1),
(159, 13, 'Hamirpur', 1),
(160, 13, 'Kangra', 1),
(161, 13, 'Kinnaur', 1),
(162, 13, 'Kullu', 1),
(163, 13, 'Lahaul and Spiti', 1),
(164, 13, 'Mandi', 1),
(165, 13, 'Shimla', 1),
(166, 13, 'Sirmaur (Sirmour)', 1),
(167, 13, 'Solan', 1),
(168, 13, 'Una', 1),
(169, 14, 'Ambala', 1),
(170, 14, 'Bhiwani', 1),
(171, 14, 'Faridabad', 1),
(172, 14, 'Fatehabad', 1),
(173, 14, 'Gurgaon', 1),
(174, 14, 'Hisar', 1),
(175, 14, 'Jhajjar', 1),
(176, 14, 'Jind', 1),
(177, 14, 'Kaithal', 1),
(178, 14, 'Karnal', 1),
(179, 14, 'Kurukshetra', 1),
(180, 14, 'Mahendragarh', 1),
(181, 14, 'Panchkula', 1),
(182, 14, 'Panipat', 1),
(183, 14, 'Rewari', 1),
(184, 14, 'Rohtak', 1),
(185, 14, 'Sirsa', 1),
(186, 14, 'Sonipat', 1),
(187, 14, 'Yamunanagar', 1),
(188, 15, 'Bokaro', 1),
(189, 15, 'Chatra', 1),
(190, 15, 'Deoghar', 1),
(191, 15, 'Dhanbad', 1),
(192, 15, 'Dumka', 1),
(193, 15, 'Garhwa', 1),
(194, 15, 'Giridih', 1),
(195, 15, 'Godda', 1),
(196, 15, 'Gumla', 1),
(197, 15, 'Hazaribag', 1),
(198, 15, 'Koderma', 1),
(199, 15, 'Lohardaga', 1),
(200, 15, 'Pakur', 1),
(201, 15, 'Palamu', 1),
(202, 15, 'West Singhbhum', 1),
(203, 15, 'East Singhbhum', 1),
(204, 15, 'Ranchi', 1),
(205, 15, 'Sahibganj', 1),
(206, 15, 'Seraikela-Kharsawan', 0),
(207, 15, 'Jamtara', 1),
(208, 15, 'Latehar', 1),
(209, 15, 'Simdega', 1),
(210, 16, 'Anantnag', 1),
(211, 16, 'Budgam', 1),
(212, 16, 'Baramulla', 1),
(213, 16, 'Doda', 1),
(214, 16, 'Jammu', 1),
(215, 16, 'Kargil', 1),
(216, 16, 'Kathua', 1),
(217, 16, 'Kupwara', 1),
(218, 16, 'Leh', 1),
(219, 16, 'Pulwama', 1),
(220, 16, 'Poonch', 1),
(221, 16, 'Rajouri', 1),
(222, 16, 'Srinagar', 1),
(223, 16, 'Udhampur', 1),
(224, 18, 'Alappuzha', 1),
(225, 18, 'Ernakulam', 1),
(226, 18, 'Idukki', 1),
(227, 18, 'Kannur', 1),
(228, 18, 'Kasaragod', 1),
(229, 18, 'Kollam', 1),
(230, 18, 'Kottayam', 1),
(231, 18, 'Kozhikode', 1),
(232, 18, 'Malappuram', 1),
(233, 18, 'Palakkad', 1),
(234, 18, 'Pathanamthitta', 1),
(235, 18, 'Thiruvananthapuram', 1),
(236, 18, 'Thrissur', 1),
(237, 18, 'Wayanad', 1),
(238, 17, 'Bagalkot', 1),
(239, 17, 'Bangalore Urban', 1),
(240, 17, 'Bangalore Rural', 1),
(241, 17, 'Belgaum', 1),
(242, 17, 'Bellary', 1),
(243, 17, 'Bidar', 1),
(244, 17, 'Bijapur', 1),
(245, 17, 'Chamarajanagar', 1),
(246, 17, 'Chickmagalur', 1),
(247, 17, 'Chitradurga', 1),
(248, 17, 'Dakshina Kannada', 1),
(249, 17, 'Davangere', 1),
(250, 17, 'Dharwad', 1),
(251, 17, 'Gadag', 1),
(252, 17, 'Gulbarga', 1),
(253, 17, 'Hassan', 1),
(254, 17, 'Haveri', 1),
(255, 17, 'Kodagu', 1),
(256, 17, 'Kolar', 1),
(257, 17, 'Koppal', 1),
(258, 17, 'Mandya', 1),
(259, 17, 'Mysore', 1),
(260, 17, 'Raichur', 1),
(261, 17, 'Shimoga', 1),
(262, 17, 'Tumkur', 1),
(263, 17, 'Udupi', 1),
(264, 17, 'Uttara Kannada (Karwar)', 1),
(265, 19, 'Lakshadweep', 1),
(266, 21, 'East Garo Hills', 1),
(267, 21, 'East Khasi Hills', 1),
(268, 21, 'Jaintia Hills', 1),
(269, 21, 'Ri Bhoi', 1),
(270, 21, 'South Garo Hills', 1),
(271, 21, 'West Garo Hills', 1),
(272, 21, 'West Khasi Hills', 1),
(273, 24, 'Aizawl', 1),
(274, 24, 'Champhai', 1),
(275, 24, 'Kolasib', 1),
(276, 24, 'Lawngtlai', 1),
(277, 24, 'Lunglei', 1),
(278, 24, 'Mamit', 1),
(279, 24, 'Saiha', 1),
(280, 24, 'Serchhip', 1),
(281, 22, 'Bishnupur', 1),
(282, 22, 'Chandel', 1),
(283, 22, 'Churachandpur', 1),
(284, 22, 'Imphal East', 1),
(285, 22, 'Imphal West', 1),
(286, 22, 'Senapati', 1),
(287, 22, 'Tamenglong', 1),
(288, 22, 'Thoubal', 1),
(289, 22, 'Ukhrul', 1),
(290, 23, 'Balaghat', 1),
(291, 23, 'Barwani', 1),
(292, 23, 'Betul', 1),
(293, 23, 'Bhind', 1),
(294, 23, 'Bhopal', 1),
(295, 23, 'Chhatarpur', 1),
(296, 23, 'Chhindwara', 1),
(297, 23, 'Damoh', 1),
(298, 23, 'Datia', 1),
(299, 23, 'Dewas', 1),
(300, 23, 'Dhar', 1),
(301, 23, 'Dindori', 1),
(302, 23, 'Guna', 1),
(303, 23, 'Gwalior', 1),
(304, 23, 'Harda', 1),
(305, 23, 'Hoshangabad', 1),
(306, 23, 'Indore', 1),
(307, 23, 'Jabalpur', 1),
(308, 23, 'Jhabua', 1),
(309, 23, 'Katni', 1),
(310, 23, 'Mandla', 1),
(311, 23, 'Mandsaur', 1),
(312, 23, 'Morena', 1),
(313, 23, 'Narsinghpur', 1),
(314, 23, 'Neemuch', 1),
(315, 23, 'Panna', 1),
(316, 23, 'Raisen', 1),
(317, 23, 'Rajgarh', 1),
(318, 23, 'Ratlam', 1),
(319, 23, 'Rewa', 1),
(320, 23, 'Sagar', 1),
(321, 23, 'Satna', 1),
(322, 23, 'Sehore', 1),
(323, 23, 'Seoni', 1),
(324, 23, 'Shahdol', 1),
(325, 23, 'Shajapur', 1),
(326, 23, 'Sheopur', 1),
(327, 23, 'Shivpuri', 1),
(328, 23, 'Sidhi', 1),
(329, 23, 'Tikamgarh', 1),
(330, 23, 'Ujjain', 1),
(331, 23, 'Umaria', 1),
(332, 23, 'Vidisha', 1),
(333, 23, 'Khargone', 1),
(334, 23, 'Khandwa', 1),
(335, 23, 'Anuppur', 1),
(336, 23, 'Burhanpur', 1),
(337, 23, 'Ashoknagar', 1),
(338, 20, 'Ahmednagar', 1),
(339, 20, 'Akola', 1),
(340, 20, 'Amravati', 1),
(341, 20, 'Aurangabad', 1),
(342, 20, 'Bhandara', 1),
(343, 20, 'Beed', 1),
(344, 20, 'Buldhana', 1),
(345, 20, 'Chandrapur', 1),
(346, 20, 'Dhule', 1),
(347, 20, 'Gadchiroli', 1),
(348, 20, 'Gondia', 1),
(349, 20, 'Hingoli', 1),
(350, 20, 'Jalgaon', 1),
(351, 20, 'Jalna', 1),
(352, 20, 'Kolhapur', 1),
(353, 20, 'Latur', 1),
(354, 20, 'Mumbai City', 1),
(355, 20, 'Mumbai Suburban', 1),
(356, 20, 'Nagpur', 1),
(357, 0, 'Nanded', 1),
(358, 20, 'Nandurbar', 1),
(359, 20, 'Nashik', 1),
(360, 20, 'Osmanabad', 1),
(361, 20, 'Parbhani', 1),
(362, 20, 'Pune', 1),
(363, 20, 'Raigad', 1),
(364, 20, 'Ratnagiri', 1),
(365, 20, 'Sangli', 1),
(366, 20, 'Satara', 1),
(367, 20, 'Sindhudurg', 1),
(368, 20, 'Solapur', 1),
(369, 20, 'Thane', 1),
(370, 20, 'Wardha', 1),
(371, 20, 'Washim', 1),
(372, 20, 'Yavatmal', 1),
(373, 25, 'Dimapur', 1),
(374, 25, 'Kohima', 1),
(375, 25, 'Mokokchung', 1),
(376, 25, 'Mon', 1),
(377, 25, 'Phek', 1),
(378, 25, 'Tuensang', 1),
(379, 25, 'Wokha', 1),
(380, 25, 'Zunheboto', 1),
(381, 26, 'Angul', 1),
(382, 26, 'Balangir', 1),
(383, 26, 'Balasore', 1),
(384, 26, 'Bargarh', 1),
(385, 26, 'Boudh', 1),
(386, 26, 'Bhadrak', 1),
(387, 26, 'Cuttack', 1),
(388, 26, 'Deogarh', 1),
(389, 26, 'Dhenkanal', 1),
(390, 26, 'Gajapati', 1),
(391, 26, 'Ganjam', 1),
(392, 26, 'Jagatsinghapur', 1),
(393, 26, 'Jajpur', 1),
(394, 26, 'Jharsuguda', 1),
(395, 26, 'Kalahandi', 1),
(396, 26, 'Kandhamal', 1),
(397, 26, 'Kendrapara', 1),
(398, 26, 'Kendujhar (Keonjhar)', 1),
(399, 26, 'Khordha', 1),
(400, 26, 'Koraput', 1),
(401, 26, 'Malkangiri', 1),
(402, 26, 'Mayurbhanj', 1),
(403, 26, 'Nabarangpur', 1),
(404, 26, 'Nayagarh', 1),
(405, 26, 'Nuapada', 1),
(406, 26, 'Puri', 1),
(407, 26, 'Rayagada', 1),
(408, 26, 'Sambalpur', 1),
(409, 26, 'Sonepur', 1),
(410, 26, 'Sundargarh', 1),
(411, 28, 'Karaikal', 1),
(412, 28, 'Mahe', 1),
(413, 28, 'Pondicherry', 1),
(414, 28, 'Yanam', 1),
(415, 27, 'Amritsar', 1),
(416, 27, 'Bathinda', 1),
(417, 27, 'Faridkot', 1),
(418, 27, 'Fatehgarh Sahib', 1),
(419, 27, 'Ferozepur', 1),
(420, 27, 'Gurdaspur', 1),
(421, 27, 'Hoshiarpur', 1),
(422, 27, 'Jalandhar', 1),
(423, 27, 'Kapurthala', 1),
(424, 27, 'Ludhiana', 1),
(425, 27, 'Mansa', 1),
(426, 27, 'Moga', 1),
(427, 27, 'Muktsar', 1),
(428, 27, 'Nawanshahr (Shahid Bhagat Singh Nagar)', 1),
(429, 27, 'Patiala', 1),
(430, 27, 'Rupnagar', 1),
(431, 27, 'Sangrur', 1),
(432, 29, 'Ajmer', 1),
(433, 29, 'Alwar', 1),
(434, 29, 'Banswara', 1),
(435, 29, 'Baran', 1),
(436, 29, 'Barmer', 1),
(437, 29, 'Bharatpur', 1),
(438, 29, 'Bhilwara', 1),
(439, 29, 'Bikaner', 1),
(440, 29, 'Bundi', 1),
(441, 29, 'Chittorgarh', 1),
(442, 29, 'Churu', 1),
(443, 29, 'Dausa', 1),
(444, 29, 'Dholpur', 1),
(445, 29, 'Dungarpur', 1),
(446, 29, 'Sri Ganganagar', 1),
(447, 29, 'Hanumangarh', 1),
(448, 29, 'Jaipur', 1),
(449, 29, 'Jaisalmer', 1),
(450, 29, 'Jalore', 1),
(451, 29, 'Jhalawar', 1),
(452, 29, 'Jhunjhunu', 1),
(453, 29, 'Jodhpur', 1),
(454, 29, 'Karauli', 1),
(455, 29, 'Kota', 1),
(456, 29, 'Nagaur', 1),
(457, 29, 'Pali', 1),
(458, 29, 'Rajsamand', 1),
(459, 29, 'Sawai Madhopur', 1),
(460, 29, 'Sikar', 1),
(461, 29, 'Sirohi', 1),
(462, 29, 'Tonk', 1),
(463, 29, 'Udaipur', 1),
(464, 30, 'East Sikkim', 1),
(465, 30, 'North Sikkim', 1),
(466, 30, 'South Sikkim', 1),
(467, 30, 'West Sikkim', 1),
(468, 31, 'Chennai', 1),
(469, 31, 'Coimbatore', 1),
(470, 31, 'Cuddalore', 1),
(471, 31, 'Dharmapuri', 1),
(472, 31, 'Dindigul', 1),
(473, 31, 'Erode', 1),
(474, 31, 'Kanchipuram', 1),
(475, 31, 'Kanyakumari', 1),
(476, 31, 'Karur', 1),
(477, 31, 'Madurai', 1),
(478, 31, 'Nagapattinam', 1),
(479, 31, 'Namakkal', 1),
(480, 31, 'Perambalur', 1),
(481, 31, 'Pudukkottai', 1),
(482, 31, 'Ramanathapuram', 1),
(483, 31, 'Salem', 1),
(484, 31, 'Sivaganga', 1),
(485, 31, 'Thanjavur', 1),
(486, 31, 'Nilgiris', 1),
(487, 31, 'Theni', 1),
(488, 31, 'Tiruvallur', 1),
(489, 31, 'Tiruvarur', 1),
(490, 31, 'Thoothukudi (Tuticorin)', 1),
(491, 31, 'Tiruchirappalli', 1),
(492, 31, 'Tirunelveli', 1),
(493, 31, 'Tiruvannamalai', 1),
(494, 31, 'Vellore', 1),
(495, 31, 'Viluppuram', 1),
(496, 31, 'Virudhunagar', 1),
(497, 31, 'Krishnagiri', 1),
(498, 32, 'Dhalai', 1),
(499, 32, 'North Tripura', 1),
(500, 32, 'South Tripura', 1),
(501, 32, 'West Tripura', 1),
(502, 34, 'Agra', 1),
(503, 34, 'Aligarh', 1),
(504, 34, 'Allahabad', 1),
(505, 34, 'Ambedkar Nagar', 1),
(506, 34, 'Auraiya', 1),
(507, 34, 'Azamgarh', 1),
(508, 34, 'Baghpat', 1),
(509, 34, 'Bahraich', 1),
(510, 34, 'Ballia', 1),
(511, 34, 'Balrampur', 1),
(512, 34, 'Banda', 1),
(513, 34, 'Barabanki', 1),
(514, 34, 'Bareilly', 1),
(515, 34, 'Basti', 1),
(516, 34, 'Bijnor', 1),
(517, 34, 'Budaun', 1),
(518, 34, 'Bulandshahr', 1),
(519, 34, 'Chandauli', 1),
(520, 34, 'Chitrakoot', 1),
(521, 34, 'Deoria', 1),
(522, 34, 'Etah', 1),
(523, 34, 'Etawah', 1),
(524, 34, 'Faizabad', 1),
(525, 34, 'Farrukhabad', 1),
(526, 34, 'Fatehpur', 1),
(527, 34, 'Firozabad', 1),
(528, 34, 'Gautam Buddha Nagar', 1),
(529, 34, 'Ghaziabad', 1),
(530, 34, 'Ghazipur', 1),
(531, 34, 'Gonda', 1),
(532, 34, 'Gorakhpur', 1),
(533, 34, 'Hamirpur', 1),
(534, 34, 'Hardoi', 1),
(535, 34, 'Hathras', 1),
(536, 34, 'Jalaun', 1),
(537, 34, 'Jaunpur', 1),
(538, 34, 'Jhansi', 1),
(539, 34, 'Jyotiba Phule Nagar (J.P. Nagar)', 1),
(540, 34, 'Kannauj', 1),
(541, 34, 'Kanpur Dehat', 1),
(542, 34, 'Kanpur Nagar', 1),
(543, 34, 'Kaushambi', 1),
(544, 34, 'Lakhimpur - Kheri', 1),
(545, 34, 'Kushinagar (Padrauna)', 1),
(546, 34, 'Lalitpur', 1),
(547, 34, 'Lucknow', 1),
(548, 34, 'Maharajganj', 1),
(549, 34, 'Mahoba', 1),
(550, 34, 'Mainpuri', 1),
(551, 34, 'Mathura', 1),
(552, 34, 'Mau', 1),
(553, 34, 'Meerut', 1),
(554, 34, 'Mirzapur', 1),
(555, 34, 'Moradabad', 1),
(556, 34, 'Muzaffarnagar', 1),
(557, 34, 'Pilibhit', 1),
(558, 34, 'Pratapgarh', 1),
(559, 34, 'RaeBareli', 1),
(560, 34, 'Rampur', 1),
(561, 34, 'Saharanpur', 1),
(562, 34, 'Sant Kabir Nagar', 1),
(563, 34, 'Sant Ravidas Nagar', 1),
(564, 34, 'Shahjahanpur', 1),
(565, 34, 'Shravasti', 1),
(566, 34, 'Siddharth Nagar', 1),
(567, 34, 'Sitapur', 1),
(568, 34, 'Sonbhadra', 1),
(569, 34, 'Sultanpur', 1),
(570, 34, 'Unnao', 1),
(571, 34, 'Varanasi', 1),
(572, 33, 'Almora', 1),
(573, 33, 'Bageshwar', 1),
(574, 33, 'Chamoli', 1),
(575, 33, 'Champawat', 1),
(576, 33, 'Dehradun', 1),
(577, 33, 'Pauri Garhwal', 1),
(578, 33, 'Haridwar', 1),
(579, 33, 'Nainital', 1),
(580, 33, 'Pithoragarh', 1),
(581, 33, 'Rudraprayag', 1),
(582, 33, 'Tehri Garhwal', 1),
(583, 33, 'Udham Singh Nagar', 1),
(584, 33, 'Uttarkashi', 1),
(585, 35, 'Bankura', 1),
(586, 35, 'Burdwan (Bardhaman)', 1),
(587, 35, 'Birbhum', 1),
(588, 35, 'Dakshin Dinajpur (South Dinajpur)', 1),
(589, 35, 'Darjeeling', 1),
(590, 35, 'Howrah', 1),
(591, 35, 'Hooghly', 1),
(592, 35, 'Jalpaiguri', 1),
(593, 35, 'Cooch Behar', 1),
(594, 35, 'Malda', 1),
(595, 35, 'Purba Medinipur (East Medinipur)', 1),
(596, 35, 'Murshidabad', 1),
(597, 35, 'Nadia', 1),
(598, 35, 'North 24 Parganas', 1),
(599, 35, 'Purulia', 1),
(600, 35, 'South  24 Parganas', 1),
(601, 35, 'Uttar Dinajpur (North Dinajpur)', 1),
(602, 35, 'Paschim Medinipur (West Medinipur)', 1),
(603, 1, 'South Andaman', 1),
(604, 3, 'Anjaw', 1),
(605, 4, 'Udalguri', 1),
(606, 4, 'Baksa', 1),
(607, 4, 'Kamrup Metropolitan', 1),
(608, 4, 'Chirang', 1),
(609, 5, 'Arwal', 1),
(610, 6, 'Narayanpur', 1),
(611, 6, 'Bijapur', 1),
(612, 12, 'Tapi (Vyara)', 1),
(613, 14, 'Mewat', 1),
(614, 14, 'Palwal', 1),
(615, 15, 'Ramgarh', 1),
(616, 15, 'Khunti', 1),
(617, 16, 'Samba', 1),
(618, 17, 'Yadgir', 1),
(619, 17, 'Ramnagara', 1),
(620, 17, 'Chikballapur', 1),
(621, 23, 'Singrauli', 1),
(622, 23, 'Alirajpur', 1),
(623, 25, 'Peren', 1),
(624, 25, 'Kiphire', 1),
(625, 25, 'Longleng', 1),
(626, 27, 'Tarn Taran', 1),
(627, 27, 'Barnala', 1),
(628, 27, 'Sahibzada Ajit Singh (SAS) Nagar (Mohali)', 1),
(629, 29, 'Pratapgarh', 1),
(630, 31, 'Ariyalur', 1),
(631, 31, 'Tiruppur', 1),
(632, 35, 'Kolkata', 1),
(642, 2, 'Kadapa', 1),
(643, 3, 'Itanagar', 1),
(644, 4, 'Baska', 1),
(645, 4, 'Chirrang', 1),
(646, 5, 'Arrah', 1),
(647, 6, 'Umaria', 1),
(648, 6, 'Balod', 1),
(649, 6, 'Kawardha', 1),
(650, 10, 'Silvassa', 1),
(651, 16, 'Bandipore', 1),
(652, 16, 'Ganderbal', 1),
(653, 16, 'Kishtwar', 1),
(654, 16, 'Kulgam', 1),
(655, 16, 'Ramban', 1),
(656, 16, 'Reasi', 1),
(657, 16, 'Shopian', 1),
(658, 15, 'Jamshedpur', 1),
(659, 17, 'Madikeri', 1),
(660, 17, 'Ramanagaram', 1),
(661, 18, 'Kochi', 1),
(662, 18, 'Nagapattinam', 1),
(663, 19, 'Kavarati', 1),
(664, 19, 'Chetlah', 1),
(665, 19, 'Minicoy', 1),
(666, 23, 'Sarguja', 1),
(667, 32, 'Agartala', 1),
(668, 32, 'Sepahijala', 1),
(669, 35, 'Barasat', 1),
(670, 35, 'Raiganj', 1),
(671, 35, 'Siliguri', 1),
(672, 40, 'Khammam', 1),
(673, 40, 'Medak', 1),
(674, 40, 'Rangareddy', 1),
(675, 40, 'Nalgonda', 1),
(676, 31, 'Udhagamandalam', 1),
(677, 30, 'Gangtok', 1),
(678, 26, 'Bhubaneswar', 1),
(679, 21, 'Shillong', 1),
(680, 21, 'Baghmara', 1),
(681, 21, 'Jowai', 1),
(682, 21, 'Nongpoh', 1),
(683, 21, 'Nongston', 1),
(684, 21, 'Tura', 1),
(685, 21, 'Williamnagar', 1),
(686, 34, 'Hapur', 1),
(687, 20, 'Nanded', 1),
(688, 34, 'sambhal', 1),
(689, 40, 'Kazipet', 1),
(690, 29, 'Beawar', 1),
(691, 40, 'Warangal', 1),
(692, 23, 'Agar Malwa', 1),
(693, 23, 'Agar', 1),
(694, 4, 'Guwahati', 1),
(695, 34, 'Kanshi Ram Nagar', 1),
(696, 20, 'Palghar', 1),
(697, 15, 'Seraikella Kharsawan', 1),
(698, 26, 'Berhampur', 1),
(699, 1, 'Port Blair', 1),
(700, 40, 'Kothagudem', 1),
(701, 27, 'Pathankot', 1),
(702, 9, 'South East Delhi', 1),
(703, 34, 'Kasganj', 1),
(704, 31, 'Tuticorin', 0),
(705, 40, 'HYDERABAD', 1),
(706, 40, 'Secunderabad', 1),
(707, 40, 'Adilabad', 1),
(708, 6, 'Surajpur', 1),
(709, 15, 'Bhilai', 1),
(710, 15, 'Bokaro IP', 0),
(711, 9, 'Shahdara', 1),
(712, 42, 'GUJ AHM', 1),
(713, 41, 'district name 345667', 1),
(714, 45, 'enter district Name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_sms_contents`
--

CREATE TABLE `email_sms_contents` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('sms','mail','','') COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_sms_contents`
--

INSERT INTO `email_sms_contents` (`id`, `subject`, `action`, `type`, `message`, `status`, `created`) VALUES
(1, 'Drivers Hub - Registration Successful', 'login', 'mail', '<p>Dear {{name}},</p>\r\n<p>Greetings from Drivers Hub.</p>\r\n<p>We would like to thank you for registering with us.</p>\r\n<p>To complete the registration process, Click here to confirm your email and fully activate your account.</p>', 1, '2020-06-29 17:40:11'),
(2, 'Drivers Hub - Reset your password', 'forgotpassword', 'mail', '<p>Dear {{name}},</p>\r\n<p>We heard that you lost your password, Sorry about that!</p>\r\n<p>But don\'t worry! You can use the following link within the next day to reset your password</p>', 1, '2020-06-29 17:40:11'),
(3, 'Drivers Hub - You Password has changed', 'resetpassword', 'mail', '<p>Dear {{name}},</p>\r\n								<p>Greetings from Drivers Hub.</p>\r\n<p>Your password has been changed successfully.</p>\r\n<p>Use your new password to log in.</p>', 1, '2020-06-29 17:40:11'),
(4, 'Drivers Hub - Registration Successful', 'registration', 'mail', '<p>Dear {{name}},</p>\r\n								<p>Greetings from Drivers Hub.</p>\r\n															<p>We would like to thank you for registering with us.</p>\r\n															<p>To complete the registration process, Click here to confirm your email and fully activate your account.</p>', 1, '2020-06-29 17:40:11'),
(5, 'Drivers Hub - Profile Update', 'profileupdate', 'mail', '<p>Dear Admin,</p>\r\n\r\n<p>Driver, {{name}} has updated his profile now you can process for screening.\r\n</p>', 1, '2020-06-29 17:40:11'),
(6, 'Drivers Hub - Profile Approved', 'profileapprove', 'mail', '<p>Dear {{name}},</p>\r\n\r\n<p>Your profile has been approved by the DH Team. You will receive notification soon regarding the recruitment.</p>', 1, '2020-06-29 17:40:11'),
(7, 'Drivers Hub - Assign Driver', 'assigndriver', 'mail', '<p>Dear {{name}},</p>\r\n\r\n<p>You have allocated on new job request by DH team for the client {{client_name}} with recruitment on {{job_subject}}. You will receive further notification on the same.</p>', 1, '2020-06-29 17:40:11'),
(8, 'Drivers Hub - Worksheet Generated', 'addworksheet ', 'mail', '<p>Dear {{name}},</p>\r\n\r\n<p>Your worksheet for the time between {{from_date}} to {{to_date}} has been generated. Your Worksheet Number is {{worksheet_no}}.Please check.</p>', 1, '2020-06-29 17:40:11'),
(9, 'Drivers Hub - New Job Posted', 'jobpost', 'mail', '<p>Dear Admin,</p>\r\n\r\n<p> One new Job Request has been post by client {{name}}. Please see.</p>', 1, '2020-06-29 17:40:11'),
(10, 'Drivers Hub - Hired By Client', 'hiredbyclient', 'mail', '<p>Dear {{name}},</p>\r\n\r\n<p>You have hired by the client {{client_name}} on Hire Rate Euro {{amount}}.</p>', 1, '2020-06-29 17:40:11'),
(11, 'Drivers Hub - Invoice Created', 'invoicecreated', 'mail', '<p>Dear {{name}},</p>\r\n\r\nInvoice {{invoice_no}} for the time between {{from_date}} to {{to_date}} has been generated. Please see.\r\n', 1, '2020-06-29 17:40:11'),
(12, 'Drivers Hub - Client Mark Paid', 'clientmarkpaid', 'mail', '<p>Dear Admin,</p>\r\n\r\n<p>Invoice {{invoice_no}} For the time between {{from_date}} to {{to_date}} has been marked paid by client {{client_name}}. Please see.</p>\r\n', 1, '2020-06-29 17:40:11'),
(13, 'Drivers Hub - Admin Mark Paid', 'adminmarkpaid', 'mail', '<p>Dear {{client_name}},</p>\r\n\r\n<p>Invoice {{invoice_no}} For the time between {{from_date}} to {{to_date}} has been marked paid by Drivers Hub team. Please see.</p>', 1, '2020-06-29 17:40:11');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `gallery_category_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `filemime` text NOT NULL,
  `filesize` varchar(100) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `description` text NOT NULL,
  `cloud_tags` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_home` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `content` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_categories`
--

INSERT INTO `gallery_categories` (`id`, `article_id`, `user_id`, `title`, `content`, `status`, `created`) VALUES
(1, NULL, 1, 'Home', 'Home', 1, '2019-07-10 11:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `culture` varchar(10) COLLATE utf8_general_mysql500_ci NOT NULL,
  `direction` enum('ltr','rtl') COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT 'ltr',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_system` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `culture`, `direction`, `is_default`, `is_system`, `status`, `created_at`, `modified_at`) VALUES
(1, 'English', 'en', 'ltr', 1, 1, 1, '2018-06-05 06:23:38', '2019-06-25 07:18:58'),
(2, 'Hindi/हिन्दी', 'hi', 'ltr', 0, 0, 1, '2018-06-05 06:24:05', '2019-01-31 13:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `locale_sources`
--

CREATE TABLE `locale_sources` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Unique identifier of this string',
  `source` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'The original string in English.',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locale_sources`
--

INSERT INTO `locale_sources` (`id`, `source`, `created`) VALUES
(1, 'Introduction', '2018-12-17 12:10:15'),
(2, 'Introduction Source', '2018-12-17 12:10:15'),
(3, 'News', '2018-12-17 12:10:15'),
(4, 'Want an MSE Loan?', '2018-12-17 12:10:15'),
(5, 'Borrower&#039;s Login', '2018-12-17 12:10:15'),
(6, 'Apply for SIDBI Loan', '2018-12-17 12:10:15'),
(7, 'Poverty Interventions', '2018-12-17 12:10:15'),
(8, 'STRUCTURAL INTERVENTION', '2018-12-17 12:10:15'),
(9, 'PSB Loans in 59 Minutes', '2018-12-17 12:10:15'),
(10, 'Documents', '2019-01-08 11:26:27'),
(11, 'Corrignedum', '2019-01-08 11:27:57'),
(12, 'Annexure', '2019-01-08 11:28:14'),
(13, 'Publication & Reports', '2019-01-14 06:17:14'),
(14, 'Annual Series Report', '2019-01-14 06:17:14'),
(15, 'View All', '2019-01-14 06:17:14'),
(16, 'Sr. No.', '2019-01-14 06:36:54'),
(17, 'Report Name', '2019-01-14 06:36:54'),
(18, 'Download', '2019-01-14 06:36:54'),
(19, 'Corporate Governance', '2019-01-14 07:08:07'),
(20, 'File Name', '2019-01-14 07:08:07'),
(21, 'Tenders', '2019-01-15 05:58:59'),
(22, 'Archived Tenders', '2019-01-15 05:58:59'),
(23, 'Archived Careers', '2019-01-15 06:18:03'),
(24, 'Careers', '2019-01-15 06:20:18'),
(25, 'Archived Press Releases', '2019-01-15 09:32:16'),
(26, 'Press Release', '2019-01-15 09:34:20'),
(27, 'Archived Press Release', '2019-01-15 09:35:05'),
(28, 'Press Releases', '2019-01-15 09:35:05'),
(29, 'Title', '2019-01-15 09:35:05'),
(30, 'Overview', '2019-01-17 09:15:26'),
(31, 'Important Links', '2019-01-24 09:02:01'),
(32, 'Downloads Files', '2019-01-24 09:18:27'),
(33, 'Archives', '2019-01-31 14:07:13'),
(34, 'Archive', '2019-01-31 14:09:34'),
(35, 'Sr. No. Test', '2019-02-02 05:46:52'),
(36, 'Job Title', '2019-02-02 09:56:09'),
(37, 'Start Date', '2019-02-02 09:56:09'),
(38, 'Corrigendum', '2019-02-06 09:27:58'),
(39, 'Direct Loans', '2019-02-07 10:31:48'),
(40, 'Venture Capital', '2019-02-07 10:31:48'),
(41, 'Indirect Finance', '2019-02-07 10:31:48'),
(42, 'Fixed Deposit', '2019-02-07 10:31:48'),
(43, 'Microfinance', '2019-02-07 10:31:48'),
(44, 'Products', '2019-02-07 10:35:17'),
(45, 'More Products', '2019-02-07 10:35:17'),
(46, 'PROMOTION AND DEVELOPMENT', '2019-02-07 10:35:17'),
(47, 'View Other Initiatives', '2019-02-07 10:38:07'),
(48, 'SWAVALAMBAN', '2019-02-07 10:49:43'),
(49, 'Bechain Sapno ko Pankh...', '2019-02-07 10:49:43'),
(50, 'An Entrepreneurship Education Knowledge Series', '2019-02-07 10:49:43'),
(51, 'Read More', '2019-02-07 10:49:43'),
(52, 'ECOSYSTEM', '2019-02-07 10:49:44'),
(53, 'SIDBI News', '2019-02-07 10:49:44'),
(54, 'Internal News', '2019-02-07 10:49:44'),
(55, 'Photos', '2019-02-07 10:49:44'),
(56, 'SOCIAL MEDIA', '2019-02-07 10:49:44'),
(57, 'MSME IN FOCUS', '2019-02-07 10:49:44'),
(58, 'Feedback', '2019-02-07 11:06:34'),
(59, 'Feedback', '2019-02-07 11:06:34'),
(60, 'Employee Corner', '2019-02-07 11:06:34'),
(61, 'Borrower\'s Corner', '2019-02-07 11:06:34'),
(62, 'Contact Us', '2019-02-07 11:06:34'),
(63, 'Enquiry', '2019-02-07 11:09:26'),
(64, 'I am looking for...', '2019-02-07 11:28:36'),
(65, 'Select category', '2019-02-07 11:28:36'),
(66, 'Scroll For PROMOTION AND DEVELOPMENT', '2019-02-07 11:34:52'),
(67, 'Scroll For SWAVALAMBAN', '2019-02-07 11:34:52'),
(68, 'Scroll For STRUCTURAL INTERVENTIONS', '2019-02-07 11:34:52'),
(69, 'Scroll For ECOSYSTEM & POVERTY INTERVENTIONS', '2019-02-07 11:37:25'),
(70, 'Scroll For News & Media', '2019-02-07 11:37:26'),
(71, 'Scroll For MSME IN FOCUS', '2019-02-07 11:37:26'),
(72, 'What’s Happening', '2019-02-07 12:29:12'),
(73, 'CPIOs Orders', '2019-02-08 12:34:05'),
(74, 'Date', '2019-02-11 08:50:09'),
(75, 'Announcements', '2019-02-15 10:33:25'),
(76, 'MSME KNOWLEDGE KIT', '2019-02-16 04:51:30'),
(77, 'MSME STUDIES AND REPORTS', '2019-02-16 04:56:52'),
(78, 'MSME POLICIES AND IMPORTANT CIRCULARS', '2019-02-16 04:57:18'),
(79, 'Synopsis', '2019-02-27 05:58:16'),
(80, 'Know More', '2019-03-05 11:19:54'),
(81, 'Click Here for more Details', '2019-03-05 12:28:12'),
(82, 'Expiry Date', '2019-03-06 07:24:33'),
(83, 'Last date of submission', '2019-03-06 07:26:45'),
(84, 'Enter keyword', '2019-03-06 09:24:25'),
(85, 'Circulations', '2019-03-08 07:04:38'),
(86, 'Circulars', '2019-03-08 08:01:46'),
(87, 'Project Brief', '2019-03-09 05:57:40'),
(88, 'GEF Project', '2019-03-09 05:57:40'),
(89, 'Procurement', '2019-03-09 06:08:42'),
(90, 'Financial Management', '2019-03-09 06:08:42'),
(91, 'Project Outcome', '2019-03-09 06:08:42'),
(92, 'Environmental and Social Risk Management Framework Manual (ESMF) for SIDBI', '2019-03-09 06:08:42'),
(93, 'Environmental Risk Management Framework (ERMF-PRSF)', '2019-03-09 06:08:42'),
(94, 'RTI Cell', '2019-03-11 06:10:18'),
(95, 'BOARD OF DIRECTORS', '2019-03-11 12:57:17'),
(96, 'Shri. Mohammad Mustafa', '2019-03-11 12:57:17'),
(97, 'Chairman & Managing Director', '2019-03-11 12:57:17'),
(98, 'View Profile', '2019-03-11 12:57:18'),
(99, 'Archived Announcements', '2019-03-12 05:11:29'),
(100, 'As on February 27, 2019', '2019-03-14 04:54:05'),
(101, 'SHAREHOLDING', '2019-03-14 04:55:46'),
(102, 'Shareholding Pattern of SIDBI', '2019-03-14 04:58:47'),
(103, 'SL. No.', '2019-03-14 05:15:11'),
(104, 'Name Of The Shareholder', '2019-03-14 05:21:20'),
(105, 'No Of Shares Held', '2019-03-14 05:22:16'),
(106, '% Of Holding', '2019-03-14 05:22:35'),
(107, 'Sr. No', '2019-03-14 05:24:35'),
(108, 'Micro Lending', '2019-03-14 12:55:09'),
(109, 'View Profile of <br>All Directors', '2019-03-18 06:55:26'),
(110, 'Assistance through Banks', '2019-03-19 09:26:20'),
(111, 'Assistance through Banks, NBFCs, SFBs', '2019-03-19 09:36:45'),
(112, 'ASSISTANCE THROUGH NBFC', '2019-03-19 10:07:15'),
(113, 'ASSISTANCE THROUGH NBFCs', '2019-03-19 10:09:44'),
(114, 'REFINANCE SCHEMES', '2019-03-19 10:12:48'),
(115, 'SFB', '2019-03-19 10:14:58'),
(116, 'Assistance to Small Finance Banks', '2019-03-19 10:17:29'),
(117, 'Institutional Finance', '2019-04-06 04:30:42'),
(118, 'OPTIMISMS', '2019-04-08 07:34:07'),
(119, 'SANKALPS', '2019-04-08 07:34:15'),
(120, 'Search all categories', '2019-04-18 07:45:08'),
(121, 'Msme Pulse All Editions', '2019-04-22 12:02:39'),
(122, 'Msme Pulse', '2019-04-22 12:02:39'),
(123, 'Scroll For Financial', '2019-04-24 06:56:50'),
(124, 'Scroll For Financial Reports', '2019-04-24 09:34:50'),
(125, 'Scroll For Direct Loans', '2019-04-24 09:35:14'),
(126, 'Borrower&#39s Corner', '2019-05-10 05:54:52'),
(127, 'As on May 26, 2019', '2019-06-03 11:57:01'),
(128, 'Archived Msme In Focus', '2019-06-19 07:55:04'),
(129, 'MsmeFocus', '2019-06-19 07:55:05'),
(130, 'Shareholders', '2019-06-25 05:24:09'),
(131, 'Swavlamban', '2019-06-25 19:05:27'),
(132, 'OPTIMISM', '2019-06-26 10:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `locale_targets`
--

CREATE TABLE `locale_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `locale_source_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Source string ID. References locale_sources.id',
  `translation` text CHARACTER SET utf8 NOT NULL COMMENT 'Translation string value in this language.',
  `language` varchar(11) NOT NULL COMMENT 'Language code. References languages.langcode.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locale_targets`
--

INSERT INTO `locale_targets` (`id`, `locale_source_id`, `translation`, `language`) VALUES
(1, 1, 'परिचय', 'hi'),
(2, 2, 'परिचय स्रोत', 'hi'),
(3, 1, 'Introducción', 'es'),
(4, 2, 'Introducción Fuente', 'es'),
(5, 3, 'समाचार', 'hi'),
(6, 3, 'Nouvelles', 'fr'),
(7, 3, 'Noticias', 'es'),
(9, 6, 'सिडबी ऋण हेतु आवेदन करें', 'hi'),
(10, 6, '', 'fr'),
(11, 6, '', 'es'),
(12, 1, 'introduction', 'fr'),
(13, 8, 'संरचनात्मक हस्तक्षेप', 'hi'),
(14, 8, '', 'fr'),
(15, 8, '', 'es'),
(16, 8, '', 'zh'),
(17, 9, '59 मिनट में पीएसबी ऋण', 'hi'),
(18, 9, '', 'fr'),
(19, 9, '', 'es'),
(20, 9, '', 'zh'),
(21, 10, 'दस्तावेज़', 'hi'),
(22, 11, 'शुद्धिपत्र', 'hi'),
(23, 12, 'अनुलग्नक', 'hi'),
(24, 16, 'अनुक्रमांक', 'hi'),
(25, 30, 'पर्यावलोकन', 'hi'),
(26, 39, 'प्रत्यक्ष ऋण', 'hi'),
(27, 40, 'उद्यम पूंजी', 'hi'),
(28, 41, 'अप्रत्यक्ष वित्त', 'hi'),
(29, 42, ' सावधि जमा', 'hi'),
(30, 43, 'माइक्रोफाइनेंस', 'hi'),
(31, 58, 'प्रतिसूचना', 'hi'),
(32, 62, 'हमारा संपर्क विवरण', 'hi'),
(33, 24, 'करियर', 'hi'),
(34, 63, 'पूछताछ ', 'hi'),
(35, 60, 'कर्मचारी कोना ', 'hi'),
(36, 21, 'निविदाएं', 'hi'),
(37, 46, 'संवर्धन एवं विकास', 'hi'),
(38, 50, 'उद्यमिता शिक्षा ज्ञानशृंखला', 'hi'),
(39, 48, 'स्वावलंबन', 'hi'),
(40, 49, 'बेचैन सपनों को पंख ', 'hi'),
(41, 67, 'स्वावलंबन के लिए  स्क्राल करें', 'hi'),
(42, 45, 'अन्य उत्पाद', 'hi'),
(43, 51, 'और पढ़ें ', 'hi'),
(44, 52, 'पारितंत्र', 'hi'),
(45, 7, 'गरीबी  अंतरवर्तन ', 'hi'),
(46, 44, 'उत्पाद ', 'hi'),
(47, 47, 'अन्य पहलकदमियों  को देखें ', 'hi'),
(48, 72, 'क्या हो रहा है ', 'hi'),
(49, 79, 'संक्षिप्त रूपरेखा ', 'hi'),
(50, 61, 'उधारकर्ता का कोना', 'hi'),
(51, 80, 'अधिक जानिए', 'hi'),
(52, 64, 'मैं खोज रहा हूँ...', 'hi'),
(53, 65, 'श्रेणी का चयन करें', 'hi'),
(54, 66, 'संवर्धन एवं विकासशील कार्यों के लिए स्क्रॉल करें', 'hi'),
(55, 68, 'संरचनात्मक  अंतरवर्तन  के लिए  स्क्राल  करें', 'hi'),
(56, 69, 'पारितंत्र एवं गरीबी अंतरवर्तन के लिए स्क्रॉल करें', ''),
(57, 81, 'अधिक जानकारी के लिए यहां क्लिक करें', 'hi'),
(58, 55, 'तस्वीरें', 'hi'),
(59, 53, 'सिडबी न्यूज़', 'hi'),
(60, 36, 'नौकरी का नाम', 'hi'),
(61, 37, 'आरंभ करने की तिथि', 'hi'),
(62, 83, 'जमा करने की अंतिम तिथि', 'hi'),
(63, 84, 'कुंजीशब्द दर्ज करें', 'hi'),
(64, 96, 'श्री मोहम्मद मुस्तफ़ा', 'hi'),
(65, 97, 'अध्यक्ष एवं प्रबंध निदेशक', 'hi'),
(66, 101, ' शेयरधारिता', 'hi'),
(67, 100, 'यथा 27फरवरी 2019', 'hi'),
(68, 102, 'सिडबी की शेयर-धारिता का स्वरूप', 'hi'),
(69, 104, 'शेयर-धारक का नाम', 'hi'),
(70, 105, 'धारित शेयरों की संख्या', 'hi'),
(71, 106, 'धारिता का% ', 'hi'),
(72, 110, 'बैंकों के माध्यम से सहायता', 'hi'),
(73, 111, 'बैंकों,गैर बैंकिंग वित्तीय संस्थाओं,लघु वित्त बैंकों के माध्यम से सहायता', 'hi'),
(74, 113, 'गैर-बैंकिंग वित्त कंपनियों को सहायता', 'hi'),
(75, 114, 'पुनर्वित्त योजनाएँ ', 'hi'),
(76, 116, 'लघु वित्त बैंकों को सहायता', 'hi'),
(77, 117, 'संस्थागत वित्त', 'hi'),
(78, 108, 'सूक्ष्म वित्तीयन', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ipaddress` varchar(20) CHARACTER SET utf8 NOT NULL,
  `failed_attempts` int(11) NOT NULL,
  `last_attempt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login_flag` tinyint(2) NOT NULL DEFAULT 0 COMMENT '1 for logged in and 0 for logged out.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `uid`, `ipaddress`, `failed_attempts`, `last_attempt`, `login_flag`) VALUES
(2, 1, '127.0.0.1', 0, '2021-08-26 08:34:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logo_sliders`
--

CREATE TABLE `logo_sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `logo_image` varchar(250) NOT NULL,
  `logo_cat_id` int(11) NOT NULL,
  `website` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo_sliders`
--

INSERT INTO `logo_sliders` (`id`, `title`, `logo_image`, `logo_cat_id`, `website`, `user_id`, `status`, `created`) VALUES
(1, 'India.gov.in', 'f-logo1.jpg', 2, 'https://www.india.gov.in/', 1, 1, '2019-07-08 06:45:56'),
(6, 'STATE GOVERNMENT OF HARYANA', 'f-logo2.jpg', 2, 'http://haryana.gov.in/', 1, 1, '2019-07-08 12:25:21'),
(7, 'Digital India Power of Empower', 'f-logo3.jpg', 2, 'https://digitalindia.gov.in/empowerment', 1, 1, '2019-07-08 12:27:11'),
(8, 'Ek kadam swachhata ki aur', 'f-logo4.jpg', 2, 'https://mhrd.gov.in/swachh-bharat-ek-kadam-swachhata-ki-aur', 1, 1, '2019-07-08 12:29:20'),
(9, 'data.gov.in', 'f-logo5.jpg', 2, 'https://data.gov.in/', 1, 1, '2019-07-08 12:30:17'),
(10, 'Election commission of india', 'f-logo6.jpg', 2, 'https://eci.gov.in/', 1, 1, '2019-07-08 12:32:11'),
(11, 'My Gov', 'f-logo7.jpg', 2, 'https://www.mygov.in/', 1, 1, '2019-07-08 12:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_region_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `lft` int(11) DEFAULT 0,
  `rght` int(11) DEFAULT 0,
  `menu_title` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `menu_type` enum('custom','object','module','internal') COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT 'custom',
  `custom_link` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `internal_link` text COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `object_type` varchar(30) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `object_id` bigint(20) NOT NULL DEFAULT 0,
  `module_id` int(11) NOT NULL DEFAULT 0,
  `redirection` enum('self','new-window') COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT 'self',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_region_id`, `parent_id`, `lft`, `rght`, `menu_title`, `menu_type`, `custom_link`, `internal_link`, `object_type`, `object_id`, `module_id`, `redirection`, `sort_order`, `status`) VALUES
(1, 2, NULL, 19, 20, 'Home', 'internal', '', '/', '', 0, 0, 'self', 0, 1),
(77, 6, NULL, 139, 140, 'Sitemap', 'object', '', '', 'article', 7, 0, 'self', 0, 1),
(35, 6, NULL, 57, 58, 'Disclaimer', 'object', '', '', 'article', 6, 0, 'self', 0, 1),
(34, 6, NULL, 109, 110, 'Accessibility', 'object', '', '', 'article', 5, 0, 'self', 0, 1),
(33, 6, NULL, 111, 112, 'Hyperlink Policy', 'object', '', '', 'article', 4, 0, 'self', 0, 1),
(32, 6, NULL, 107, 108, 'Copyright Policy', 'object', '', '', 'article', 3, 0, 'self', 0, 1),
(31, 6, NULL, 55, 56, 'Privacy Policy', 'object', '', '', 'article', 2, 0, 'self', 0, 1),
(30, 6, NULL, 105, 106, 'Terms & Condition', 'object', '', '', 'article', 1, 0, 'self', 0, 1),
(78, 2, NULL, 143, 144, 'How it Works', 'object', '', '', 'article', 3, 0, 'self', 3, 1),
(79, 2, NULL, 141, 142, 'About Us', 'object', '', '', 'article', 6, 0, 'self', 2, 1),
(80, 2, NULL, 145, 146, 'Why Us', 'object', '', '', 'article', 5, 0, 'self', 4, 1),
(81, 2, NULL, 147, 148, 'Contact Us', 'internal', '', 'contact-us', '', 0, 0, 'self', 6, 1),
(82, 2, NULL, 149, 150, 'Teams', 'object', '', '', 'article', 8, 0, 'self', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_regions`
--

CREATE TABLE `menu_regions` (
  `id` int(11) NOT NULL,
  `region` varchar(35) COLLATE utf8_general_mysql500_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `menu_regions`
--

INSERT INTO `menu_regions` (`id`, `region`, `slug`, `status`) VALUES
(2, 'Main Menu', 'main-menu', 1),
(6, 'Footer', 'footer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_translations`
--

CREATE TABLE `menu_translations` (
  `id` bigint(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `culture` varchar(10) COLLATE utf8_general_mysql500_ci NOT NULL,
  `menu_title` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  `cid` int(11) DEFAULT NULL,
  `controller` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `action` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `depth` decimal(6,3) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `description`, `pid`, `cid`, `controller`, `action`, `depth`, `icon`, `created`, `modified`) VALUES
(1, 'Users', NULL, 0, NULL, '#', '#', '3.000', 'fa fa-user', '2018-10-26 12:16:20', '2018-10-29 11:36:54'),
(2, 'Change Password', 'Change Password', 1, NULL, 'users', 'change-password', '1.000', NULL, '2018-10-29 11:53:04', '2018-10-29 11:53:04'),
(3, 'Masters', 'All masters data', 0, NULL, NULL, NULL, '2.000', 'fa fa-folder', '2018-10-29 12:06:53', '2018-10-29 12:06:53'),
(4, 'Roles', '', 3, NULL, 'roles', 'index', '1.000', NULL, '2018-10-29 12:07:19', '2018-10-29 12:07:19'),
(5, 'Modules', 'module list', 3, NULL, 'modules', 'index', '2.000', NULL, '2018-10-29 12:09:45', '2018-10-29 12:09:45'),
(6, 'Departments', 'Departments list', 3, NULL, 'Departments', 'index', '3.000', NULL, '2018-10-29 12:10:54', '2018-10-29 12:10:54'),
(7, 'Assign Role', 'rolespermissions', 1, NULL, 'rolespermissions', 'index', '2.000', NULL, '2018-10-29 12:14:41', '2018-10-29 12:20:18'),
(8, 'All Users', 'All users list', 1, NULL, 'users', 'index', '1.000', NULL, '2018-10-29 12:21:10', '2018-10-29 12:21:10'),
(9, 'Designation', '', 3, NULL, 'Designations', 'index', '4.000', NULL, '2018-10-29 12:28:34', '2018-10-29 12:28:34'),
(10, 'States', '', 3, NULL, 'States', 'index', '5.000', NULL, '2018-10-29 12:30:53', '2018-10-29 12:30:53'),
(11, 'Languages', 'languages list', 3, 3, 'languages', 'index', '7.000', NULL, '2018-12-17 16:35:31', '2018-12-17 16:35:31'),
(13, 'Districts', '', 3, NULL, 'Districts', 'index', '6.000', NULL, '2018-10-29 12:35:48', '2018-10-29 12:36:01'),
(14, 'Dashboard', 'for all users', 0, NULL, NULL, NULL, '1.000', 'fa fa-dashboard', '2018-11-14 14:31:27', '2018-11-14 14:31:27'),
(15, 'Dashboard', '', 14, NULL, 'dashboard', 'index', '1.000', NULL, '2018-11-14 14:32:05', '2018-11-14 14:32:05'),
(16, 'Content types', '', 0, NULL, NULL, NULL, '10.000', 'fa fa-folder', '2020-05-14 01:16:42', '2020-05-14 01:16:42'),
(17, 'Articles', '', 16, 16, 'articles', 'index', '1.000', NULL, '2018-12-17 15:06:20', '2018-12-17 15:06:20'),
(19, 'Logo Sliders', 'Logo Sliders list', 16, 16, 'logo-sliders', 'index', '5.000', NULL, '2018-12-17 15:31:48', '2018-12-17 15:31:48'),
(21, 'Banners', 'All banners list', 16, 16, 'banners', 'index', '2.000', NULL, '2018-12-17 15:05:45', '2018-12-17 15:05:45'),
(23, 'Language Management', 'Language Management', 0, NULL, NULL, NULL, '8.000', 'fa fa-language', '2018-12-17 14:32:29', '2018-12-17 14:32:29'),
(24, 'Interface translation', 'User interface translation', 23, 23, 'locale-targets', 'index', '1.000', NULL, '2018-11-30 17:55:26', '2018-11-30 17:55:26'),
(25, 'Locale String', 'Locale String for translation', 23, 0, 'locale-sources', 'index', '2.000', NULL, '2018-11-30 17:57:28', '2018-11-30 17:57:28'),
(27, 'Appearance', '', 0, NULL, NULL, NULL, '9.000', 'fa fa-folder', '2018-12-26 16:59:23', '2018-12-26 16:59:23'),
(28, 'Menus', 'Menu list', 27, NULL, 'menus', 'index', '1.000', NULL, '2018-12-26 16:59:49', '2018-12-26 16:59:49'),
(29, 'News', 'All news', 16, 0, 'news', 'index', '7.000', NULL, '2018-12-27 19:25:13', '2018-12-27 19:25:13'),
(40, 'Edit Article', '', 16, 17, 'articles', 'edit', '1.000', NULL, '2019-01-24 17:39:48', '2019-01-24 17:39:48'),
(41, 'Add Articles', '', 16, 17, 'articles', 'add', '2.000', NULL, '2019-01-24 17:44:31', '2019-01-24 17:44:31'),
(46, 'Add Banners', '', 16, 21, 'banners', 'add ', '1.000', NULL, '2019-01-24 17:52:21', '2019-01-24 17:52:21'),
(47, 'Edit Banners', 'For edit Home page Banners', 16, 16, 'banners', 'edit', '2.000', NULL, '2019-01-24 17:55:39', '2019-01-24 17:55:39'),
(52, 'Add News', '', 16, 29, 'news', 'add', '1.000', NULL, '2019-01-24 17:58:14', '2019-01-24 17:58:14'),
(53, 'Edit News', '', 16, 29, 'news', 'edit', '2.000', NULL, '2019-01-24 17:58:45', '2019-01-24 17:58:45'),
(69, 'Add Logo Sliders', '', 16, 19, 'logo-sliders', 'add', '1.000', NULL, '2019-01-24 18:20:42', '2019-01-24 18:20:42'),
(70, 'Edit Logo Sliders', '', 16, 19, 'logo-sliders', 'edit', '2.000', NULL, '2019-01-24 18:21:19', '2019-01-24 18:21:19'),
(71, 'Banners', '', 0, NULL, NULL, NULL, '4.000', '', '2019-01-24 18:49:24', '2019-01-24 18:49:24'),
(72, 'Articles', '', 0, NULL, NULL, NULL, '3.000', '', '2019-01-24 18:45:10', '2019-01-24 18:45:10'),
(75, 'Galleries', '', 0, NULL, NULL, NULL, '6.000', 'fa fa-folder', '2019-02-02 13:25:47', '2019-02-02 13:25:47'),
(76, 'Galleries', '', 75, NULL, 'galleries', 'index', '1.000', NULL, '2019-02-02 13:24:09', '2019-02-02 13:24:09'),
(77, 'Categories', 'gallery categories', 75, 0, 'gallery-categories', 'index', '2.000', NULL, '2019-02-02 13:25:02', '2019-02-02 13:25:02'),
(85, 'User Logs', 'user-log', 1, 0, 'users', 'user-log', '3.000', NULL, '2019-02-20 17:25:53', '2019-02-20 17:25:53'),
(89, 'Contacts', 'Contacts', 27, 27, 'contact-us', ' ', '3.000', NULL, '2020-06-06 21:08:46', '2020-06-06 21:08:46'),
(90, 'Complaints Grievance View', 'Complaints Grievance View', 27, 0, 'online-enquiry', 'complaints-view', '4.000', NULL, '2019-03-04 12:56:15', '2019-03-04 12:56:15'),
(91, 'Password History', '', 1, 0, 'users', 'change-password-history', '4.000', NULL, '2019-03-07 18:16:59', '2019-03-07 18:16:59'),
(96, 'Subscription', 'Subscription', 27, 0, 'newsletters', 'index', '7.000', NULL, '2019-05-30 11:40:50', '2019-05-30 11:40:50'),
(112, 'Teams', '', 16, 0, 'teams', 'index', '4.000', NULL, '2020-06-28 02:07:43', '2020-06-28 02:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `header_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `cloud_tags` longtext NOT NULL,
  `news_url` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `display_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `custom_link` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `upload_document_1` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `upload_document_2` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `is_unsubscribe` tinyint(1) NOT NULL DEFAULT 0,
  `reason` text DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL COMMENT '1=>All,2=>UDYAM ABHILASHA, 3=> MSME Pulse, 4=>Crisidex',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_translations`
--

CREATE TABLE `news_translations` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `culture` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `news_url` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `is_view` smallint(2) NOT NULL,
  `message` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `from_user_id`, `to_user_id`, `is_view`, `message`, `action`, `created`, `status`) VALUES
(1, 1, 28, 0, 'You are requested for change password.', '', '2020-07-05 00:05:49', 1),
(2, 1, 28, 0, 'Your password has been changed.', '', '2020-07-05 00:07:25', 1),
(3, 1, 28, 0, 'You have update your profile.', '', '2020-07-05 00:25:16', 1),
(4, 1, 42, 0, 'Your profile has been Screening Complete.', '', '2020-07-05 00:49:02', 1),
(5, 1, 42, 0, 'Your profile screening has been completed.', '', '2020-07-05 01:09:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `otp` mediumint(5) NOT NULL,
  `verified` int(1) DEFAULT NULL,
  `repeats` int(1) DEFAULT NULL,
  `wrong_attempt` int(1) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `designation_id` int(11) DEFAULT NULL COMMENT 'Primary Key of designation table',
  `date_of_birth` date DEFAULT NULL,
  `organization` varchar(250) NOT NULL,
  `shortname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `state_id` bigint(20) NOT NULL,
  `district_id` bigint(20) NOT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `star` mediumint(10) DEFAULT NULL COMMENT '1=>One Star,2=>Two Star,3=>Three Star,4=>Four Star,5=>Five Star',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`, `status`) VALUES
(1, 'Administrator', '2020-07-09 19:21:21', '2020-07-10 00:51:21', 1),
(2, 'Frontuser', '2020-07-09 19:21:42', '2020-07-10 00:51:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `mid` int(11) NOT NULL,
  `navigationshow` int(2) DEFAULT NULL COMMENT 'Show=0 ; Hide=1',
  `module` varchar(200) NOT NULL,
  `moduletask` varchar(200) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role_id`, `mid`, `navigationshow`, `module`, `moduletask`, `updated`, `created`) VALUES
(18, 1, 4, 0, 'Masters', 'Roles', '2018-10-29 12:36:34', '2018-10-29 12:36:34'),
(19, 1, 5, 0, 'Masters', 'Modules', '2018-10-29 12:36:34', '2018-10-29 12:36:34'),
(20, 1, 6, 0, 'Masters', 'Departments', '2018-10-29 12:36:34', '2018-10-29 12:36:34'),
(21, 1, 9, 0, 'Masters', 'Designation', '2018-10-29 12:36:34', '2018-10-29 12:36:34'),
(22, 1, 10, 0, 'Masters', 'States', '2018-10-29 12:36:35', '2018-10-29 12:36:35'),
(23, 1, 11, 0, 'Masters', 'Holidays', '2018-10-29 12:36:35', '2018-10-29 12:36:35'),
(24, 1, 12, 0, 'Masters', 'Quotes', '2018-10-29 12:36:35', '2018-10-29 12:36:35'),
(25, 1, 13, 0, 'Masters', 'Districts', '2018-10-29 12:36:35', '2018-10-29 12:36:35'),
(27, 2, 15, 1, 'Dashboard', 'Dashboard', '2018-11-14 09:02:30', '2018-11-14 14:32:30'),
(28, 3, 15, 1, 'Dashboard', 'Dashboard', '2018-11-14 09:02:43', '2018-11-14 14:32:43'),
(32, 4, 15, 1, 'Dashboard', 'Dashboard', '2018-11-22 23:41:35', '2018-11-23 10:41:35'),
(59, 4, 18, 1, 'Banners', 'Banner Add ', '2018-11-26 01:35:18', '2018-11-26 12:35:18'),
(60, 4, 19, 1, 'Banners', 'Banner Edit', '2018-11-26 01:35:19', '2018-11-26 12:35:19'),
(61, 4, 20, 1, 'Banners', 'Banner Delete ', '2018-11-26 01:35:19', '2018-11-26 12:35:19'),
(62, 4, 21, 0, 'Banners', 'Banners', '2018-11-26 01:35:19', '2018-11-26 12:35:19'),
(63, 4, 22, 1, 'Banners', 'View Banner', '2018-11-26 01:35:19', '2018-11-26 12:35:19'),
(464, 3, 17, 0, 'Content types', 'Articles', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(466, 3, 19, 0, 'Content types', 'Logo Sliders', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(468, 3, 21, 0, 'Content types', 'Banners', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(471, 3, 29, 0, 'Content types', 'News', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(479, 3, 40, 1, 'Content types', 'Edit Article', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(480, 3, 41, 1, 'Content types', 'Add Articles', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(485, 3, 46, 1, 'Content types', 'Add Banners', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(486, 3, 47, 1, 'Content types', 'Edit Banners', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(491, 3, 52, 1, 'Content types', 'Add News', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(492, 3, 53, 1, 'Content types', 'Edit News', '2019-01-24 13:57:13', '2019-01-24 19:27:13'),
(640, 6, 15, 1, 'Dashboard', 'Dashboard', '2019-02-23 06:58:27', '2019-02-23 12:28:27'),
(674, 1, 2, 1, 'Users', 'Change Password', '2019-03-07 12:47:16', '2019-03-07 18:17:16'),
(675, 1, 7, 0, 'Users', 'Assign Role', '2019-03-07 12:47:16', '2019-03-07 18:17:16'),
(676, 1, 8, 0, 'Users', 'All Users', '2019-03-07 12:47:17', '2019-03-07 18:17:17'),
(677, 1, 85, 0, 'Users', 'User Logs', '2019-03-07 12:47:17', '2019-03-07 18:17:17'),
(678, 1, 91, 0, 'Users', 'Password History', '2019-03-07 12:47:17', '2019-03-07 18:17:17'),
(679, 2, 2, 1, 'Users', 'Change Password', '2019-03-07 12:47:28', '2019-03-07 18:17:28'),
(680, 2, 85, 0, 'Users', 'User Logs', '2019-03-07 12:47:29', '2019-03-07 18:17:29'),
(681, 2, 91, 0, 'Users', 'Password History', '2019-03-07 12:47:29', '2019-03-07 18:17:29'),
(685, 6, 2, 1, 'Users', 'Change Password', '2019-03-07 12:48:00', '2019-03-07 18:18:00'),
(686, 6, 85, 0, 'Users', 'User Logs', '2019-03-07 12:48:00', '2019-03-07 18:18:00'),
(687, 6, 91, 0, 'Users', 'Password History', '2019-03-07 12:48:00', '2019-03-07 18:18:00'),
(738, 1, 33, 0, 'Appearance', 'Online Enquiry', '2019-05-30 06:11:08', '2019-05-30 11:41:07'),
(749, 1, 18, 0, 'Content types', 'Posts', '2019-06-25 08:40:51', '2019-06-25 14:10:51'),
(751, 1, 20, 0, 'Content types', 'Testimonials', '2019-06-25 08:40:51', '2019-06-25 14:10:51'),
(755, 3, 2, 1, 'Users', 'Change Password', '2020-05-11 19:52:45', '2020-05-12 01:22:45'),
(756, 3, 8, 0, 'Users', 'All Users', '2020-05-11 19:52:45', '2020-05-12 01:22:45'),
(757, 3, 85, 0, 'Users', 'User Logs', '2020-05-11 19:52:45', '2020-05-12 01:22:45'),
(758, 3, 91, 0, 'Users', 'Password History', '2020-05-11 19:52:45', '2020-05-12 01:22:45'),
(772, 1, 28, 0, 'Appearance', 'Menus', '2020-06-06 15:39:10', '2020-06-06 21:09:10'),
(773, 1, 89, 0, 'Appearance', 'Contacts', '2020-06-06 15:39:10', '2020-06-06 21:09:10'),
(779, 1, 17, 0, 'Content types', 'Articles', '2020-06-27 20:38:12', '2020-06-28 02:08:12'),
(780, 1, 21, 0, 'Content types', 'Banners', '2020-06-27 20:38:13', '2020-06-28 02:08:13'),
(781, 1, 112, 0, 'Content types', 'Teams', '2020-06-27 20:38:13', '2020-06-28 02:08:13'),
(782, 2, 17, 0, 'Content types', 'Articles', '2021-08-26 08:33:14', '2021-08-26 14:03:14'),
(783, 2, 19, 0, 'Content types', 'Logo Sliders', '2021-08-26 08:33:14', '2021-08-26 14:03:14'),
(784, 2, 21, 0, 'Content types', 'Banners', '2021-08-26 08:33:14', '2021-08-26 14:03:14'),
(785, 2, 29, 0, 'Content types', 'News', '2021-08-26 08:33:14', '2021-08-26 14:03:14'),
(786, 2, 40, 0, 'Content types', 'Edit Article', '2021-08-26 08:33:15', '2021-08-26 14:03:14'),
(787, 2, 41, 0, 'Content types', 'Add Articles', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(788, 2, 46, 0, 'Content types', 'Add Banners', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(789, 2, 47, 0, 'Content types', 'Edit Banners', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(790, 2, 52, 0, 'Content types', 'Add News', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(791, 2, 53, 0, 'Content types', 'Edit News', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(792, 2, 69, 0, 'Content types', 'Add Logo Sliders', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(793, 2, 70, 0, 'Content types', 'Edit Logo Sliders', '2021-08-26 08:33:15', '2021-08-26 14:03:15'),
(794, 2, 112, 0, 'Content types', 'Teams', '2021-08-26 08:33:15', '2021-08-26 14:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL,
  `data` blob DEFAULT NULL,
  `expires` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `code`, `name`, `created`, `flag`) VALUES
(1, 'AN', 'Andaman and Nicobar Islands', '2018-01-20 03:32:16', 1),
(2, 'AP', 'Andhra Pradesh', '2018-01-20 03:32:16', 1),
(3, 'AR', 'Arunachal Pradesh', '2018-01-20 03:32:16', 1),
(4, 'AS', 'Assam', '2018-01-20 03:32:16', 1),
(5, 'BR', 'Bihar', '2018-01-20 03:32:16', 1),
(6, 'CT', 'Chhattisgarh', '2018-01-20 03:32:16', 1),
(7, 'CH', 'Chandigarh', '2018-01-20 03:32:16', 1),
(8, 'DD', 'Daman and Diu', '2018-01-20 03:32:16', 1),
(9, 'DL', 'Delhi', '2018-01-20 03:32:16', 1),
(10, 'DN', 'Dadra and Nagar Haveli', '2018-01-20 03:32:16', 1),
(11, 'GA', 'Goa', '2018-01-20 03:32:16', 1),
(12, 'GJ', 'Gujarat', '2018-01-20 03:32:16', 1),
(13, 'HP', 'Himachal Pradesh', '2018-01-20 03:32:16', 1),
(14, 'HR', 'Haryana', '2018-01-20 03:32:16', 1),
(15, 'JH', 'Jharkhand', '2018-01-20 03:32:16', 1),
(16, 'JK', 'Jammu and Kashmir', '2018-01-20 03:32:16', 1),
(17, 'KA', 'Karnataka', '2018-01-20 03:32:16', 1),
(18, 'KL', 'Kerala', '2018-01-20 03:32:16', 1),
(19, 'LD', 'Lakshadweep', '2018-01-20 03:32:16', 1),
(20, 'MH', 'Maharashtra', '2018-01-20 03:32:16', 1),
(21, 'ML', 'Meghalaya', '2018-01-20 03:32:16', 1),
(22, 'MN', 'Manipur', '2018-01-20 03:32:16', 1),
(23, 'MP', 'Madhya Pradesh', '2018-01-20 03:32:16', 1),
(24, 'MZ', 'Mizoram', '2018-01-20 03:32:16', 1),
(25, 'NL', 'Nagaland', '2018-01-20 03:32:16', 1),
(26, 'OR', 'Odisha', '2018-01-20 03:32:16', 1),
(27, 'PB', 'Punjab', '2018-01-20 03:32:16', 1),
(28, 'PY', 'Puducherry', '2018-01-20 03:32:16', 1),
(29, 'RJ', 'Rajasthan', '2018-01-20 03:32:16', 1),
(30, 'SK', 'Sikkim', '2018-01-20 03:32:16', 1),
(31, 'TN', 'Tamil Nadu', '2018-01-20 03:32:16', 1),
(32, 'TR', 'Tripura', '2018-01-20 03:32:16', 1),
(33, 'UL', 'Uttarakhand', '2018-01-20 03:32:16', 1),
(34, 'UP', 'Uttar Pradesh', '2018-01-20 03:32:16', 1),
(35, 'WB', 'West Bengal', '2018-01-20 03:32:16', 1),
(40, 'TL', 'Telangana', '2018-01-20 03:32:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `content` text DEFAULT NULL,
  `profile_photo` varchar(250) DEFAULT NULL,
  `facebook_url` varchar(250) DEFAULT NULL,
  `linkedin_url` varchar(250) DEFAULT NULL,
  `twitter_url` varchar(250) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `designation`, `content`, `profile_photo`, `facebook_url`, `linkedin_url`, `twitter_url`, `status`, `created`, `updated`) VALUES
(1, 1, 'Ashley Smith', 'CEO', 'Team', 'auth-1.jpg', '#', '#', '#', 1, '2020-06-27 23:04:39', '0000-00-00 00:00:00'),
(2, 1, 'William John', 'Chief Technology Director', 'Chief Technology Director', 'auth-2.jpg', '#', '#', '#', 1, '2020-06-27 23:24:00', '0000-00-00 00:00:00'),
(3, 1, 'Johnson Brown', 'Chief Protocol Architect', 'Chief Protocol Architect', 'auth-3.jpg', '#', '#', '#', 1, '2020-06-27 23:24:42', '0000-00-00 00:00:00'),
(4, 1, 'Susan Linn', 'Chief Product Officer', 'Chief Product Officer', 'auth-4.jpg', '#', '#', '#', 1, '2020-06-27 23:25:21', '0000-00-00 00:00:00'),
(5, 1, 'Ashley Smith', 'Chief Technology Director', 'Chief Technology Director', 'auth-5.jpg', '#', '#', '#', 1, '2020-06-27 23:46:58', '0000-00-00 00:00:00'),
(6, 1, 'William John', 'Ipsum Lorem Ipsum', 'Ipsum Lorem Ipsum', '2020-07-09-024555-98j41-auth-6.jpg', '#', '#', '#', 1, '2020-07-09 02:45:55', '2020-07-09 02:45:55'),
(7, 1, 'Johnson Brown', 'Ipsum Lorem Ipsum', 'Ipsum Lorem Ipsum', 'auth-7.jpg', '#', '#', '#', 1, '2020-07-09 02:46:25', '2020-07-09 02:46:25'),
(8, 1, 'Susan Linn', 'Ipsum Lorem Ipsum', 'Ipsum Lorem Ipsum', 'auth-8.jpg', '#', '#', '#', 1, '2020-07-09 02:46:51', '2020-07-09 02:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hint` varchar(250) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `fp_token` text DEFAULT NULL,
  `fp_token_at` datetime DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `password_hint`, `role_id`, `status`, `fp_token`, `fp_token_at`, `created`, `modified`) VALUES
(1, 'Administrator', 'admin', 'admin@shoeindex.com', '$2y$10$B9qa6FkC4iM4kkLATr40u.dNXMeWLptC67x0Y7Uk0/RcS0Ft2dKrC', '', 1, 1, NULL, NULL, '2020-07-09 21:18:28', '2020-07-10 02:48:28'),
(2, 'Nilesh', 'frontuser', 'user@shoeindex.com', '$2y$10$B9qa6FkC4iM4kkLATr40u.dNXMeWLptC67x0Y7Uk0/RcS0Ft2dKrC', '', 2, 1, NULL, NULL, '2020-07-09 21:19:17', '2021-08-26 13:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `shortname` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state_id` int(20) DEFAULT NULL,
  `district_id` int(20) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pincode` int(8) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `user_video` varchar(250) DEFAULT NULL,
  `user_cv` varchar(250) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `star` mediumint(10) DEFAULT NULL COMMENT '1=>One Star,2=>Two Star,3=>Three Star,4=>Four Star,5=>Five Star',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `date_of_birth`, `shortname`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `mobile_number`, `phone`, `fax`, `country`, `state_id`, `district_id`, `city_name`, `address`, `pincode`, `profile_photo`, `user_video`, `user_cv`, `website`, `star`, `created`) VALUES
(1, 2, '1994-07-11', NULL, 'Nilesh', NULL, 'Kushvaha', 1, 'user@shoeindex.com', '9984479213', NULL, NULL, 'India', NULL, NULL, 'Delhi', 'New Delhi', 110023, NULL, NULL, NULL, 'https://whatsapp.com', NULL, '2021-08-26 13:47:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_images`
--
ALTER TABLE `article_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `changed` (`changed`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `article_links`
--
ALTER TABLE `article_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `article_translations`
--
ALTER TABLE `article_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auditrail`
--
ALTER TABLE `auditrail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_ibfk_1` (`user_id`);

--
-- Indexes for table `banner_categories`
--
ALTER TABLE `banner_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_password_logs`
--
ALTER TABLE `change_password_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_sms_contents`
--
ALTER TABLE `email_sms_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `culture` (`culture`) USING BTREE;

--
-- Indexes for table `locale_sources`
--
ALTER TABLE `locale_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locale_targets`
--
ALTER TABLE `locale_targets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locale_source_id` (`locale_source_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_sliders`
--
ALTER TABLE `logo_sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_region_id` (`menu_region_id`) USING BTREE,
  ADD KEY `menu_type` (`menu_type`) USING BTREE,
  ADD KEY `object_type` (`object_type`) USING BTREE,
  ADD KEY `object_id` (`object_id`) USING BTREE,
  ADD KEY `module_id` (`module_id`) USING BTREE;

--
-- Indexes for table `menu_regions`
--
ALTER TABLE `menu_regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`) USING BTREE;

--
-- Indexes for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `article_images`
--
ALTER TABLE `article_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article_links`
--
ALTER TABLE `article_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `article_translations`
--
ALTER TABLE `article_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auditrail`
--
ALTER TABLE `auditrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner_categories`
--
ALTER TABLE `banner_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `change_password_logs`
--
ALTER TABLE `change_password_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=715;

--
-- AUTO_INCREMENT for table `email_sms_contents`
--
ALTER TABLE `email_sms_contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locale_sources`
--
ALTER TABLE `locale_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier of this string', AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `locale_targets`
--
ALTER TABLE `locale_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logo_sliders`
--
ALTER TABLE `logo_sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `menu_regions`
--
ALTER TABLE `menu_regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu_translations`
--
ALTER TABLE `menu_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_translations`
--
ALTER TABLE `news_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=795;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news_translations`
--
ALTER TABLE `news_translations`
  ADD CONSTRAINT `news_translations_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
