<?php

class Proyek_model
{

    private $table = 'proyek';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllProyek()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' order by tanggal_update');
        return $this->db->resultSet();
        
    }
    public function getProyekById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function tambahDataProyek($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO proyek VALUES(NULL,:pt,:nama_proyek,:tahun_proyek,:bulan_proyek,:tanggal_proyek,:lokasi,:maps,:link,:tanggal_input,:tanggal_update)";
        $this->db->query($query);
        $this->db->bind('pt', $data['pt']);
        $this->db->bind('nama_proyek', $data['nama_proyek']);
        $this->db->bind('tahun_proyek', $data['tahun_proyek']);
        $this->db->bind('bulan_proyek', $data['bulan_proyek']);
        $this->db->bind('tanggal_proyek', $data['tanggal_proyek']);
        $this->db->bind('lokasi', $data['lokasi']);
        $this->db->bind('maps', $data['maps']);
        $this->db->bind('link', $data['link']);
        $this->db->bind('tanggal_input', $date);
        $this->db->bind('tanggal_update', $date);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataProyek($id)
    {
        $query = "DELETE FROM proyek where id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function ubahDataProyek($data)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $query = "UPDATE proyek set
        pt=:pt,
        nama_proyek=:nama_proyek,
        tahun_proyek=:tahun_proyek,
        bulan_proyek=:bulan_proyek,
        tanggal_proyek=:tanggal_proyek,
        lokasi=:lokasi,
        maps=:maps,
        link=:link,
        tanggal_update=:tanggal_update 
        where id=:id";
        $this->db->query($query);
        $this->db->bind('pt', $data['pt']);
        $this->db->bind('nama_proyek', $data['nama_proyek']);
        $this->db->bind('tahun_proyek', $data['tahun_proyek']);
        $this->db->bind('bulan_proyek', $data['bulan_proyek']);
        $this->db->bind('tanggal_proyek', $data['tanggal_proyek']);
        $this->db->bind('lokasi', $data['lokasi']);
        $this->db->bind('maps', $data['maps']);
        $this->db->bind('link', $data['link']);
        $this->db->bind('tanggal_update', $date);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function cariDataProyek()
    {
        $keyword = $_POST['keyword'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nama_proyek LIKE :keyword order by tanggal_update desc');
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    public function cariDataProyekTahun($tahun)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tahun_proyek LIKE :tahun');
        $this->db->bind('tahun', $tahun);
        return $this->db->resultSet();
    }


    
}
