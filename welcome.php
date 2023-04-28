<?php
	if (empty($_SESSION['auth'])) {
		$content = '';
	} else {
		$content = '<a href="/test/user/' . $_SESSION['login'] . '">Ваш профиль</a>';
	}
	$page = [
			'title' => 'добро пожаловать! ',
			'content' => $content,
			'info' => 'Добро пожаловать!'
		];

	return $page;
?>