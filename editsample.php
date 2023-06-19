<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
else {
    die ("Error. No ID Selected!");    
}
include "koneksi.php";
$query = mysqli_query($koneksi2, "SELECT * FROM 115_pengambilan_sampel WHERE 115_pengambilan_sampel.id='$id'");
$tpeg = mysqli_fetch_array($query);

// Check if form is submitted for user update, then redirect to homepage after update
//if(isset($_POST['update'])){
if ($_SERVER['REQUEST_METHOD'] == "POST") {	
    $id = $_POST['id'];
    $pro = $_POST['pro'];

    $jumlah_sample_qc=$_POST['jumlah_sample_qc'];
    $jumlah_sampel_produksi=$_POST['jumlah_sampel_produksi'];
        
    // update user data
    $result = mysqli_query($koneksi2, "UPDATE 115_pengambilan_sampel SET
    pro='$pro', 
    jumlah_sample_qc='$jumlah_sample_qc', 
    jumlah_sampel_produksi='$jumlah_sampel_produksi' 
    WHERE 115_pengambilan_sampel.id=$id");
    
    // Redirect to homepage to display updated user in list
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
                    <h5 class="m-0">Edit Data Sample Rejection</h5>
                </div>
                <div class="card-body">
                    <form class="form-container" method="POST" action="" enctype="multipart/form-data">
                    	<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
                    	<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
                        <input type="hidden" name="id" value="<?= $tpeg["id"]; ?>">
                        <input type="hidden" name="pro" value="<?= $tpeg["pro"]; ?>">
                        
                        <label class="col-sm-2 col-form-label">Sample Botol QC (S001)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="jumlah_sample_qc" value="<?= $tpeg["jumlah_sample_qc"]; ?>">
                        </div>
                        
                        <label class="col-sm-2 col-form-label">Sample Botol Produksi (S002)</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="jumlah_sampel_produksi" value="<?= $tpeg["jumlah_sampel_produksi"]; ?>">
                        </div>

                        <button class="text-center btn btn-outline-primary rounded-pill mt-3" type="submit" name="update" value="Update">Save</button>
                        <a href="Sample?pro=<?php echo $tpeg['pro']; ?>" class="btn btn-outline-danger rounded-pill mt-3">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>