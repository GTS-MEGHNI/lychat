<?php

namespace App;

class Utility
{

    public static function getUserId(): int
    {
        return intval(request()->route('userId'));
    }

}
