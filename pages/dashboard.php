<?php
session_start();

require_once "../Config/Database.php";
require_once "../Helper/functions.php";
$conn = getConnection();


// $conn = getConnection();

// Cek apakah ada session login
if ($_SESSION['login'] != true) {
  header("Location: login.php");
  exit();
}

// Get total customer 
$jmlCustomerSql = "SELECT * FROM customer;";
$jmlCustomerState = $conn->query($jmlCustomerSql);
$jmlCustomerAngka = $jmlCustomerState->rowCount();

// Get total pemasukan
$totalPemasukanSql = "SELECT SUM(t.total_tagihan) 'total' FROM transaksi t GROUP BY 'total';";
$totalPemasukanState = $conn->query($totalPemasukanSql);
$totalPemasukanAngka = $totalPemasukanState->fetch();
$totalPemasukanAngka = rupiah($totalPemasukanAngka['total']);

// Get total transaction
$totalTransactionSql = "SELECT * FROM transaksi";
$totalTransactionState = $conn->query($totalTransactionSql);
$totalTransactionAngka = $totalTransactionState->rowCount();

//Get total produk terjual
$totalProdukTerjual = "SELECT SUM(t.jumlah_barang) 'total' FROM transaksi t GROUP BY 'total';";
$totalProdukTerjualState = $conn->query($totalProdukTerjual);
$totalProdukTerjualAngka = $totalProdukTerjualState ->fetch();
$totalProdukTerjualAngka = $totalProdukTerjualAngka['total'];

//Get Produk Terlaris
$produkpalinglaris = "SELECT t.id_barang, p.nama_produk 'namaproduk' FROM transaksi t JOIN produk p on t.id_barang = p.kode_produk  GROUP BY id_barang ORDER BY SUM(jumlah_barang) DESC limit 1;";
$produkpalinglarisState = $conn->query($produkpalinglaris);
$produkpalinglarisHasil = $produkpalinglarisState ->fetch();
$produkpalinglarisHasil = $produkpalinglarisHasil['namaproduk'];


//Get Stok Terendah
$stokTerendah = "SELECT nama_produk FROM produk ORDER BY stok ASC LIMIT 1";
$stokTerendahState = $conn->query($stokTerendah);
$stokTerendahHasil = $stokTerendahState ->fetch();
$stokTerendahHasil = $stokTerendahHasil['nama_produk'];

//CHART
//TOP 3 PRODUK TERLARIS

//PRODUK 1
$produkterlaris1 = "SELECT SUM(jumlah_barang) 'total_penjualan' FROM transaksi WHERE id_barang = 1;";
$hasilprodukterlaris1 = $conn->query($produkterlaris1);
$hasilprodukterlaris1Hasil = $hasilprodukterlaris1 -> fetch();
$hasilprodukterlaris1Hasil = $hasilprodukterlaris1Hasil['total_penjualan'];

//PRODUK 2
$produkterlaris2 = "SELECT SUM(jumlah_barang) 'total_penjualan' FROM transaksi WHERE id_barang = 1;";
$hasilprodukterlaris2 = $conn->query($produkterlaris2);
$hasilprodukterlaris2Hasil = $hasilprodukterlaris2 -> fetch();
$hasilprodukterlaris2Hasil = $hasilprodukterlaris2Hasil['total_penjualan'];

//PRODUK 3
$produkterlaris3 = "SELECT SUM(jumlah_barang) 'total_penjualan' FROM transaksi WHERE id_barang = 3;";
$hasilprodukterlaris3 = $conn->query($produkterlaris3);
$hasilprodukterlaris3Hasil = $hasilprodukterlaris3 -> fetch();
$hasilprodukterlaris3Hasil = $hasilprodukterlaris3Hasil['total_penjualan'];

//KATEGORI

//KAT1
$kat1 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 1;";
$kat1state = $conn->query($kat1);
$kat1hasil = $kat1state -> fetch();
$kat1hasil = $kat1hasil['totalpenjualan'];

//KAT2
$kat2 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 2;";
$kat2state = $conn->query($kat2);
$kat2hasil = $kat2state -> fetch();
$kat2hasil = $kat2hasil['totalpenjualan'];

