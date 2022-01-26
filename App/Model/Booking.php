<?php


namespace App\Model;


class Booking {


    private $id;
    private $f_name;
    private $l_name;
    private $email;
    private $tel;
    private $time;
    private $size;
    private $date;
    

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

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}