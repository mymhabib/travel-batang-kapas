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


    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }
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
    <div class="row row-cols-sm-2 mt-4 pt-4">
        <?php foreach ($data['orders'] as $ord) : ?>
            <a href="<?= BASEURL; ?>home/orderDetail/<?= $ord['orderId']; ?>" style="text-decoration:none;">
                <div class="card text-center ml-4 mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= $ord['dari']; ?> - <?= $ord['tujuan']; ?></h5>
                        <p class="text-muted card-subtitle"><?= $ord['tanggal']; ?> <?= $ord['jam']; ?></p>
                        <p class="text-muted card-subtitle"><?= $ord['jumlah_penumpang']; ?> Penumpang</p>
                        <?php
                        if ($ord['driverId'] == 0) {
                            echo 
                            '<div class="text-wrap badge bg-secondary">
                            <p class="text-light card-subtitle">Belum ada driver</p>
                            </div>';
                        } else if ($ord['selesai'] == 1) {
                            echo 
                            '<div class="text-wrap badge bg-success">
                            <p class="text-light card-subtitle">Perjalanan selesai</p>
                            </div>';
                        }else if ($ord['driverId'] != 0){
                            echo 
                            '<div class="text-wrap badge bg-info">
                            <p class="text-light card-subtitle">Sudah ada driver</p>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </a>
            </form>
        <?php endforeach; ?>
    </div>
    <br>
    <br>
    <br>
    <p class="text-muted text-center align-middle"><?= $data['kosong']; ?></p>
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