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
?>

<div class="container" align="center">
    <h1>
        <p class="text-center text-uppercase fw-bold">Daftar Driver</p>
    </h1>
    <div class="container mt-4" align="center">
        <div class="col-lg-4">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row row-cols-sm-1 cols-xl-1 mt-4 pt-4" style="max-width: 400px;">
        <?php $counter = 1; ?>
        <?php foreach ($data['drivers'] as $drivers) : ?>
            <?php $counter++; ?>
            <div class="card text-center ml-4 mb-4">
                <a data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">
                    <div class="card-title" id="heading<?php echo $counter; ?>">
                        <button class="btn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">
                            <h5><?php echo $drivers['nama']; ?></h5>
                        </button>
                    </div>
                </a>

                <div id="collapse<?php echo $counter; ?>" class="collapse hide" aria-labelledby="heading<?php echo $counter; ?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form mb-2">
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $drivers['email']; ?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="telp<?php echo $counter; ?>" name="telp" value="<?php echo $drivers['telp']; ?>" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary copy-button" type="button" id="copy-button<?php echo $counter; ?>"><img src="<?= BASEURL; ?>img/copy-icon.png" alt="copy" class="copy-button" style="width: 20px; height: 20px;"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <form class="g-3" action="<?php echo BASEURL; ?>admin/hapusDriver" method="POST">
                                <input type="hidden" name="driverId" id="driverId" value="<?php echo $drivers['driverId']; ?>">
                                <button type="button" class="btn btn-lg btn-secondary btn-login text-uppercase fw-bold mb-2" data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">Tutup</button>
                                <?php if ($drivers['driverId'] != 1) { ?>
                                    <button class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2" type="submit">Hapus</button>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <br>
    <br>
    <p class="text-muted text-center align-middle"><?php echo $data['kosong']; ?></p>
</div>
<script>
    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', function() {
            const telp = this.parentElement.previousElementSibling;
            telp.select();
            document.execCommand("copy");
        });
    });
</script>