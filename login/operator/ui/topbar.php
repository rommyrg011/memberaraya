<?php 
// Include database connection (assuming this is handled by ../function)

// Check for members with expiration dates within the next 3 days
$today = date('Y-m-d');
$three_days_later = date('Y-m-d', strtotime('+3 days'));

$query_expiring_members = mysqli_query($koneksi, "
    SELECT memberid, nama, expired
    FROM member
    WHERE expired <= '$three_days_later' AND expired >= '$today' AND `status` = 'Aktif'
    ORDER BY expired ASC
");

$expiring_members_count = mysqli_num_rows($query_expiring_members);
?>
<style>
    .red-text {
        color: red;
    }

</style>

<nav
    class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
>
    <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3"
    >
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="alertsDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="fas fa-bell fa-fw"></i>
                <?php if ($expiring_members_count > 0) { ?>
                    <span class="badge badge-danger badge-counter"><?= $expiring_members_count; ?></span>
                <?php } ?>
            </a>
            <div
                class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown"
            >
                <h6 class="dropdown-header">Notifikasi</h6>
                <?php 
                if ($expiring_members_count > 0) {
                    while ($member = mysqli_fetch_assoc($query_expiring_members)) {
                        $expired_date = date('d F Y', strtotime($member['expired']));
                        $is_today_expired = ($member['expired'] == $today);
                        $alert_bg_color = $is_today_expired ? 'bg-danger' : 'bg-warning';
                        $alert_icon = $is_today_expired ? 'fa-exclamation-triangle' : 'fa-calendar-alt';
                ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle <?= $alert_bg_color; ?>">
                                <i class="fas <?= $alert_icon; ?> text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">
                                Segera Expired: <?= $expired_date; ?>
                            </div>
                            <span class="font-weight-bold">
                                <?= htmlspecialchars($member['nama']); ?> dengan Id Member <span class="red-text"><?= htmlspecialchars($member['memberid']); ?></span>
                                akan segera expired!
                            </span>
                        </div>
                    </a>
                <?php
                    }
                } else {
                    echo '<a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada notifikasi</a>';
                }
                ?>
                <!-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> -->
            </div>
        </li>
        
        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?php echo $_SESSION['nama_lengkap']; ?>
                </span>
                <img
                    class="img-profile rounded-circle"
                    src="<?= htmlspecialchars($_SESSION['foto']); ?>"
                    
                />
            </a>
            <div
                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown"
            >
                <a class="dropdown-item" href="profil">
                    <img
                        src="<?= htmlspecialchars($_SESSION['foto']); ?>"
                        alt="Foto Profil"
                        class="rounded-circle mr-2"
                        style="width: 20px; height: 20px; object-fit: cover;"
                    >
                    Profil <?php echo $_SESSION['nama_lengkap']; ?>
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>