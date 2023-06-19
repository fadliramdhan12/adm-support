<?php
if(isset($_GET['pro'])){
    $pro = $_GET['pro'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT *,
    	IFNULL(jumlah_sample_qc, 0) AS jumlah_sample_qc, IFNULL(jumlah_sampel_produksi, 0) AS jumlah_sampel_produksi
		FROM 115_pengambilan_sampel WHERE 115_pengambilan_sampel.pro='$pro'");
$tpeg = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Production Report OCI3</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    </head>
    <body>
        <div>
            <h5 class="my-3">Sample Rejection</h5>
            <a href="Report?prod_order=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill my-3">Kembali</a>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>No. Produksi</th>
                        <th>Lot. No.</th>
                        <th>Sample Botol QC (S001)</th>
                        <th>Sample Botol Produksi (S002)</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $tpeg) { ?>
                    <tr>
                        <td><?php echo $tpeg['pro']; ?></td>
                        <td><?php echo $tpeg['lotno']; ?></td>
                        <td><?php echo $tpeg['jumlah_sample_qc']; ?></td>
                        <td><?php echo $tpeg['jumlah_sampel_produksi']; ?></td>
                        <td><?php echo $tpeg['waktu']; ?></td>
                        <td><a href="Editsample?id=<?php echo $tpeg['id']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Edit</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('.table-rejection').DataTable();
            } );
        </script>
    </body>
</html>