<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | Consultant</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.6/dist/sweetalert2.all.min.js" integrity="sha256-cPAjH3qcCfJYMWZtmUXU13lT9v4SqTdjk+N7KamTlOc=" crossorigin="anonymous"></script>

        <!-- Our Custom CSS -->
<link rel="stylesheet" href="style2.css">
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

        <style>


        .sidebar-container {
          position: fixed;
          width: 220px;
          height: 100%;
          left: 0;
          overflow-x: hidden;
          overflow-y: auto;
          background: #1a1a1a;
          color: #fff;
        }

        .content-container {
          padding-top: 20px;
        }

        .sidebar-logo {
          padding: 10px 15px 10px 30px;
          font-size: 20px;
          background-color: #2574A9;
        }

        .sidebar-navigation {
          padding: 0;
          margin: 0;
          list-style-type: none;
          position: relative;
        }

        .sidebar-navigation li {
          background-color: transparent;
          position: relative;
          display: inline-block;
          width: 100%;
          line-height: 20px;
        }

        .sidebar-navigation li a {
          padding: 10px 15px 10px 30px;
          display: block;
          color: #fff;
        }

        .sidebar-navigation li .fa {
          margin-right: 10px;
        }

        .sidebar-navigation li a:active,
        .sidebar-navigation li a:hover,
        .sidebar-navigation li a:focus {
          text-decoration: none;
          outline: none;
        }

        .sidebar-navigation li::before {
          background-color: #2574A9;
          position: absolute;
          content: '';
          height: 100%;
          left: 0;
          top: 0;
          -webkit-transition: width 0.2s ease-in;
          transition: width 0.2s ease-in;
          width: 3px;
          z-index: -1;
        }

        .sidebar-navigation li:hover::before {
          width: 100%;
        }

        .sidebar-navigation .header {
          font-size: 12px;
          text-transform: uppercase;
          background-color: #151515;
          padding: 10px 15px 10px 30px;
        }

        .sidebar-navigation .header::before {
          background-color: transparent;
        }

        .content-container {
          padding-left: 220px;
        }

        </style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>
    <body>
    <div class="wrapper">
      @include('sweetalert::alert')
    <!-- Sidebar -->
      <nav id="sidebar">
      <div class="sidebar-container">
        <div class="sidebar-logo">
          {{Auth::user()->eid}}

          <br>
          <small>
            {{Auth::user()->name}}
            <br>
            {{Auth::user()->assignments->modul_id}} - {{Auth::user()->assignments->submodul_id}}
          </small>
        </div>
        <ul class="sidebar-navigation">
          <li class="header"></li>
          <li>
            <a href="/overview">
              <i class="fa fa-tachometer" aria-hidden="true"></i> Overview
            </a>
          </li>
          <li>
            <a href="/ticket">
              <i class="fa fa-ticket" aria-hidden="true"></i> Ticket
            </a>
          </li>
          {{-- <li class="header">Ticket</li>

          <li>
            <a href="/client">
              <i class="fa fa-building-o" aria-hidden="true"></i> Working
            </a>
          </li>
          <li>
            <a href="/module">
              <i class="fa fa-folder" aria-hidden="true"></i></i> Closed
            </a>
          </li> --}}
          <li class="header">Account</li>
          <li>
            <a href="/settings">
              <i class="fa fa-cogs" aria-hidden="true"></i> Settings
            </a>
          </li>
          <li>
            <a href="/logout">
              <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
            </a>
          </li>
        </ul>
      </div>

      <div class="content-container">
        <div class="container-fluid">
          <div class="row justify-content-center">
            @yield('content')
          </div>
        </div>
      </div>

      @stack('script')
      <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    </body>
</html>
