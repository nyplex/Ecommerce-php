<?php 


namespace App;

class Form {

    public function input(string $type, string $class, string $placeHolder, string $id): string 
    {
       return "<input class='{$class}' id='{$id}' placeholder='{$placeHolder}' type='{$type}'>" ;
    }


    public function select(string $name, string $id, array $options = [], string $class): string 
    {
        $optionsHTML = [];
        foreach($options as $option)
        {
            $optionsHTML[] = "<option value='{$option}'>{$option}</option>";
        }
        $optionsHTML = implode("", $optionsHTML);
        return "<select name='{$name}' id='{$id}' class='{$class}'>{$optionsHTML}</select>";
    }

    public function selectTime(string $name, string $id, string $class) 
    {
        $array = [
            "12:00",
            "12:15",
            "12:30",
            "12:45",
            "13:00",
            "13:15",
            "13:30",
            "13:45",
            "14:00",
            "14:15",
            "14:30",
            "14:45",
            "15:00",
            "15:15",
            "15:30",
            "15:45",
            "16:00",
            "16:15",
            "16:30",
            "16:45",
            "17:00",
            "17:15",
            "17:30",
            "17:45",
            "18:00",
            "18:15",
            "18:30",
            "18:45",
            "19:00",
            "19:15",
            "19:30",
            "19:45",
            "20:00",
            "20:15",
            "20:30",
            "20:45",
            "21:00",
            "21:15",
            "21:30",
            "21:45",
            "22:00",
            "22:15",
            "22:30",
            "22:45",
            "23:00",
            "23:15",
            "23:30",
            "23:45",
            "00:00",
        ];

        return $this->select($name, $id, $array, $class);
    }

}

?>