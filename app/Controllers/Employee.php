<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Employee extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Employee'
        ];

        return view('employee/index', $data);
    }
}
