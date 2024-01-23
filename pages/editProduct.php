<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql = "SELECT p.kode_produk 'kode_p', p.nama_produk 'nama_p', p.harga_produk 'harga_p', p.kategori_produk 'id_kategori', k.nama_kategori 'kategori_p', p.stok 'stok_p' 
    FROM produk p JOIN kategori k
    ON(p.kategori_produk = k.kode_kategori) WHERE kode_produk = $id";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();

    $kode_produk = $hasilSatu["kode_p"];
    $nama_produk = $hasilSatu["nama_p"];
    $id_kategori = $hasilSatu["id_kategori"];
    $nama_kategori = $hasilSatu["kategori_p"];
    $harga = $hasilSatu["harga_p"];
    $stok = $hasilSatu["stok_p"];
    
}
?>

<div class="modal fade" id="editProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editProductForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">No Produk</label>
                                <select class="form-select" name="edit_no_produk" id="edit_no_produk">
                                    <?php $sqlSelectIdProduk = "SELECT kode_produk 'kode_produk' FROM produk WHERE kode_produk = $id AND nama_produk = '$nama_produk' AND harga_produk = $harga AND stok = $stok;";
                                    $stateSelectIdProduk = $conn->query($sqlSelectIdProduk);
                                    $row = $stateSelectIdProduk->fetch();
                                    ?>
                                    <option value="<?= $row["kode_produk"]  ?>" selected="selected"><?= $row["kode_produk"] ?></option>
                                    <?php  ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Produk</label>
                                <input name="edit_nama_produk" id="edit_nama_produk" type="text" class="form-control" value="<?= $nama_produk ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID - Kategori Produk</label>
                                <select class="form-select" name="edit_kategori" id="edit_kategori">
                                    <option value="">- Masukkan Kategori -</option>
                                    <?php $sqlSelectIdKategori = "SELECT CONCAT (k.kode_kategori, '-', k.nama_kategori) 'kategori_produk' FROM kategori k;";
                                    $stateSelectIdKategori = $conn->query($sqlSelectIdKategori);
                                    foreach ($stateSelectIdKategori as $row) {
                                    ?>
                                        <option value="<?php echo $row["kategori_produk"] ?>" <?php
                                                                                        $kategoriBanding = $hasilSatu["id_kategori"] . '-' . $hasilSatu["kategori_p"];
                                                                                        if ($row["kategori_produk"] == $kategoriBanding) {
                                                                                            echo "selected='selected'";
                                                                                        } ?>><?php echo $row["kategori_produk"] ?> </option> <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Harga (Rp)</label>
                                <input class="form-control" type="text" name="edit_harga" id="edit_harga" placeholder="Harga (Rp)" value="<?= $harga ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input class="form-control" type="text" name="edit_stok" id="edit_stok" placeholder="Stok" value="<?= $stok ?>">
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editProductForm" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editProductForm").submit(function(e) {
            // alert();
            e.preventDefault();
            const nama_produk = $("#edit_nama_produk").val();
            const id_kategori = $("#edit_kategori option:selected").val();
            const harga = $("#edit_harga").val();
            const stok = $("#edit_stok").val();
            

            if (nama_produk == "" || id_kategori == "" || harga == "" || stok == "") {
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
                    text: `Anda akan mengubah produk tersebut? `,
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