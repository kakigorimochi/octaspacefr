<?php

namespace App\Libraries;

class SharedFunctions
{
    public static function default_msg()
    {
        return [
            'status'    => 0,
            'title'     => "Oops!",
            'text'      => "Something went wrong!",
            'type'      => 'error'
        ];
    }

    public static function success_msg($message = "Successfully!")
    {
        return [
            'status'    => 1,
            'title'     => "Success!",
            'text'      => $message,
            'type'      => 'success'
        ];
    }

    public static function prompt_msg($message = "Invalid!")
    {
        return[
            'status' => 0,
            'title' => 'Oops!',
            'text' => $message,
            'type' => 'error'
        ];
    }

    public static function array_contains(array $arr, $str)
    {
        foreach($arr as $a) {
            if (stripos($a, $str) !== false) return true;
        }
        return false;
    }

    public static function generate_random_string($length = 10) {
        $characters = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $characters_length = strlen($characters);
        $random_string = "";
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[random_int(0, $characters_length - 1)];
        }
        return $random_string;
    }

    public static function query_log($builder)
    {
        $query = str_replace(array('?'), array('\'%s\''), $builder->toSql());
        $query = vsprintf($query, $builder->getBindings());
        dd($query);
    }
}
