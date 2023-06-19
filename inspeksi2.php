<?php
if(isset($_GET['pro'])){
    $pro = $_GET['pro'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT *,
       IFNULL(cap_crack, 0) AS cap_crack,
       IFNULL(ijp_miring, 0) AS ijp_miring,
       IFNULL(ijp_blank, 0) AS ijp_blank,
       IFNULL(ijp_buram, 0) AS ijp_buram,
       IFNULL(high_volume, 0) AS high_volume,
       IFNULL(low_volume, 0) AS low_volume,
       IFNULL(rsb, 0) AS rsb,
       IFNULL(cap_miring, 0) AS cap_miring,
       IFNULL(cap_kotor, 0) AS cap_kotor,
       IFNULL(cap_coak, 0) AS cap_coak
       FROM 113_inspeksi_produksi WHERE 113_inspeksi_produksi.pro='$pro'");
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
            <h5 class="my-3">Inspeksi 2 Rejection</h5>
            <a href="Report?prod_order=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill my-3">Kembali</a>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>No. Produksi</th>
                        <th>Lot. No.</th>
                        <th>Cap Crack (RF53)</th>
                        <th>IJP Miring (Lot. No.) (RF25)</th>
                        <th>IJP Blank (Lot. No.) (RF25)</th>
                        <th>IJP Buram (Lot. No.) (RF25)</th>
                        <th>Over Fill (RF82)</th>
                        <th>Under Fill (RF83)</th>
                        <th>Ring Support Broken (RF94)</th>
                        <th>Cap Miring (RF95)</th>
                        <th>Cap Kotor (RF96)</th>
                        <th>Cap Coak (RF97)</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $tpeg) { ?>
                    <tr>
                        <td><?php echo $tpeg['pro']; ?></td>
                        <td><?php echo $tpeg['lotno']; ?></td>
                        <td><?php echo $tpeg['cap_crack']; ?></td>
                        <td><?php echo $tpeg['ijp_miring']; ?></td>
                        <td><?php echo $tpeg['ijp_blank']; ?></td>
                        <td><?php echo $tpeg['ijp_buram']; ?></td>
                        <td><?php echo $tpeg['high_volume']; ?></td>
                        <td><?php echo $tpeg['low_volume']; ?></td>
                        <td><?php echo $tpeg['rsb']; ?></td>
                        <td><?php echo $tpeg['cap_miring']; ?></td>
                        <td><?php echo $tpeg['cap_kotor']; ?></td>
                        <td><?php echo $tpeg['cap_coak']; ?></td>
                        <td><?php echo $tpeg['waktu']; ?></td>
                        <td><a href="Editinspeksi2?id=<?php echo $tpeg['id']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Edit</a></td>
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