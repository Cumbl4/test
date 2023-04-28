<meta charset="utf-8">
<?php

	$info = '';

		if (!empty($_POST['button'])) {
			if (!empty($_POST['password']) and !empty($_POST['login'])) {
				$login = $_POST['login'];
				$password = $_POST['password'];

				$query = "SELECT * FROM users WHERE login='$login'";
				$result = mysqli_query($link, $query);
				$user = mysqli_fetch_assoc($result);


				if (!empty($user)) {
					$hash = $user['password'];

					if (password_verify($_POST['password'], $hash)) {
						$_SESSION['mes']  = 'Добро пожаловать ' . $_POST['login'] . '!';
						$_SESSION['auth'] = true;
						$_SESSION['id'] = $user['id'];
						$_SESSION['login'] = $user['login'];
						header('Location: test/user/'.$_SESSION['login']);
					} else {
						$info = 'Неверный пароль!';
					}
				} else {
					$info = 'Неверный логин!';
				}
			}  else {
				$info = 'Незаполнено одно из полей!';
			}
		}

		if (empty($_SESSION['auth'])) {

		$content = '
			<div>
				<form action="" method="POST">
					Логин:<br><input name="login"><br><br>
					Пароль:<br><input name="password" type="password"><br><br>
					<input type="submit" name="button">
				</form>
			</div>
			';
		} else {
			$info = 'Вы уже авторизованы!';
			$content = '<a href="/test/user/' . $_SESSION['login'] . '">Ваш профиль</a>';
		}

		$page = [
			'title' => 'аутентификация ',
			'content' => $content,
		];

		$page['info'] = $info;
		return $page;
?>