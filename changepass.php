<?php
	if (empty($_SESSION['auth'])) {
		header('Location: /test/authentication');
	} else {

		$info = '';
		$id = $_SESSION['id'];

		if (!empty($_POST['button'])) {
			if (!empty($_POST['old_password']) and !empty($_POST['new_password'])) {
				if (preg_match('#^[0-9a-zA-Z!-/]{6,12}$#', $_POST['new_password'])) {
					if ($_POST['new_password'] == $_POST['new_password_confirm']) {
						$query = "SELECT * FROM users WHERE id='$id'";

						$result = mysqli_query($link, $query);
						$user = mysqli_fetch_assoc($result);

						$hash = $user['password'];
						$oldPassword = $_POST['old_password'];
						$newPassword = $_POST['new_password'];
							if (password_verify($oldPassword, $hash)) {
							$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

							$query = "UPDATE users SET password='$newPasswordHash' WHERE id='$id'";
							mysqli_query($link, $query);
							header('Location: /test/user/'.$_SESSION['login']);
						} else {
								$info = 'Старый пароль введен неверно!';
						}
					} else {
						$info = 'Пароли не совпадают!';
					}
				} else {
					$info = 'Пароль должен быть от 6 до 12 символов!';
				}
			} else {
				$info = 'Не заполнено одно из полей!';
			}
		}


		$content = '
				<div>
					<form action="" method="POST">
						Старый пароль:<br><input type="password" name="old_password"><br>
						Новый пароль:<br><input type="password" name="new_password"><br>
						Повторите пароль:<br><input type="password" name="new_password_confirm"><br>
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