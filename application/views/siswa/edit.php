<div class="row">
    <div class="col-lg-6">
        <h3>Edit Siswa</h3>

        <div class="spinner-border text-primary d-none" role="status" id="loading">
            <span class="visually-hidden">Loading...</span>
        </div>

        <form id="form">
            <input type="hidden" name="id" id="id" value="<?=$siswa['id'];?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?=$siswa['nama'];?>">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Masukkan File</label>
                <input class="form-control" type="file" id="file" name="file"
                    accept="image/jpeg, image/png, application/pdf">
            </div>

            <div class="progress mb-3 d-none" id="progressLoading">
                <label for=" progress" id="progress-label"></label>
                <div class="progress-bar" id="progress" role="progressbar" aria-label="Basic example" style="width: 0%">
                </div>
            </div>

            <?php if ($siswa['file']): ?>
            <embed src="<?=base_url('assets/files/' . $siswa['file']);?>" width="100"><br>
            <?php endif;?>

            <button type="submit" id="simpan" class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>
</div>