<?php

class M_barang extends CI_Model
{
	// Nama tabel didalam database
	protected $_table = 'barang';
	
	// Mengambil semua data barang dari tabel
	public function lihat()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	// Mendapatkan jumlah total data barang dalam tabel
	public function jumlah()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	// Mendapatkan data barang yang memiliki stok lebih dari 1
	public function lihat_stok()
	{
		$query = $this->db->get_where($this->_table, 'stok > 1');
		return $query->result();
	}

	// Mendapatkan data barang berdasarkan kode_barang
	public function lihat_id($kode_barang)
	{
		$query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
		return $query->row();
	}

	// Mendapatkan data barang berdasarkan nama_barang
	public function lihat_nama_barang($nama_barang)
	{
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	// Menambahkan data barang baru ke dalam tabel
	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}

	// Menambahkan nilai stok barang tertentu
	public function plus_stok($stok, $nama_barang)
	{
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	// Mengurangkan nilai stok barang tertentu
	public function min_stok($stok, $nama_barang)
	{
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	// Mengubah data barang berdasarkan kode_barang
	public function ubah($data, $kode_barang)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}
	
	// Menghapus data barang berdasarkan kode_barang
	public function hapus($kode_barang)
	{
		return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
	}
}
