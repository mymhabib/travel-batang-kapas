console.log('asklfjasklfjhaslkfj');
$(function() {
    $('.tombolTambahData').on('click', function() {
        $('#modalLabelProyek').html('Tambah Data Proyek');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#pt').val("");
        $('#nama_proyek').val("");
        $('#tahun_proyek').val("");
        $('#bulan_proyek').val("");
        $('#tanggal_proyek').val("");
        $('#lokasi').val("");
        $('#maps').val("");
        $('#link').val("");
        $('#id').val("");
    });

    $('.tampilModalUbah').on('click', function() {
        $('#modalLabelProyek').html('Ubah Data Proyek');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost/PTPWL/public/proyek/ubah');

        const id = $(this).data('id');
        console.log(id);
        $.ajax({
            url: 'http://localhost/PTPWL/public/proyek/getubah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#pt').val(data.pt);
                $('#nama_proyek').val(data.nama_proyek);
                $('#tahun_proyek').val(data.tahun_proyek);
                $('#bulan_proyek').val(data.bulan_proyek);
                $('#tanggal_proyek').val(data.tanggal_proyek);
                $('#lokasi').val(data.lokasi);
                $('#maps').val(data.maps);
                $('#link').val(data.link);
                $('#id').val(data.id);
            }

        });
    });

});