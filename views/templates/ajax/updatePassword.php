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

$v->rule('required', ['account_new_password', 'account_confirm_new_password', 'account_old_password'])->message("This field is required");
$v->rule('lengthBetween', 'account_new_password', 6, 50)->message("Must be minimum 6 characters");
$v->rule('regex', 'account_new_password', '@[A-Z]@')->message("Must contain at least 1 uppercase character");
$v->rule('regex', 'account_new_password', '@[a-z]@')->message("Must contain at least 1 lowercase character");
$v->rule('regex', 'account_new_password', '@[0-9]@')->message("Must contain at least 1 number");
$v->rule('equals', 'account_confirm_new_password', 'account_new_password')->message("Your passwords do not match");



if($v->validate()){
    if(password_verify($_POST['account_old_password'], $user->getPassword())) {
        $newPassword = password_hash($_POST['account_new_password'], PASSWORD_DEFAULT);
        $data = [
            'password' => $newPassword
        ];
        Helpers::hydrate($user, $data, ['password']);
        $userTable->updateUser($user);
        echo json_encode(true);
        exit();
    }else{
        $return = [
            'account_old_password' => ['Old password is incorrect!']
        ];
        echo json_encode($return);
        exit();
    }
}else{
    // Errors
    $errors = $v->errors();
    echo json_encode($errors);
    exit();
}