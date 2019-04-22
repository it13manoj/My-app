-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2019 at 02:25 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `JP_admins`
--

CREATE TABLE `JP_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` enum('Admin','Moderator') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `panels` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_admins`
--

INSERT INTO `JP_admins` (`id`, `name`, `email`, `user_role`, `password`, `status`, `panels`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'manoj.vayuz@gmail.com', 'Admin', '$2y$10$DP6Cf7Qf65DlLUyPY9L9IuGfk.71Zegn5AA9yk1bwAv9OzXJ.Dpyy', 1, NULL, 'mR1XQHLT7hAtQOZZkaTyCmT739fr1mS0LFBkpeQU6DNf8pukf2zrttFd3RPT', '2018-10-15 01:08:13', '2018-11-26 06:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `JP_advertisements`
--

CREATE TABLE `JP_advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adv_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adv_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `advStartDate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advEndDate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adv_status` smallint(6) NOT NULL DEFAULT '0',
  `adv_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adv_for` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adv_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_advertisements`
--

INSERT INTO `JP_advertisements` (`id`, `adv_title`, `adv_link`, `advStartDate`, `advEndDate`, `adv_status`, `adv_image`, `adv_for`, `adv_category`, `created_at`, `updated_at`) VALUES
(1, 'Test advertisement', 'https://www.google.com', '12/12/2019', '12/12/2020', 1, 'NC6W9TuwJF.gif', 'all', 'Adv_1_cat,Adv_2_cat,Adv_3_cat,Adv_4_cat', NULL, '2019-03-04 04:22:45'),
(2, 'Test adv 2', 'https://www.google.com', '12/12/2019', '12/12/2020', 1, 'x2CW7bmm6W.gif', 'Employer', NULL, NULL, '2019-03-04 01:12:02'),
(3, 'Test adv 3', 'https://www.google.com', '12/12/2019', '12/12/2020', 0, '11WkkgB2Jo.gif', 'Jobseeker', NULL, NULL, '2019-03-04 01:12:10'),
(4, 'Test adv 4', 'https://www.google.com', '12/12/2019', '12/12/2020', 0, NULL, NULL, NULL, NULL, NULL),
(5, 'Test adv 6', 'https://www.google.com', '12/12/2019', '12/12/2020', 0, 'gi64bD8J1k.gif', 'all', NULL, NULL, '2019-03-04 01:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `JP_categories`
--

CREATE TABLE `JP_categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_for` enum('Blog','Job') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` tinyint(8) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_categories`
--

INSERT INTO `JP_categories` (`category_id`, `category_name`, `category_for`, `category_status`, `created_at`, `updated_at`, `featured`) VALUES
(1, 'E-Governance Jobs', 'Job', 1, NULL, NULL, 1),
(2, 'Civil', 'Job', 1, NULL, NULL, 1),
(3, 'Mechanical', 'Job', 1, NULL, NULL, 1),
(4, 'Government Jobs', 'Job', 1, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `JP_cities`
--

CREATE TABLE `JP_cities` (
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `city_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_cities`
--

INSERT INTO `JP_cities` (`city_id`, `city_name`, `state_id`, `country_id`, `city_status`, `created_at`, `updated_at`) VALUES
(1, 'Noidaa', 1, 1, 1, '2018-12-06 05:43:56', '2018-12-06 05:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `JP_companies`
--

CREATE TABLE `JP_companies` (
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_category` bigint(20) DEFAULT NULL,
  `company_city` bigint(20) DEFAULT NULL,
  `company_state` bigint(20) DEFAULT NULL,
  `company_country` bigint(20) DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci,
  `company_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_employees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_about` longtext COLLATE utf8mb4_unicode_ci,
  `company_form_of_business` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_capital` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_sales` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_corporate_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_pics` text COLLATE utf8mb4_unicode_ci,
  `company_establish_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_workingtime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_fb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_tag_line` text COLLATE utf8mb4_unicode_ci,
  `company_google_plus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_linked_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_package` bigint(20) DEFAULT NULL,
  `company_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_videos` text COLLATE utf8mb4_unicode_ci,
  `is_marked_top` tinyint(4) NOT NULL DEFAULT '0',
  `is_marked_featured` tinyint(4) NOT NULL DEFAULT '0',
  `company_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `additionalinfo` longtext COLLATE utf8mb4_unicode_ci,
  `company_slug` text COLLATE utf8mb4_unicode_ci,
  `company_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_companies`
--

