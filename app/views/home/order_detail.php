<style>
    /*-----------------
    card animation
---------------------*/
    .card {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
    }

    /* .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    } */
</style>
<!-- jQuery css -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
function isOnMobile()
{
    // match popular mobile devices
    if (preg_match('/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|mobi|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo|mobile/', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        return TRUE;
    }
    return FALSE;
}
$ord = $data['order_detail'];
$driverDetail = $data['driver_detail'];
?>
<div class="container" align="center">
    <?php
    if (isOnMobile()) {

    ?>
        <div class="container mt-5 pt-5 row d-flex justify-content-center">
            <div class="card mx-auto rounded-sm" style="width: 30rem;">
                <div class="card-body">
                    <!-- <h4 class="card-title">Orderan anda</h4> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $ord['dari']; ?> - <?= $ord['tujuan']; ?></h5>
                        <p class="text-muted card-subtitle"><?= $ord['tanggal']; ?> <?= $ord['jam']; ?></p>
                        <p class="text-muted card-subtitle"><?= $ord['jumlah_penumpang']; ?> Penumpang</p>
                    </div>
                    <div class="d-grid">
                        <?php
                        if ($ord['driverId'] == 0) {
                            echo
                            '<a href="" style="text-decoration:none;" class="btn btn-danger tampilModalHapus" data-bs-toggle="modal" data-bs-target="#modalHapus"> Hapus</a>';
                        } else {
                        ?>
                            <div class="text-wrap badge bg-info">
                                <h6 class="text-light card-subtitle">Driver: <br> <?= $driverDetail['nama'] ?>
                                    <br><?= $driverDetail['telp'] ?>
                                </h6>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container mt-4" align="center">
                <div class="col-lg-4">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
        </div>

        <div class="modal fade pt-5" data-bs-backdrop="static" data-bs-keyboard="false" id="modalHapus" tabindex="-1" aria-labelledby="judulModalHapus" aria-hidden="true">
            <form class="g-3" style="margin-top: 100px; position: center; padding-left: 5px; padding-right: 5px;" action="<?= BASEURL; ?>home/hapusOrder" method="POST">
                <input type="hidden" name="orderId" id="orderId" value="<?= $data['order_detail']['orderId']; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelHapusOrder">Hapus Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">Apakah anda yakin ingin menghapus order ini?</h6>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-lg btn-secondary btn-login text-uppercase fw-bold mb-2" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                            <button class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2" type="submit">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    <?php
    } else {
    ?>
        <div class="mt-5 pt-5 row d-flex justify-content-center">
            <div class="card rounded-sm m-auto" style="width: 35rem;">
                <div class="card-body">
                    <!-- <h5 class="card-title"></h5> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $ord['dari']; ?> - <?= $ord['tujuan']; ?></h5>
                        <p class="text-muted card-subtitle"><?= $ord['tanggal']; ?> <?= $ord['jam']; ?></p>
                        <p class="text-muted card-subtitle"><?= $ord['jumlah_penumpang']; ?> Penumpang</p>
                    </div>
                    <div class="d-grid">
                    <?php
                        if ($ord['driverId'] == 0) {
                            echo
                            '<a href="" style="text-decoration:none;" class="btn btn-danger tampilModalHapus" data-bs-toggle="modal" data-bs-target="#modalHapus"> Hapus</a>';
                        } else {
                        ?>
                            <div class="text-wrap badge bg-info">
                                <h6 class="text-light card-subtitle">Driver: <br> <?= $driverDetail['nama'] ?>
                                    <br><?= $driverDetail['telp'] ?>
                                </h6>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container mt-4" align="center">
                <div class="col-lg-4">
                    <?php Flasher::flash(); ?>
                </div>
            </div>
        </div>
        <div class="modal fade pt-5" data-bs-backdrop="static" data-bs-keyboard="false" id="modalHapus" tabindex="-1" aria-labelledby="judulModalHapus" aria-hidden="true">
            <form class="g-3" style="margin-top: 100px; position: center; padding-left: 5px; padding-right: 5px;" action="<?= BASEURL; ?>home/hapusOrder" method="POST">
                <input type="hidden" name="orderId" id="orderId" value="<?= $data['order_detail']['orderId']; ?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelHapusOrder">Hapus Order</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="text-center">Apakah anda yakin ingin menghapus order ini?</h6>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-lg btn-secondary btn-login text-uppercase fw-bold mb-2" data-bs-dismiss="modal" aria-label="Close">Batal</button>
                            <button class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2" type="submit">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
</div>
<script>
    function swap() {
        let x = document.getElementById('dari').value;
        let y = document.getElementById('tujuan').value;
        document.getElementById('dari').value = y;
        document.getElementById('tujuan').value = x;
    }
    $("#tanggal").datepicker({
        dateFormat: "dd/mm/yy"
    });
</script>