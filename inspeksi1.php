<?php
if(isset($_GET['pro'])){
    $pro = $_GET['pro'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT *,
       IFNULL(reject_botol_other, 0) AS reject_botol_other,
       IFNULL(reject_botol_volume, 0) AS reject_botol_volume,
       IFNULL(reject_botol_cap_rejector, 0) AS reject_botol_cap_rejector,
       IFNULL(reject_botol_fall_before_bpd, 0) AS reject_botol_fall_before_bpd,
       IFNULL(reject_botol_after_bpd, 0) AS reject_botol_after_bpd,
       IFNULL(reject_label_joint, 0) AS reject_label_joint,
       IFNULL(reject_no_label, 0) AS reject_no_label,
       IFNULL(reject_label_wrinkle, 0) AS reject_label_wrinkle,
       IFNULL(reject_label_gap, 0) AS reject_label_gap,
       IFNULL(reject_botol_fall_after_label, 0) AS reject_botol_fall_after_label,
       IFNULL(reject_botol_cap_rejector, 0) AS reject_botol_cap_rejector 
       FROM 112_inspeksi_produksi_ WHERE 112_inspeksi_produksi_.pro='$pro'");
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
            <h5 class="my-3">Inspeksi 1 Rejection</h5>
            <a href="Report?prod_order=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill my-3">Kembali</a>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>No. Produksi</th>
                        <th>Lot. No.</th>
                        <th>Lifetime Process (RF01)</th>
                        <th>Volume Filling Pack (RF02)</th>
                        <th>Capping Defect (RF03)</th>
                        <th>Fallen Bottle Before BPD (RF06)</th>
                        <th>Fallen Bottle After BPD (RF07)</th>
                        <th>Joint Label (RF20)</th>
                        <th>No Label (RF21)</th>
                        <th>Label Wrinkle (RF43)</th>
                        <th>Label Gap (RF46)</th>
                        <th>Fallen Bottle After Label (RF76)</th>
                        <th>Waktu</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($query as $tpeg) { ?>
                    <tr>
                        <td><?php echo $tpeg['pro']; ?></td>
                        <td><?php echo $tpeg['lotno']; ?></td>
                        <td><?php echo $tpeg['reject_botol_other']; ?></td>
                        <td><?php echo $tpeg['reject_botol_volume']; ?></td>
                        <td><?php echo $tpeg['reject_botol_cap_rejector']; ?></td>
                        <td><?php echo $tpeg['reject_botol_fall_before_bpd']; ?></td>
                        <td><?php echo $tpeg['reject_botol_after_bpd']; ?></td>
                        <td><?php echo $tpeg['reject_label_joint']; ?></td>
                        <td><?php echo $tpeg['reject_no_label']; ?></td>
                        <td><?php echo $tpeg['reject_label_wrinkle']; ?></td>
                        <td><?php echo $tpeg['reject_label_gap']; ?></td>
                        <td><?php echo $tpeg['reject_botol_fall_after_label']; ?></td>
                        <td><?php echo $tpeg['waktu']; ?></td>
                        <td><a href="Editinspeksi1?id=<?php echo $tpeg['id']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Edit</a></td>
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