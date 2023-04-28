<?php
	if (empty($_SESSION['auth'])) {
		header('Location: /test/authentication');
	} else {

		$info = '';
		$id = $_SESSION['id'];

		if (!empty($_POST['button'])) {
			if (!empty($_POST['email'])) {
				if (preg_match('#^[a-z0-9_-]+\@[a-z]{2,}\.[a-z]{2,}$#', $_POST['email'])) {
					$email = $_POST['email'];
					$query = "SELECT * FROM users WHERE email='$email'";
					$user = mysqli_fetch_assoc(mysqli_query($link, $query));

					if(empty($user)) {
						$query = "UPDATE users SET email='$email' WHERE id='$id'";
						mysqli_query($link, $query) or die(mysqli_error($link));
						header('Location: /test/user/'.$_SESSION['login']);
					} else {
						$info = 'Пользователь с таким email уже зарегестрирован!';
					}
				} else {
					$info = 'Некорректный email!';
				}
			} else {
				$info = 'Поле не заполнено!';
			}
		}

		$content = '
				<div>
					<form action="" method="POST">
						email:<br><input name="email"><br><br>
						<input type="submit" name="button">
					</form>
				</div>
				';

			$page = [
				'title' => 'Изменить почтовый адрес ',
				'content' => $content,
			];

			$page['info'] = $info;
			return $page;
	}
?>