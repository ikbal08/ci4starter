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

        if (empty($data['emp'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Employee ' . $slug . ' Not Exist!');
        }

        return view('employee/detail', $data);
    }

    public function create()
    {
        $data = [
            'title'         => 'Add Data Employee',
            'validation'    => \Config\Services::validation()
        ];

        return view('employee/create', $data);
    }

    public function save()
    {
        //validasi
        if (!$this->validate([
            'nik'   => [
                'rules' => 'required|is_unique[employee.nik]',
                'errors' => [
                    'required' => '{field} karyawan tidak boleh kosong',
                    'is_unique' => '{field} karyawan sudah terdaftar'
                ]
            ],
            'photo' => 'uploaded[photo]'
        ])) {

            // return redirect()->to('/employee/create')->withInput()->with('validation', $validation);
            return redirect()->to('/employee/create')->withInput();
        }

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

        return redirect()->to('/employee');
    }

    public function edit($slug)
    {
        $data = [
            'title'         => 'Add Data Employee',
            'validation'    => \Config\Services::validation(),
            'emp'           => $this->employeeModel->getEmployee($slug)
        ];

        return view('employee/edit', $data);
    }

    public function update($id)
    {
        $post = $this->request->getVar();

        //cek judul
        $empOld = $this->employeeModel->getEmployee($post['slug']);
        if ($empOld['nik'] == $post['nik']) {
            $rule_nik  = 'required';
        } else {
            $rule_nik  = 'required|is_unique[employee.nik]';
        }

        //validasi
        if (!$this->validate([
            'nik'   => [
                'rules' => $rule_nik,
                'errors' => [
                    'required' => '{field} karyawan tidak boleh kosong',
                    'is_unique' => '{field} karyawan sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/employee/edit/' . $post['slug'])->withInput()->with('validation', $validation);
        }


        $crSlug = $post['nik'] . ' ' . $post['nama'];
        $slug = url_title($crSlug, '-', true);

        $this->employeeModel->save([
            'id'        => $id,
            'nik'       => $post['nik'],
            'nama'      => $post['nama'],
            'slug'      => $slug,
            'alamat'    => $post['alamat'],
            'photo'     => $post['photo']
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully');

        return redirect()->to('/employee');
    }

    public function delete($id)
    {
        $this->employeeModel->delete($id);

        session()->setFlashdata('pesan', 'Data deleted successfully');

        return redirect()->to('/employee');
    }
}
