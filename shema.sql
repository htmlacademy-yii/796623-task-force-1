CREATE DATABASE IF NOT EXISTS taskforce DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `surname` varchar(255),
    `email` varchar(255) NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `city_id` int(11) NOT NULL,
    `birthday` date,
    `phone` varchar(255),
    `skype` varchar(255),
    `telegram` varchar(255),
    `avatar_path` varchar(255),
    `popularity` int(11) NOT NULL,
    `creating_dt` datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS `specializations` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `category_id` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `works` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `photo_path` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `settings` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `show_contacts_for_customer_only` int(1) NOT NULL,
    `show_my_profile` int(1) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user_events` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `event_id` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `favorites` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `owner_user_id` int(11) NOT NULL,
    `favorite_user_id` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `roles` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `task_statuses` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `status` varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `tasks` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `owner_user_id` int(11) NOT NULL,
    `executor_user_id` int(11),
    `task_status_id` int(11) NOT NULL,
    `task_name` varchar(255) NOT NULL,
    `task_description` text NOT NULL,
    `category_id` int(11) NOT NULL,
    `city_id` int(11),
    `coordinate_latitude` float,
    `coordinate_longitude` float,
    `budget` int(11),
    `rating` int(11),
    `deadline` datetime,
    `creating_dt` datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS `task_attachments` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `task_id` int(11) NOT NULL,
    `attachment_path` varchar(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS `categories` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `category` varchar(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS `cities` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `city` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `chat_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` int(11) NOT NULL,
    `task_id` int(11) NOT NULL,
    `message` text NOT NULL,
    `creating_dt` datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS `replies` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `task_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `budget` int(11),
    `comment` text,
    `creating_dt` datetime NOT NULL
);

CREATE TABLE IF NOT EXISTS `events` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `event` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `feedback` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `task_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `comment` text NOT NULL
);
