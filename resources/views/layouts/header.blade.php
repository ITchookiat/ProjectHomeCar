
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-orange navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        {{-- <a class="nav-link" href="../../../../Projectleasing/public/home">
          <i class="fab fa-accusoft"></i> ระบบลิสซิ่ง
        </a> --}}
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        {{-- <a href="#" class="nav-link">Contact</a> --}}
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
        </a>
        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div> --}}
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item dropdown user user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ asset('dist/img/avatar5.png') }}" class="user-image img-circle elevation-2 alt="User Image">
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-yellow">
            <img src="{{ asset('dist/img/homecarlogo2.jpg') }}" class="img-circle elevation-2" alt="User Image">
              <p>
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->username }}</small>
              </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer form-inline">
            <div class="col-6 text-left">
              <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="col-6 text-right">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                Sign out
              </button>
          </div>
          </li>
        </ul>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
          <h5 align="center">คุณแน่ใจที่จะออกจากระบบหรือไม่ 
            <i class="fas fa-question"></i>
          </h5>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i>  ยกเลิก</button>
          <a href="{{ route('logout') }}" class="btn btn-success btn-outline" >
            <i class="fa fa-check-circle"></i>  ตกลง
          </a>
        </div>
      </div>
    </div>
  </div>

  {{-- เมนู แถบด้านขวามือ --}}
<aside class="control-sidebar control-sidebar-dark" style="top: 57px; height: 747px; display: block;">
  <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-host-scrollbar-vertical-hidden" style="height: 747px;">
    <div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: -16px; width: 249px; height: 746px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="">
        <div class="os-content" style="padding: 16px; height: 100%; width: 100%;">
          <h5>เมนูตั้งค่า (Menu Setting)</h5><hr class="mb-2">
          @if(auth::user()->type == "Admin")
            <div class="mb-2">
              <a href="{{ route('MasterMaindata.index') }}">
                <i class="far fa-id-badge text-red mr-1"></i> ข้อมูลผู้ใช้งานระบบ
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="transform: translate(0px, 0px); width: 100%;"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden os-scrollbar-unusable">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="transform: translate(0px, 0px); height: 100%;"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
</aside>
