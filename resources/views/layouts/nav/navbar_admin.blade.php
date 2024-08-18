 <!--Start sidebar-wrapper-->
 <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
         <a href="index.html">
             {{-- <img src=".." class="logo-icon" alt="logo icon"> --}}
             <h5 class="logo-text">CiVent Admin</h5>
         </a>
     </div>
     <ul class="sidebar-menu do-nicescrol">
         <li class="sidebar-header">MAIN NAVIGATION</li>
         <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
             <a href="{{ route('admin.dashboard') }}">
                 <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
             </a>
         </li>

         <li class="{{ Request::is('admin/events/create') ? 'active' : '' }}">
             <a href="{{ route('admin.events.create') }}">
                 <i class="bi bi-plus-square"></i><span>Create Event</span>
             </a>
         </li>

         <li class="{{ Request::is('admin/events') ? 'active' : '' }}">
             <a href="{{ route('admin.events.index') }}">
                 <i class="zmdi zmdi-format-list-bulleted"></i> <span>Daftar Events</span>
             </a>
         </li>

         <li class="{{ Request::is('admin/events/report') ? 'active' : '' }}">
             <a href="{{ route('admin.events.report') }}">
                 <i class="bi bi-journal-text"></i> <span>Laporan</span>
             </a>
         </li>




     </ul>
     <ul>

     </ul>


 </div>
 <!--End sidebar-wrapper-->

 <!--Start topbar header-->
 <header class="topbar-nav">
     <nav class="navbar navbar-expand fixed-top">
         <ul class="navbar-nav mr-auto align-items-center">
             <li class="nav-item">
                 <a class="nav-link toggle-menu" href="javascript:void();">
                     <i class="icon-menu menu-icon"></i>
                 </a>
             </li>
         </ul>

         <ul class="navbar-nav align-items-center right-nav-link">
             <li class="nav-item">

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                     @csrf
                     <button type="submit" class="btn btn-outline-danger w-100 text-white">Logout</button>
                 </form>
             </li>

         </ul>
         </li>
         </ul>
     </nav>
 </header>
 <!--End topbar header-->
 @include('vendor.sweetalert')