//KAT3
$kat4 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 4;";
$kat4state = $conn->query($kat4);
$kat4hasil = $kat4state -> fetch();
$kat4hasil = $kat4hasil['totalpenjualan'];

//KAT4
$kat7 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 7;";
$kat7state = $conn->query($kat7);
$kat7hasil = $kat7state -> fetch();
$kat7hasil = $kat7hasil['totalpenjualan'];

//KAT5
$kat8 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 8;";
$kat8state = $conn->query($kat8);
$kat8hasil = $kat8state -> fetch();
$kat8hasil = $kat8hasil['totalpenjualan'];

//KAT6
$kat9 = "SELECT k.kode_kategori, k.nama_kategori, SUM(jumlah_barang) 'totalpenjualan' FROM transaksi t JOIN produk p ON t.id_barang = p.kode_produk JOIN kategori k ON p.kategori_produk = k.kode_kategori WHERE k.kode_kategori = 9;";
$kat9state = $conn->query($kat9);
$kat9hasil = $kat9state -> fetch();
$kat9hasil = $kat9hasil['totalpenjualan'];


//PENJUALAN PER BULAN
//JANUARI
$janTotal = "SELECT sum(total_tagihan) 'tagihan' FROM `transaksi` WHERE tanggal_transaksi BETWEEN '2023-01-01' AND '2023-01-31';";
$janTotalState = $conn->query($janTotal);
$janTotalHasil = $janTotalState -> fetch();
$janTotalHasil = $janTotalHasil['tagihan'];

//FEBRUARU
$febTotal = "SELECT sum(total_tagihan) 'tagihan' FROM `transaksi` WHERE tanggal_transaksi BETWEEN '2023-02-01' AND '2023-03-28';";
$febTotalState = $conn->query($febTotal);
$febTotalHasil = $febTotalState -> fetch();
$febTotalHasil = $febTotalHasil['tagihan'];

//MARET
$marTotal = "SELECT sum(total_tagihan) 'tagihan' FROM `transaksi` WHERE tanggal_transaksi BETWEEN '2023-03-01' AND '2023-03-30';";
$marTotalState = $conn->query($marTotal);
$marTotalHasil = $marTotalState -> fetch();
$marTotalHasil = $marTotalHasil['tagihan'];



// if($hasilprodukterlaris->rowCount()>0){
//   $barang = array();
//   $laku = array();

//   while($row = $hasilprodukterlaris->fetch()){
//     $barang = $row["id_barang"];
//     $laku = $row['total_penjualan'];
//   }
//   unset($result);
// }else{
//   echo "No Records matching your query were found.";
// }
// unset($pdo);

//PRODUK 2
$produkterlaris2 = "";


// Get user's name
$email = $_SESSION['email'];
$namasql = "SELECT nama FROM karyawan WHERE email = ?;";
$hasil = $conn->prepare($namasql);
$hasil->execute([$email]);

