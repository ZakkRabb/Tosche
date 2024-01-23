<?php
session_start();
if ($_SESSION['login'] != true) {
  header("Location: login.php");
  exit();
}


require_once "../Config/Database.php";
require_once "../Helper/functions.php";

$conn = getConnection();
$sql = "SELECT t.id_transaksi 'id_transaksi', c.nama 'nama_customer', k.nama 'nama_pegawai', t.tanggal_transaksi 'tanggal_transaksi', p.nama_produk 'nama_produk', t.jumlah_barang 'jumlah_barang', t.total_tagihan 'total_tagihan'
FROM transaksi t JOIN customer c 
ON(t.id_customer = c.id_customer)
JOIN karyawan k
ON(t.id_pegawai = k.id_karyawan)
JOIN produk p
ON(t.id_barang = p.kode_produk)
ORDER BY t.tanggal_transaksi DESC; ";
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
  <link rel="stylesheet" href="../src/css/transaksi.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <title>Lihat Transaksi</title>
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
      <li onclick="pindahPage('laporan.php')">
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

    <!-- <h3 class="i-name">Transaksi</h3> -->
    <div class="transaksi-tambah">
      <h3 class="i-name">Transaksi</h3>
      <button data-bs-toggle="modal" data-bs-target="#newUserModal" type="button" class="btn btn-outline-primary active aksi-btn tambah-btn aksi-btn">
        Tambah Transaksi
      </button>
    </div>

    <div class="board">
      <p id="p-order">List Transaksi</p>
      <div>
      </div>
      <div class="show-search">
        <div>
          <label id="show" for="">Show</label>
          <select name="jumlah-data" id="jumlah-data">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
          <label id="show" for="">entries</label>
        </div>
        <div class="search">
          <i class="fa fa-search"></i>
          <input type="text" placeholder="Search" name="" id="" />
        </div>
      </div>
      <table width="100%">
        <thead>
          <tr>
            <td>No</td>
            <td>Customer</td>
            <td>Tanggal Transaksi</td>
            <td>Nama Barang</td>
            <td>Jumlah</td>
            <td>Total</td>
            <td>Kasir</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($hasil as $row) { ?>
            <tr>
              <td><?php echo $no ?></td>
              <?php $no++; ?>
              <td><?php echo $row['nama_customer'] ?></td>
              <td><?php echo $row['tanggal_transaksi'] ?></td>
              <td><?php echo $row['nama_produk'] ?></td>
              <td><?php echo $row['jumlah_barang'] ?></td>
              <td><?php echo rupiah($row['total_tagihan']) ?></td>
              <td><?php echo $row['nama_pegawai'] ?></td>
              <td>
                <button type="button" class="btn btn-outline-primary active aksi-btn edit" id="<?= $row['id_transaksi'] ?>">
                  Edit
                </button>
                <button type="submit" form="" class="btn btn-outline-success active aksi-btn">
                  Invoice
                </button>
                <button type="button" class="btn btn-outline-danger active aksi-btn font-kecil hapus" id="<?= $row['id_transaksi'] ?>">
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

    <!-- MODAL -->
    <div class="modal fade" id="newUserModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form id="newTransactionForm" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">No Order</label>
                    <select class="form-select" name="no_order" id="" disabled>
                      <?php $sqlSelectIdPesanan = "SELECT MAX(id_transaksi) 'id_transaksi' FROM transaksi;";
                      $stateSelectIdPesanan = $conn->query($sqlSelectIdPesanan);
                      foreach ($stateSelectIdPesanan as $row) {
                      ?>
                        <option value="<?= $row["id_transaksi"] + 1 ?>"><?= $row["id_transaksi"] + 1 ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID - Nama Customer</label>
                    <select class="form-select" name="id_nama" id="id_nama">
                      <option value="">- Masukkan ID & Nama -</option>
                      <?php $sqlSelectIdNama = "SELECT CONCAT(c.id_customer, ' - ', c.nama) 'id_nama' FROM customer c;";
                      $stateSelectIdNama = $conn->query($sqlSelectIdNama);
                      foreach ($stateSelectIdNama as $row) {
                      ?>
                        <option value="<?php echo $row["id_nama"] ?>"><?php echo $row["id_nama"] ?> </option> <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Tanggal Transaksi</label>
                    <input class="form-control" type="date" name="tgl_transaksi" id="tgl_transaksi">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID - Nama Barang</label>
                    <select class="form-select" name="nama_produk" id="nama_produk">
                      <option value="">- Masukkan ID & Nama Barang -</option>
                      <?php $sqlSelectIdProduk = "SELECT CONCAT(p.kode_produk, ' - ', p.nama_produk) 'nama_produk' FROM produk p;";
                      $stateSelectIdProduk = $conn->query($sqlSelectIdProduk);
                      foreach ($stateSelectIdProduk as $row) {
                      ?>
                        <option value="<?php echo $row["nama_produk"] ?>"><?php echo $row["nama_produk"] ?> </option> <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Jumlah Barang</label>
                    <input class="form-control" type="text" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Total</label>
                    <input class="form-control" type="text" name="total_tagihan" id="total_tagihan" placeholder="Total Tagihan (Rp)">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID - Nama Kasir</label>
                    <select class="form-select" name="nama_karyawan" id="nama_karyawan">
                      <option value="">- Masukkan ID & Nama Kasir -</option>
                      <?php $sqlSelectIdKasir = "SELECT CONCAT(k.id_karyawan, ' - ', k.nama) 'nama_karyawan' FROM karyawan k WHERE role = 1;";
                      $stateSelectIdKasir = $conn->query($sqlSelectIdKasir);
                      foreach ($stateSelectIdKasir as $row) {
                      ?>
                        <option value="<?php echo $row["nama_karyawan"] ?>"><?php echo $row["nama_karyawan"] ?> </option> <?php } ?>
                    </select>
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
    <div id="display-transaction"></div>
  </section>

  <script>
    // Modal
    $(document).ready(function() {

      // Logout
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

      $(document).on("click", ".edit", function() {
        const id = $(this).attr('id');

        $("#display-transaction").html("");
        $.ajax({
          url: "editTransaction.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-transaction").html(data);
            $("#editTransactionModal").modal("show");
          }
        })

      })

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
              url: "deleteTransaction.php",
              type: 'POST',
              data: {
                id: id
              },
              success: function(data) {
                Swal.fire(
                  'Data terhapus!',
                  'Data transaksi telah terhapus.',
                  'success'
                ).then(() => {
                  window.location.reload();
                })
              }

            })
          }
        })
      })


      $("#newTransactionForm").submit(function(e) {
        e.preventDefault();
        const id_nama = $("#id_nama option:selected").val();
        const tgl_transaksi = $("#tgl_transaksi").val();
        const nama_produk = $("#nama_produk option:selected").val();
        const jumlah_produk = $("#jumlah_barang").val();
        const total_tagihan = $("#total_tagihan").val();
        const kasir = $("#nama_karyawan option:selected").val();

        if (id_nama == "" || tgl_transaksi == "" || nama_produk == "" || jumlah_produk == "" || total_tagihan == "" || kasir == "") {
          Swal.fire(
            "Masukan Salah!",
            "Isian data belum lengkap!",
            "error"
          )
          // alert("COK")
        } else {

          Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda akan menambahkan transaksi baru?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'newTransaction.php',
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

    let sideBar = document.getElementById("menu");
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

    // PINDAH PAGE

    function pindahPage(namaPage) {
      window.location.href = namaPage;
    }

    $("#slide-bar").click(function() {
      $("#menu").toggleClass("active");
    });

    $("#slide-bar").click(function() {
      $("#menu").toggleClass("activeWeb");
    });

    // alert("Apakah bisa ");
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  <!-- SWAL -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>

</body>

</html>