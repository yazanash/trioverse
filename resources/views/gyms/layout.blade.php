<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrioVerse - Dashboard</title>
    
    <!-- BOOTSTRAP STYLE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <!-- CSS FILE -->
    <link rel="stylesheet" href="public/css/index.min.css">

    <style>
      html{
        font-size: 12px;
      }
      body{
        background-color: #FBFEFD;
      }
      main .icon{
        font-size: 2rem;
       color: #fff;
        background-color: var(--icon-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
      }
      .card{
        border: none;
        border-radius: 20px;
      }
     
    </style>
</head>
<body >
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light px-5 shadow fs-4" aria-label="Main navigation">
      <div class="container-fluid ">
        <a class="navbar-brand" href="#"><img src="public/assets/trio-logo.png" width="50" height="50" alt=""></a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="navbar-collapse offcanvas-collapse bg-light  " id="navbarsExampleDefault">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Licenses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Plans</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Offers</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                User Name
              </a>
              <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Account</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="public/js/index.js"></script>
</body>
</html>