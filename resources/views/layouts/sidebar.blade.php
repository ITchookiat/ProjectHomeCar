@php
  function active($currect_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
      echo 'active'; //class name in css
    }
  }
@endphp
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left">
        <img src="{{ asset('dist/img/homecar-orange1.jpg') }}" alt="User Image" style="width: 30%;">
      </div>
      <div class="pull-left info">
        <p>&nbsp;&nbsp;&nbsp;{{ Auth::user()->username }}</p>
        <a href="#">&nbsp;&nbsp;&nbsp;<i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

        @if(auth::user()->type == 1)
        <li class="treeview {{ (request()->is('maindata/view*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-window-restore"></i> <span> ข้อมูลหลัก</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-id-badge text-red"></i>  ข้อมูลผู้ใช้งานระบบ</a></li>
          </ul>
        </li>
        @endif

        <li class="treeview {{ (request()->is('datacar/view*')) ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-database"></i> <span> สต๊อกรถยนต์</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="{{ route('datacar',1) }}"><i class="fa fa-cube text-red"></i> รถยนต์ทั้งหมด</a>
            </li>
            <li>
                <a href="{{ route('datacar',7) }}"><i class="fa fa-cube text-red"></i> รถยนต์นำเข้าใหม่</a>
            </li>
            <li>
                <a href="{{ route('datacar',2) }}"><i class="fa fa-cube text-red"></i> รถยนต์ระหว่างทำสี</a>
            </li>
            <li>
                <a href="{{ route('datacar',3) }}"><i class="fa fa-cube text-red"></i> รถยนต์รอซ่อม</a>
            </li>
            <li>
                <a href="{{ route('datacar',4) }}"><i class="fa fa-cube text-red"></i> รถยนต์ระหว่างซ่อม</a>
            </li>
            <li>
                <a href="{{ route('datacar',5) }}"><i class="fa fa-cube text-red"></i> รถยนต์ที่พร้อมขาย</a>
            </li>
            <li>
                <a href="{{ route('datacar',6) }}"><i class="fa fa-cube text-red"></i> รถยนต์ที่ขายแล้ว</a>
            </li>
            <li>
                <a href="{{ route('datacar',8) }}"><i class="fa fa-cube text-red"></i> รถยนต์ยืมใช้</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ (request()->is('datacar/viewreport*')) ? 'active' : '' }}"> <!-- /.DINsidebar -->
          <a href="#">
            <i class="fa fa-book"></i> <span> รายงาน</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li>
                <a href="{{ route('datacarreport',1) }}"><i class="fa fa-book text-success"></i> รายงานรถยนต์ทั้งหมด</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',2) }}"><i class="fa fa-book text-info"></i> รายงานรถยนต์พร้อมขาย</a>
            </li> -->
            <li>
                <a href="{{ route('datacarreport',3) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน สต๊อกบัญชี</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',4) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน วันหมดอายุบัตร</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',5) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน รถยึด</a>
            </li>
            <li>
                <a href="{{ route('datacarreport',6) }}"><i class="fa fa-clipboard text-yellow"></i> รายงาน ยอดขาดทุนรถต่อคัน</a>
            </li>
        </li>
      </li>
    </ul>
  </section>
</aside>
