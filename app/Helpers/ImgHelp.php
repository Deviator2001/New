<?php
namespace App\Helpers;


use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ImgHelp
{

    public static function getCurUser()
    {
        return Sentinel::check();
    }

    public static function getCurUserId()
    {
        if ($user = self::getCurUser()) return $user->id;
        return null;
    }
}