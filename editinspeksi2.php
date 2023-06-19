<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT * FROM 113_inspeksi_produksi WHERE 113_inspeksi_produksi.id='$id'");
$tpeg = mysqli_fetch_array($query);

// Check if form is submitted for user update, then redirect to homepage after update
//if(isset($_POST['update'])){
if ($_SERVER['REQUEST_METHOD'] == "POST") {	
    $id = $_POST['id'];
    $pro = $_POST['pro'];

    $cap_crack=$_POST['cap_crack'];
    $ijp_miring=$_POST['ijp_miring'];
    $ijp_blank=$_POST['ijp_blank'];
    $ijp_buram=$_POST['ijp_buram'];
    $high_volume=$_POST['high_volume'];
    $low_volume=$_POST['low_volume'];
    $rsb=$_POST['rsb'];
    $cap_miring=$_POST['cap_miring'];
    $cap_kotor=$_POST['cap_kotor'];
    $cap_coak=$_POST['cap_coak'];
        
    // update user data
    $result = mysqli_query($koneksi2, "UPDATE 113_inspeksi_produksi SET
    pro='$pro', 
    cap_crack='$cap_crack', 
    ijp_miring='$ijp_miring', 
    ijp_blank='$ijp_blank', 
    ijp_buram='$ijp_buram', 
    high_volume='$high_volume', 
    low_volume='$low_volume', 
    rsb='$rsb', 
    cap_miring='$cap_miring', 
    cap_kotor='$cap_kotor', 
    cap_coak='$cap_coak' 
    WHERE 113_inspeksi_produksi.id=$id");
    
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
                    <h5 class="m-0">Edit Data Inspeksi 2 Rejection</h5>
                </div>
                <div class="card-body">
                    <form class="form-container" method="POST" action="" enctype="multipart/form-data">
                    	<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                    	<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
                        <input type="hidden" name="id" value="<?= $tpeg["id"]; ?>">
                        <input type="hidden" name="pro" value="<?= $tpeg["pro"]; ?>">
                        
                        <label class="col-sm-2 col-form-label">Cap Crack (RF53)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="cap_crack" value="<?= $tpeg["cap_crack"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">IJP Miring (Lot. No.) (RF25)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="ijp_miring" value="<?= $tpeg["ijp_miring"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">IJP Blank (Lot. No.) (RF25)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="ijp_blank" value="<?= $tpeg["ijp_blank"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">IJP Buram (Lot. No.) (RF25)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="ijp_buram" value="<?= $tpeg["ijp_buram"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Over Fill (RF82)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="high_volume" value="<?= $tpeg["high_volume"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Under Fill (RF83)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="low_volume" value="<?= $tpeg["low_volume"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Ring Support Broken (RF94)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="rsb" value="<?= $tpeg["rsb"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Cap Miring (RF95)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="cap_miring" value="<?= $tpeg["cap_miring"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Cap Kotor (RF96)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="cap_kotor" value="<?= $tpeg["cap_kotor"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Cap Coak (RF97)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="cap_coak" value="<?= $tpeg["cap_coak"]; ?>">
                        </div>

                        <button class="text-center btn btn-outline-primary rounded-pill mt-3" type="submit" name="update" value="Update">Save</button>
                        <a href="Inspeksi2?pro=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>