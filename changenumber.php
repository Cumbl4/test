<?php
	if (empty($_SESSION['auth'])) {
		header('Location: /test/authentication');
	} else {

		$info = '';
		$id = $_SESSION['id'];

		if (!empty($_POST['button'])) {
			if (!empty($_POST['phone_number'])) {
				if (preg_match('#^[0-9]{10}$#', $_POST['phone_number'])) {
					$phone_number = $_POST['phone_number'];
					$query = "SELECT * FROM users WHERE phone_number='$phone_number'";
					$user = mysqli_fetch_assoc(mysqli_query($link, $query));

					if(empty($user)) {
						$query = "UPDATE users SET phone_number='$phone_number' WHERE id='$id'";
						mysqli_query($link, $query) or die(mysqli_error($link));
						header('Location: /test/user/'.$_SESSION['login']);
					} else {
						$info = 'Пользователь с таким номером телефона уже зарегестрирован!';
					}
				} else {
					$info = 'Номер телефона должен состоять из 10 цифр!';
				}
			} else {
				$info = 'Поле не заполнено!';
			}
		}

		$content = '
				<div>
					<form action="" method="POST">
						Телефон:<br>+7<input name="phone_number" type="number"><br><br>
						<input type="submit" name="button">
					</form>
				</div>
				';

			$page = [
				'title' => 'Изменение номера телефона ',
				'content' => $content,
			];

			$page['info'] = $info;
			return $page;
	}
?>