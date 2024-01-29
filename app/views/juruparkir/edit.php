<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $data['title']; ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url; ?>/juruparkir/updateJuruparkir" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_juru" value="<?= $data['juruparkir']['id_juru']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Juru Parkir</label>
                        <input type="text" class="form-control" placeholder="masukkan nama juru parkir..." name="nama_juru" value="<?= $data['juruparkir']['nama_juru']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" placeholder="masukkan tempat tanggal lahir..." name="tempat_tgl_lahir" value="<?= $data['juruparkir']['tempat_tgl_lahir']; ?>">
                    </div>
                    <div class="form-group">
                        <label>KTP</label>
                        <input type="text" class="form-control" placeholder="masukkan nomor KTP..." name="ktp" value="<?= $data['juruparkir']['ktp']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="masukkan alamat..." name="alamat"><?= $data['juruparkir']['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" placeholder="masukkan nomor telepon..." name="telepon" value="<?= $data['juruparkir']['telepon']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                        <img src="<?= base_url; ?>../images/<?= $data['juruparkir']['foto']; ?>" alt="Foto Juru Parkir" class="img-thumbnail mt-2" width="100">
                    </div>
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-control" name="wilayah_id">
                            <option value="">Pilih</option>
                            <?php foreach ($data['wilayah'] as $row) : ?>
                                <option value="<?= $row['id']; ?>" <?php if ($data['juruparkir']['wilayah_id'] == $row['id']) {
                                                                        echo "selected";
                                                                    } ?>><?= $row['nama_wilayah']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>