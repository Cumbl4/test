<?php
	if (empty($_SESSION['auth'])) {
		header('Location: /test/authentication');
	} else {

		$link = mysqli_connect($host, $user, $pass, $name);
		mysqli_query($link, "SET NAMES 'utf8'");

		$id = $_SESSION['id'];
		$query = "SELECT login,phone_number,email FROM users WHERE id=$id";

		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$user = mysqli_fetch_assoc($result);

		$content = '<a href=/test/changelogin>Изменить логин</a><br>
					<a href=/test/changenumber>Изменить телефон</a><br>
					<a href=/test/changemail>Изменить email</a><br>
					<a href=/test/changepass>Изменить пароль</a><br>';

		foreach ($user as $value) {
			$info[] = "<p>$value</p>";
		}

		$page = [
			'title' => 'Страница пользователя '.$user['login'],
			'content' => $content,
		];

		$page['info'] = implode($info);
		return $page;
	}
?>