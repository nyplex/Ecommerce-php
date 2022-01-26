<?php 


namespace App\Table;

use PDO;
use App\Model\Users;

final class UserTable extends Table {
    

    protected $table = "users";
    protected $class = Users::class;

    
    /**
     * createNewUser
     * this function creates a new users in the DB
     * 
     * @param  mixed $user
     * @return void
     */
    public function createNewUser(Users $user): void 
    {
        $id = $this->create([
            'f_name' => $user->getF_name(),
            'l_name' => $user->getL_name(),
            'slug' => $user->getSlug(),
            'email' => $user->getEmail(),
            'tel' => $user->getTel(),
            'password' => $user->getPassword(),
            'login_email' => $user->getEmail(),
        ]);
        $user->setID($id);
    }
    
    /**
     * findUser
     * This function finds an user in the DB using their EMAIL
     *
     * @param  mixed $email
     * @return object
     */
    public function findUser(string $email)
    {
        $query = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE login_email = :email');
        $query->execute([
            'email' => $email
        ]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if($result === false) {
            return false;
        }
        return $result;
    }
    
    /**
     * updateUser
     * This function updates the user's details in the DB
     *
     * @param  mixed $user
     * @return void
     */
    public function updateUser(Users $user): void
    {
        $this->update([
            'id' => $user->getID(),
            'f_name' => $user->getF_name(),
            'l_name' => $user->getL_name(),
            'slug' => $user->getSlug(),
            'email' => $user->getEmail(),
            'tel' => $user->getTel(),
            'password' => $user->getPassword()
        ], $user->getID());
    }



}
