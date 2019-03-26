<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class AppController extends BaseController
{
    public function show()
    {
        return view('index', ['project' => env('APP_NAME')]);
    }
}
