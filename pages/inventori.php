<?php
session_start();

require_once "../Config/Database.php";
require_once "../Helper/functions.php";
$conn = getConnection();

$dataperhalaman = 30;

$cekdata = ("SELECT COUNT(*) FROM produk") ;
$jumlahdata = $cekdata;
$jumlahHalaman = ceil(intval($jumlahdata) / $dataperhalaman);
$halamanAktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $dataperhalaman * $halamanAktif ) - $dataperhalaman;



// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasilNama = $conn->prepare($namasql);
$hasilNama->execute([$email]);

$nama = $hasilNama->fetch();


$sql = "SELECT p.kode_produk 'kode_p', p.nama_produk 'nama_p', p.gambar_produk 'gambar_p', p.harga_produk 'harga_p', k.nama_kategori 'kategori_p', p.stok 'stok_p'
FROM produk p JOIN kategori k
ON(p.kategori_produk = k.kode_kategori)
ORDER BY p.stok ASC LIMIT $dataperhalaman;";
$hasil = $conn->query($sql);




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
  <link rel="stylesheet" href="../src/css/produk.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <title>Tosche Inventori</title>
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
      <h3 class="i-name">Daftar Produk</h3>
      <button data-bs-toggle="modal" data-bs-target="#newUserModal" type="button" class="btn btn-outline-primary active aksi-btn tambah-btn aksi-btn">
        Tambah Produk
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
              <td>Nama Produk</td>
              <td>Kode Produk</td>
              <td>Gambar</td>
              <td>Jenis Produk</td>
              <td>Stok Produk</td>
              <td>Harga Produk</td>
              <td>Aksi</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($hasil as $row) { ?>
              <tr>
                <td><?php echo $no ?></td>
                <?php $no++; ?>
                <td><?php echo $row['nama_p'] ?></td>
                <td><?php echo $row['kode_p'] ?></td>
                
                <td><img class="img_produk" src="<?php echo $row['gambar_p'] ?>"></td>
                <td><?php echo $row['kategori_p'] ?></td>
                <td><?php echo $row['stok_p'] ?></td>
                <td><?php echo rupiah($row['harga_p']) ?></td>
                <td>
                  <button type="button" class="btn btn-outline-primary active aksi-btn edit" id="<?= $row['kode_p'] ?>">
                    Edit
                  </button>
                  <button type="button" class="btn btn-outline-danger active aksi-btn font-kecil hapus" id="<?= $row['kode_p'] ?>">
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
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item">
              <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <?php for($i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
              <?php if( $i == $halamanAktif ) : ?>
                <li class="page-item"><a class="page-link" href="#" aria-disabled="true"><?= $i; ?></a></li>
              <?php else : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>
            <li class="page-item">
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
    </div>
    
    <div class="modal fade" id="newUserModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <form id="newProductForm" method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">No Produk</label>
                    <select class="form-select" name="no_order" id="" disabled>
                      <?php $sqlSelectIdProduk = "SELECT MAX(kode_produk) 'kode_produk' FROM produk;";
                      $stateSelectIdProduk = $conn->query($sqlSelectIdProduk);
                      foreach ($stateSelectIdProduk as $row) {
                      ?>
                        <option value="<?= $row["kode_produk"] + 1 ?>"><?= $row["kode_produk"] + 1 ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input name="nama_p" id="nama_p" type="text" class="form-control" placeholder="Nama Produk">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">ID - Kategori</label>
                    <select class="form-select" name="id_kategori" id="id_kategori">
                      <option value="">- Masukkan Kategori Produk -</option>
                      <?php $sqlSelectIdKategori = "SELECT CONCAT (k.kode_kategori, '-', k.nama_kategori) 'id_kategori' FROM kategori k;";
                      $stateSelectIdKategori = $conn->query($sqlSelectIdKategori);
                      foreach ($stateSelectIdKategori as $row) {
                      ?>
                        <option value="<?php echo $row["id_kategori"] ?>"><?php echo $row["id_kategori"] ?> </option> <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Harga (Rp)</label>
                    <input class="form-control" type="text" name="harga_p" id="harga_p" placeholder="Harga (Rp)">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="">Stok</label>
                    <input class="form-control" type="text" name="stok_p" id="stok_p" placeholder="Stok Produk">
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

    <div id="display-product">
    </div>
  </section>

  <script>
    // Modal
    $(document).ready(function() {
      $(document).on("click", ".edit", function() {
        const id = $(this).attr('id');

        $("#display-product").html("");
        $.ajax({
          url: "editProduct.php",
          type: "POST",
          data: {
            id: id
          },
          cache: false,
          success: function(data) {
            $("#display-product").html(data);
            $("#editProductModal").modal("show");
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
              url: "deleteProduk.php",
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

      $("#newProductForm").submit(function(e) {
        e.preventDefault();
        const nama_produk = $("#nama_p").val();
        const id_kategori = $("#id_kategori option:selected").val();
        const harga = $("#harga_p").val();
        const stok = $("#stok_p").val();

        if (nama_produk == "" || id_kategori == "" || harga == "" || stok == "") {
          Swal.fire(
            "Masukan Salah!",
            "Isian data belum lengkap!",
            "error"
          )
        } else {

          Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Anda akan menambahkan produk baru?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: 'newProduk.php',
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