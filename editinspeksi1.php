<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT * FROM 112_inspeksi_produksi_ WHERE 112_inspeksi_produksi_.id='$id'");
$tpeg = mysqli_fetch_array($query);

// Check if form is submitted for user update, then redirect to homepage after update
//if(isset($_POST['update'])){
if ($_SERVER['REQUEST_METHOD'] == "POST") {	
    $id = $_POST['id'];
    $pro = $_POST['pro'];

    $reject_botol_other=$_POST['reject_botol_other'];
    $reject_botol_volume=$_POST['reject_botol_volume'];
    $reject_botol_cap_rejector=$_POST['reject_botol_cap_rejector'];
    $reject_botol_fall_before_bpd=$_POST['reject_botol_fall_before_bpd'];
    $reject_botol_after_bpd=$_POST['reject_botol_after_bpd'];
    $reject_label_joint=$_POST['reject_label_joint'];
    $reject_no_label=$_POST['reject_no_label'];
    $reject_label_wrinkle=$_POST['reject_label_wrinkle'];
    $reject_label_gap=$_POST['reject_label_gap'];
    $reject_botol_fall_after_label=$_POST['reject_botol_fall_after_label'];
        
    // update user data
    $result = mysqli_query($koneksi2, "UPDATE 112_inspeksi_produksi_ SET
    pro='$pro', 
    reject_botol_other='$reject_botol_other', 
    reject_botol_volume='$reject_botol_volume', 
    reject_botol_cap_rejector='$reject_botol_cap_rejector', 
    reject_botol_fall_before_bpd='$reject_botol_fall_before_bpd', 
    reject_botol_after_bpd='$reject_botol_after_bpd', 
    reject_label_joint='$reject_label_joint', 
    reject_no_label='$reject_no_label', 
    reject_label_wrinkle='$reject_label_wrinkle', 
    reject_label_gap='$reject_label_gap', 
    reject_botol_fall_after_label='$reject_botol_fall_after_label' 
    WHERE 112_inspeksi_produksi_.id=$id");
    
    // Redirect to homepage to display updated user in list
    header("Location: Report?prod_order=".urlencode($pro));
    exit();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Production Report OCI3</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    </head>
    <body>
        <div class="container-sm my-5">
            <div class="card ">
                <div class="card-header">
                    <h5 class="m-0">Edit Data Inspeksi 1 Rejection</h5>
                </div>
                <div class="card-body">
                    <form class="form-container" method="POST" action="" enctype="multipart/form-data">
                    	<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                    	<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
                        <input type="hidden" name="id" value="<?= $tpeg["id"]; ?>">
                        <input type="hidden" name="pro" value="<?= $tpeg["pro"]; ?>">
                        
                        <label class="col-sm-2 col-form-label">Lifetime Process (RF01)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_other" value="<?= $tpeg["reject_botol_other"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Volume Filling Pack (RF02)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_volume" value="<?= $tpeg["reject_botol_volume"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Capping Defect (RF03)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_cap_rejector" value="<?= $tpeg["reject_botol_cap_rejector"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Fallen Bottle Before BPD (RF06)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_fall_before_bpd" value="<?= $tpeg["reject_botol_fall_before_bpd"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Fallen Bottle After BPD (RF07)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_after_bpd" value="<?= $tpeg["reject_botol_after_bpd"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Joint Label (RF20)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_label_joint" value="<?= $tpeg["reject_label_joint"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">No Label (RF21)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_no_label" value="<?= $tpeg["reject_no_label"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Label Wrinkle (RF43)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_label_wrinkle" value="<?= $tpeg["reject_label_wrinkle"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Label Gap (RF46)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_label_gap" value="<?= $tpeg["reject_label_gap"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Fallen Bottle After Label (RF76)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_fall_after_label" value="<?= $tpeg["reject_botol_fall_after_label"]; ?>">
                        </div>

                        <button class="text-center btn btn-outline-primary rounded-pill mt-3" type="submit" name="update" value="Update">Save</button>
                        <a href="Inspeksi1?pro=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>