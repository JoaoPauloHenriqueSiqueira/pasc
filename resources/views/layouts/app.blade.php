  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Clients/Debts Panel</title>

    <!-- Lato Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/gallery-materialize.min.opt.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}" />

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
      .grid-item {
        width: 250px;
        margin: 5px;
      }


      .modal-content {
        height: 100% !important;
      }

      .material-tooltip {
        background-color: purple;
      }
    </style>

  </head>

  <body class="vsc-initialized">

    <!-- Navbar and Header -->
    <nav class="nav-extended ao darken-1">
      <div class="nav-background">
        <div class="ea k"></div>
      </div>
      <div class="nav-wrapper db">
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="bt hide-on-med-and-down">
          <li>
            <a class="white-text" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
              Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>

        </ul>
        <!-- Dropdown Structure -->

        <div class="nav-header de">
          <h1>
          <img src="https://www.labspaschoalotto.com.br/assets/images/logotipo-labs-paschoalotto-2-384x194.png">
          </h1>
        </div>
      </div>
    </nav>
    <ul class="side-nav" id="nav-mobile" style="transform: translateX(-100%);">
    </ul>

    <div id="portfolio" class="cx gray">
      <div class="db">
        <div class="b e messages grid">
          @yield('content')
        </div>
      </div>
    </div><!-- /.container -->



    <!-- Core Javascript -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>


    <script>
      $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 50
      });


      $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        onOpenEnd: function(modal, trigger) {
          var d = $('.modal-content');
          d.scrollTop(d.prop("scrollHeight")); // Callback for Modal open. Modal and trigger parameters available.
        },
        onCloseEnd: function() { // Callback for Modal close
          $(".debtsClients").empty();
          $("#total").text("Total ");
        }
      });
    </script>

  </html>