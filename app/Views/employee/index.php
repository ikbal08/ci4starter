<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/employee/create" class="btn btn-primary mt-3">Add Data Employee</a>
            <h1 class="mt-2">Daftar Employee</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
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
                    <?php $no = 1 + ($perpage * ($current_page - 1));
                    foreach ($emp as $e) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><img src="/img/<?= $e['photo']; ?>" alt="" class="photo"></td>
                            <td><?= $e['nik']; ?></td>
                            <td><?= $e['nama']; ?></td>
                            <td><?= $e['alamat']; ?></td>
                            <td>
                                <a href="/employee/<?= $e['slug']; ?>" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('employee', 'employee_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>