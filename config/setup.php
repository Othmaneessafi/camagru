<?php
require_once("database.php");
try
{
	$options = array(
		PDO::ATTR_PERSISTENT => true ,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
	$sql = "CREATE DATABASE IF NOT EXISTS " . $DB_NAME . ";";
	$conn->exec($sql);
	$conn->exec('use ' . $DB_NAME . ';');
	$sql = "CREATE TABLE IF NOT EXISTS `comments` (
		`id` int NOT NULL,
		`user_id` int NOT NULL,
		`post_id` int NOT NULL,
		`content` varchar(255) NOT NULL
	  );

	  CREATE TABLE IF NOT EXISTS `likes` (
		`id` int NOT NULL,
		`user_id` int NOT NULL,
		`post_id` int NOT NULL
		);
		
		CREATE TABLE IF NOT EXISTS `posts` (
			`id` int NOT NULL,
			`user_id` int NOT NULL,
			`title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'camagru',
			`content` varchar(255) NOT NULL,
			`create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`comments` int NOT NULL DEFAULT '0',
			`likes` int NOT NULL DEFAULT '0',
			`like_nbr` int DEFAULT '0'
		);
		CREATE TABLE IF NOT EXISTS `users` (
			`id` int NOT NULL,
			`fullname` varchar(255) NOT NULL,
			`email` varchar(255) NOT NULL,
			`username` varchar(255) NOT NULL,
			`profile_img` varchar(255) NOT NULL DEFAULT 'https://www.washingtonfirechiefs.com/Portals/20/EasyDNNnews/3584/img-blank-profile-picture-973460_1280.png',
			`password` varchar(255) NOT NULL,
			`token` varchar(255) NOT NULL,
			`create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`verified` int NOT NULL DEFAULT '0',
			`notification` tinyint(1) NOT NULL DEFAULT '1'
		);
		ALTER TABLE `comments`
		ADD PRIMARY KEY (`id`);

		ALTER TABLE `likes`
		ADD PRIMARY KEY (`id`);


		ALTER TABLE `posts`
		ADD PRIMARY KEY (`id`);


		ALTER TABLE `users`
		ADD PRIMARY KEY (`id`);


		ALTER TABLE `comments`
		MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

		ALTER TABLE `likes`
		MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

		ALTER TABLE `posts`
		MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

		ALTER TABLE `users`
		MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;";
	$conn->exec($sql);
}
catch (PDOException $e)
{
	echo 'Error: ' . $e->getMessage() . '\n';
	die();
}