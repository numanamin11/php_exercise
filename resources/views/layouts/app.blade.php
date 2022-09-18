<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Test - @yield('title')</title>
      <link href="css/styles.css" rel="stylesheet" />
      <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
      @yield('css')
   </head>
   <body>
      <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
         <!-- Navbar Brand-->
         <a class="navbar-brand ps-3" href="{{ route('home') }}">PHP Exercise</a>
      </nav>
      <div id="layoutSidenav">
         <div id="layoutSidenav_content">
            <main>
               @yield('content')
            </main>
            <footer class="py-4 bg-light mt-auto">
               <div class="container-fluid px-4">
                  <div class="d-flex align-items-center justify-content-between small">
                  </div>
               </div>
            </footer>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
      @yield('scripts')
   </body>
</html>