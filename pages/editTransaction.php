<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql = "SELECT t.id_transaksi 'id_transaksi', t.id_customer 'id_customer', c.nama 'nama_customer', k.nama 'nama_pegawai', t.id_barang 'id_barang', t.tanggal_transaksi 'tanggal_transaksi', p.nama_produk 'nama_p', t.jumlah_barang 'jumlah_barang', t.total_tagihan 'total_tagihan'
    FROM transaksi t JOIN customer c 
    ON(t.id_customer = c.id_customer)
    JOIN karyawan k
    ON(t.id_pegawai = k.id_karyawan)
    JOIN produk p
    ON(t.id_barang = p.kode_produk)
    WHERE id_transaksi = $id;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();

    $nama_customer = $hasilSatu["nama_customer"];
    $tgl_transaksi = ($hasilSatu["tanggal_transaksi"]);
    $tgl_transaksi_html = date("Y-m-d", strtotime($tgl_transaksi));
    $id_produk = $hasilSatu["id_barang"];
    $nama_produk = $hasilSatu["nama_produk"];
    $jumlah_barang = $hasilSatu["jumlah_barang"];
    $total_tagihan = $hasilSatu["total_tagihan"];
    $nama_pegawai = $hasilSatu["nama_pegawai"];
}




?>

<div class="modal fade" id="editTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editTransactionForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">No Order</label>
                                <select class="form-select" name="edit_no_order" id="edit_no_order">
                                    <?php $sqlSelectIdTransaksi = "SELECT t.id_transaksi 'id_transaksi' FROM transaksi t WHERE t.id_transaksi = $id;";
                                    $stateSelectIdTransaksi = $conn->query($sqlSelectIdTransaksi);
                                    $row = $stateSelectIdTransaksi->fetch();
                                    ?>
                                    <option value="<?= $row["id_transaksi"]  ?>" selected="selected"><?= $row["id_transaksi"] ?></option>
                                    <?php  ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID - Nama Customer</label>
                                <select class="form-select" name="edit_id_nama" id="edit_id_nama">
                                    <option value="">- Masukkan ID & Nama -</option>
                                    <?php $sqlSelectIdNama = "SELECT CONCAT(c.id_customer, ' - ', c.nama) 'id_nama' FROM customer c;";
                                    $stateSelectIdNama = $conn->query($sqlSelectIdNama);
                                    foreach ($stateSelectIdNama as $row) {
                                    ?>
                                        <option value="<?php echo $row["id_nama"] ?>" <?php
                                                                                        $idNamaBanding = $hasilSatu["id_customer"] . " - " . $hasilSatu["nama_customer"];
                                                                                        if ($row["id_nama"] == $idNamaBanding) {
                                                                                            echo "selected='selected'";
                                                                                        } ?>><?php echo $row["id_nama"] ?> </option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Tanggal Transaksi</label>
                                <input class="form-control" type="date" name="edit_tanggal" id="edit_tanggal" placeholder="Tanggal Transaksi" value="<?= $tgl_transaksi_html?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID - Nama Barang</label>
                                <select class="form-select" name="edit_id_barang" id="edit_id_barang">
                                    <option value="">- Masukkan ID & Nama Barang -</option>
                                    <?php $sqlSelectIdBarang = "SELECT CONCAT(p.kode_produk, ' - ', p.nama_produk) 'id_nama' FROM produk p;";
                                    $stateSelectIdBarang = $conn->query($sqlSelectIdBarang);
                                    foreach ($stateSelectIdBarang as $row) {
                                    ?>
                                        <option value="<?php echo $row["id_nama"] ?>" <?php
                                                                                        $idProdukBanding = $hasilSatu["id_barang"] . " - " . $hasilSatu["nama_p"];
                                                                                        if ($row["id_nama"] == $idProdukBanding) {
                                                                                            echo "selected='selected'";
                                                                                        } ?>><?php echo $row["id_nama"] ?> </option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Jumlah Barang</label>
                                <input class="form-control" type="text" name="edit_jumlah_barang" id="edit_jumlah_barang" placeholder="Jumlah Barang" value="<?= $jumlah_barang ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Total</label>
                                <input class="form-control" type="text" name="edit_total_tagihan" id="edit_total_tagihan" placeholder="Total Tagihan (Rp)" value="<?= $total_tagihan ?>">
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button form="editTransactionForm" type="submit" class="btn btn-success active aksi-btn" id="edit-mase">Update</button>
            </div>
            </form>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editTransactionForm").submit(function(e) {
            // alert();
            e.preventDefault();
            const no_order = $("#edit_no_order option:selected").val();
            const judul_pesanan = $("#edit_judul_pesanan").val();
            const id_nama = $("#edit_id_nama option:selected").val();
            const status_bayar = $("#edit_status_bayar option:selected").val();
            const status_pesanan = $("#edit_status_pesanan option:selected").val();
            const jenis_paket = $("#edit_jenis_paket option:selected").val();
            const berat = $("#edit_berat").val();
            const tgl_masuk = $("#edit_tgl_masuk").val();
            const tgl_keluar = $("#edit_tgl_keluar").val();

            if (judul_pesanan == "" || id_nama == "" || status_bayar == "" || status_pesanan == "" || jenis_paket == "" || berat == "" || tgl_masuk == "" || tgl_keluar == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
            } else {

                console.log(judul_pesanan);
                // alert();
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Anda akan mengubah transaksi tersebut? `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, tambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'postEditTransaction.php',
                            type: 'POST',
                            data: $(this).serialize(),
                            cache: false,
                            success: function(data) {
                                Swal.fire(
                                    "Berhasil!",
                                    "Penambahan transaksi baru berhasil!",
                                    "success"
                                ).then(() => {
                                    window.location.reload();
                                })
                            }
                        })
                    }
                })

            }

        })
    })
</script>