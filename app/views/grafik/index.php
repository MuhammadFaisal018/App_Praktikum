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

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Grafik Data Motor per Wilayah (Bulan ke Bulan)</h3>
                </div>
                <div class="card-body">
                    <canvas id="motorChart" width="400" height="200"></canvas>
                </div>
            </div>

            <script>
                // Fetch data for the chart using AJAX
                fetch('<?= base_url; ?>/motor/fetchMotorChartData')
                    .then(response => response.json())
                    .then(data => {
                        // Extract labels and data
                        const labels = data.motorChartData.map(item => item.label);
                        const values = data.motorChartData.map(item => item.value);

                        // Create a bar chart
                        const ctx = document.getElementById('motorChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar', // Change the chart type to 'bar'
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Motor Data',
                                    data: values,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Set the background color for bars
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        type: 'category',
                                        labels: labels
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching motor chart data:', error);
                    });
            </script>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->