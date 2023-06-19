<?php
if(isset($_GET['pro'])){
    $pro = $_GET['pro'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT * FROM 74_pemeriksaan_reject_dan_sample_ 
        INNER JOIN 133_proses_produksi_filling_used_ln_2 ON 74_pemeriksaan_reject_dan_sample_.lotno = 133_proses_produksi_filling_used_ln_2.lotno 
        WHERE 133_proses_produksi_filling_used_ln_2.pro='$pro'");
// "SELECT * FROM 74_pemeriksaan_reject_dan_sample_ INNER JOIN 133_proses_produksi_filling_used_ln_2 ON 74_pemeriksaan_reject_dan_sample_.lotno = 133_proses_produksi_filling_used_ln_2.lotno WHERE 133_proses_produksi_filling_used_ln_2.pro=".$pro.""
$tpeg = mysqli_fetch_array($query);

// Check if form is submitted for user update, then redirect to homepage after update
//if(isset($_POST['update'])) {
if ($_SERVER['REQUEST_METHOD'] == "POST") {	
    $pro = $_POST['pro'];
    $Pro = $_POST['Pro'];
    
    $reject_preform_before_oven=$_POST['reject_preform_before_oven'];
    $reject_preform_after_oven=$_POST['reject_preform_after_oven'];
    $reject_preform_manually_transfer=$_POST['reject_preform_manually_transfer'];
    $reject_botol_base=$_POST['reject_botol_base'];
    $reject_botol_neck=$_POST['reject_botol_neck'];
    $reject_botol_seal=$_POST['reject_botol_seal'];
    $reject_ln2=$_POST['reject_ln2'];
    $sample_botol_qc=$_POST['sample_botol_qc'];
    $sample_botol_prod=$_POST['sample_botol_prod'];
    
    // update user data
    $result = mysqli_query($koneksi2, "UPDATE 74_pemeriksaan_reject_dan_sample_ 
            INNER JOIN 133_proses_produksi_filling_used_ln_2 ON 74_pemeriksaan_reject_dan_sample_.lotno = 133_proses_produksi_filling_used_ln_2.lotno SET reject_preform_before_oven='$reject_preform_before_oven', 
            reject_preform_manually_transfer='$reject_preform_manually_transfer', 
            reject_preform_after_oven='$reject_preform_after_oven', 
            reject_botol_base='$reject_botol_base', 
            reject_botol_neck='$reject_botol_neck', 
            reject_botol_seal='$reject_botol_seal', 
            reject_ln2='$reject_ln2', 
            sample_botol_qc='$sample_botol_qc', 
            sample_botol_prod='$sample_botol_prod' 
            WHERE 133_proses_produksi_filling_used_ln_2.pro=$pro AND 74_pemeriksaan_reject_dan_sample_.Pro=$Pro");
    // $result = mysqli_query($koneksi2, "UPDATE 74_pemeriksaan_reject_dan_sample_ INNER JOIN 133_proses_produksi_filling_used_ln_2 ON 74_pemeriksaan_reject_dan_sample_.lotno = 133_proses_produksi_filling_used_ln_2.lotno SET reject_preform_before_oven=".$reject_preform_before_oven.", reject_preform_manually_transfer=".$reject_preform_manually_transfer.", reject_preform_after_oven=".$reject_preform_after_oven.", reject_botol_base=".$reject_botol_base.", reject_botol_neck=".$reject_botol_neck.", reject_botol_seal=".$reject_botol_seal.", reject_ln2=".$reject_ln2.", sample_botol_qc=".$sample_botol_qc.", sample_botol_prod=".$sample_botol_prod." WHERE 133_proses_produksi_filling_used_ln_2.pro=".$pro." AND 74_pemeriksaan_reject_dan_sample_.Pro=".$Pro."");
    
    // Redirect to homepage to display updated user in list
    // header("Location: index.php?prod_order=" . urlencode($pro));
    header("Location: Report?prod_order=" . urlencode($pro));
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
                    <h5 class="m-0">Edit Data Blowfill Rejection</h5>
                </div>
                <div class="card-body">
                    <form class="form-container" method="POST" action="" enctype="multipart/form-data">
                    	<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                    	<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
                        <input type="hidden" name="pro" value="<?= $tpeg["pro"]; ?>">
                        <input type="hidden" name="Pro" value="<?= $tpeg["Pro"]; ?>">

                        <label class="col-sm-2 col-form-label">Preform Before Oven</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_preform_before_oven" value="<?= $tpeg["reject_preform_before_oven"]; ?>">
                        </div>

                        <label class="col-sm-2 col-form-label">Preform After Oven</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_preform_after_oven" value="<?= $tpeg["reject_preform_after_oven"]; ?>">
                        </div>

                        <label class="col-sm-2 col-form-label">Preform Manually Transfer</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_preform_manually_transfer" value="<?= $tpeg["reject_preform_manually_transfer"]; ?>">
                        </div>

                        <label class="col-sm-2 col-form-label">Bottle Base</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_base" value="<?= $tpeg["reject_botol_base"]; ?>">
                        </div>

                        <label class="col-sm-2 col-form-label">Bottle Neck</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_neck" value="<?= $tpeg["reject_botol_neck"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Bottle Seal</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_botol_seal" value="<?= $tpeg["reject_botol_seal"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Reject Material LN2</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="reject_ln2" value="<?= $tpeg["reject_ln2"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Sample Bottle QC</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="sample_botol_qc" value="<?= $tpeg["sample_botol_qc"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Sample Bottle Production</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="sample_botol_prod" value="<?= $tpeg["sample_botol_prod"]; ?>">
                        </div>
                        
                        <button class="text-center btn btn-outline-primary rounded-pill mt-3" type="submit" name="update">Save</button>
                        <a href="Report?prod_order=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>