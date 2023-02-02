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

    .form-select {
        background-color: dimgray;
        color: white;
    }

    .form-control {
        background-color: dimgray;
        color: white;
    }
    .invert { filter: invert(100%); }



    /* 
    .card:hover {
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
$daftarLokasi = ["-", "Sungai Penuh", "Silaut", "Lunang", "Tapan", "Airpura", "Pancung Soal", "Linggo Sari Baganti", "Ranah Pesisir", "Lengayang", "Sutera", "Batang Kapas", "Painan", "Bayang", "Tarusan", "Padang", "Pariaman", "Padang Panjang", "Bukittinggi", "Bandara Minang Kabau"]
?>

<?php
if (isOnMobile()) {

?>

    <div class="container mt-2" align="center">
        <div class="container" align="center">
            <div class="col-lg-4">
                <?php Flasher::flash(); ?>
            </div>
        </div>
        <div class="card rounded-lg text-white bg-dark" style="width: 20rem;" align="center">
            <div class="card-body">
                <h5 class="card-title">Where to go</h5>
                <form class="row g-3 text-white " style="margin-top: 10px; position: center; justify-content-md-center; padding-left: 5px;" action="<?php echo BASEURL; ?>home/booking" method="POST">
                <div class="form-floating">
                        <input type="text" style="background-color: dimgray; color:white;" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" readonly>
                        <label for=" floatingInput">Tanggal Keberangkatan</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="dari" name="dari" aria-label="dari">
                            <?php
                            for ($i = 0; $i < count($daftarLokasi); $i++) { ?>
                                <option value="<?php echo $daftarLokasi[$i] ?>"><?php echo $daftarLokasi[$i] ?></option>
                            <?php } ?>
                        </select>
                        <label for="dari">Dari</label>
                    </div>
                    <div>
                        <!-- make an image as swap button -->
                        <img src="<?php echo BASEURL; ?>img/swap-vertical.png" class="invert" alt="swap" id="tombol-swap" onclick="swap()" style="width: 20px; height: 20px;">
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="tujuan" name="tujuan" aria-label="tujuan">
                            <?php
                            for ($i = 0; $i < count($daftarLokasi); $i++) { ?>
                                <option value="<?php echo $daftarLokasi[$i] ?>"><?php echo $daftarLokasi[$i] ?></option>
                            <?php } ?>
                        </select>
                        <label for="dari">Tujuan</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" style="background-color: dimgray; color:white;" id="titikJemput" name="titikJemput" placeholder="Titik Jemput">
                        <label for="jumlah">Titik Jemput</label>
                    </div>
                    <div class="form">
                        <div class="form-floating mb-1">
                            <select class="form-select" id="jam" name="jam" aria-label="jam">
                                <option selected value="0">-</option>
                                <option value="03:00">03:00</option>
                                <option value="04:00">04:00</option>
                                <option value="05:00">05:00</option>
                                <option value="07:00">07:00</option>
                                <option value="10:00">10:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="20:00">20:00</option>
                            </select>
                            <label for=" floatingInput">Jam</label>
                        </div>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="jumlah" name="jumlah" aria-label="jumlah">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <label for="jumlah">Jumlah Penumpang</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
} else {
?>

    <div class="container mt-5" align="center">
        <div class="card rounded-sm text-white bg-dark" style="width: 35rem;" align="center">
            <div class="card-body">
                <h3 class="card-title">Where to go</h3>
                <form class="row g-3" style="margin-top: 10px; position: center; padding-left: 5px;" action="<?php echo BASEURL; ?>home/booking" method="POST">
                    <div class="row g-2 justify-content-md-center">
                        <div class="col-5">
                            <div class="form-floating">
                                <select class="form-select" id="dari" name="dari" aria-label="dari">
                                    <?php
                                    for ($i = 0; $i < count($daftarLokasi); $i++) { ?>
                                        <option value="<?php echo $daftarLokasi[$i] ?>"><?php echo $daftarLokasi[$i] ?></option>
                                    <?php } ?>
                                </select>
                                <label for="dari">Dari</label>
                            </div>
                        </div>
                        <div class="col-1" style="display: flex; align-items: center;">

                            <img src="<?php echo BASEURL; ?>img/swap-horizontal.png" class="align-top mx-auto invert" alt="swap" id="tombol-swap" onclick="swap()" style="width: 20px; height: 20px;">
                        </div>
                        <!-- <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2 rounded-c" id="tombol-swap" onclick="swap()" type="button">Pesan</button> -->
                        <div class="col-5">
                            <div class="form-floating">
                                <select class="form-select" id="tujuan" name="tujuan" aria-label="tujuan">
                                    <?php
                                    for ($i = 0; $i < count($daftarLokasi); $i++) { ?>
                                        <option value="<?php echo $daftarLokasi[$i] ?>"><?php echo $daftarLokasi[$i] ?></option>
                                    <?php } ?>
                                </select>
                                <label for="ke">Tujuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" style="background-color: dimgray; color:white;" class="form-control" id="titikJemput" name="titikJemput" placeholder="Titik Jemput">
                        <label for="jumlah">Titik Jemput</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input type="text" style="background-color: dimgray; color:white;" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" readonly>
                        <label for=" floatingInput">Tanggal Keberangkatan</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" id="jam" name="jam" aria-label="jam">
                            <option selected value="0">-</option>
                            <option value="03:00">03:00</option>
                            <option value="04:00">04:00</option>
                            <option value="05:00">05:00</option>
                            <option value="07:00">07:00</option>
                            <option value="10:00">10:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="20:00">20:00</option>
                        </select>
                        <label for=" floatingInput">Jam</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="jumlah" name="jumlah" aria-label="jumlah">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <label for="jumlah">Jumlah Penumpang</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" type="submit">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container mt-4" align="center">
            <div class="col-lg-4">
                <?php Flasher::flash(); ?>
            </div>
        </div>
    </div>
<?php
}
?>
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