<?php 
use App\Models\User;
// use Auth;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="styles/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">
           {{-- {{Auth::User->name}}   --}}
      {{-- </span> --}}
    {{-- </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admintemplate/no_avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> Wellcome Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link  active">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link ">
              <i class="fas fa-bars"></i>
              <p  class="ml-1">
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('category')}}" class="nav-link">
                  <i class="fa fa-list-alt"></i>
                  <p class="ml-1">Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('product')}}" class="nav-link">
                  <i class="fa fa-product-hunt" aria-hidden="true"></i>
                  <p class="ml-1">Products</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('users')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <p class="ml-1">Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('roles')}}" class="nav-link">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <i class="fa fa-lock" aria-hidden="true"></i>
                  <p class="ml-1">Roles</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>