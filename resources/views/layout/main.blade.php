<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard - Mazer Admin Dashboard</title>

     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
          rel="stylesheet">
     <link rel="stylesheet" href="./mazer/css/bootstrap.css">

     <link rel="stylesheet" href="./mazer/vendors/iconly/bold.css">

     <link rel="stylesheet" href="./mazer/vendors/perfect-scrollbar/perfect-scrollbar.css">
     <link rel="stylesheet" href="./mazer/vendors/bootstrap-icons/bootstrap-icons.css">
     <link rel="stylesheet" href="./mazer/css/app.css">
     <link rel="shortcut icon" href="./mazer/images/favicon.svg" type="image/x-icon">
     @yield('css')
</head>

<body>
     <div id="app">
          <div id="sidebar" class="active">
               <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                         <div class="d-flex justify-content-between">
                              <div class="logo">
                                   <a href="index.html">General Affair</a>
                              </div>
                              <div class="toggler">
                                   <a href="{{ url('/') }}" class="sidebar-hide d-xl-none d-block"><i
                                             class="bi bi-x bi-middle"></i></a>
                              </div>
                         </div>
                    </div>
                    <div class="sidebar-menu">
                         <ul class="menu">
                              <li class="sidebar-title">Menu</li>
                              {{ $subMenu; }}
                              <li class="sidebar-item {{ $treeMenu=='home'?'active':''; }} ">
                                   <a href="{{ url('/') }}" class='sidebar-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Home</span>
                                   </a>
                              </li>

                              <li class="sidebar-item {{ $treeMenu=='master'?'active':''; }} has-sub">
                                   <a href="#" class='sidebar-link'>
                                        <i class="bi bi-stack"></i>
                                        <span>Master Data</span>
                                   </a>
                                   <ul class="submenu" style="display: {{ $treeMenu=='master'?'block':'none'; }}">
                                        <li class="submenu-item {{ $subMenu=='store'?'active':''; }}">
                                             <a href="{{ route('store.index') }}">Stores</a>
                                        </li>
                                        <li class="submenu-item {{ $subMenu=='inventory'?'active':''; }}">
                                             <a href="{{ route('inventory.index') }}">Inventories</a>
                                        </li>
                                   </ul>
                              </li>

                              <li class="sidebar-title">Pages</li>

                              <li class="sidebar-item  ">
                                   <a href="application-email.html" class='sidebar-link'>
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Email Application</span>
                                   </a>
                              </li>

                              <li class="sidebar-item  ">
                                   <a href="application-chat.html" class='sidebar-link'>
                                        <i class="bi bi-chat-dots-fill"></i>
                                        <span>Chat Application</span>
                                   </a>
                              </li>

                              <li class="sidebar-item  ">
                                   <a href="application-gallery.html" class='sidebar-link'>
                                        <i class="bi bi-image-fill"></i>
                                        <span>Photo Gallery</span>
                                   </a>
                              </li>

                              <li class="sidebar-item  ">
                                   <a href="application-checkout.html" class='sidebar-link'>
                                        <i class="bi bi-basket-fill"></i>
                                        <span>Checkout Page</span>
                                   </a>
                              </li>
                         </ul>
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
               </div>
          </div>
          <div id="main">
               <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                         <i class="bi bi-justify fs-3"></i>
                    </a>
               </header>

               <div class="page-heading d-flex">
                    <div class="dropdown ms-auto">
                         <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                              <div class="user-menu d-flex">
                                   <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600">John Ducky</h6>
                                        <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                   </div>
                                   <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                             <img src="./mazer/images/faces/1.jpg">
                                        </div>
                                   </div>
                              </div>
                         </a>
                         <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                              <li>
                                   <h6 class="dropdown-header">Hello, John!</h6>
                              </li>
                              <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i>Ganti
                                        Password</a></li>
                              <li><a class="dropdown-item" href="#"><i
                                             class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a></li>
                         </ul>
                    </div>
               </div>

               <section class="maincontent">
                    {{ $slot }}
               </section>
          </div>
     </div>
     <script src="./mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
     <script src="./mazer/js/bootstrap.bundle.min.js"></script>
     <script src="./mazer/js/mazer.js"></script>
     @yield('javascript')
</body>

</html>