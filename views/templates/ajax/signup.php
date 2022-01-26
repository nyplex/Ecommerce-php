<?php

use App\Config;
use App\Helpers;
use App\Model\Users;
use App\Table\UserTable;

$pdo = Config::getPDO();
$v = new Valitron\Validator($_POST);
$user = new Users();
$userTable = new UserTable($pdo);


$v->rule('required', ['f_name', 'l_name', 'email', 'confirm_email', 'tel', 'password', 'confirm_password'])->message("This field is required");
$v->rule('lengthBetween', 'f_name', 2, 15)->message("Must be between 2 and 15 characters");
$v->rule('lengthBetween', 'l_name', 2, 20)->message("Must be between 2 and 20 characters");
$v->rule('length', 'tel', 11)->message("Must be 11 characters");
$v->rule('lengthBetween', 'password', 6, 50)->message("Must be minimum 6 characters");
$v->rule('lengthBetween', 'email', 5, 100)->message("Must be between 5 and 100 characters");
$v->rule('email', 'email')->message("This is not a valid Email");
$v->rule('equals', 'confirm_email', 'email')->message("Your emails must match");
$v->rule('regex', 'tel', '/^((\\(?0\\d{4}\\)?\\s?\\d{3}\\s?\\d{3})|(\\(?0\\d{3}\\)?\\s?\\d{3}\\s?\\d{4})|(\\(?0\\d{2}\\)?\\s?\\d{4}\\s?\\d{4}))(\\s?\\#(\\d{4}|\\d{3}))?$/')->message("Invalide UK phone number");
$v->rule('regex', 'password', '@[A-Z]@')->message("Must contain at least 1 uppercase character");
$v->rule('regex', 'password', '@[a-z]@')->message("Must contain at least 1 lowercase character");
$v->rule('regex', 'password', '@[0-9]@')->message("Must contain at least 1 number");
$v->rule('equals', 'confirm_password', 'password')->message("Your passwords do not match");


if($v->validate()) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $data = [
        'f_name' => $_POST['f_name'],
        'l_name' => $_POST['l_name'],
        'email' => $_POST['email'],
        'tel' => $_POST['tel'],
        'password' => $password,
        'slug' => $_POST['f_name'] . '_' . $_POST['l_name'],
        'login_email' => $_POST['email']
    ];
    Helpers::hydrate($user, $data, ['f_name', 'l_name', 'slug', 'email', 'tel', 'password', 'login_email']);
    if($userTable->exists('login_email', $_POST['email']) > 0) {
        $return = [
            'email' => ['This email already exists']
        ];
        echo json_encode($return);
        exit();
    }elseif($userTable->exists('tel', $_POST['tel']) > 0){
        $return = [
            'tel' => ['This telephone already exists']
        ];
        echo json_encode($return);
        exit();
    }else{
        $userTable->createNewUser($user);
        session_start();
        $_SESSION['auth'] = $user->getId();
        $response = [
            'slug' => $user->getSlug(),
            'id' => $user->getId(),
        ];
        echo json_encode($response);
        exit();
    }
    
} else {
    // Errors
    $errors = $v->errors();
    echo json_encode($errors);
    exit();
}


?>