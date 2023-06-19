<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Production Report OCI3</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    </head>
    <body>
        <style>
            table.table thead th {
                border-bottom: 0px solid #111;
            }

            table.table tbody th {
                border-top: 0px solid  #111;
                border-bottom: 0px solid #111;
            }
            table.table tfoot td {
                border-top: 0px solid  #111;
            }
        </style>
        <form action="http://localhost/webReportSummary/Report" method="GET" class="ew-form ew-add-form ew-horizontal" style="width: 100%">
            <input type="hidden" name="token" value="">
            <div class="form-group row">
                <h4>Report Summary Product</h4>
                <span>
                    <div class="col-sm-10">
                        <div class="input-group ew-lookup-list">
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <label for="#prod_order">Prod. Order </label>
                                    </td>
                                    <td>
                                        <select id="prod_order" name="prod_order" class="form-control form-select form-select-sm" aria-label="Default select example">
                                            <option selected disabled>Open this select menu</option>
                                            <?php 
                                                include "koneksi.php";
                                                $query = mysqli_query($koneksi1, "SELECT * FROM oc3_mst_prodidentity ORDER BY oc3_mst_prodidentity.prod_order");
                                                while ($po = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?= $po['prod_order']; ?>"><?php echo $po['prod_order']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="button btn btn-outline-primary rounded-pill" type="submit" value="Pilih">
                                        <a href="Report" class="button btn btn-outline-success rounded-pill">Reset</a>                
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </span>
            </div>
        </form>
        <hr>
        <?php
            if (isset($_GET['prod_order'])) {
            $prod_order=$_GET['prod_order'];

            //menampilkan data pegawai berdasarkan pilihan combobox ke dalam form
            // $tamPeg=mysqli_query($koneksi, "SELECT * FROM tb002_po_cust_h INNER JOIN tb002_customer ON tb002_po_cust_h.fk_customer = tb002_customer.fk_customer WHERE prod_order='$prod_order'");
            // $tamPeg=mysqli_query($koneksi1, "SELECT * FROM oc3_mst_prodidentity WHERE prod_order='$prod_order'");
            $tamPeg1 = mysqli_query($koneksi1, "SELECT * FROM oc3_reject_blowfill 
                INNER JOIN oc3_mst_prodidentity ON oc3_reject_blowfill.prod_order = oc3_mst_prodidentity.prod_order
                WHERE oc3_reject_blowfill.prod_order='$prod_order'");
            $tamPeg2 = mysqli_query($koneksi1, "SELECT * FROM oc3_reject_packing 
                INNER JOIN oc3_mst_prodidentity ON oc3_reject_packing.prod_order = oc3_mst_prodidentity.prod_order
                WHERE oc3_reject_packing.prod_order='$prod_order'");
            $tamPeg3 = mysqli_query($koneksi1, "SELECT * FROM oc3_reject_preparasi 
                INNER JOIN oc3_mst_prodidentity ON oc3_reject_preparasi.prod_order = oc3_mst_prodidentity.prod_order
                WHERE oc3_reject_preparasi.prod_order='$prod_order'");
            $tpeg1 = mysqli_fetch_array($tamPeg1);
            $tpeg2 = mysqli_fetch_array($tamPeg2);
            $tpeg3 = mysqli_fetch_array($tamPeg3);
        ?>

        <form action="#" method="POST">
            <h5 class="my-3">Identity</h5>
            <table class="table table-borderless table-responsive" border="0">
                <tr>
                    <td>No. Prod Order</td>
                    <td>: <input type="text" name="prod_order" value="<?php echo $tpeg1['prod_order']; ?>" style="border: none;" readonly/></td>
                </tr>
                <tr>
                    <td>Lot. No.</td>
                    <td>: <input type="text" name="lotno" value="<?php echo $tpeg1['lotno']; ?>" style="border: none;" readonly/></td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>: <input type="text" name="product" value="<?php echo $tpeg1['product']; ?>" style="border: none;" readonly/></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: <input type="date" name="tgl" value="<?php echo $tpeg1['tgl']; ?>" style="border: none;" readonly/></td>
                </tr>
            </table><hr>

            <h5 class="my-3">Blowfill Rejection</h5>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>Reject Name</th>
                        <th>Code Rejection</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalQuantityBlowfill = 0;
                        foreach($tamPeg1 as $tpeg1) { 
                            $quantityBlowfill = $tpeg1['quantity_blowfill'];
                            $totalQuantityBlowfill += $quantityBlowfill;
                    ?>
                    <tr>
                        <td><input type="text" name="reject_name_blowfill" value="<?php echo $tpeg1['reject_name_blowfill']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="code_rejection_blowfill" value="<?php echo $tpeg1['code_rejection_blowfill']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="quantity_blowfill" value="<?php echo $tpeg1['quantity_blowfill']; ?>" style="border: none;" readonly/></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Blowfill Rejection</th>
                        <th></th>
                        <th><?php echo $totalQuantityBlowfill; ?></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="Editblowfill?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Edit Data Blowfill</a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table><hr>
            
            <h5>Packing Rejection</h5>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>Reject Name</th>
                        <th>Code Rejection</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $totalQuantityPacking = 0;
                        foreach($tamPeg2 as $tpeg2) { 
                            $quantityPacking = $tpeg2['quantity_packing'];
                            $totalQuantityPacking += $quantityPacking;
                    ?>
                    <tr>
                        <td><input type="text" name="reject_name_packing" value="<?php echo $tpeg2['reject_name_packing']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="code_rejection_packing" value="<?php echo $tpeg2['code_rejection_packing']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="quantity_packing" value="<?php echo $tpeg2['quantity_packing']; ?>" style="border: none;" readonly/></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Packing Rejection</th>
                        <th></th>
                        <th><?php echo $totalQuantityPacking; ?></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="Inspeksi1?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Inspeksi 1</a>
                        </td>
                        <td>
                            <a href="Inspeksi2?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Inspeksi 2</a>
                        </td>
                        <td>
                            <a href="Inspeksi3?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Inspeksi 3</a>
                        </td>
                        <td>
                            <a href="Caser?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Caser</a>
                        </td><br>
                    </tr>
                    <tr>
                        <td>
                            <a href="Sample?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Sample</a>
                        </td>
                        <td>
                            <a href="Outerbox?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Outer Box</a>
                        </td>
                        <td>
                            <a href="Label?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Label</a>
                        </td>
                        <td>
                            <a href="Clossure?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Data Clossure</a>
                        </td>
                    </tr>
                </tfoot>
            </table><hr>
            
            <h5 class="my-3">Preparasi Rejection</h5>
            <table class="table table-rejection table-borderless table-responsive" border="0">
                <thead>
                    <tr>
                        <th>Reject Name</th>
                        <th>Code Rejection</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalQuantityPreparasi = 0;
                    foreach($tamPeg3 as $tpeg3) { 
                        $quantityPreparasi = $tpeg3['quantity_preparasi'];
                        $totalQuantityPreparasi += $quantityPreparasi;
                    ?>
                    <tr>
                        <td><input type="text" name="reject_name_preparasi" value="<?php echo $tpeg3['reject_name_preparasi']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="code_rejection_preparasi" value="<?php echo $tpeg3['code_rejection_preparasi']; ?>" style="border: none;" readonly/></td>
                        <td><input type="text" name="quantity_preparasi" value="<?php echo $tpeg3['quantity_preparasi']; ?>" style="border: none;" readonly/></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Preparasi Rejection</th>
                        <th></th>
                        <th><?php echo $totalQuantityPreparasi; ?></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="Editpreparasi?pro=<?php echo $tpeg1['pro']; ?>" class="btn btn-outline-primary rounded-pill mb-3">Edit Data Preparasi</a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table><hr>
        </form>
        <?php } ?>
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('.table-rejection').DataTable();
            } );
        </script>
        <script>
            $(document).ready(function () {
                $("#prod_order").select2({
                    theme: 'bootstrap-5',
                    placeholder: "Please Select"
                });
            });
        </script>
    </body>
</html>