<?php 


namespace App\Model;

class Users {

    private $id;
    private $f_name;
    private $l_name;
    private $slug;
    private $email;
    private $tel;
    private $password;
    private $login_email;
    

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getF_name()
    {
        return $this->f_name;
    }

    public function setF_name($f_name)
    {
        $this->f_name = $f_name;

        return $this;
    }

    public function getL_name()
    {
        return $this->l_name;
    }

    public function setL_name($l_name)
    {
        $this->l_name = $l_name;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
 
    public function getLogin_email()
    {
        return $this->login_email;
    }

    public function setLogin_email($login_email)
    {
        $this->login_email = $login_email;

        return $this;
    }
}