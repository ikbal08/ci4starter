<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Update Data Employee</h2>
            <form action="/employee/update/<?= $emp['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $emp['slug']; ?>">
                <input type="hidden" name="photoLama" value="<?= $emp['photo']; ?>">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" autofocus value="<?= (old('nik')) ? old('nik') : $emp['nik']; ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $emp['nama']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $emp['alamat']; ?>">
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $emp['photo']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input class="form-control custom-file-input <?= ($validation->hasError('photo')) ? 'is-invalid' : ''; ?>" type="file" id="photo" name="photo" onchange="loadImg();">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('photo'); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <button type=" submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>