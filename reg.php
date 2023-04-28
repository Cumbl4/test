<meta charset="utf-8">
<?php
	$info = '';

	if (!empty($_POST['button'])) {
		if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['phone_number']) and !empty($_POST['email'])) {
			if (preg_match('#^[0-9a-zA-Z]{4,20}$#', $_POST['login'])) {
				if (preg_match('#^[0-9]{10}$#', $_POST['phone_number'])) {
					if (preg_match('#^[a-z0-9_-]+\@[a-z]{2,}\.[a-z]{2,}$#', $_POST['email'])) {
						if (preg_match('#^[0-9a-zA-Z!-/]{6,12}$#', $_POST['password'])) {
							if ($_POST['password'] == $_POST['confirm']) {
								$login = $_POST['login'];
								$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
								$phone_number = $_POST['phone_number'];
								$email = $_POST['email'];
								$query = "SELECT * FROM users WHERE login='$login'";
								$user = mysqli_fetch_assoc(mysqli_query($link, $query));
									if (empty($user)) {
										$query = "SELECT * FROM users WHERE phone_number='$phone_number'";
										$user = mysqli_fetch_assoc(mysqli_query($link, $query));
										if (empty($user)) {
											$query = "SELECT * FROM users WHERE email='$email'";
											$user = mysqli_fetch_assoc(mysqli_query($link, $query));
											if (empty($user)) {
												$query = "INSERT INTO users SET login='$login', password='$password', phone_number='$phone_number', email='$email'";
												mysqli_query($link, $query);

												$_SESSION['auth'] = true;
												$id = mysqli_insert_id($link);
												$_SESSION['id'] = $id;

												header('Location: /test');
											} else {
												$info = 'Пользователь с таким email уже зарегестрирован!';
											}
										} else {
											$info = 'Пользователь с таким номером телефона уже зарегестрирован!';
										}
									} else {
										$info = 'Логин занят!';
									}
								} else {
									$info = 'Пароли не совпадают!';
								}
						} else {
							$info = 'Пароль должен быть от 6 до 12 символов!';
						}
					} else {
						$info = 'Некорректный email!';
					}
				} else {
					$info = 'Номер телефона должен состоять из 10 цифр!';
				}
			} else {
				$info = 'Логин должен быть от 4 до 20 символов и содержать только латинские буквы и цифры!';
			}
		} else {
			$info = 'Не заполнено одно из полей!';
		}
	}

	if (empty($_SESSION['auth'])) {

		$content = '
		<ul>
		<form action="" method="POST">
			<li>Логин:<br><input name="login" value=""></li><br><br>
			<li>Телефон:<br>+7<input name="phone_number" type="number" value=""></li><br><br>
			<li>Email:<br><input name="email" value=""></li><br><br>
			<li>Пароль:<br><input name="password" type="password" value=""></li><br><br>
			<li>Повторите пароль:<br><input type="password" name="confirm" value=""></li><br><br>
			<input type="submit" name="button">
		</form>
		</ul>
		';
	} else {
		$info = 'Вы уже зарегистрированы!';
		$content = '<a href="/test/user/' . $_SESSION['login'] . '">Ваш профиль</a>';
	}

	$page = [
			'title' => 'регистрация ',
			'content' => $content,
		];

	$page['info'] = $info;

	return $page;
?>