<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silahkan Login</title>
    <link rel="website icon" type="png" href="images/logoaraya.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    
    <div class="video-background">
        <video autoplay muted loop id="myVideo">
            <source src="images/bg.mp4" type="video/mp4">
        </video>
    </div>
    <div class="video-overlay"></div>

    <div class="login-container">
        <img src="images/logoaraya.png" alt="Logo Araya" class="logo">
        <form id="loginForm" class="login-form" action="cek_login.php" method="POST">
            <h2>SILAHKAN LOGIN</h2>
            <div class="input-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="input-group password-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <i id="eye-icon" class="fa fa-eye-slash"></i>
                </span>
            </div>
            <button type="submit">Login</button>
            <a href="../" class="link-kembali">Kembali ke awal</a>
        </form>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }

        const urlParams = new URLSearchParams(window.location.search);
        const pesan = urlParams.get('pesan');
        const admin = urlParams.get('admin');
        const operator = urlParams.get('operator');

        if (pesan === 'gagal') {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Username atau password salah!",
                showConfirmButton: false,
                timer: 3000
            });
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (pesan === 'gagal_level') {
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Level pengguna tidak valid!",
                showConfirmButton: false,
                timer: 3000
            });
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (admin !== null || operator !== null) {
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Login Berhasil!",
                showConfirmButton: false,
                timer: 4000
            }).then(() => {
                if (admin !== null) {
                    window.location.href = 'admin/';
                } else if (operator !== null) {
                    window.location.href = 'operator/';
                }
            });
        }
    </script>
</body>
</html>