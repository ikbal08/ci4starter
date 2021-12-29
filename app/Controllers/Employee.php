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
            'photo' => [
                'rules' => 'max_size[photo,1024]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size'  => 'Ukuran gambar terlalu besar',
                    'is_image'  => 'Yang anda pilih bukan gambar',
                    'mime_in'  => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            // return redirect()->to('/employee/create')->withInput()->with('validation', $validation);
            return redirect()->to('/employee/create')->withInput();
        }

        // ambil gambar
        $filePhoto = $this->request->getFile('photo');
        if ($filePhoto->getError() == 4) {
            $namaPhoto = 'default.png';
        } else {
            // generate nama random
            $namaPhoto = $filePhoto->getRandomName();
            // pindahkan photo ke folder
            $filePhoto->move('img', $namaPhoto);
        }

        $post = $this->request->getVar();
        $crSlug = $post['nik'] . ' ' . $post['nama'];
        $slug = url_title($crSlug, '-', true);

        $this->employeeModel->save([
            'nik'       => $post['nik'],
            'nama'      => $post['nama'],
            'slug'      => $slug,
            'alamat'    => $post['alamat'],
            'photo'     => $namaPhoto
        ]);

        session()->setFlashdata('pesan', 'Data saved successfully');

        return redirect()->to('/employee');
    }

    public function edit($slug)
    {
        $data = [
            'title'         => 'Edit Data Employee',
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
            ],
            'photo' => [
                'rules' => 'max_size[photo,1024]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size'  => 'Ukuran gambar terlalu besar',
                    'is_image'  => 'Yang anda pilih bukan gambar',
                    'mime_in'  => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {

            return redirect()->to('/employee/edit/' . $post['slug'])->withInput();
        }

        // ambil gambar
        $filePhoto = $this->request->getFile('photo');
        $photoLama = $this->request->getVar('photoLama');

        if ($filePhoto->getError() == 4) {
            $namaPhoto = $photoLama;
        } else {
            // generate nama random
            $namaPhoto = $filePhoto->getRandomName();
            // pindahkan photo ke folder
            $filePhoto->move('img', $namaPhoto);
            // hapus file lama
            unlink('img/' . $photoLama);
        }


        $crSlug = $post['nik'] . ' ' . $post['nama'];
        $slug = url_title($crSlug, '-', true);

        $this->employeeModel->save([
            'id'        => $id,
            'nik'       => $post['nik'],
            'nama'      => $post['nama'],
            'slug'      => $slug,
            'alamat'    => $post['alamat'],
            'photo'     => $namaPhoto
        ]);

        session()->setFlashdata('pesan', 'Data updated successfully');

        return redirect()->to('/employee');
    }

    public function delete($id)
    {
        // cari data berdasarkan id
        $emp = $this->employeeModel->find($id);

        // cek jika file gambar default.png
        if ($emp['photo'] != 'default.png') {
            unlink('img/' . $emp['photo']);
        }

        $this->employeeModel->delete($id);
        session()->setFlashdata('pesan', 'Data deleted successfully');

        return redirect()->to('/employee');
    }
}
