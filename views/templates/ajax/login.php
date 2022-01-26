<?php 

use App\Config;
use App\Model\Users;
use App\Table\UserTable;


$pdo = Config::getPDO();
$v = new Valitron\Validator($_POST);
$user = new Users();
$userTable = new UserTable($pdo);

$v->rule('required', ['loginEmail', 'loginPassword'])->message("This field is required");
$v->rule('email', 'loginEmail')->message("This is not a valid Email");

if($v->validate()) {
    $table = new UserTable($pdo);
    $u = $table->findUser($_POST['loginEmail']);
    if($u === false) {
        $return = [
            'loginEmail' => ['This email does not exist!']
        ];
        echo json_encode($return);
        exit();
    }
    if(password_verify($_POST['loginPassword'], $u->getPassword()) === true) {
        session_start();
        $_SESSION['auth'] = $u->getId();
        echo json_encode(true);
        exit();
    }else{
        $return = [
            'loginPassword' => ['Incorrect password!']
        ];
        echo json_encode($return);
        exit();
    }
}else {
    // Errors
    $errors = $v->errors();
    echo json_encode($errors);
    exit();
}

