<ul
        class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <a
          class="sidebar-brand d-flex align-items-center justify-content-center"
          href="./"
        >
          <div class="sidebar-brand-icon rotate-n-15">
            <img src="../images/logoaraya.png" style="width: 50px;">
          </div>
          <div class="sidebar-brand-text mx-1">ARAYA GAMESTATION</div>
        </a>

        <hr class="sidebar-divider my-0" />

        <li class="nav-item active">
          <a class="nav-link" href="./">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a
          >
        </li>

        <hr class="sidebar-divider" />
        

        <div class="sidebar-heading">Master Data</div>
        
        <li class="nav-item active">
          <a class="nav-link" href="member">
            <i class="fas fa-book"></i>
            <span>Member</span></a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="leaderboard">
            <i class="fas fa-chart-line"></i>
            <span>Leaderboard</span>
          </a>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="history">
            <i class="fas fa-undo"></i>
            <span>History</span>
          </a>
        </li>

        <hr class="sidebar-divider" />
        <div class="sidebar-heading">User</div>
        
        <li class="nav-item active">
          <a class="nav-link" href="user">
            <i class="fas fa-user"></i>
            <span>User</span></a>
        </li>

        <hr class="sidebar-divider" />

        <div class="sidebar-heading">Tier Member</div>

        <li class="nav-item active">
          <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapsePages"
            aria-expanded="true"
            aria-controls="collapsePages"
          >
            <i class="fas fa-crown"></i>
            <span>Tier</span>
          </a>
          <div
            id="collapsePages"
            class="collapse"
            aria-labelledby="headingPages"
            data-parent="#accordionSidebar"
          >
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="alltier">All</a>
              <a class="collapse-item" href="tierbronze">Bronze</a>
              <a class="collapse-item" href="tiersilver">Silver</a>
              <a class="collapse-item" href="tiergold">Gold</a>
              
            </div>
          </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>