INSERT INTO `JP_companies` (`company_id`, `company_name`, `company_category`, `company_city`, `company_state`, `company_country`, `company_address`, `company_email`, `company_contact`, `company_website`, `number_of_employees`, `company_about`, `company_form_of_business`, `company_capital`, `company_sales`, `company_corporate_number`, `company_pics`, `company_establish_date`, `company_logo`, `company_workingtime`, `company_cover_image`, `company_fb`, `company_twitter`, `company_tag_line`, `company_google_plus`, `company_linked_in`, `company_package`, `company_owner`, `company_videos`, `is_marked_top`, `is_marked_featured`, `company_status`, `created_at`, `updated_at`, `additionalinfo`, `company_slug`, `company_lat`, `company_long`) VALUES
(1, 'L&T', 2, NULL, NULL, 1, 'Noida', 'lnt@test.one', '9898989898', 'http://www.google.com', '32', 'This is test description', NULL, '423234', '4234234', 'fsdfa23423423', NULL, '2000', '', NULL, NULL, 'http://www.facebook.com', 'http://www.facebook.com', NULL, 'http://www.facebook.com', 'http://www.facebook.com', NULL, NULL, NULL, 1, 0, 0, '2018-12-06 05:43:56', '2019-02-26 05:00:17', NULL, NULL, NULL, NULL),
(2, 'HCL', 1, NULL, NULL, 1, 'Noida', 'hcl@test.one', '9898989898', 'http://www.google.com', '32', 'this is test', NULL, '423234', '4234234', 'fsdfa23423423', NULL, '2000', 'Vv3Yl9Jv1o.jpg', NULL, NULL, 'http://www.facebook.com', 'http://www.facebook.com', NULL, 'http://www.facebook.com', 'http://www.facebook.com', NULL, NULL, NULL, 0, 1, 1, '2018-12-06 05:43:56', '2019-02-26 05:00:22', NULL, NULL, NULL, NULL),
(3, 'Vayuz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, '2018-12-10 13:19:18', '2019-03-02 07:16:46', NULL, NULL, '28.6008159', '77.28994839999996'),
(4, 'TCS', 1, 1, 1, 1, 'Noida Link Road, Mayur Vihar Phase 1 Extension, Mayur Vihar Phase 1, New Delhi, Delhi, India', 'mannu1993negi@gmail.com', '9557244908', 'https://www.tcs.com', '2000', '<p>Tata Consultancy Services Limited is an Indian multinational information technology service, consulting company headquartered in Mumbai, Maharashtra. It is part of the Tata Group and operates in 46 countries. TCS is one of the largest Indian companies by market capitalization.</p>', NULL, '423234543', '76767676698', 'TCS312321', ',5c1373d6c8927.png,5c1373d7282c4.png', '2000', '5c1370dbf0086.png', NULL, '5c63b69ca0b39.jpg', 'http://www.facebook.com', 'http://www.facebook.com', 'This is tag line', 'http://www.facebook.com', 'http://www.facebook.com', NULL, 'Manoj Negi', 'https://www.youtube.com/watch?v=-nSHiHO6QJI', 0, 0, 1, '2018-12-11 07:28:34', '2019-02-26 07:25:31', '<p>This is test additional info</p>', 'TCS-1551185731', '28.6008159', '77.28994839999996');

-- --------------------------------------------------------

--
-- Table structure for table `JP_countries`
--

CREATE TABLE `JP_countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_currency_code` text COLLATE utf8mb4_unicode_ci,
  `country_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_countries`
--

INSERT INTO `JP_countries` (`country_id`, `country_name`, `country_code`, `country_currency_code`, `country_status`, `created_at`, `updated_at`) VALUES
(1, 'India', '+91', 'INRR', 1, '2018-12-06 05:43:57', '2019-02-26 07:03:29'),
(2, 'Nepal', '92', 'NER', 1, '2018-12-06 05:43:57', '2018-12-06 05:43:57'),
(3, 'China', '93', 'YEN', 1, '2018-12-19 08:13:37', '2018-12-19 08:13:37');

-- --------------------------------------------------------

--
-- Table structure for table `JP_interviews`
--

CREATE TABLE `JP_interviews` (
  `interview_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `venue_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` text COLLATE utf8mb4_unicode_ci,
  `application_status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `interview_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interview_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `JP_jobApplication`
--

CREATE TABLE `JP_jobApplication` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `applicationStatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `followUp` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_questionnaire_submit` tinyint(8) NOT NULL DEFAULT '0',
  `questionnaire_answers` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_jobApplication`
--

INSERT INTO `JP_jobApplication` (`id`, `user_id`, `job_id`, `applicationStatus`, `tags`, `comments`, `followUp`, `created_at`, `updated_at`, `is_questionnaire_submit`, `questionnaire_answers`) VALUES
(20, 22, 2, 'Shortlisted', NULL, NULL, 0, '2019-03-01 10:36:57', '2019-03-04 11:59:57', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `JP_jobs`
--

CREATE TABLE `JP_jobs` (
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_user_id` bigint(20) NOT NULL,
  `job_company_id` bigint(20) NOT NULL,
  `job_description` longtext COLLATE utf8mb4_unicode_ci,
  `job_responsibility` longtext COLLATE utf8mb4_unicode_ci,
  `job_category` bigint(20) NOT NULL,
  `job_sub_category` bigint(20) NOT NULL,
  `job_offered_salary_min` bigint(20) NOT NULL,
  `job_offered_salary_max` bigint(20) NOT NULL,
  `job_is_salary_disclosed` tinyint(8) NOT NULL DEFAULT '0',
  `job_experience` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_qualification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_vacancy` int(11) NOT NULL,
  `job_graduation_start_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_graduation_end_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_career_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_preference` text COLLATE utf8mb4_unicode_ci,
  `job_skills` text COLLATE utf8mb4_unicode_ci,
  `job_benefits` text COLLATE utf8mb4_unicode_ci,
  `job_keywords` text COLLATE utf8mb4_unicode_ci,
  `job_questionnaire` bigint(20) DEFAULT NULL,
  `job_last_applying_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_expiry_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_country` bigint(20) DEFAULT NULL,
  `job_p_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_state` bigint(20) DEFAULT NULL,
  `job_city` bigint(20) DEFAULT NULL,
  `job_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_event_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_event_end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_event_number_of_companies` int(11) DEFAULT NULL,
  `job_event_companies` text COLLATE utf8mb4_unicode_ci,
  `job_status` int(11) NOT NULL DEFAULT '0',
  `job_is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published_on` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` text COLLATE utf8mb4_unicode_ci,
  `min_exp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_exp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_jobs`
--

INSERT INTO `JP_jobs` (`job_id`, `job_title`, `job_user_id`, `job_company_id`, `job_description`, `job_responsibility`, `job_category`, `job_sub_category`, `job_offered_salary_min`, `job_offered_salary_max`, `job_is_salary_disclosed`, `job_experience`, `job_qualification`, `job_vacancy`, `job_graduation_start_year`, `job_graduation_end_year`, `job_type`, `job_career_level`, `job_role`, `job_shift`, `job_preference`, `job_skills`, `job_benefits`, `job_keywords`, `job_questionnaire`, `job_last_applying_date`, `job_expiry_date`, `job_country`, `job_p_category`, `job_state`, `job_city`, `job_address`, `job_event`, `job_event_start_date`, `job_event_end_date`, `job_event_number_of_companies`, `job_event_companies`, `job_status`, `job_is_deleted`, `created_at`, `updated_at`, `published_on`, `reject_reason`, `min_exp`, `max_exp`) VALUES
(1, 'Need .Net Developer Urgent', 18, 4, '<p>fasdfasdfads</p>', '<p>fsadfsadfasd</p>', 1, 2, 11, 14, 0, '0-3', 'Intermediate,Graduation Diploma,Masters Post-Graduation', 44, '1975', '1980', 'Full Time', 'Entry Level', 'fsadf', 'Morning', 'women', '<p>fsadfsafdasd</p>', 'Accommodation,Gratuity', 'fsdf,gfdg', 7, '12/22/2018', '12/22/2018', NULL, '1', NULL, NULL, 'Noida, Uttar Pradesh, India', 'Job-fair', '12/29/2018', '12/31/2018', 4, 'fasdfdas,fsafdsa', 1, 0, '2018-12-19 11:13:17', '2019-03-01 23:45:07', 'Dec 20,2018', NULL, '0', '3'),
(2, 'Web developer', 18, 4, '<p>Minimum 3 years experience on PHP and Magento - Strong knowledge of PHP web frameworks - Understanding the fully synchronous behavior of PHP - Understanding of MVC design patterns - Strong experience on Magento system configuration and customization - Understanding of SVN, XML and JSON - Basic understanding of front-end technologies, such as JavaScript, HTML5, and CSS3 - Knowledge of object oriented PHP programming - Understanding accessibility and security compliance - Strong knowledge of the common PHP or web server exploits and their solutions - Understanding fundamental design principles behind a scalable application - Understanding of SQL, Web Services (SOAP, RESTful), jQuery and AJAX - User authentication and authorization between multiple systems, servers, and environments - Integration of multiple data sources and databases into one system - Familiarity with limitations of PHP as a platform and its workarounds - Creating database schemas that represent and support business processes - Familiarity with SQL/NoSQL databases and their declarative query languages - Proficient understanding of code versioning tools, such as Git</p>', '<p><strong>Minimum 3 years experience on PHP and Magento - Strong knowledge of PHP web frameworks - Understanding the fully synchronous behavior of PHP - Understanding of MVC design patterns - Strong experience on Magento system configuration and customization - Understanding of SVN, XML and JSON - Basic understanding of front-end technologies, such as JavaScript, HTML5, and CSS3 - Knowledge of object oriented PHP programming - Understanding accessibility and security compliance - Strong knowledge of the common PHP or web server exploits and their solutions - Understanding fundamental design principles behind a scalable application - Understanding of SQL, Web Services (SOAP, RESTful), jQuery and AJAX - User authentication and authorization between multiple systems, servers, and environments - Integration of multiple data sources and databases into one system - Familiarity with limitations of PHP as a platform and its workarounds - Creating database schemas that represent and support business processes - Familiarity with SQL/NoSQL databases and their declarative query languages - Proficient understanding of code versioning tools, such as Git</strong></p>', 2, 1, 1, 6, 0, '0-6', 'BBA', 4, '1977', '1981', 'Full Time', 'Entry Level', 'HR', 'Morning', 'women,Retired', '<p>Minimum 3 years experience on PHP and Magento - Strong knowledge of PHP web frameworks - Understanding the fully synchronous behavior of PHP - Understanding of MVC design patterns - Strong experience on Magento system configuration and customization - Understanding of SVN, XML and JSON - Basic understanding of front-end technologies, such as JavaScript, HTML5, and CSS3 - Knowledge of object oriented PHP programming - Understanding accessibility and security compliance - Strong knowledge of the common PHP or web server exploits and their solutions - Understanding fundamental design principles behind a scalable application - Understanding of SQL, Web Services (SOAP, RESTful), jQuery and AJAX - User authentication and authorization between multiple systems, servers, and environments - Integration of multiple data sources and databases into one system - Familiarity with limitations of PHP as a platform and its workarounds - Creating database schemas that represent and support business processes - Familiarity with SQL/NoSQL databases and their declarative query languages - Proficient understanding of code versioning tools, such as Git</p>', 'Gratuity,Health Insurance,Incentive Bonus,Leaves', 'PHP,SQL,noSql,MVC,Git,Laravel', 7, '12/29/2018', '12/29/2018', NULL, '2', NULL, NULL, 'Noida, Uttar Pradesh, India', 'Normal', NULL, NULL, NULL, NULL, 1, 0, '2018-12-19 12:14:40', '2019-03-01 23:45:08', 'Jan 07,2019', NULL, NULL, NULL),
(3, 'This is test from admin', 18, 4, 'This is test description<br>', 'This is test description<br>', 1, 2, 1, 9, 1, '2-8', 'BBA', 4, '1970', '1980', 'Full Time', 'Top Level', 'HR', 'Morning', 'women,Differently Abled', 'This is test description<br>', 'Accommodation,Gratuity,Health Insurance,Leaves,Travelling', 'PHP,LARAVEL', 7, '12/29/2018', '12/29/2018', NULL, '2', NULL, NULL, 'Noida-Greater Noida Expressway, Film City, Sector 16A, Noida, Uttar Pradesh, India', 'Normal', NULL, NULL, NULL, NULL, 1, 0, '2018-12-20 12:30:10', '2019-03-01 23:45:13', 'Jan 07,2019', 'this is for second test', NULL, NULL),
(4, 'PHP Developer / PHP Programmer ( Codeigniter ) - NSEZ , Noida', 18, 4, NULL, NULL, 1, 2, 1, 2, 0, '6-11', 'BBA', 4, '1970', '1976', 'Part Time', 'Entry Level', 'HR', 'Morning', 'women', 'fasdfasdf', 'Accommodation,Gratuity', 'fas,df,asdfa,d,vzx,cv,zxc,vz,xcz', 7, '12/29/2018', '12/29/2018', NULL, '3', NULL, NULL, 'Noida-Greater Noida Expressway, Film City, Sector 16A, Noida, Uttar Pradesh, India', 'Normal', NULL, NULL, NULL, NULL, 1, 0, '2018-12-22 09:44:59', '2019-02-16 05:38:00', 'Jan 07,2019', 'this is test reason', NULL, NULL),
(5, 'Test  1111', 18, 4, '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 1, 2, 6, 12, 1, '8-12', 'Graduation Diploma,Masters Post-Graduation', 4, '1971', '1987', 'Full Time', 'Entry Level', 'HR', 'Day', 'women,Differently Abled', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Accommodation,Gratuity,Health Insurance,Incentive Bonus,Leaves,Travelling', 'PHP,Laravel,Vuejs,Mysql,Git', NULL, '02-27-2019', '02-27-2019', NULL, '2', NULL, NULL, 'Noidaa,Delhi', 'Normal', NULL, NULL, NULL, NULL, 1, 0, '2019-02-20 08:34:31', '2019-02-20 03:46:25', 'Feb 20,2019', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `JP_migrations`
--

CREATE TABLE `JP_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_migrations`
--

INSERT INTO `JP_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_15_062532_create_admins_table', 1),
(4, '2018_10_15_114812_create_countries_table', 2),
(5, '2018_10_16_050232_create_states_table', 3),
(6, '2018_10_16_053835_create_cities_table', 4),
(7, '2018_10_16_063831_create_categories_table', 5),
(8, '2018_10_16_070353_create_subcategories_table', 6),
(9, '2018_10_16_075023_create_companies_table', 7),
(11, '2018_12_14_122524_create_jobs_table', 8),
(12, '2018_12_17_064655_create_packages_table', 8),
(13, '2018_12_19_061621_create_questionnaires_table', 9),
(14, '2019_01_08_071635_create_resume_table', 10),
(15, '2019_01_09_053326_create_user_meta_table', 11),
(16, '2019_01_21_073102_create_saved_jobs_table', 12),
(17, '2019_01_21_100711_create_job_application_table', 13),
(18, '2019_01_28_061717_create__questions_table', 14),
(19, '2019_01_31_052356_add_pages_table', 15),
(20, '2019_01_31_102150_create_advertisements_table', 16),
(21, '2019_02_05_055437_create_venues_table', 17),
(22, '2019_02_05_092426_create_interviews_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `JP_packages`
--

CREATE TABLE `JP_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_description` longtext COLLATE utf8mb4_unicode_ci,
  `package_price` int(11) NOT NULL,
  `package_duration` int(11) NOT NULL,
  `package_total_jobs` int(11) NOT NULL,
  `package_total_resume_download` int(11) NOT NULL,
  `package_total_excel_export` int(11) NOT NULL,
  `package_total_resume_views` int(11) NOT NULL,
  `package_total_resume_forward` int(11) NOT NULL,
  `package_total_resume_search` int(11) NOT NULL,
  `package_total_email` int(11) NOT NULL,
  `package_total_sms` int(11) NOT NULL,
  `package_status` tinyint(4) NOT NULL DEFAULT '1',
  `package_recruitment_service` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `package_for` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_packages`
--

INSERT INTO `JP_packages` (`id`, `package_name`, `package_description`, `package_price`, `package_duration`, `package_total_jobs`, `package_total_resume_download`, `package_total_excel_export`, `package_total_resume_views`, `package_total_resume_forward`, `package_total_resume_search`, `package_total_email`, `package_total_sms`, `package_status`, `package_recruitment_service`, `created_at`, `updated_at`, `package_for`) VALUES
(1, 'Professional', 'gsdfgsdf', 3456, 53, 53, 534, 53, 34, 345, 534, 34, 43, 1, 1, NULL, NULL, 'Employer'),
(2, 'Standard', 'gsdfgsdf', 4345, 53, 53, 534, 53, 34, 345, 534, 34, 43, 1, 1, NULL, NULL, 'Employer'),
(3, 'Premium', 'gsdfgsdf', 6345, 53, 53, 534, 53, 34, 345, 534, 34, 43, 1, 1, NULL, NULL, 'Employer');

-- --------------------------------------------------------

--
-- Table structure for table `JP_pages`
--

CREATE TABLE `JP_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_pages`
--

INSERT INTO `JP_pages` (`id`, `page_name`, `slug`, `description`, `status`, `created_at`, `updated_at`, `position`) VALUES
(1, 'About us', 'About-us-', '<p><strong>This is test page description is it working</strong></p>', 1, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `JP_password_resets`
--

CREATE TABLE `JP_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `JP_questionnaires`
--

CREATE TABLE `JP_questionnaires` (
  `questionnaire_id` int(10) UNSIGNED NOT NULL,
  `questionnaire_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `questionnaire_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `submission_days` int(11) DEFAULT NULL,
  `accept_late_submission` tinyint(4) NOT NULL DEFAULT '1',
  `suffle_questions` tinyint(4) NOT NULL DEFAULT '0',
  `questionnaire_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_questionnaires`
--

INSERT INTO `JP_questionnaires` (`questionnaire_id`, `questionnaire_title`, `questionnaire_type`, `user_id`, `company_id`, `submission_days`, `accept_late_submission`, `suffle_questions`, `questionnaire_status`, `created_at`, `updated_at`) VALUES
(7, 'Test Questionnaire', NULL, 18, 4, 4, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `JP_questions`
--

CREATE TABLE `JP_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questionnaire_id` bigint(20) NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int(11) NOT NULL,
  `is_required` smallint(6) NOT NULL DEFAULT '0',
  `is_suffle` smallint(6) NOT NULL DEFAULT '0',
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_questions`
--

INSERT INTO `JP_questions` (`id`, `questionnaire_id`, `question`, `marks`, `is_required`, `is_suffle`, `options`, `created_at`, `updated_at`) VALUES
(5, 7, 'This is test question', 3, 1, 0, 'option 1,option 2', '2019-01-28 08:38:02', '2019-01-28 08:38:02'),
(6, 7, 'This is second question', 42, 1, 1, 'option 11,option 21,option 31', '2019-02-04 08:38:22', '2019-02-04 08:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `JP_resume`
--

CREATE TABLE `JP_resume` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resumeData` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_resume`
--

INSERT INTO `JP_resume` (`id`, `user_id`, `type`, `resumeData`, `created_at`, `updated_at`) VALUES
(13, 22, 'Skills', '{\"skill\":\"PHP\",\"expertise\":\"Expert\"}', '2019-01-16 06:15:01', '2019-02-14 07:34:02'),
(18, 22, 'Education', '{\"education\":\"Graduation\\/Diploma\",\"degree\":\"BCA\",\"percentage\":\"75\",\"institute\":\"Kimt\",\"passing_out_year\":\"06\\/05\\/2015\"}', '2019-01-18 05:52:47', '2019-02-18 10:46:29'),
(19, 22, 'Education', '{\"education\":\"10th\",\"board\":\"State Board\",\"degree\":\"Intermediate\",\"percentage\":\"75\",\"institute\":\"S.V.M. Inter college\",\"passing_out_year\":\"Tue Jul 01 2008 11:24:00 GMT+0530 (India Standard Time)\"}', '2019-01-18 05:55:12', '2019-01-18 05:55:12'),
(20, 22, 'Professional', '{\"designation\":\"Sr. Web Developer\",\"organization\":\"Starview Soft\",\"jobtype\":\"Full Time\",\"jobshift\":\"Day\",\"industry\":\"1\",\"fArea\":\"2\",\"roleandresp\":\"undefined\",\"startDate\":\"01\\/01\\/2016\",\"currentlyWork\":false,\"endDate\":\"08\\/02\\/2017\"}', '2019-01-18 06:10:28', '2019-02-18 09:53:21'),
(21, 22, 'Professional', '{\"designation\":\"Sr. Web Developer\",\"organization\":\"Vayuz Tech\",\"jobtype\":\"Full Time\",\"jobshift\":\"Day\",\"industry\":\"1\",\"fArea\":\"2\",\"roleandresp\":\"Website and software application designing, building, or maintaining.\\nUsing scripting or authoring languages, management tools, content creation tools, applications and digital media.\\nConferring with teams to resolve conflicts, prioritize needs, develop content criteria, or choose solutions.\\nDirecting or performing Website updates.\",\"startDate\":\"Fri Dec 01 2017 11:40:00 GMT+0530 (India Standard Time)\",\"currentlyWork\":true}', '2019-01-18 06:10:52', '2019-01-18 06:10:52'),
(22, 22, 'Professional', '{\"designation\":\"Sr. Web Developer\",\"organization\":\"Vayuz Tech\",\"jobtype\":\"Full Time\",\"jobshift\":\"Day\",\"industry\":\"1\",\"fArea\":\"2\",\"roleandresp\":\"Website and software application designing, building, or maintaining.\\nUsing scripting or authoring languages, management tools, content creation tools, applications and digital media.\\nConferring with teams to resolve conflicts, prioritize needs, develop content criteria, or choose solutions.\\nDirecting or performing Website updates.\",\"startDate\":\"Thu Dec 03 2015 11:42:00 GMT+0530 (India Standard Time)\",\"currentlyWork\":false,\"endDate\":\"Sat Dec 31 2016 11:42:00 GMT+0530 (India Standard Time)\"}', '2019-01-18 06:12:31', '2019-01-18 06:12:31'),
(23, 22, 'Certification', '{\"course\":\"Ethical Hacking\",\"institute\":\"Appin Technology\",\"startDate\":\"05\\/02\\/2012\",\"endDate\":\"12\\/31\\/2012\",\"willExpire\":true,\"validTill\":null,\"score\":\"A\",\"certificationType\":\"Full Time\",\"description\":\"Developing or validating test routines and schedules to ensure that test cases mimic external interfaces and address all browser and device types.\\nEditing, writing, or designing Website content, and directing team members who produce content.\"}', '2019-01-18 06:21:06', '2019-02-18 11:55:12'),
(24, 22, 'Skills', '{\"skill\":\"Javascript\",\"expertise\":\"Expert\"}', '2019-01-18 06:25:38', '2019-01-18 06:25:38'),
(25, 22, 'Skills', '{\"skill\":\"CSS\",\"expertise\":\"Expert\"}', '2019-01-18 06:25:48', '2019-01-18 06:25:48'),
(26, 22, 'Skills', '{\"skill\":\"HTML\",\"expertise\":\"Expert\"}', '2019-01-18 06:25:55', '2019-01-18 06:25:55'),
(27, 22, 'Skills', '{\"skill\":\"Vue Js\",\"expertise\":\"Expert\"}', '2019-01-18 06:26:05', '2019-01-18 06:26:05'),
(28, 22, 'Skills', '{\"skill\":\"Laravel\",\"expertise\":\"Expert\"}', '2019-01-18 06:26:13', '2019-01-18 06:26:13'),
(29, 22, 'Resume', '{\"cover_letter\":\"<p>Dear Mr. Lee,<\\/p>\\n\\n<p>This letter is to express my interest in the job posted on your website for an experienced, detailed-oriented, front-end web developer. As you&#39;ll see, I have six years of hands-on experience efficiently coding websites and applications using modern HTML, CSS, and JavaScript.<\\/p>\\n\\n<p>Building state-of-the-art, easy to use, user-friendly websites and applications is truly a passion of mine and I am confident I would be an excellent addition to your organization. In addition to my knowledge base, I actively seek out new technologies and stay up-to-date on industry trends and advancements. This has allowed me to stay ahead of the curve and deliver exceptional work to all of my employers, including those I&#39;ve worked for on a project basis. I&rsquo;ve attached a copy of my resume detailing my experience, along with links to websites and applications I&rsquo;ve had the honor of working on.<\\/p>\\n\\n<p>I can be reached anytime via my cell phone, 555-555-5555 or by email at rita.applicant@gmail.com.<\\/p>\\n\\n<p>Thank you for your time and consideration. I look forward to speaking with you about this opportunity.&nbsp;<\\/p>\\n\\n<p>Best regards,<\\/p>\\n\\n<p>Manoj Applicant \\u200b(signature for a&nbsp;hard copy letter)<\\/p>\\n\\n<p>Manoj Applicant<\\/p>\",\"resume_link\":null,\"resume\":null,\"video_resume\":null}', '2019-01-18 06:57:02', '2019-02-18 13:34:04'),
(30, 22, 'Education', '{\"education\":\"12th\",\"board\":\"State Board\",\"percentage\":\"54\",\"institute\":\"S.V.M.I.C\",\"passing_out_year\":\"Thu Jul 01 2010 13:15:00 GMT+0530 (India Standard Time)\"}', '2019-02-13 07:47:05', '2019-02-13 07:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `JP_savedJobs`
--

CREATE TABLE `JP_savedJobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_savedJobs`
--

INSERT INTO `JP_savedJobs` (`id`, `user_id`, `job_id`, `created_at`, `updated_at`) VALUES
(26, 18, 1, '2019-01-21 12:01:06', '2019-01-21 12:01:06'),
(30, 22, 4, '2019-02-11 05:08:03', '2019-02-11 05:08:03'),
(31, 22, 5, '2019-02-22 04:56:39', '2019-02-22 04:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `JP_states`
--

CREATE TABLE `JP_states` (
  `state_id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) DEFAULT NULL,
  `state_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_states`
--

INSERT INTO `JP_states` (`state_id`, `state_name`, `country_id`, `state_status`, `created_at`, `updated_at`) VALUES
(1, 'Uttar pradesh', 1, 1, '2018-12-06 05:43:58', '2018-12-06 05:43:58'),
(2, 'Uttarakhandd', 1, 1, '2018-12-06 05:43:58', '2019-02-26 07:13:22');

-- --------------------------------------------------------

--
-- Table structure for table `JP_subcategories`
--

CREATE TABLE `JP_subcategories` (
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `subcategory_status` tinyint(4) NOT NULL DEFAULT '0',
  `subcategory_for` enum('Blog','Job') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_subcategories`
--

INSERT INTO `JP_subcategories` (`subcategory_id`, `subcategory_name`, `category_id`, `subcategory_status`, `subcategory_for`, `created_at`, `updated_at`) VALUES
(1, 'Finance', 2, 1, 'Job', '2018-12-06 05:43:59', '2019-01-09 10:22:03'),
(2, 'Accounts', 1, 1, 'Job', '2018-12-06 05:43:59', '2019-01-09 10:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `JP_users`
--

CREATE TABLE `JP_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_gender` enum('Male','Female','Other') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` enum('Jobseeker','Employer','Consultant') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_company` bigint(20) DEFAULT NULL,
  `user_token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `is_email_verified` tinyint(4) NOT NULL DEFAULT '0',
  `is_contact_verified` tinyint(4) NOT NULL DEFAULT '0',
  `blocked_by_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_industry` bigint(20) DEFAULT NULL,
  `user_functional_area` bigint(20) DEFAULT NULL,
  `user_experience_year` int(11) DEFAULT NULL,
  `user_experience_months` int(11) DEFAULT NULL,
  `user_current_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_current_salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_expected_salary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_prefered_location` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_salary_confidential` tinyint(4) NOT NULL DEFAULT '0',
  `user_salary_negotiable` tinyint(4) NOT NULL DEFAULT '0',
  `user_fb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_fb_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_google_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_linkedin_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_linkedin_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_twitter_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_twitter_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_about` longtext COLLATE utf8mb4_unicode_ci,
  `user_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_can_edit_comp` tinyint(8) NOT NULL DEFAULT '0',
  `user_profile_pic_thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidate_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_users`
--

INSERT INTO `JP_users` (`id`, `user_first_name`, `user_last_name`, `user_username`, `email`, `user_contact`, `user_gender`, `user_dob`, `user_profile_picture`, `user_role`, `user_address`, `user_company`, `user_token`, `user_designation`, `user_id_proof`, `user_status`, `is_email_verified`, `is_contact_verified`, `blocked_by_admin`, `is_deleted`, `user_industry`, `user_functional_area`, `user_experience_year`, `user_experience_months`, `user_current_location`, `user_current_salary`, `user_expected_salary`, `user_prefered_location`, `user_salary_confidential`, `user_salary_negotiable`, `user_fb_id`, `user_fb_link`, `user_google_id`, `user_google_link`, `user_linkedin_id`, `user_linkedin_link`, `user_twitter_id`, `user_twitter_link`, `last_login`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `user_about`, `user_slug`, `user_can_edit_comp`, `user_profile_pic_thumb`, `candidate_type`) VALUES
(18, 'Manoj', 'Negi', 'baba', 'baba@mailinator.com', '8778766909', 'Male', '12/07/1990', '5c6e3af89c49d.jpg', 'Employer', NULL, 4, 'c644122bbdc78ab45e577336d30e3a92', 'Developer', '321312321312', 1, 0, 0, 0, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 'https://www.facebook.com', NULL, NULL, NULL, 'https://www.facebook.com', NULL, 'https://www.facebook.com', '2019-03-05 06:05:58', NULL, '$2y$10$5Hfi/e5mAXKPxJkKsV1cNuQDksMfX.p6Lvh66FLcULvBeyi/4G.d2', 'lPJZwkO5A4p9acxFhozp2OQJPAAQB6s263D8NMNkuxFt3Ss0zCvtdXieWCsx', '2018-12-11 07:29:27', '2019-03-05 06:05:58', 'bafsd asd', 'Manoj-Negi-1541980800', 1, '5c6e3af89c49d.jpg', NULL),
(19, 'Ravi', 'sharma', 'ravi', 'ravi@mailinator.com', '9898989898', NULL, NULL, '5c17325e6a1f8.png', 'Employer', NULL, 1, 'e245146c78309900354b9295a9d86f81', 'hr', NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$9tbX9D/WAyZD4NZJPm62FOnsppgBd69.YbhiTZx22vSt6Xy8DnnGq', NULL, '2018-12-17 05:21:34', '2018-12-17 05:21:34', 'This is test', NULL, 0, NULL, NULL),
(20, 'Sanjay', 'sahu', 'sanjay', 'sanjay@mailinator.com', '9887676789', NULL, NULL, '5c173e4c5e477.png', 'Jobseeker', NULL, NULL, '4fb074ed4436f386b580bcaf6ed4e767', NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '100000', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$g7IVLv4wxxueRHxiVEFT9OqRbQNYV3TjAgzYe0GBhtFYj1DhmiUPC', NULL, '2018-12-17 05:23:03', '2019-02-25 10:43:40', 'This is test', 'Sanjay-32323342', 0, '5c173e4c5e477.png', NULL),
(21, 'test', 'test', 'test', 'test@mailinator.com', '9898878789', NULL, NULL, '5c206f3ebfba1.png', 'Jobseeker', NULL, NULL, '2cc283723be12578ef015614b508b7cb', NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '456565', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$AmcSI3h9DXe56K50G2bFPOw.1in22c60jHRxreGBkQaE/6XxGcdx6', NULL, '2018-12-24 05:31:43', '2019-02-25 10:49:30', 'This is test', 'Test-48732687432', 0, '5c206f3ebfba1.png', NULL),
(22, 'Manoj', 'negi', 'manoj.vayuz', 'manoj.vayuz@gmail.com', '9557244908', 'Male', 'Mon Jan 25 1993 17:22:00 GMT+0530 (India Standard Time)', '5c35b39ed7504.png', 'Jobseeker', NULL, NULL, '7afbc14b17b2b49e314e44487cfbbe75', 'HR', '34534534543', 1, 1, 0, 0, 0, 2, 1, 1, 1, 'Noida', '45645', '678767', 'Delhi', 1, 1, NULL, 'http://www.facebook.com', NULL, NULL, NULL, 'http://www.facebook.com', NULL, 'https://www.twitter.com', '2019-03-04 10:00:36', NULL, '$2y$10$zt7EeIY/2Dkrq30kD349TuQyPJ34mECClxa98tMVbRWeGJPzgAPIe', 'OzT4yJUXfmjHWy2bsMs57ERwVUB0xWEG83wNRKnE3q6OmpLrbqqgz3rICQLN', '2019-01-03 07:15:05', '2019-03-04 10:30:09', NULL, 'Manoj-negi-1551398400', 0, NULL, 'Experience'),
(23, 'Manoj', 'Negi', 'manoj', 'manoj@mailinator.com', '9878787908', NULL, NULL, NULL, 'Jobseeker', NULL, NULL, 'cba88a714454c60c0ee8336f8e0f46a2', NULL, NULL, 1, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '1009898', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NQVw0wJTxdD6LUZ3yehv/eoW3MWLJBnL/rYUx0e8WaOxxVdgvmo0S', NULL, '2019-02-07 10:53:20', '2019-02-25 10:53:25', NULL, 'Manoj-Negi-1562025600', 0, NULL, 'Fresher'),
(24, 'Shobhita', 'Yadav', 'shobhita.vayuz', 'shobhita.vayuz@gmail.com', '8987676567', NULL, NULL, NULL, 'Jobseeker', NULL, NULL, 'd4897e009690e40f525166fd331e401e', NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$S5ODyUCePPp1Os0aFHu0keCiQ0le4Flp25XupuDQBtiQbEAePKCSi', NULL, '2019-02-07 10:53:20', '2019-02-08 11:01:13', NULL, 'Shobhita-Yadav-1562025600', 0, NULL, 'Fresher'),
(27, 'Ankit', 'Arora', 'ankit.vayuz', 'ankit.vayuz@gmail.com', '9887564554', NULL, NULL, NULL, 'Jobseeker', NULL, NULL, 'b65f6faa81907c280ccb4f1b794db896', NULL, NULL, 1, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$I4X/gMLmxFjgCCwTGKcZWOH8JZ13iKY8Ld9TflMVaChbeSieiAagm', NULL, '2019-02-07 11:41:49', '2019-02-08 11:01:19', NULL, 'Ankit-Arora-1562025600', 0, NULL, 'Fresher');

-- --------------------------------------------------------

--
-- Table structure for table `JP_user_meta`
--

CREATE TABLE `JP_user_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_nationality` bigint(20) DEFAULT NULL,
  `workauth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_text` longtext COLLATE utf8mb4_unicode_ci,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_follow` longtext COLLATE utf8mb4_unicode_ci,
  `user_saved` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notice_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_user_meta`
--

INSERT INTO `JP_user_meta` (`id`, `user_id`, `user_nationality`, `workauth`, `resume_text`, `job_type`, `user_follow`, `user_saved`, `created_at`, `updated_at`, `notice_period`) VALUES
(1, 22, 3, '4', NULL, '1', NULL, NULL, '2019-01-09 08:41:03', '2019-01-18 07:29:43', '15 Days');

-- --------------------------------------------------------

--
-- Table structure for table `JP_venues`
--

CREATE TABLE `JP_venues` (
  `venue_id` bigint(20) UNSIGNED NOT NULL,
  `venue_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `venue_status` smallint(6) NOT NULL DEFAULT '1',
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `JP_venues`
--

INSERT INTO `JP_venues` (`venue_id`, `venue_name`, `venue_address`, `contact_person`, `contact_email`, `contact_no`, `instructions`, `venue_status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Test venue', 'Noida', 'manoj', 'mannu1993negi@gmail.com', '9557244908', 'this is test instruction', 1, 18, '2019-02-05 06:47:49', '2019-02-05 09:38:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `JP_admins`
--
ALTER TABLE `JP_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `JP_advertisements`
--
ALTER TABLE `JP_advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_categories`
--
ALTER TABLE `JP_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `JP_cities`
--
ALTER TABLE `JP_cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `JP_companies`
--
ALTER TABLE `JP_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `JP_countries`
--
ALTER TABLE `JP_countries`
  ADD PRIMARY KEY (`country_id`),
  ADD UNIQUE KEY `countries_country_name_unique` (`country_name`);

--
-- Indexes for table `JP_interviews`
--
ALTER TABLE `JP_interviews`
  ADD PRIMARY KEY (`interview_id`);

--
-- Indexes for table `JP_jobApplication`
--
ALTER TABLE `JP_jobApplication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_jobs`
--
ALTER TABLE `JP_jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `JP_migrations`
--
ALTER TABLE `JP_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_packages`
--
ALTER TABLE `JP_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_pages`
--
ALTER TABLE `JP_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_password_resets`
--
ALTER TABLE `JP_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `JP_questionnaires`
--
ALTER TABLE `JP_questionnaires`
  ADD PRIMARY KEY (`questionnaire_id`);

--
-- Indexes for table `JP_questions`
--
ALTER TABLE `JP_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_resume`
--
ALTER TABLE `JP_resume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_savedJobs`
--
ALTER TABLE `JP_savedJobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_states`
--
ALTER TABLE `JP_states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `JP_subcategories`
--
ALTER TABLE `JP_subcategories`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `JP_users`
--
ALTER TABLE `JP_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `JP_user_meta`
--
ALTER TABLE `JP_user_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `JP_venues`
--
ALTER TABLE `JP_venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `JP_admins`
--
ALTER TABLE `JP_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `JP_advertisements`
--
ALTER TABLE `JP_advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `JP_categories`
--
ALTER TABLE `JP_categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `JP_cities`
--
ALTER TABLE `JP_cities`
  MODIFY `city_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `JP_companies`
--
ALTER TABLE `JP_companies`
  MODIFY `company_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `JP_countries`
--
ALTER TABLE `JP_countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `JP_interviews`
--
ALTER TABLE `JP_interviews`
  MODIFY `interview_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `JP_jobApplication`
--
ALTER TABLE `JP_jobApplication`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `JP_jobs`
--
ALTER TABLE `JP_jobs`
  MODIFY `job_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `JP_migrations`
--
ALTER TABLE `JP_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `JP_packages`
--
ALTER TABLE `JP_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `JP_pages`
--
ALTER TABLE `JP_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `JP_questionnaires`
--
ALTER TABLE `JP_questionnaires`
  MODIFY `questionnaire_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `JP_questions`
--
ALTER TABLE `JP_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `JP_resume`
--
ALTER TABLE `JP_resume`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `JP_savedJobs`
--
ALTER TABLE `JP_savedJobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `JP_states`
--
ALTER TABLE `JP_states`
  MODIFY `state_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `JP_subcategories`
--
ALTER TABLE `JP_subcategories`
  MODIFY `subcategory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `JP_users`
--
ALTER TABLE `JP_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `JP_user_meta`
--
ALTER TABLE `JP_user_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `JP_venues`
--
ALTER TABLE `JP_venues`
  MODIFY `venue_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