$nama = $hasil->fetch();

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
  <link rel="stylesheet" href="../src/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

  <title>Tosche Dashboard</title>
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
        <img src="../src/img/profil_empty.png" alt="" />
        <span class="material-symbols-outlined" onclick="toggleMenu()">
          expand_more
        </span>
      </div>
      <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
          <div class="user-info">
            <img src="../src/img/profil_empty.png" alt="" />
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

  

    <!-- <div class="values"> -->
      <!-- <div class="val-box">
        <div class="headerpage">
          <h3>Selamat Datang, </h3>
          
          <h6>Toko Kelontong Koh Aldo</h6>
        </div>
        <div id="imgplace">
        <img src="../src/img/headerpage.png" alt="">
        </div>
        
      </div> -->

    
    <div class="values">
      <div class="val-box">
        <i class="fa fa-users"></i>
        <div>
          <h3><?= $jmlCustomerAngka ?></h3>
          <span>Total Customer</span>
        </div>
      </div>
      <div class="val-box">
        <i class="fa-solid fa-money-check-dollar"></i>
        <div>
          <h3><?= $totalPemasukanAngka ?></h3>
          <span>Pemasukan</span>
        </div>
      </div>
      <div class="val-box">
        <i class="fa-solid fa-bag-shopping"></i>
        <div>
          <h3><?= $stokTerendahHasil ?></h3>
          <span>Stok Terendah</span>
        </div>
      </div>
      <div class="val-box">
        <i class="fa-solid fa-money-check"></i>
        <div>
          <h3 class="fs-6"><?= $produkpalinglarisHasil?></h3>
          <span>Terlaris</span>
        </div>
      </div>
    </div>

    
  <div class="row">
    <div class="col-12">
      <div style="">
        <canvas id="myLineChart"></canvas>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-6">
        <div style="%">
            <canvas class="chartrow2" id="myChart1"></canvas>
        </div>
      </div>
      <div class="col-6">
        <div style="">
          <canvas class="chartrow2" id="myChart2"></canvas>
        </div>
      </div>
      </div>
  </div> -->
    
    
    
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // logout
    $(document).ready(function() {
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
              url: "logout.php",
              type: "POST",
              success: function() {
                Swal.fire(
                  'Logout berhasil!',
                  'Anda akan keluar dari halaman karyawan.',
                  'success'
                ).then(() => {
                  window.location.href = "login2.php";
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

    //chart
    // const ctx = document.getElementById('myChart');
    // const barang = ;
    // const total = ;

    // new Chart(ctx, {
    //   type: 'bar',
    //   data: {
    //     labels: barang,
    //     datasets: [{
    //       label: '# of Sales',
    //       data: total,
    //       borderWidth: 1
    //     }]
    //   },
    //   options: {
    //     scales: {
    //       y: {
    //         beginAtZero: true
    //       }
    //     }
    //   }
    // });

    // const labels = {!! json_encode($barang) !!};;
    //                     const data = {
    //                         labels: labels.map(label => label.substring(5)),
    //                         datasets: [{
    //                             label: 'Total Pendapatan',
    //                             backgroundColor: ['blue', 'red', 'green', 'purple', 'orange', 'grey'],
    //                             borderColor: 'rgb(255, 99, 132)',
    //                             data: {!! json_encode($total) !!},
    //                         }, ],
    //                     };

    //                     const config = {
    //                         type: 'bar',
    //                         data: data,
    //                         options: {
    //                             plugins: {
    //                                 legend: {
    //                                     display: false,
    //                                 },
    //                                 title: {
    //                                     display: true,
    //                                     text: 'Top 3 Terlaris',
    //                                 },
    //                             },
    //                         },
    //                     };

    //                     var myChart = new Chart(document.getElementById('myChart'), config)

  //linechart
  const ctx = document.getElementById('myLineChart');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Januari", "Februari", "Maret"],
        datasets: [{
          label: 'Total Pendapatan ',
          data: [
            <?php
            echo $janTotalHasil
              ?>,
            <?php
            echo $febTotalHasil
              ?>,
            <?php
            echo $marTotalHasil
              ?>],
          fill: false,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });




    //chart 1
  const ctx1 = document.getElementById('myChart1');
  new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: ['Indomie Goreng Jumbo Ayam', 'Pilot Pulpen BPT-P Hitam', 'Indomie Japanese Ramen Miso'],
    datasets: [{
      label: 'Jumlah Produk Terjual',
      data: [
        <?php echo $hasilprodukterlaris1Hasil ?>, 
        <?php echo $hasilprodukterlaris2Hasil ?>,
        <?php echo $hasilprodukterlaris3Hasil ?>],
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)'
    ],
    borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

  //chart2
  const ctx2 = document.getElementById('myChart2');
  new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ['Makanan dan Minuman', 'Obat dan Suplemen', 'Alat Tulis', 'Rokok', 'Produk Kecantikan', 'Perawatan Pribadi'],
    datasets: [{
      label: 'Jumlah Produk Terjual',
      data: [
        <?php echo $kat1hasil ?>, 
        <?php echo $kat2hasil ?>,
        <?php echo $kat4hasil ?>,
        <?php echo $kat7hasil ?>,
        <?php echo $kat8hasil ?>,
        <?php echo $kat9hasil ?>,
      ],
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)'
    ],
    borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});



    // alert("Apakah bisa ");
  </script>
  

</body>

</html>