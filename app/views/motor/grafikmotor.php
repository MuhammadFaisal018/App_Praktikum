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
        <div class="row">
            <div class="col-sm-12">
                <?php Flasher::Message(); ?>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $data['title'] ?></h3>
                <div class="btn-group float-right">
                    <a href="<?= base_url; ?>/motor/tambah" class="btn float-right btn-xs btn btn-primary">Tambah Motor</a>
                    <a href="<?= base_url; ?>/motor/laporan" class="btn float-right btn-xs btn btn-info" target="_blank">Laporan Motor</a>
                    <a href="<?= base_url; ?>/motor/grafikmotor" class="btn float-right btn-xs btn btn-primary">Grafik Motor</a>
                    <a href="<?= base_url; ?>/motor/lihatlaporan" class="btn float-right btn-xs btn btn-warning" target="_blank">Lihat Laporan Motor</a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url; ?>/motor/cari" method="post">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="" name="key">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Cari Data</button>
                                    <a class="btn btn-outline-danger" href="<?= base_url; ?>/motor">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->