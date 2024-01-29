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
            <form role="form" action="<?= base_url; ?>/mobil/updateMobil" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_mobil" value="<?= $data['mobil']['id_mobil']; ?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control datepicker" placeholder="Pilih Tanggal..." name="tanggal" value="<?= date('d F Y', strtotime($data['mobil']['tanggal'])); ?>">
                    </div>
                    <div class="form-group">
                        <label>Wilayah</label>
                        <select class="form-control" name="wilayah_id">
                            <option value="">Pilih</option>
                            <?php foreach ($data['wilayah'] as $row) : ?>
                                <option value="<?= $row['id']; ?>" <?php if ($data['mobil']['wilayah_id'] == $row['id']) {
                                                                        echo "selected";
                                                                    } ?>><?= $row['nama_wilayah']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Juru Parkir</label>
                        <select class="form-control" name="nama_juru">
                            <?php foreach ($data['juruparkir'] as $row) : ?>
                                <option value="<?= $row['nama_juru']; ?>" <?php if ($data['mobil']['nama_juru'] == $row['nama_juru']) {
                                                                                echo "selected";
                                                                            } ?>>
                                    <?= $row['nama_juru']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Koordinator</label>
                        <select class="form-control" name="nama_koor">
                            <?php foreach ($data['koordinator'] as $row) : ?>
                                <option value="<?= $row['nama_koor']; ?>" <?php if ($data['mobil']['nama_koor'] == $row['nama_koor']) {
                                                                                echo "selected";
                                                                            } ?>>
                                    <?= $row['nama_koor']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mobil Masuk</label>
                        <input type="text" class="form-control" placeholder="Masukkan Mobil Masuk..." name="mobil_masuk" value="<?= $data['mobil']['mobil_masuk']; ?>">

                        <label>Mobil Keluar</label>
                        <input type="text" class="form-control" placeholder="Masukkan Mobil Keluar..." name="mobil_keluar" value="<?= $data['mobil']['mobil_keluar']; ?>">
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