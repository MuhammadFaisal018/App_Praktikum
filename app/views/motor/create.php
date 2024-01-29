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
            <form role="form" action="<?= base_url; ?>/motor/simpanmotor" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
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
                    <div class="form-group">
                        <label>Juru Parkir</label>
                        <select class="form-control" name="nama_juru">
                            <option value="">Pilih</option>
                            <?php foreach ($data['juruparkir'] as $row) : ?>
                                <option value="<?= $row['nama_juru']; ?>"><?= $row['nama_juru']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Koordinator</label>
                        <select class="form-control" name="nama_koor">
                            <option value="">Pilih</option>
                            <?php foreach ($data['koordinator'] as $row) : ?>
                                <option value="<?= $row['nama_koor']; ?>"><?= $row['nama_koor']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Motor Masuk</label>
                        <input type="text" class="form-control" placeholder="Masukkan Motor Masuk..." name="motor_masuk">

                        <label>Motor Keluar</label>
                        <input type="text" class="form-control" placeholder="Masukkan Motor Keluar..." name="motor_keluar">
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