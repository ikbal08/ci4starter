<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Employee</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $emp['photo']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Nama : <?= $emp['nama']; ?></h5>
                            <p class="card-text">Alamat : <?= $emp['alamat']; ?></p>
                        </div>

                        <a href="/employee/edit/<?= $emp['slug']; ?>" class="btn btn-primary">Edit</a>

                        <form action="/employee/<?= $emp['id']; ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin hapus data?');">Delete</button>
                        </form>

                        <br><br>
                        <a href="/" class="mb-3">Back To List Employee</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>