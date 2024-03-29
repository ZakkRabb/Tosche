<?php
session_start();

require_once "../Config/Database.php";
require_once "../Helper/functions.php";
$conn = getConnection();
$_SESSION['loginStr'] = "false";
// error_reporting(E_ALL ^ E_WARNING);
if (isset($_SESSION['login']) && $_SESSION['login']) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM karyawan WHERE email=? AND password=?;";
    $hasil = $conn->prepare($sql);
    $hasil->execute([$email, $password]);

    if ($row = $hasil->fetch()) {
        $nama = $row['nama'];
        $_SESSION['admin'] = "";
        $_SESSION['nama'] = $nama;
        $_SESSION['login'] = true;
        $_SESSION['loginStr'] = "true";
        $_SESSION['email'] = $email;
        $_SESSION['id_karyawan'] = $row["id_karyawan"];
        if ($row["role"] == 1) {
            $_SESSION['admin'] = true;
        } else {
            $_SESSION['admin'] = false;
        }


        // successLogin($nama);
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
    }
    // $_SESSION['login'] = true;
    // $_SESSION['username'] = 'Eko';

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Register</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="login.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
            <form method="POST" action="#" id="formlogin">
                        <!-- logo diatas -->
        <div class="logo mt-3 mb-3 justify-content-center d-flex">
            <img src="../src/img/tosche.png" width="130px">
        </div>
                        <div>
                            <label for="">Email</label>
                            <div class="form-input">
                                <span onclick="clearField()"><i class="fa fa-times-circle-o"></i></i></span>
                                <input autocomplete="off" type="email" id="email" name="email" placeholder="Email Address">
                            </div>
                        </div>

                        <div>
                            <label for="">Password</label>
                            <div class="form-input">
                                <span><i onclick="changeIcon(this)" class="fa fa-eye"></i></span>
                                <input autocomplete="off" type="password" id="password" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6 d-flex">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cb1">
                                    <label class="custom-control-label" for="cb1">Remember me</label>
                                </div>
                            </div>

                            <div class="col-6 text-end">
                                <a href="TidakAda.html" class="forget-link">Forget password?</a>
                            </div>
                        </div>


                        <script>
                            // alert()
                        </script>
                        <div class="text-center mb-3">
                            <button id="sign-in-btn" type="submit" name="submit" class="btn" login="<?php if (isset($_SESSION['loginStr'])) {
                                                                                                        echo $_SESSION['loginStr'];
                                                                                                    } ?>">Sign In</button>
                        </div>
                    </form>
          </div>
        </div>
      </div>
    </div>
  </div>




    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     $("#formlogin").submit(function(e) {
        //         e.preventDefault();
        //         const pass = $("#password").val();
        //         const emaill = $("#email").val();

        //         if (pass == "" || emaill == "") {

        //             Swal.fire(
        //                 'Login gagal!',
        //                 'Isian masih ada yang kosong!',
        //                 'error'
        //             )
        //         } else {
        //             isLoginBerhasil = $("#sign-in-btn").attr("login");
        //             // isLoginBerhasil = true;
        //             console.log(isLoginBerhasil);
        //             if (isLoginBerhasil === "true") {
        //                 $.ajax({
        //                     type: "POST",
        //                     url: "login.php",
        //                     data: $(this).serialize(),
        //                     cache: false,
        //                     success: function(data) {
        //                         Swal.fire(
        //                             'Login sukses!',
        //                             'Selamat, ' + emaill + ' telah berhasil login!',
        //                             'success'
        //                         ).then(() => {
        //                             window.location.href = "dashboard.php";
        //                         })
        //                     }
        //                 })

        //             } else {
        //                 Swal.fire(
        //                     'Login gagal!',
        //                     'Username atau password salah!',
        //                     'error'
        //                 )
        //             }

        //         }

        //     })
        // })


        let errormsg = document.getElementById("errormsg");
        let email = document.getElementById("email");
        let password = document.getElementById("password");
        let hide = document.getElementById("hide");
        let form = document.getElementById("formlogin");

        window.onload = gantiText();

        function gantiText() {
            if (urlParams === errortrue) {
                errormsg.innerHTML = "Username atau Password anda salah.";
            } else {
                errormsg.innerHTML = error;
            }

        }





        let changeIcon = function(icon) {
            if (password.type === "password") {
                icon.classList.toggle('fa-eye-slash');
                password.type = "text";
            } else {
                icon.classList.toggle("fa-eye-slash");
                password.type = "password";
            }


        }

        function clearField() {
            email.value = "";
        }

        function switchVis() {
            hide.classList.toggle("fa-eye");

        }

        // form.addEventListener("submit", function(event){
        //     event.preventDefault()
        //     });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js"></script>

</body>

</html>