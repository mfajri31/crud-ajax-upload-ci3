<div class="row mt-5">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-md-6">
                <h4>Data Siswa</h4>
            </div>
            <div class="col-md-6">
                <a href="<?=base_url('siswa/tambah');?>" class="btn btn-primary btn-sm float-end">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
foreach ($siswa as $siswa):
?>

                <tr>
                    <td scope="row"><?=$no++;?></td>
                    <td><?=$siswa['nama'];?></td>
                    <td>
                        <a href="<?=base_url('siswa/edit/' . $siswa['id']);?>" class="btn btn-success btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="<?=base_url('siswa/hapus/' . $siswa['id']);?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin dihapus?')">
                            <i class="fa fa-trash"></i>
                        </a>
                        <?php if ($siswa['file'] !== null): ?>
                        <a href="<?=base_url('assets/files/' . $siswa['file']);?>" target="_blank"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-file"></i>
                        </a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>