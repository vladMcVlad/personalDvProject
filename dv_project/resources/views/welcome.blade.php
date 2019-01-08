<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .subtitle {
            font-size: 60px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links {
            border-top-bottom: 1px;
            border-top-style: solid;
            border-top-color: #636b6f;
            border-bottom: 1px;
            border-bottom-style: solid;
            border-bottom-color: #636b6f;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .bigMarginBot {
            margin-bottom: 60px;
        }

        .introText > p {
            font-size: 17px;
            color: #636b6f;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height" style="page-break-after: always;">
        <div class="content">
            <div class="title m-b-md">
                Recorded UFO Sightings<br>Over the Course of the Last Century
            </div>
            <div class="subtitle bigMarginBot">
                Personal DV Project<br>Vladimir Katrandzhiev, 371829
            </div>

            <div class="links">
                <a href="#intro">Introduction</a>
                <a href={{ route('geoDistribution') }}>Geo Record Distribution</a>
                <a href={{ route('densityVsArea') }}>Population Density vs State Area</a>
                <a href={{ route('timeDistribution') }}>Record Distribution Over Time</a>
                <a href={{ route('playground') }}>Shapes of UFOs</a>
                <a href={{ route('allRecordsTable') }}>Table With All Records</a>

            </div>
        </div>
    </div>

    <div class="introText" style="margin-left: 10%; margin-right: 10%; page-break-after: always; margin-bottom: 250px">
        <h1 id="intro">Introduction</h1>
        <p>This website is created as my submission for our Data Visualisation
            personal project.</p>
        <p>When we initally got the assignment, quite honestly, I was definitely
            not expecting to end up doing a project about UFOs. I actually had in
            mind focusing on something in a similar area, but still quite different -
            records about falling stars and the likes. I was curious to see
            where were they most observed and dwell into some relations such as
            light pollution and others. Well. It turns out people only record falling
            stars only after they have fallen and debris from the said stars have been
            located on the ground. This frankly did not sound too interesting to me and
            after some head scratching I arrived here - at a project about UFOs.</p>
        <p>I ended up using more than one dataset, the main one being
            <a href=" https://www.kaggle.com/NUFORC/ufo-sightings">this</a> one, kindly provided
            by Kaggle. The list has quite a bit of entries with different kinds of information.
            That's why it needed a bit of cleaning to compensate for missing values,
            inconsistent formatting of values and others, but those were fixable. More about the
            other datasets - when we get to them.</p>
        <p>In the content of this page, you will be able to see some graphs showing different
            observations and relations about UFO sightings, mostly above the United States. Various
            graph types have been used and I hope I have managed to acheive sufficient readability
            through them. The graph libraries used were
            <a href="https://www.vincentbroute.fr/mapael/">jQuery Mapael</a> for the maps and
            <a href="http://dimplejs.org/index.html">dimple</a> for pretty much the rest.
        </p>
        <p>Anyway, enough technical talk - follow the links to any of the other pages to proceed
            to the actual visualizations. I would recommend starting with the <a href={{ route('geoDistribution') }}>Geographical
                Record Distribution</a>. Also, just a heads up - some pages take a bit longer to load because of the
            size of the datasets displayed, please be patient when necessary. :)</p>

        <div class="content">
            <div class="links">
                <a href={{ route('geoDistribution') }}>Geo Record Distribution</a>
                <a href={{ route('densityVsArea') }}>Population Density vs State Area</a>
                <a href={{ route('timeDistribution') }}>Record Distribution Over Time</a>
                <a href={{ route('playground') }}>Shapes of UFOs</a>
                <a href={{ route('allRecordsTable') }}>Table With All Records</a>
            </div>
        </div>
    </div>


</body>
</html>
