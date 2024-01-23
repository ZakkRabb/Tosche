<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];


    $sql = "SELECT * FROM karyawan WHERE karyawan.id_karyawan = $id ;";
    $hasil = $conn->query($sql);
    $hasil->execute();
    $hasilSatu = $hasil->fetch();


    $nama_karyawan = $hasilSatu["nama"];
    $email = $hasilSatu["email"];
    $password = $hasilSatu["password"];
    $no_telepon = $hasilSatu["no_telepon"];
}




?>

<div class="modal fade" id="editKaryawanModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="editKaryawanForm" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">ID</label>
                                <select class="form-select" name="edit_id_karyawan" id="edit_id_karyawan" selected="selected">

                                    <option value="<?= $id ?>"><?= $id ?></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Karyawan</label>
                                <input name="edit_nama_karyawan" id="edit_nama_karyawan" type="text" class="form-control" placeholder="Nama Karyawan" value="<?= $nama_karyawan ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input class="form-control" type="text" name="edit_email" id="edit_email" placeholder="Email" value="<?= $email ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group bi bi-eye-slash">
                                <label for="">Password Baru</label>
                                <input class="form-control" type="password" name="edit_password" id="edit_password" placeholder="Password" value="<?= $password ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group bi bi-eye-slash">
                                <label for="">Konfirmasi Password</label>
                                <input class="form-control" type="password" name="edit_password_baru" id="edit_password_baru" placeholder="Password Baru" value="<?= $password ?> ">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input class="form-control bi bi-eye-slash" type="text" name="edit_no_telp" id="edit_no_telp" placeholder="Nomor Telepon" value="<?= $no_telepon ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editKaryawanForm" class="btn btn-success active aksi-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#editKaryawanForm").submit(function(e) {
            e.preventDefault();
            const id_karyawan = $("#edit_id_karyawan option:selected").val();
            const nama_karyawan = $("#edit_nama_karyawan").val();
            const email = $("#edit_email").val();
            const no_telp = $("#edit_no_telp").val();
            const password = $("#edit_password").val();
            const password_baru = $("#edit_password_baru").val();

            if (nama_karyawan == "" || email == "" || no_telp == "" || password == "") {
                Swal.fire(
                    "Masukan Salah!",
                    "Isian data belum lengkap!",
                    "error"
                )
                // alert("COK")
            } else {

                if (password != password_baru) {
                    Swal.fire(
                        "Password salah!",
                        "Password tidak sama, mohon cek kembali!",
                        "error"
                    )
                } else {


                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: `Anda akan mengubah data dengan ID ${id_karyawan}?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, ubah!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'postEditKaryawan.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                cache: false,
                                success: function(data) {
                                    Swal.fire(
                                        "Berhasil!",
                                        "Perubahan data sukses!",
                                        "success"
                                    ).then(() => {
                                        window.location.reload();
                                    })
                                }
                            })
                        }
                    })
                }

            }
        })
    })
</script>