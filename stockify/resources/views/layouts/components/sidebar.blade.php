@php
  $menus = [
    (object)[
      "title" => "Dashboard",
      "path" => "/",
      "icon" => "fas fa-th",
      ],
      (object)[
      "title" => "Category",
      "path" => "categories",
      "icon" => "fas fa-th",
      ],
      (object)[
      "title" => "Material",
      "path" => "materials",
      "icon" => "fas fa-th",
      ],
      (object)[
      "title" => "Transaction",
      "path" => "stock-transactions",
      "icon" => "fas fa-th",
      ],
  ];

  if (auth()->check() && auth()->user()->role === 'admin') 
  {
    $menus[] = (object)[
      "title" => "User",
      "path" => "users",
      "icon" => "fas fa-users",
      ];
  }

  // Supplier menu can be accessed by all roles
  if (auth()->check()) {
      $menus[] = (object)[
        "title" => "Supplier",
        "path" => "suppliers",
        "icon" => "fas fa-truck",
      ];
  }

  if (auth()->check() && auth()->user()->role === 'admin' || auth()->check() && auth()->user()->role === 'manager') 
  {
    $menus[] = (object)[
      "title" => "Report",
      "path" => "reports",
      "icon" => "fas fa-users",
      ];
  }

@endphp



<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('templates/index3.html') }}" class="brand-link">
      <img src="{{ asset('templates/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">StockifyV1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('templates/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @foreach ($menus as $menu)
          <li class="nav-item">
            <a href="{{ $menu->path[0] !== '/' ? '/' . $menu->path : $menu->path }}" class="nav-link {{ request()->path() === $menu->path ? 'active' : '' }}">
              <i class="nav-icon {{ $menu->path }}"></i>
              <p>
                {{ $menu->title}}
                {{-- <span class="right badge badge-danger">New</span>--}}
              </p>
            </a>
          </li>
        @endforeach
        
        </ul>
      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>