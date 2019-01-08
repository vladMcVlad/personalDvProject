@extends('layouts.app')

@section('title', 'Time Distribution of UFO Observations')

@section('content')
    <h1 class="centerContent">Distribution of the Sightings Over the Years</h1>

    <p class="centerContent biggerText">The dataset concerns sightings for a period of a
        hundredish years, it will be interesting to see how are the records distributed.</p>

    <h3 class="centerContent"> Question: What is the distribution of the records over time?</h3>

    <div id="distributionOfYears"></div>

    <p class="centerContent biggerText">
        Above you can see the amount of records of sightings per year. Originally the dataset was going to the middle of
        2014, but that caused a weird sudden drop after a very plentyful start of the year, so it was spoiling the
        accuracy of the graph. This is why I have cut it short to jsut 2013.
        <br>
        I personally would have expected that the spike would have probably been somewhere during the Cold War and then
        perhaps around the late '80s and '90s. There is are actual minor surges between '64 and the early '80s, but it
        seems that the numbers have really ramped up only after the early '90s and they have been really soaring in the
        recent years. This could be simply because of people's improved ability to report and document a sighting. Or
        people got wilder imaginations thanks to the X-Files, Alien and the likes.
        <br>
        Whatever the reason, sadly, no full HD alien sighting videos seem to have come up as result of the recent
        spikes, though. </p>


    <div class="mapcontainer">
        <div class="map">
            <span>Map is loading, please give it a bit...</span>
        </div>
    </div>

    <p class="centerContent biggerText">On this map you can play around (even if it is just a bit) with the years and
        see when and where has there been a reported sighing. Just a heads up, thing might get slightly laggy during the
        last few years, where there have been more reports.</p>

    <div class="slidecontainer">
        <input type="range" min="1925" max="2013" value="1970" class="slider" id="yearSliderAllRecords">
        <p>Selected year: <span id="demo"></span></p>

    </div>

    <div id="distributionOfDays"></div>

    <p class="centerContent biggerText">And a fun little bit - how many observations have been made (in total)
        for every day of the week. Apparently the least sightings have been recorded on Mondays, and the most - on
        Saturdays, with a general higher number of total reprots for the whole weekend. Guess no one looks up to the sky
        after a nasty Monday and people's imagination tends to go wild after an evening of scary movies, a bit of
        boredom or maybe a glass or two.
        <br>
        If you have followed my advice, you have yet to see <a href="{{ route('playground') }}">the page about the
            different types of UFOs</a>.</p>

    <script type="text/javascript">
        //draw the yearly distribution chart
        var yearlyDistributionArray =
                {!! json_encode($yearlyRecordNumbers) !!}

        var data = []
        $.each(yearlyDistributionArray, function (key, value) {
            data.push({"Year": key, "Records": value});
        });

        var svg = dimple.newSvg("#distributionOfYears", "100%", 400);

        var chart = new dimple.chart(svg, data);
        var x = chart.addCategoryAxis("x", "Year");
        x.addOrderRule("Date");
        chart.addMeasureAxis("y", "Records");
        chart.addSeries(null, dimple.plot.line);
        chart.draw();

        //slider magic
        var slider = document.getElementById("yearSliderAllRecords");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value;

        slider.oninput = function () {
            output.innerHTML = this.value;

            drawTheMapWithUSSightings();

        }

        //draw the map
        var allUfos = {!! json_encode($usRows) !!};

        function filterPointsToDrawByYear() {
            var pointsToPlot = [];

            for (i = 0; i < allUfos.length; i++) {
                if (allUfos[i][1].substring(6, 10) == slider.value) {
                    pointsToPlot.push({
                        type: "circle",
                        size: 3,
                        latitude: allUfos[i][10],
                        longitude: allUfos[i][11],
                        tooltip: {content: "<span style=\"font-weight:bold;\">City: </span>" + allUfos[i][2][0].toUpperCase() + allUfos[i][2].slice(1) + " <br /> Date: " + allUfos[i][1]},
                    })
                }
            }

            return pointsToPlot;
        }


        function drawTheMapWithUSSightings() {
            var pointsToDraw = filterPointsToDrawByYear();

            $(".mapcontainer").mapael({
                map: {
                    name: "world_countries"
                    , zoom: {
                        enabled: true,
                        maxLevel: 10,
                        init: {
                            latitude: 43.717079,
                            longitude: -100.00116,
                            level: 6
                        }
                    }
                    // Set default plots and areas style
                    , defaultPlot: {
                        attrs: {
                            fill: "#004a9b"
                            , opacity: 0.6
                        }
                        , attrsHover: {
                            opacity: 1
                        }
                        , text: {
                            attrs: {
                                fill: "#505444"
                            }
                            , attrsHover: {
                                fill: "#000"
                            }
                        }
                    }
                    , defaultArea: {
                        attrs: {
                            fill: "#f4f4e8"
                            , stroke: "#ced8d0"
                        }
                        , attrsHover: {
                            fill: "#a4e100"
                        }
                        , text: {
                            attrs: {
                                fill: "#505444"
                            }
                            , attrsHover: {
                                fill: "#000"
                            }
                        }
                    }
                },

                // Add some plots on the map
                plots: pointsToDraw
            });
        }

        drawTheMapWithUSSightings();

        var dailyRecords = {!! json_encode($perDayCounter) !!};

        var svg = dimple.newSvg("#distributionOfDays", "100%", 600);
        var data = [
            {"Day": "Monday", "Records": dailyRecords[0]},
            {"Day": "Tuesday", "Records": dailyRecords[1]},
            {"Day": "Wednesday", "Records": dailyRecords[2]},
            {"Day": "Thursday", "Records": dailyRecords[3]},
            {"Day": "Friday", "Records": dailyRecords[4]},
            {"Day": "Saturday", "Records": dailyRecords[5]},
            {"Day": "Sunday", "Records": dailyRecords[6]}

        ];
        var chart = new dimple.chart(svg, data);
        var x = chart.addCategoryAxis("x", "Day");
        x.addOrderRule(["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]);
        chart.addMeasureAxis("y", "Records");
        chart.addSeries(null, dimple.plot.bar);
        chart.draw();

    </script>
@endsection