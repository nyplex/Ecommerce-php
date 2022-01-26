<?php

use App\Auth;
use App\Config;
use App\Helpers;
use App\Table\UserTable;

Auth::Auth();
$pdo = Config::getPDO();
$v = new Valitron\Validator($_POST);
$userTable = new UserTable($pdo);
$user = $userTable->find($_SESSION['auth']);


$v->rule('lengthBetween', 'account_f_name', 2, 15)->message("Must be between 2 and 15 characters");
$v->rule('lengthBetween', 'account_l_name', 2, 20)->message("Must be between 2 and 20 characters");
$v->rule('length', 'account_tel', 11)->message("Must be 11 characters");
$v->rule('lengthBetween', 'account_email', 5, 100)->message("Must be between 5 and 100 characters");
$v->rule('email', 'account_email')->message("This is not a valid Email");
$v->rule('regex', 'account_tel', '/^((\\(?0\\d{4}\\)?\\s?\\d{3}\\s?\\d{3})|(\\(?0\\d{3}\\)?\\s?\\d{3}\\s?\\d{4})|(\\(?0\\d{2}\\)?\\s?\\d{4}\\s?\\d{4}))(\\s?\\#(\\d{4}|\\d{3}))?$/')->message("Invalide UK phone number");

if($v->validate()){
    $data = $_POST;
    if($data['account_f_name'] == "") {
        $f_name = $user->getF_name();
    }else{
        $f_name = $_POST['account_f_name'];
    }
    if($data['account_l_name'] == "") {
        $l_name = $user->getL_name();
    }else{
        $l_name = $_POST['account_l_name'];
    }
    if($data['account_email'] == "") {
        $email = $user->getEmail();
    }else{
        $email = $_POST['account_email'];
    }
    if($data['account_tel'] == "") {
        $tel = $user->getTel();
    }else{
        $tel = $_POST['account_tel'];
    }
    $data = [
        'f_name' => $f_name,
        'l_name' => $l_name,
        'slug' => $f_name . '_' . $l_name,
        'email' => $email,
        'tel' => $tel,
    ];
    Helpers::hydrate($user, $data, ['f_name', 'l_name', 'email', 'tel', 'slug']);
    if($userTable->exists('login_email', $user->getLogin_email(), $user->getId()) > 0 || $userTable->exists('email', $user->getEmail(), $user->getId()) > 0) {
        $return = [
            'account_email' => ['This email already exists']
        ];
        echo json_encode($return);
        exit();
    }elseif($userTable->exists('tel', $user->getTel(), $user->getId()) > 0){
        $return = [
            'account_tel' => ['This telephone already exists']
        ];
        echo json_encode($return);
        exit();
    }else{
        $userTable->updateUser($user);
        echo json_encode(true);
        exit();
    }
}else{
    // Errors
    $errors = $v->errors();
    echo json_encode($errors);
    exit();
}