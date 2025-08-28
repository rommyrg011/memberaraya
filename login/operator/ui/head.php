<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="website icon" type="png" href="../images/logoaraya.png" />
    <title>Dashboard Operator</title>
    
    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">


  <!-- kepunyaan select2 -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <style>
     /* Mobile Navbar Styles */
.mobile-navbar {
  display: none;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1035;
  background: white;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  height: 70px; /* Sedikit lebih tinggi */
  transition: all 0.3s ease;
}

/* Efek saat navbar di-scroll */
.mobile-navbar.scrolled {
  height: 60px; /* Kembali ke tinggi normal */
}

.mobile-navbar .nav-items {
  display: flex;
  height: 100%;
  padding: 0;
  margin: 0;
  list-style: none;
}

.mobile-navbar .nav-item {
  flex: 1;
  text-align: center;
}

.mobile-navbar .nav-link {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  padding: 5px 0;
  color: #6e707e;
  text-decoration: none;
  font-size: 0.7rem;
  transition: all 0.3s ease;
}

.mobile-navbar .nav-link:hover {
  color: #4e73df;
}

.mobile-navbar .nav-link.active {
  color: #4e73df;
}

.mobile-navbar .nav-link i {
  font-size: 1.2rem;
  margin-bottom: 3px;
  transition: all 0.3s ease;
}

/* Efek saat di-scroll */
.mobile-navbar.scrolled .nav-link i {
  font-size: 1.5rem; /* Ikon lebih besar */
  color: #4e73df; /* Warna ikon berubah */
}

.mobile-navbar.scrolled .nav-link span {
  font-weight: bold; /* Teks lebih tebal */
  color: #4e73df; /* Warna teks berubah */
}

/* Adjust content padding for mobile navbar */
@media (max-width: 768px) {
  body {
    padding-bottom: 70px; /* Space for mobile navbar */
  }

  .mobile-navbar {
    display: block;
  }

  #accordionSidebar {
    display: none !important;
  }

  #sidebarToggleTop {
    display: none; /* Ini menyembunyikan tombol toggle sidebar di topbar mobile */
  }

  /* HAPUS ATAU KOMENTARI BLOK DI BAWAH INI */
  /*
  .topbar .navbar-search {
    max-width: 180px;
  }

  .topbar #alertsDropdown,
  .topbar #messagesDropdown,
  .topbar .topbar-divider {
    display: none;
  }
  */
  /* BATAS AKHIR BLOK YANG DIHAPUS/DIKOMENTARI */

  .d-sm-inline-block.btn {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
  }
}

/* Dalam file CSS Anda, misalnya, di akhir sb-admin-2.min.css atau file kustom Anda */

@media (max-width: 767.98px) {
  /* Pastikan sidebar disembunyikan di mobile */
  #accordionSidebar {
    display: none !important;
  }

  /* Buat topbar fixed di bagian atas */
  .topbar {
    position: fixed; /* Membuat topbar menempel di posisi tetap */
    top: 0; /* Menempel di bagian paling atas */
    width: 100%; /* Memastikan lebarnya 100% dari viewport */
    z-index: 1050; /* Pastikan topbar berada di atas elemen lain */
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important; /* Agar tetap ada shadow */
  }

  /* Sesuaikan padding-top untuk konten utama agar tidak tertutup topbar fixed */
  #content-wrapper #content {
    padding-top: 70px; /* Sesuaikan dengan tinggi topbar Anda + sedikit spasi jika perlu */
  }

  /* Sesuaikan padding-bottom untuk konten utama agar tidak tertutup bottom navbar */
  #content-wrapper {
    padding-bottom: 56px; /* Tinggi bottom navbar, sesuaikan jika berbeda */
  }

  /* Pastikan elemen topbar lainnya tetap responsif dengan baik */
  .topbar .navbar-nav {
    flex-direction: row; /* Item tetap dalam satu baris */
    align-items: center; /* Pusat vertikal */
  }

  .topbar .navbar-nav .nav-item {
    margin-left: 0.5rem;
    margin-right: 0.5rem;
  }
}

/* Style for the mobile bottom navigation bar (tetap sama) */
.mobile-bottom-navbar {
  width: 100%;
  z-index: 1050;
  border-top: 1px solid #e3e6f0;
}

.mobile-bottom-navbar .nav-item {
  flex: 1;
  text-align: center;
}

.mobile-bottom-navbar .nav-link {
  color: #858796;
  font-size: 0.75rem;
  padding: 0.5rem 0.25rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: color 0.15s ease-in-out;
}

.mobile-bottom-navbar .nav-link i {
  font-size: 1.2rem;
  margin-bottom: 0.2rem;
}

.mobile-bottom-navbar .nav-item.active .nav-link,
.mobile-bottom-navbar .nav-link:hover {
  color: #4e73df;
}

.mobile-bottom-navbar .nav-item.active .nav-link span {
  font-weight: bold;
}

/* Jika Anda ingin efek scroll pada bottom navbar untuk hide/show (opsional) */
.mobile-bottom-navbar.scrolled {
  transform: translateY(100%);
  transition: transform 0.3s ease-out;
}

.mobile-bottom-navbar:not(.scrolled) {
  transform: translateY(0);
  transition: transform 0.3s ease-in;
}

/* perkecil ukuran pada saat tampilan mobile */
  /* mobile-table.css */
  @media (max-width: 576px) {
  /* Mengatur ukuran font pada tabel saat tampilan mobile */
  #dataTable {
    font-size: 0.65rem;
  }
  
  /* Mengatur padding (jarak dalam sel) agar lebih rapat */
  #dataTable th,
  #dataTable td {
    padding: 0.3rem;
  }
  
  /* Mengatur tampilan tabel agar lebih optimal di mobile */
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
}

/* bagian untuk css member */
.selected {
      background-color: tomato !important;
      color: white !important;
      cursor: pointer;
    }
    
    /* Perbaikan Jarak Card Header dan Body */
    .card-header, .card-body {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    /* Merapikan tata letak tombol */
    .btn-group {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    /* Penyesuaian Tombol untuk Mobile */
    @media (max-width: 576px) {
      .btn-mobile {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
      }
    }
    
    /* Perbaikan CSS untuk DataTable */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        font-size: 0.8rem; /* Ukuran font lebih kecil */
    }
    
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        height: calc(1.5em + .5rem + 2px); /* Menyesuaikan tinggi input */
        padding: 0.25rem 0.5rem; /* Padding lebih kecil */
        font-size: 0.8rem; /* Ukuran font lebih kecil */
    }
    
    /* Mengatur lebar kolom secara otomatis berdasarkan konten */
    #dataTable {
        table-layout: auto !important;
        width: 100% !important;
    }
    #dataTable th, #dataTable td {
        white-space: nowrap;
    }

    /* mengubah ukuran button pada saat tampilan mobile */
    @media (max-width: 768px) {
      .btn-xs {
        padding: .25rem .5rem; /* Smaller padding */
        font-size: .8rem;      /* Smaller font size */
        line-height: 1.2;      /* Adjust line height for a tighter fit */
      }
    }
    </style>
  </head>