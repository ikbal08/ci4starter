<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Employee</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Photo</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="" alt=""></td>
                        <td>3018</td>
                        <td>Ikbal Ardhi</td>
                        <td>jl. ABS</td>
                        <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>