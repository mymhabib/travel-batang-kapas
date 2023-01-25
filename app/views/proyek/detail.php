<style>
    /*-----------------
    card shadow
---------------------*/
    .card {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
    }
</style>


<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalProyek" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelProyek">Ubah Data Proyek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>proyek/ubah" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="pt">
                            <h6>Nama instansi pemberi kerja:</h6>
                        </label>
                        <input type="text" class="form-control" id="pt" name="pt">
                        <label for="nama_proyek" style="margin-top:10px;">
                            <h6>Nama Paket Pekerjaan:</h6>
                        </label>
                        <input type="text" class="form-control" id="nama_proyek" name="nama_proyek">
                        <table style="margin-top:10px;">
                            <tr>
                                <td style="padding-right:10px;">
                                    <label for="tahun_proyek">
                                        <h6>Tahun Anggaran:</h6>
                                    </label>
                                    <input type="number" class="form-control" id="tahun_proyek" name="tahun_proyek">
                                </td>
                                <td style="padding-right:10px;">
                                    <label for="tanggal_proyek">
                                        <h6>Tanggal:</h6>
                                    </label>
                                    <select class="form-control" id="tanggal_proyek" name="tanggal_proyek">
                                        <?php for ($j = 1; $j <= 31; $j++) { ?>
                                            <option value="<?= $j ?>"><?= $j ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="padding-right:10px;">
                                    <label for="bulan_proyek">
                                        <h6>Bulan:</h6>
                                    </label>
                                    <select class="form-control" id="bulan_proyek" name="bulan_proyek">
                                        <?php $daftarBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                                        for ($i = 0; $i < 12; $i++) { ?>
                                            <option value="<?= $daftarBulan[$i] ?>"><?= $daftarBulan[$i] ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <label for="Lokasi" style="margin-top:10px;">
                            <h6>Lokasi:</h6>
                        </label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi">
                        <label for="maps" style="margin-top:10px;">
                            <h6>Link Google Maps:</h6>
                        </label>
                        <input type="text" class="form-control" id="maps" name="maps">
                        <label for="link" style="margin-top:10px;">
                            <h6>Link File Google Drive:</h6>
                        </label>
                        <input type="text" class="form-control" id="link" name="link">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary " data-target="#modalProyek">Ubah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modalHapus" tabindex="-1" aria-labelledby="judulModalHapus" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelHapusProyek">Hapus Proyek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-center">Apakah anda yakin ingin menghapus data ini?</h6>
            </div>
            <div class="modal-footer text-center">
                <a href="<?= BASEURL; ?>proyek/hapus/<?= $data['proyek']['id']; ?>" style="text-decoration:none;" class="btn btn-danger"> Ya</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-9">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td></td>
                <td>
                    <div class="col lg-1">
                        <?php Flasher::flash(); ?>
                    </div>
                </td>
                <td style="text-align: left; width: 55%;"></td>
            </tr>
            <tr>
                <td style="text-align: right;"><button onclick="history.back()" class="btn btn-primary mt-1">←</a></td>
                <td style="text-align: left;">
                    <div class="card" style="width: 30rem;">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td style="width:70%; border-right: 1px solid #dfe2e6">
                                        <h5 class="card-title" style="vertical-align:bottom;"><?= $data['proyek']['nama_proyek']; ?></h5>
                                    </td>
                                    <td rowspan="2" style="width:39%;">
                                        <h2 style="text-align:center"><?= $data['proyek']['tahun_proyek']; ?></h2>
                                        <h6 style="text-align:center"><?= $data['proyek']['tanggal_proyek']; ?> <?= $data['proyek']['bulan_proyek']; ?></h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-right: 1px solid #dfe2e6">
                                        <h6 class="card-subtitle mb-4 mt-3 text-muted"><?= $data['proyek']['pt']; ?></h6>
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                            </table>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="border-top: 1px solid #dfe2e6" scope="row">Lokasi:</th>
                                        <td style="border-top: 1px solid #dfe2e6"><?= $data['proyek']['lokasi']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Google Maps:</th>
                                        <td><a style="text-decoration: underline;" href="<?= $data['proyek']['maps']; ?>" target="_blank" rel="noopener noreferrer"><?= $data['proyek']['maps']; ?></a></p>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #ffffff">
                                        <th scope="row">Link File:</th>
                                        <td><a style="text-decoration: underline;" href="<?= $data['proyek']['link']; ?>" target="_blank" rel="noopener noreferrer"><?= $data['proyek']['link']; ?></a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($_SESSION['tbkb_user_id'] == 1) { ?>
                            <div class="card-footer text-center">
                                <a href="<?= BASEURL; ?>proyek/detail/<?= $data['proyek']['id']; ?>" style="text-decoration:none;" class="btn btn-success tampilModalUbah" data-bs-toggle="modal" data-bs-target="#modalProyek" data-id="<?= $data['proyek']['id'] ?>"> Edit</a>
                                <a href="<?= BASEURL; ?>proyek/detail/<?= $data['proyek']['id']; ?>" style="text-decoration:none;" class="btn btn-danger tampilModalHapus" data-bs-toggle="modal" data-bs-target="#modalHapus"> Hapus</a>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>