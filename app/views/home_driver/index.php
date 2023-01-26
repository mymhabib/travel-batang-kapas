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
    <div class="container mt-4" align="center">
        <div class="col-lg-4">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row row-cols-sm-1 cols-xl-1 mt-4 pt-4" style="max-width: 400px;">
        <?php $counter = 1; ?>
        <?php foreach ($data['bookings'] as $ord) : ?>
            <?php $counter++; ?>
            <div class="card text-center ml-4 mb-4">
                <a data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">
                    <div class="card-title" id="heading<?php echo $counter; ?>">
                        <h2>
                            <button class="btn" type="button" data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">
                                <?php echo $ord['dari']; ?> - <?php echo $ord['tujuan']; ?>
                                <p class=" text-muted card-subtitle"><?php echo $ord['tanggal']; ?> <?php echo $ord['jam']; ?></p>
                            </button>
                        </h2>
                    </div>
                </a>

                <div id="collapse<?php echo $counter; ?>" class="collapse hide" aria-labelledby="heading<?php echo $counter; ?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <textarea type="text" class="form-control" style="display: block;overflow:hidden; resize:none; height:auto;" id="dari" name="dari" value="<?php echo $ord['dari']; ?>" readonly><?php echo $ord['dari']; ?>
                                        </textarea>
                                        <label for="dari">Dari</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="tujuan" name="tujuan" value="<?php echo $ord['tujuan']; ?>" readonly>
                                        <label for="tujuan">Tujuan</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $ord['tanggal']; ?>" readonly>
                                        <label for="tanggal">Tanggal</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="jam" name="jam" value="<?php echo $ord['jam']; ?>" readonly>
                                        <label for="jam">Jam</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="jumlah_penumpang" name="jumlah_penumpang" value="<?php echo $ord['jumlah_penumpang']; ?>" readonly>
                                        <label for="jumlah_penumpang">Jumlah Penumpang</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="titikJemput" name="titikJemput" value="<?php echo $ord['titik_jemput']; ?>" readonly>
                                        <label for="titikJemput">Titik Jemput</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <form class="g-3" action="<?php echo BASEURL; ?>home_driver/acceptBooking" method="POST">
                                <input type="hidden" name="bookingId" id="bookingId" value="<?php echo $ord['bookingId']; ?>">
                                <button type="button" class="btn btn-lg btn-secondary btn-login text-uppercase fw-bold mb-2" data-toggle="collapse" data-target="#collapse<?php echo $counter; ?>" aria-expanded="true" aria-controls="collapse<?php echo $counter; ?>">Batal</button>
                                <button class="btn btn-lg btn-info btn-login text-uppercase fw-bold mb-2" type="submit">Terima</button>
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
    $(document).ready(function() {
        $('#dari').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
</script>