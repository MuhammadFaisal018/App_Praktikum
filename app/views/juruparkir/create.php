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
            <form role="form" action="<?= base_url; ?>/juruparkir/simpanjuruparkir" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Juru Parkir</label>
                        <input type="text" class="form-control" placeholder="masukkan nama juru parkir..." name="nama_juru">
                    </div>
                    <div class="form-group">
                        <label>Tempat Tanggal Lahir</label>
                        <input type="text" class="form-control" placeholder="masukkan tempat tanggal lahir..." name="tempat_tgl_lahir">
                    </div>
                    <div class="form-group">
                        <label>KTP</label>
                        <input type="text" class="form-control" placeholder="masukkan nomor KTP..." name="ktp">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" rows="3" placeholder="masukkan alamat koordinator parkir..." name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" class="form-control" placeholder="masukkan nomor telepon..." name="telepon">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control-file" name="foto">
                    </div>
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-control" name="wilayah_id">
                            <option value="">Pilih</option>
                            <?php foreach ($data['wilayah'] as $row) : ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama_wilayah']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->