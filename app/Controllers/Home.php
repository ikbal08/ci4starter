<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Employee'
        ];

        return view('employee/index', $data);

        // return view('welcome_message');
    }
}
