-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Ноя 07 2024 г., 12:38
-- Версия сервера: 8.0.35
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `website_OO`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AcademicSubject`
--

CREATE TABLE `AcademicSubject` (
  `subject_id` int NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Achievements`
--

CREATE TABLE `Achievements` (
  `achievement_id` int NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `event_levle` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `event_form` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `event_result` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Employees`
--

CREATE TABLE `Employees` (
  `employee_id` int NOT NULL,
  `post` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employee_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employee_surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `employee_patronymic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Files`
--

CREATE TABLE `Files` (
  `file_id` int NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Groups`
--

CREATE TABLE `Groups` (
  `group_id` int NOT NULL,
  `specialties_id` int NOT NULL,
  `group_number` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `place_bf` int NOT NULL,
  `place_br` int NOT NULL,
  `place_bm` int NOT NULL,
  `place_ed` int NOT NULL,
  `fee_per_year` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Managers`
--

CREATE TABLE `Managers` (
  `maneger_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `manager_phone_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `manager_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `PageFile`
--

CREATE TABLE `PageFile` (
  `page_id` int NOT NULL,
  `file_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Pages`
--

CREATE TABLE `Pages` (
  `page_id` int NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_modified_date` datetime NOT NULL,
  `last_modified_user_id` datetime NOT NULL,
  `page_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `page_file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Specialties`
--

CREATE TABLE `Specialties` (
  `specialties_id` int NOT NULL,
  `specialties_number` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `specialties_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `training_duration` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `foreign_students_number` int NOT NULL,
  `language` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `employed_students_number` int NOT NULL,
  `education_form` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `accreditation_validity_period` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `curriculum_file_id` int NOT NULL,
  `work_programms_page_id` int NOT NULL,
  `calendar_schedule_file_id` int NOT NULL,
  `metodological_documents_page_id` int NOT NULL,
  `e_and_distance_learning` text COLLATE utf8mb4_general_ci NOT NULL,
  `basic_education` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `education_level` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `annotations_page_id` int NOT NULL,
  `description_file_id` int NOT NULL,
  `professions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `SpecialtiesSubject`
--

CREATE TABLE `SpecialtiesSubject` (
  `academic_subject_id` int NOT NULL,
  `specialties_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Teachers`
--

CREATE TABLE `Teachers` (
  `teacher_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `education` text COLLATE utf8mb4_general_ci NOT NULL,
  `professional_development` text COLLATE utf8mb4_general_ci NOT NULL,
  `professional_retraining` text COLLATE utf8mb4_general_ci NOT NULL,
  `academic_degress` text COLLATE utf8mb4_general_ci NOT NULL,
  `academic_rank` text COLLATE utf8mb4_general_ci NOT NULL,
  `experience` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `TeacherSubject`
--

CREATE TABLE `TeacherSubject` (
  `academic_subject_id` int NOT NULL,
  `teacher_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `user_id` int NOT NULL,
  `employee_id` int NOT NULL,
  `user_role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `VisitorQuestions`
--

CREATE TABLE `VisitorQuestions` (
  `question_id` int NOT NULL,
  `respondent_id` int DEFAULT NULL,
  `visitor_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visitor_phone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visitor_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visitor_surname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visitor_patronymic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `question_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `question_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `question_date` datetime NOT NULL,
  `answer_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AcademicSubject`
--
ALTER TABLE `AcademicSubject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Индексы таблицы `Achievements`
--
ALTER TABLE `Achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Индексы таблицы `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Индексы таблицы `Files`
--
ALTER TABLE `Files`
  ADD PRIMARY KEY (`file_id`);

--
-- Индексы таблицы `Groups`
--
ALTER TABLE `Groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Индексы таблицы `Managers`
--
ALTER TABLE `Managers`
  ADD PRIMARY KEY (`maneger_id`);

--
-- Индексы таблицы `Pages`
--
ALTER TABLE `Pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `Specialties`
--
ALTER TABLE `Specialties`
  ADD PRIMARY KEY (`specialties_id`);

--
-- Индексы таблицы `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `VisitorQuestions`
--
ALTER TABLE `VisitorQuestions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `AcademicSubject`
--
ALTER TABLE `AcademicSubject`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Achievements`
--
ALTER TABLE `Achievements`
  MODIFY `achievement_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Employees`
--
ALTER TABLE `Employees`
  MODIFY `employee_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Files`
--
ALTER TABLE `Files`
  MODIFY `file_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Groups`
--
ALTER TABLE `Groups`
  MODIFY `group_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Managers`
--
ALTER TABLE `Managers`
  MODIFY `maneger_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Pages`
--
ALTER TABLE `Pages`
  MODIFY `page_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Specialties`
--
ALTER TABLE `Specialties`
  MODIFY `specialties_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `teacher_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `VisitorQuestions`
--
ALTER TABLE `VisitorQuestions`
  MODIFY `question_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
