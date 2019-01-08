<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <style type="text/css">
        .centerContent {
            text-align: center;
            color: #636b6f;
        }

        .biggerText {
            font-size: 17px;
        }

        h1 {
            color: #636b6f;
        }

        /* Specific mapael css class are below
         * 'mapael' class is added by plugin
        */

        .mapael .map {
            position: relative;
        }

        /* Reset Zoom button first */
        .mapael .zoomReset {
            top: 10px;
        }

        /* Then Zoom In button */
        .mapael .zoomIn {
            top: 30px;
        }

        /* Then Zoom Out button */
        .mapael .zoomOut {
            top: 50px;
        }

        .mapael .mapTooltip {
            position: absolute;
            background-color: #fff;
            moz-opacity: 0.70;
            opacity: 0.70;
            filter: alpha(opacity=70);
            border-radius: 10px;
            padding: 10px;
            z-index: 1000;
            max-width: 200px;
            display: none;
            color: #343434;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"
            charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js" charset="utf-8"></script>
    <script src="../../js/jquery.mapael.js" charset="utf-8"></script>
    <script src="../../js/maps/france_departments.js" charset="utf-8"></script>
    <script src="../../js/maps/world_countries.js" charset="utf-8"></script>
    <script src="../../js/maps/usa_states.js" charset="utf-8"></script>
    <script src="http://d3js.org/d3.v4.min.js"></script>
    <script src="http://dimplejs.org/dist/dimple.v2.3.0.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="../../css/all.css">


</head>
<body>
    <header id="header"
            style="  border-bottom: 1px;  border-bottom-style: solid;	  border-bottom-color: #636b6f; margin-bottom:1px;">
        <div class="container">
            <nav id="nav">

                <div class="nav-drop">
                    <ul>
                        <li><a href="{{ route('home') }}"
                               style="color: #636b6f; padding: 0 25px; font-size: 12px;  font-weight: 600;  letter-spacing: .1rem; text-decoration: none;
                               text-transform: uppercase;">Home</a>
                        </li>
                        <li><a href="{{ route('geoDistribution') }}"
                               style="color: #636b6f; padding: 0 25px; font-size: 12px;  font-weight: 600;  letter-spacing: .1rem; text-decoration: none;
                               text-transform: uppercase;">Geo Record Distribution</a>
                        </li>
                        <li><a href="{{ route('densityVsArea') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;
            text-decoration: none;  text-transform: uppercase;">Population Density vs State Area</a></li>
                        <li><a href="{{ route('timeDistribution') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;            text-decoration: none;            text-transform: uppercase;">
                                Distribution Over Time</a>
                        </li>
                        <li><a href="{{ route('playground') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;            text-decoration: none;            text-transform: uppercase;">Shapes</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <div class="container" style="margin-top: 115px">
        @yield('content')
    </div>

    <footer id="footer"
            style="border-top: 1px;  border-top-style: solid;	  border-top-color: #636b6f;">
        <div class="container">
            <nav id="nav">

                <div class="nav-drop">
                    <ul>
                        <li><a href="{{ route('home') }}"
                               style="color: #636b6f; padding: 0 25px; font-size: 12px;  font-weight: 600;  letter-spacing: .1rem; text-decoration: none;
                               text-transform: uppercase;">Home</a>
                        </li>
                        <li><a href="{{ route('geoDistribution') }}"
                               style="color: #636b6f; padding: 0 25px; font-size: 12px;  font-weight: 600;  letter-spacing: .1rem; text-decoration: none;
                               text-transform: uppercase;">Geo Record Distribution</a>
                        </li>
                        <li><a href="{{ route('densityVsArea') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;
            text-decoration: none;  text-transform: uppercase;">Population Density vs State Area</a></li>
                        <li><a href="{{ route('timeDistribution') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;            text-decoration: none;            text-transform: uppercase;">
                                Distribution Over Time</a>
                        </li>
                        <li><a href="{{ route('playground') }}" style="color: #636b6f;
            padding: 0 25px; font-size: 12px; font-weight: 600; letter-spacing: .1rem;            text-decoration: none;            text-transform: uppercase;">Shapes </a>
                        </li>
                </div>
            </nav>
        </div>
    </footer>

</body>
</html>