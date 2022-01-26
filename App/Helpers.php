<?php 

namespace App;

class Helpers {

    
    /**
     * hydrate
     * this function hydrate an object
     *
     * @param  mixed $object
     * @param  mixed $data
     * @param  mixed $fields
     * @return void
     */
    public static function hydrate($object, array $data, array $fields): void
    {
        foreach($fields as $field) {
            $method = 'set' . ucwords($field);
            $object->$method($data[$field]);
        }
    }

}