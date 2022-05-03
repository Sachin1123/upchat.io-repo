
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link Brand-Logo">
      <img src="{{URL::asset('dist/img/22.png')}}" alt="Logo" class="logo">


      <!-- <span class="brand-text font-weight-light">Upchat.io</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(!empty(Auth::user()->profile))
          <img class="img-circle elevation-2"
                  src="{{asset('images/profile/'.Auth::user()->profile)}}"
                  alt="User profile">
          @else
          <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ !empty(auth()->user()->name) ? auth()->user()->name : 'Admin' }}</a>
        </div>
      </div>




      <!-- Sidebar Menu -->
      <nav class="mt-2 SidebarSet">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="{{url('customer/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('customer-leads.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Leads
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{route('customer-contacts.index')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Contacts
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{route('customer-service-tickets.index')}}" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt" aria-hidden="true"></i>

              <p>
                 Service Tickets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer-reports.index')}}" class="nav-link">

            <i class="nav-icon fa fa-file" aria-hidden="true"></i>
              <p>
                 Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer-profile.index')}}" class="nav-link">
            <i class="nav-icon fa fa-user" aria-hidden="true"></i>
              <p>
                 Profile
              </p>
            </a>
          </li>
             <li class="nav-item">
        <a href="{{url('logout')}}" class="nav-link logout">
          <i class="nav-icon fas fa-arrow-circle-right" aria-hidden="true"></i>
          <p > Logout </p>
        </a>
      </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
