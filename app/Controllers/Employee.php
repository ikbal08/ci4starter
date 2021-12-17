<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class Employee extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Daftar Employee',
            'emp'   => $this->employeeModel->getEmployee()
        ];

        return view('employee/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Employee',
            'emp'   => $this->employeeModel->getEmployee($slug)
        ];

        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Employee ' . $slug . ' Not Exist!');
        }

        return view('employee/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Data Employee'
        ];

        return view('employee/create', $data);
    }

    public function save()
    {
        $post = $this->request->getVar();
        $crSlug = $post['nik'] . ' ' . $post['nama'];
        $slug = url_title($crSlug, '-', true);

        $this->employeeModel->save([
            'nik'       => $post['nik'],
            'nama'      => $post['nama'],
            'slug'      => $slug,
            'alamat'    => $post['alamat'],
            'photo'     => $post['photo']
        ]);

        session()->setFlashdata('pesan', 'Data saved successfully');

        return redirect()->to('/');
    }
}
