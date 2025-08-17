<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Silahkan Login</title>
    <link rel="website icon" type="png" href="../images/maps.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    html,
    body {
        background-image: url("images/1.png");
        height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.5);
        background-blend-mode: darken;

    }

    h1 {
        font-family: Helvetica;
        color: white;
        font-weight: 790;
    }

    h5 {
        font-family: Helvetica;
        color: #79DC30;
        font-weight: 390;
    }

    h6 {
        font-family: Helvetica;
        color: white;
        font-weight: 500;

    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 20%;
    }

    .btn-md {
        color: white;
    }

    .btn-md:hover {
        color: white;
    }
    a{
        text-decoration: none;
    }
</style>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center mt-3">

                        <div class="col-lg-6">
                            <br>
                           <center><img src="images/logoaraya.png"></center>
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h4 class="text-center font-weight-light my-4">SILAHKAN LOGIN</h4>
                                </div>
                                <div class="card-body">
                                    <form action="cek_login.php" method="post">
                                        <?php
                                        //Jika Gagal Login
                                        if (isset($_GET['pesan'])) {
                                            if ($_GET['pesan'] == "gagal") {
                                                echo "<div class='alert alert-danger alert-dismissible'>
                                                    <center><i class='fa fa-hourglass fa-spin' style='color:red;'></i>  <strong>Maaf! Username dan Password tidak sesuai</strong></center>
                                                    <meta http-equiv='refresh' content='3; url=./'/>
                                                </div>";
                                            }
                                        }

                                        //Jika berhasil Login admin
                                        if (isset($_GET['admin'])) {
                                            echo "
                                            <div class='alert alert-info alert-dismissible'>
                                                <center>
                                                <i class='fa fa-refresh fa-spin'></i>
                                                <strong>Login Sukses! Tunggu Sebentar...</strong>
                                        
                                                </center>
                                                <meta http-equiv='refresh' content='3; url=admin/'/>
                                            </div>";
                                        }

                                        ?>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" type="text" placeholder="Username" required autocomplete="off" />
                                            <label>Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" type="password" id="myInput" placeholder="Password" required autocomplete="off" />
                                            <label>Password</label>
                                        </div>
                                        <!-- perlihatkan kata sandi-->
                                        <input type="checkbox" onclick="myFunction()"> Perlihatkan Sandi
                                        <center>
                                            <br>
                                            <script>
                                                function myFunction() {
                                                    var x = document.getElementById("myInput");
                                                    if (x.type === "password") {
                                                        x.type = "text";
                                                    } else {
                                                        x.type = "password";
                                                    }
                                                }
                                            </script>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md">Silahkan Masuk</button>
                                                
                                            </div>
                                            <br>
                                            <p><a href="../"> Kembali ke awal</a></p>
                                        </center>

                                    </form>
                                </div>

                            </div>
                            <br>
                            <br>
                            <h6 align="center">&copy; ARAYA GAMESTATION - 2025</h6>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./admin/template/js/scripts.js"></script>
</body>

</html>