<?php
// Отправляем браузеру правильную кодировку,
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

 
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }

    // Складываем признак ошибок в массив.
    $errors = array();
    $errors['inName'] = !empty($_COOKIE['inName_error']);
    $errors['inEmail'] = !empty($_COOKIE['inEmail_error']);
    $errors['inDate'] = !empty($_COOKIE['inDate_error']);
    $errors['inGender'] = !empty($_COOKIE['inGender_error']);
    $errors['inLimb'] = !empty($_COOKIE['inLimb_error']);
    $errors['inSuperpowers'] = !empty($_COOKIE['inSuperpowers_error']);
    $errors['inMessage'] = !empty($_COOKIE['inMessage_error']);
    $errors['check'] = !empty($_COOKIE['check_error']);

  // TODO: аналогично все поля.

// Выдаем сообщения об ошибках.
    if ($errors['inName']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('inName_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя.</div>';
    }

    if ($errors['inEmail']) {
        setcookie('inEmail_error', '', 100000);
        $messages[] = '<div class="error">Заполните email в правильной форме</div>';
    }

    if ($errors['inDate']) {
        setcookie('inDate_error', '', 100000);
        $messages[] = '<div class="error">Заполните дату.</div>';
    }

    if ($errors['inGender']) {
        setcookie('inGender_error', '', 100000);
        $messages[] = '<div class="error">Выберите пол.</div>';
    }

    if ($errors['inLimb']) {
        setcookie('inLimb_error', '', 100000);
        $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
    }

    if (!isset($_POST['inSup1']) && !isset($_POST['inSup2']) && !isset($_POST['inSup3'])) {
        setcookie('inSuperpowers_error', '1', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите способность.</div>';
      }
      else {
        setcookie('inSup1_value', isset($_POST['inSup1']) ? $_POST['inSup1'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('inSup2_value', isset($_POST['inSup2']) ? $_POST['inSup2'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('inSup3_value', isset($_POST['inSup3']) ? $_POST['inSup3'] : '', time() + 365 * 30 * 24 * 60 * 60);
      }
    
    if ($errors['inMessage']) {
        setcookie('inMessage_error', '', 100000);
        $messages[] = '<div class="error">Введите сообщение.</div>';
        }

    if ($errors['check']) {
        setcookie('check_error', '', 100000);
        $messages[] = '<div class="error">Ознакомьтесь с контрактом.</div>';
    }

    // Складываем предыдущие значения полей в массив, если есть.
    $values = array();
    $values['inName'] = empty($_COOKIE['inName_value']) ? '' : $_COOKIE['inName_value'];
    $values['inEmail'] = empty($_COOKIE['inEmail_value']) ? '' : $_COOKIE['inEmail_value'];
    $values['inDate'] = empty($_COOKIE['inDate_value']) ? '' : $_COOKIE['inDate_value'];
    $values['inGender'] = empty($_COOKIE['inGender_value']) ? '' : $_COOKIE['inGender_value'];
    $values['inLimb'] = empty($_COOKIE['inLimb_value']) ? '' : $_COOKIE['inLimb_value'];
    $values['inSup1'] = empty($_COOKIE['inSup1_value']) ? '' : $_COOKIE['inSup1_value'];
    $values['inSup2'] = empty($_COOKIE['inSup2_value']) ? '' : $_COOKIE['inSup2_value'];
    $values['inSup3'] = empty($_COOKIE['inSup3_value']) ? '' : $_COOKIE['inSup3_value'];
    $values['inMessage'] = empty($_COOKIE['inMessage_value']) ? '' : $_COOKIE['inMessage_value'];
    $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
   
    // Включаем содержимое файла form.php.
    include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
    $errors = FALSE;
    if (empty($_POST['inName'])) {
      setcookie('inName_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    }
    else {
        setcookie('inName_value', $_POST['inName'], time() + 30 * 24 * 60 * 60);
    }

    if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['inEmail'])) {
        setcookie('inEmail_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('inEmail_value', $_POST['inEmail'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['inDate'])) {
        setcookie('inDate_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('inDate_value', $_POST['inDate'], time() + 30 * 24 * 60 * 60);
    }   

    if (empty($_POST['inGender'])) {
        setcookie('inGender_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('inGender_value', $_POST['inGender'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['inLimb'])) {
        setcookie('inLimb_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('inLimb_value', $_POST['inLimb'], time() + 30 * 24 * 60 * 60);
    }

    if (!isset($_POST['inSup1']) && !isset($_POST['inSup2']) && !isset($_POST['inSup3'])) {
        setcookie('inSuperpowers_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
      }
      else {
        setcookie('inSup1_value', isset($_POST['inSup1']) ? $_POST['inSup1'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('inSup2_value', isset($_POST['inSup2']) ? $_POST['inSup2'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('inSup3_value', isset($_POST['inSup3']) ? $_POST['inSup3'] : '', time() + 365 * 30 * 24 * 60 * 60);
      }

    if (empty($_POST['inMessage'])) {
        setcookie('inMessage_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('inMessage_value', $_POST['inMessage'], time() + 30 * 24 * 60 * 60);
    }

    if (empty($_POST['check'])) {
        setcookie('check_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else {
        setcookie('check_value', $_POST['check'], time() + 30 * 24 * 60 * 60);
    }
  
    if ($errors) {
      // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
      header('Location: index.php');
      exit();
    }
else{
    setcookie('inName_error', '', 100000);
    setcookie('inEmail_error', '', 100000);
    setcookie('inDate_error', '', 100000);
    setcookie('inGender_error', '', 100000);
    setcookie('inLimb_error', '', 100000);
    setcookie('inSuperpowers_error', '', 100000);
    setcookie('inMessage_error', '', 100000);

    extract($_POST);
	$user = 'u20295';
	$pass = '7045626';
	$db = new PDO('mysql:host=localhost;dbname=u20295', $user, $pass);

	$name = $_POST['inName'];
	$email = $_POST['inEmail'];
	$date = $_POST['inDate'];
	$gender = $_POST['inGender'];
	$limb = $_POST['inLimb'];
    $super = $_POST['inSup1'].
        (isset($_POST['inSup2']) ? (' '. $_POST['inSup2']) : '').
        (isset($_POST['inSup3']) ? (' '. $_POST['inSup3']) : '');

	$message = $_POST['inMessage'];
	try {
		$stmt = $db->prepare("INSERT INTO anketa (name, email, date, gender, limb, super, message) VALUES (:name, :email, :date, :gender, :limb, :super, :message)");
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':date', $date);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':limb', $limb);
		$stmt->bindParam(':super', $super);
		$stmt->bindParam(':message', $message);
		$stmt->execute();
		print('Спасибо, результаты сохранены.');
		exit();
	}
	catch(PDOException $e){
		print('Error : ' . $e->getMessage());
		exit();
    }
}
    // Сохраняем куку с признаком успешного сохранения.
    setcookie('save', '1');

    // Делаем перенаправление.
    header('Location: index.php');
}
