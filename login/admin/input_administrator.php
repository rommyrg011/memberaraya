<?php
include '../function.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../");
    exit();
}

?>

<?php include 'ui/head.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include 'ui/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'ui/topbar.php'; ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary text-center">Input Administrator</h4>
                        </div>
                        <form method="post" autocomplete="off">
                            <div class="card-body">

                                <input type="hidden" name="cabang" value="-">

                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap :</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Username :</label>
                                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password :</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                </div>

                                <input type="hidden" name="level" value="admin">

                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-sm mr-2" name="tambahAdministrator">Submit</button>
                                    <a href="administrator" type="button" class="btn btn-secondary btn-sm mr-2">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
    </div>

    <?php include 'ui/mobile.php'; ?>
    <?php include 'ui/js.php'; ?>

</body>

</html>