<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $treeMenu }} || General Affair</title>

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
          rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('mazer/css/bootstrap.css') }}">

     <link rel="stylesheet" href="{{ asset('mazer/vendors/iconly/bold.css') }}">

     <link rel=" stylesheet" href="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
     <link rel="stylesheet" href="{{ asset('mazer/vendors/bootstrap-icons/bootstrap-icons.css') }}">
     <link rel="stylesheet" href="{{ asset('mazer/css/app.css') }}">
     <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
     @yield('css')
</head>

<body>
     <div id="app">
          <div id="main" class="layout-horizontal">
               <header class="mb-5">
                    <div class="header-top">
                         <div class="container">
                              <div class="logo">
                                   <a href="index.html">General Affair</a>
                              </div>
                              <div class="header-top-right">

                                   <!-- Burger button responsive -->
                                   <a href="#" class="burger-btn d-block d-xl-none">
                                        <i class="bi bi-justify fs-3"></i>
                                   </a>
                              </div>
                         </div>
                    </div>
                    <nav class="main-navbar">
                         <div class="container">
                              <ul>
                                   <li class="menu-item  ">
                                        <a href="{{ url('/') }}" class='menu-link'>
                                             <i class="bi bi-grid-fill"></i>
                                             <span>Home</span>
                                        </a>
                                   </li>
                                   <li class="menu-item active has-sub">
                                        <a href="#" class='menu-link'>
                                             <i class="bi bi-grid-1x2-fill"></i>
                                             <span>Master Data</span>
                                        </a>
                                        <div class="submenu ">
                                             <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                             <div class="submenu-group-wrapper">
                                                  <ul class="submenu-group">
                                                       <li class="submenu-item  ">
                                                            <a href="{{ route('store.index') }}"
                                                                 class='submenu-link'>Stores</a>
                                                       </li>
                                                       <li class="submenu-item  ">
                                                            <a href="{{ route('inventory.index') }}"
                                                                 class='submenu-link'>Inventories</a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </li>
                                   <li class="menu-item active has-sub">
                                        <a href="#" class='menu-link'>
                                             <i class="bi bi-grid-1x2-fill"></i>
                                             <span>Stock</span>
                                        </a>
                                        <div class="submenu ">
                                             <div class="submenu-group-wrapper">
                                                  <ul class="submenu-group">
                                                       <li class="submenu-item  ">
                                                            <a href="{{ route('income.index') }}"
                                                                 class='submenu-link'>Barang Masuk</a>
                                                       </li>
                                                       <li class="submenu-item  ">
                                                            <a href="{{ route('outcome.index') }}"
                                                                 class='submenu-link'>Barang Keluar</a>
                                                       </li>
                                                  </ul>
                                             </div>
                                        </div>
                                   </li>
                              </ul>
                         </div>
                    </nav>
               </header>

               <div class="content-wrapper container-fluid">
                    <div class="page-content">
                         {{ $slot }}
                    </div>
               </div>
          </div>
     </div>
     <script src="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
     <script src="{{ asset('mazer/js/bootstrap.bundle.min.js') }}"></script>
     <script src="{{ asset('mazer/js/mazer.js') }}"></script>
     @yield('javascript')
</body>

</html>