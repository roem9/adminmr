    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <i class="fas fa-wine-bottle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dehiz Parfum</div>
      </a>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Imarat Bandung
      </div>

      <li class="nav-item" id="dosen">
        <a class="nav-link" href="<?= base_url()?>dosen">
          <i class="fas fa-fw fa-user-tie"></i>
          <span>Dosen</span></a>
      </li>
      
      <li class="nav-item" id="kelas">
        <a class="nav-link" href="<?= base_url()?>kelas">
          <i class="fas fa-fw fa-building"></i>
          <span>Kelas</span></a>
      </li>

      <li class="nav-item" id="mahasiswa">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dropone" aria-expanded="true" aria-controls="dropone">
          <i class="fas fa-users"></i>
          <span>Mahasiswa</span>
        </a>
        <div id="dropone" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-primary py-2 collapse-inner rounded">
            <h6 class="collapse-header text-light">Mahasiswa</h6>
            <a class="collapse-item text-light" href="<?= base_url()?>mahasiswa/aktif">Mahasiswa Aktif</a>
            <a class="collapse-item text-light" href="<?= base_url()?>mahasiswa/nonaktif">Mahasiswa Nonaktif</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()?>login/logout">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>
    <!-- End of Sidebar -->
