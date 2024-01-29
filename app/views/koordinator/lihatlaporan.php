<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Juruparkir</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="<?= base_url ?>/dist/js/normalize.min.css">
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="<?= base_url ?>/dist/css/paper.css">
    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }
    </style>
    <style>
        .center {
            margin-right: auto;
            margin-left: auto;
            text-align: center;
        }

        h1 {
            font-size: 16px;
        }

        * {
            font-family: Calibri;
            font-size: 14px;
        }

        .table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
            width: 100%;
        }

        .table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }

        .table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 potrait">
    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-15mm">
        <h1 class="center" style="text-decoration: underline;margin-top: 20px;"><?= $data['title'] ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nama Juru Parkir</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>KTP</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Foto</th>
                    <th>Wilayah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data['koordinator'] as $row) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row['nama_koor']; ?></td>
                        <td><?= $row['tempat_tgl_lahir']; ?></td>
                        <td><?= $row['ktp']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['telepon']; ?></td>
                        <td><?= $row['foto']; ?></td>
                        <td><?= $row['wilayah_id']; ?></td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </section>
    <script type="text/javascript">
        //window.print();
        //window.onafterprint = window.close;
    </script>
</body>

</html>