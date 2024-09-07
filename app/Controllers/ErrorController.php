<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
    public function show404()
    {
        echo view('error404');
    }
    
}
