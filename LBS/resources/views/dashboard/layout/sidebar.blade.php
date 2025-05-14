<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard')?'active':'' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/reqs')?'active':'' }}" aria-current="page" href="/dashboard/reqs">
              <span data-feather="file-text"></span>
              Pengajuan
            </a>
          </li>
        </ul>

        
        @can('admin') 
        <h6 class="sidebar-heading d-flex justify-conten-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Petugas</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/tugas*')?'active':'' }}" href="/dashboard/tugas"> 
              <span data-feather="file-text"></span>
              Daftar Pekerjaan
            </a>
          </li>
        </ul>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/riwayat*')?'active':'' }}" href="/dashboard/riwayat"> 
              <span data-feather="file-text"></span>
              Sampah Telah Dibersihkan
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-conten-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts*')?'active':'' }}" href="/dashboard/posts"> 
              <span data-feather="file-text"></span>
              Postingan Artikel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/admin_reqs*')?'active':'' }}" aria-current="page" href="/dashboard/admin_reqs">
              <span data-feather="file-text"></span>
              Daftar Titik Sampah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/regions*')?'active':'' }}" aria-current="page" href="/dashboard/regions">
              <span data-feather="map"></span>
              Wilayah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/categories*')?'active':'' }}" href="/dashboard/categories">
              <span data-feather="grid"></span>
             Categori Postingan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/users*')?'active':'' }}" href="/dashboard/users"> 
              <span data-feather="users"></span>
            User
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-conten-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Report</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/reports*')?'active':'' }}" href="/dashboard/reports"> 
              <span data-feather="file-text"></span>
              Laporan
            </a>
          </li>
        </ul>
        @endcan
        @can('petugas')
        <h6 class="sidebar-heading d-flex justify-conten-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Petugas</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/tugas*')?'active':'' }}" href="/dashboard/tugas"> 
              <span data-feather="file-text"></span>
              Daftar Pekerjaan
            </a>
          </li>
        </ul>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/riwayat*')?'active':'' }}" href="/dashboard/riwayat"> 
              <span data-feather="file-text"></span>
              Sampah Telah Dibersihkan
            </a>
          </li>
        </ul>
        @endcan
      </div>
    </nav>