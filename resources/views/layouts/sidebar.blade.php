@php
  function active($currect_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
      echo 'active'; //class name in css
    }
  }
@endphp

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-dark-warning">
    <!-- Brand Logo -->
    <a href="{{ route('index','home') }}" class="brand-link">
      <img src="{{ asset('dist/img/homecarlogo2.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CHOOKIAT HOMECAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก ผู้จัดการ")
            <li class="nav-item has-treeview {{ Request::is('BoardMaster/view/*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link active">
                <i class="nav-icon fab fa-black-tie"></i>
                <p>
                  Board Directors
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('BoardMaster',1) }}" class="nav-link {{ Request::is('BoardMaster/view/1') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Commision Sale</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('BoardMaster',2) }}" class="nav-link {{ Request::is('BoardMaster/view/2') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Cars Sale</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          <li class="nav-item has-treeview {{ Request::is('ResearchCus/view/*') ? 'menu-open' : '' }} {{ Request::is('MasterResearchCus/*/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-handshake"></i>
              <p>
                Stock Customer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ResearchCus', 1) }}" class="nav-link {{ Request::is('ResearchCus/view/*') ? 'active' : '' }} {{ Request::is('MasterResearchCus/*/*') ? 'active' : '' }}">
                  <i class="far fa-dot-circle nav-icon"></i>
                  <p>SC001</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::is('datacar/view*') ? 'menu-open' : '' }} {{ Request::is('datacar/create/*') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-luggage-cart"></i>
              <p>
                Car warehouse
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview {{ Request::is('datacar/view/12') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="far fa-window-restore text-red nav-icon"></i>
                  <p>
                    Produce Car
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="margin-left: 15px;">
                  <li class="nav-item">
                    <a href="{{ route('datacar',12) }}" class="nav-link {{ Request::is('datacar/view/12') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยึดจากเร่งรัด</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview {{ Request::is('datacar/view/1') ? 'menu-open' : '' }} {{ Request::is('datacar/view/7') ? 'menu-open' : '' }} {{ Request::is('datacar/view/2') ? 'menu-open' : '' }} {{ Request::is('datacar/view/3') ? 'menu-open' : '' }} {{ Request::is('datacar/view/4') ? 'menu-open' : '' }} {{ Request::is('datacar/view/5') ? 'menu-open' : '' }}
                                                {{ Request::is('datacar/view/6') ? 'menu-open' : '' }} {{ Request::is('datacar/view/8') ? 'menu-open' : '' }} {{ Request::is('datacar/view/14') ? 'menu-open' : '' }}
                                                {{ Request::is('datacar/create/*') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/1') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/2') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/3') ? 'menu-open' : '' }} 
                                                {{ Request::is('datacar/edit/*/4') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/5') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/6') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/7') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="far fa-window-restore text-red nav-icon"></i>
                  <p>
                    Model Car
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="margin-left: 15px;">
                  <li class="nav-item">
                    <a href="{{ route('datacar',1) }}" class="nav-link {{ Request::is('datacar/view/1') ? 'active' : '' }} {{ Request::is('datacar/create/*') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ทั้งหมด</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',7) }}" class="nav-link {{ Request::is('datacar/view/7') ? 'active' : '' }} {{ Request::is('datacar/edit/*/1') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์นำเข้าใหม่</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',2) }}" class="nav-link {{ Request::is('datacar/view/2') ? 'active' : '' }} {{ Request::is('datacar/edit/*/2') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ระหว่างทำสี</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',3) }}" class="nav-link {{ Request::is('datacar/view/3') ? 'active' : '' }} {{ Request::is('datacar/edit/*/3') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์รอซ่อม</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',4) }}" class="nav-link {{ Request::is('datacar/view/4') ? 'active' : '' }} {{ Request::is('datacar/edit/*/4') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ระหว่างซ่อม</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',5) }}" class="nav-link {{ Request::is('datacar/view/5') ? 'active' : '' }} {{ Request::is('datacar/edit/*/5') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ที่พร้อมขาย</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',6) }}" class="nav-link {{ Request::is('datacar/view/6') ? 'active' : '' }} {{ Request::is('datacar/edit/*/6') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ที่ขายแล้ว</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',8) }}" class="nav-link {{ Request::is('datacar/view/8') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ยืมใช้</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('datacar',14) }}" class="nav-link {{ Request::is('datacar/view/14') ? 'active' : '' }} {{ Request::is('datacar/edit/*/7') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รถยนต์ส่งประมูล</p>
                    </a>
                  </li>  
                </ul>
              </li>

              <li class="nav-item has-treeview {{ Request::is('datacar/view/100') ? 'menu-open' : '' }} {{ Request::is('datacar/edit/*/100') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="far fa-window-restore text-red nav-icon"></i>
                  <p>
                     Mechanic Car
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="margin-left: 15px;">
                  <li class="nav-item">
                    <a href="{{ route('datacar',100) }}" class="nav-link {{ Request::is('datacar/view/100') ? 'active' : '' }} {{ Request::is('datacar/edit/*/100') ? 'active' : '' }}">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>รายการรถยนต์</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::is('reportcar/viewreport/3') ? 'menu-open' : '' }} {{ Request::is('reportcar/viewreport/4') ? 'menu-open' : '' }} {{ Request::is('reportcar/viewreport/5') ? 'menu-open' : '' }} {{ Request::is('reportcar/viewreport/6') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Report Car
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('reportcar',3) }}" class="nav-link {{ Request::is('reportcar/viewreport/3') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>รายงาน สต๊อกบัญชี</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('reportcar',4) }}" class="nav-link {{ Request::is('reportcar/viewreport/4') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>รายงาน วันหมดอายุบัตร</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('reportcar',5) }}" class="nav-link {{ Request::is('reportcar/viewreport/5') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>รายงาน รถยึด / CKL</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('reportcar',6) }}" class="nav-link {{ Request::is('reportcar/viewreport/6') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>รายงาน ยอดต้นทุนรถ</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>

          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
    </div>
  </aside>
