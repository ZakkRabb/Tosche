<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();
$sql = "SELECT id_karyawan, karyawan.nama, karyawan.no_telepon 'no_telp', email FROM karyawan JOIN role ON(karyawan.role = role.id_role) WHERE role.id_role = 1;";
$hasil = $conn->query($sql);

// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasilNama = $conn->prepare($namasql);
$hasilNama->execute([$email]);

$nama = $hasilNama->fetch();


$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../src/css/karyawan.css" />
  <!-- <link rel="stylesheet" href="karyawan.css"/> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

  <title>Tosche Karyawan</title>
</head>

<body>
  <section id="menu">
    <div class="logo">
      <img src="../src/img/tosche.png" alt="" />
    </div>
    <div class="items">
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Menu Utama</h6>
      </li>
      <li onclick="pindahPage('dashboard.php')">
        <span class="material-icons"> dashboard </span>
        <a class="menu-text">Dashboard</a>
      </li>
      <li onclick="pindahPage('inventori.php')">
        <span class="material-icons"> inventory_2 </span>
        <a class="menu-text">Inventori</a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Laporan</h6>
      </li>
      <li id="manajemen-li" onclick="dropManajemen()">
        <span class="material-symbols-outlined"> badge </span>
        <a class="menu-text">Pegawai</a>
      </li>
      <div id="manajemen">
        <div onclick="pindahPage('karyawan.php')">
          <span></span>
          <a>Karyawan</a>
        </div>
        <div onclick="pindahPage('administrator.php')">
          <span></span>
          <a>Administrator</a>
        </div>
      </div>
      <li onclick="pindahPage('transaksi.php')">
        <span class="material-symbols-outlined"> contract </span>
        <a class="menu-text">Transaksi</a>
      </li>
      <li onclick="pindahPage('BuatLaporan.php')">
        <span class="material-symbols-outlined"> summarize </span>
        <a class="menu-text">Laporan</a>
      </li>
    </div>
    <!-- <div id="profilediv" onclick="toggleMenu()">
      <img src="../src/img/profil_empty.png" alt="">
      <span><?php echo $nama['nama'] ?></span>
    </div> -->
  </section>


  <section id="interface">
    <div class="navigation">
      <div class="n1">
        <i id="slide-bar" class="fa-solid fa-bars" style="color: #FFFFFF;"></i>
      </div>
      <div class="profile">
        <i class="fa fa-bell"> </i>
        <img src="../src/img/profil_empty.png" alt="">
        <span class="material-symbols-outlined" onclick="toggleMenu()">
          expand_more
        </span>
      </div>
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="../src/img/profil_empty.png" alt="">
            <h2><?php echo $nama['nama'] ?></h2>
          </div>
          <hr />
          <a href="TidakAda.php" class="sub-menu-link">
            <span class="material-symbols-outlined"> manage_accounts </span>
            <p>Edit Profile</p>
          </a>
          <a href="TidakAda.php" class="sub-menu-link">
            <span class="material-symbols-outlined"> settings </span>
            <p>Settings</p>
          </a>
          <a href="TidakAda.php" class="sub-menu-link">
            <span class="material-symbols-outlined"> contact_support </span>
            <p>Help & Support</p>
          </a>
          <a class="sub-menu-link" id="logout">
            <span class="material-symbols-outlined"> logout </span>
            <p>Logout</p>
          </a>
        </div>
      </div>
    </div>

    <div class="transaksi-tambah">
      <h3 class="i-name">Karyawan</h3>
      <button type="button" data-bs-toggle="modal" data-bs-target="#newKaryawanModal" class="btn btn-outline-primary active aksi-btn tambah-btn">
        Tambah Karyawan
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newKaryawanModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form id="newKaryawanForm" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID</label>
                    <select class="form-select" name="id_karyawan" id="id_karyawan" disabled>
                      <?php $sqlSelectIdKaryawan = "SELECT MAX(id_karyawan) 'id_karyawan' FROM karyawan;";
                      $stateSelectIdKaryawan = $conn->query($sqlSelectIdKaryawan);
                      foreach ($stateSelectIdKaryawan as $row) {
                      ?>
                        <option value="<?= $row["id_karyawan"] + 1 ?>"><?= $row["id_karyawan"] + 1 ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Nama Karyawan</label>
                    <input name="nama_karyawan" id="nama_karyawan" type="text" class="form-control" placeholder="Nama Karyawan">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="Email">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Konfirmasi Password</label>
                    <input class="form-control bi bi-eye-slash" type="password" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input class="form-control bi bi-eye-slash" type="text" name="no_telp" id="no_telp" placeholder="Nomor Telepon">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark active aksi-btn" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success active aksi-btn">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="board">
      <p id="p-order">List Karyawan</p>
      <div>

      </div>
      <div class="show-search">
        <div class="show-entries">
          <label id="show" for="">Show</label>
          <select name="jumlah-data" id="jumlah-data">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <label id="show" for="">entries</label>
        </div>
        <!-- <div class="search">
          <i class="fa fa-search"></i>
          <input type="text" placeholder="Search" name="" id="" />
        </div> -->
      </div>
      <table width="100%">
        <thead>
          <tr>
            <td>No</td>
            <td>ID</td>
            <td>Nama</td>
            <td>Nomor Telepon</td>
            <td>Email</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($hasil as $row) { ?>
            <tr>
              <td><?php echo $no;
                  $no++;  ?></td>
              <td><?php echo $row['id_karyawan'] ?></td>
              <td><?php echo $row['nama'] ?></td>
              <td><?php echo $row['no_telp'] ?></td>
              <td><?php echo $row['email'] ?></td>
              <td>
                <button type="button" id="<?= $row['id_karyawan'] ?>" <?php if (!$_SESSION['admin']) {
                                                                        if ($_SESSION['id_karyawan'] != $row['id_karyawan']) {
                                                                          echo "disabled";
                                                                        }
                                                                      } ?> class="btn btn-outline-primary active aksi-btn edit">
                  Edit
                </button>
                <button type="button" id="<?= $row['id_karyawan'] ?>" <?php if (!$_SESSION['admin']) {
                                                                        if ($_SESSION['id_karyawan'] != $row['id_karyawan'] || $_SESSION['id_karyawan'] == $row['id_karyawan']) {
                                                                          echo "disabled";
                                                                        }
                                                                      } ?> class="btn btn-outline-danger active aksi-btn font-kecil hapus">
                  Hapus
                </button>
              </td>
            </tr>
          <?php } ?>

        </tbody>
        <tbody>
          <tr>
            <td class="people"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="display-karyawan"></div>
  </section>
  <script>
    // logout
    $(document).ready(function() {

      $(document).on("click", ".edit", function() {
        const id = $(this).attr('id');
        console.log(id);
        $("#display-karyawan").html("");
        $.ajax({
          url: "editKaryawan.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-karyawan").html(data);
            $("#editKaryawanModal").modal("show");
          }
        })

      })


      // Hapus
      $(document).on("click", ".hapus", function() {
        const id = $(this).attr('id');
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda tidak akan bisa mengembalikan data ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "deleteKaryawan.php",
              type: 'POST',
              data: {
                id: id
              },
              success: function(data) {
                Swal.fire(
                  'Data terhapus!',
                  'Data karyawan berhasil dihapus.',
                  'success'
                ).then(() => {
                  window.location.reload();
                })
              }

            })
          }
        })
      })


      // Tambah 
      $("#newKaryawanForm").submit(function(e) {
        e.preventDefault();
        const nama_karyawan = $("#nama").val();
        const email = $("#email").val();
        const no_telp = $("#no_telp").val();
        const password = $("#password").val();
        const konfirmasi_password = $("#konfirmasi_password").val();


        if (nama_karyawan == "" || email == "" || no_telp == "" || konfirmasi_password == "" || password == "") {
          Swal.fire(
            "Masukan Salah!",
            "Isian data belum lengkap!",
            "error"
          )
          // alert("COK")
        } else {
          if (password != konfirmasi_password) {
            Swal.fire(
              "Password salah!",
              "Password tidak sama, mohon cek kembali!",
              "error"
            )
          } else {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: "Anda akan menambahkan karyawan baru?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, tambahkan!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'newKaryawan.php',
                  type: 'POST',
                  data: $(this).serialize(),
                  cache: false,
                  success: function(data) {
                    Swal.fire(
                      "Berhasil!",
                      "Penambahan karyawan baru berhasil!",
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



      $("#logout").click(function() {
        Swal.fire({
          title: 'Apakah Anda yakin?',
          text: "Anda akan keluar dari halaman ini!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, keluar saja!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "Logout.php",
              type: "POST",
              success: function() {
                Swal.fire(
                  'Logout berhasil!',
                  'Anda akan keluar dari halaman karyawan.',
                  'success'
                ).then(() => {
                  window.location.href = "login.php";
                })
              }
            })
          }
        })
      })
    })


    let sideBar = document.getElementById("menu");
    let el_html = document.querySelector("html");
    let subMenu = document.getElementById("subMenu");
    let slideBar = document.getElementById("slide-bar");
    let manajemen = document.getElementById("manajemen-li");
    let manajemenDrop = document.getElementById("manajemen");

    // let x = window.matchMedia("(max-width: 769px)");

    function toggleMenu() {
      // subMenu.subMenu.classList.toggle("open-menu");
      if (subMenu.style.maxHeight == "400px") {
        subMenu.style.maxHeight = "0px";
      } else {
        subMenu.style.maxHeight = "400px";
      }
    }

    $("#manajemen-li").click(function() {
      $("#manajemen").toggleClass("active2");
    });


    $("#slide-bar").click(function() {
      $("#menu").toggleClass("active");
    });

    $("#slide-bar").click(function() {
      $("#menu").toggleClass("activeWeb");
    });

    function pindahPage(namaPage) {
      window.location.href = namaPage;
    }



    // alert("Apakah bisa ");
    </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  <!-- SWAL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>
</body>

</html>