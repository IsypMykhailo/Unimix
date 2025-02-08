<?php

namespace App\Helpers;

class Redirect
{
    public function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}
