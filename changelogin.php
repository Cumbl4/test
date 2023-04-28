<?php
	if (empty($_SESSION['auth'])) {
		header('Location: /test/authentication');
	} else {

		$info = '';
		$id = $_SESSION['id'];

		if (!empty($_POST['button'])) {
			if (!empty($_POST['login'])) {
				if (preg_match('#^[0-9a-zA-Z]{4,20}$#', $_POST['login'])) {
					$login = $_POST['login'];
					$query = "SELECT * FROM users WHERE login='$login'";
					$user = mysqli_fetch_assoc(mysqli_query($link, $query));

					if(empty($user)) {
						$query = "UPDATE users SET login='$login' WHERE id='$id'";
						mysqli_query($link, $query) or die(mysqli_error($link));
						header('Location: /test/user/'.$_SESSION['login']);
					} else {
						$info = 'Логин занят!';
					}
				} else {
					$info = 'Логин должен быть от 4 до 20 символов и содержать только латинские буквы и цифры!';
				}
			} else {
				$info = 'Поле не заполнено!';
			}
		}

		$content = '
				<div>
					<form action="" method="POST">
						Логин:<br><input name="login"><br><br>
						<input type="submit" name="button">
					</form>
				</div>
				';

			$page = [
				'title' => 'Изменить логин ',
				'content' => $content,
			];

			$page['info'] = $info;
			return $page;
	}
?>