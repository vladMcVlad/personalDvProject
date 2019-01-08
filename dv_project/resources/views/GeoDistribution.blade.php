@extends('layouts.app')

@section('title', 'Geographical Distribution of UFO Observations')

@section('content')
    <h1 class="centerContent">Geographical Distribution of the Sightings</h1>

    <div class="mapcontainer" style="display: flex">
        <div class="map" style="flex: 1;">
            <span>Map is loading, please give it a bit...</span>
        </div>
        <div class="areaLegend" style="width: 50px;">
            <span></span>
        </div>
    </div>

    <p class="centerContent biggerText">As it is readily visible on the above map, representing how many sightings of
        UFOs
        have been recorded over the years over a number of countries, most of the data on hand relates
        to the USA and the difference between the States and the rest of the world
        is huge. This is why I will be focusing my observations solely on these records.</p>

    <div id="countriesBarChart"></div>

    <p class="centerContent biggerText">The above bar char displays the huge difference in the number
        of records in a different light.</p>
    <br>
    <p class="centerContent biggerText">Since our focus will be falling on the States,
        might as well look into the the numbers of records for every single state.</p>

    <div class="mapcontainerUSA" style="display: flex">
        <div class="map" style="flex: 1;">
            <span>Map is loading, please give it a bit...</span>
        </div>
        <div class="areaLegend" style="width: 50px;">
            <span></span>
        </div>
    </div>

    <p class="centerContent biggerText">The map displays the number of sightings per state in the USA.</p>

    <p class="centerContent biggerText">The most clearly visible outlier is California, which has more than twice as
        many sightings compared to any other
        state. There is a tendency where all the highest ranking states seem to be border states and mostly bordering
        big water entities. Such are the Pacific Ocean, The Atlantic Ocean and the Gulf of Mexico and the Michigan
        Lakes. I also find it interesting that there hardly seems to be any relation between neighboring states. For
        example, California is the state with the highest sighting ratio and its adjacent Nevada has a pretty low-ish
        record count.</p>


    <div id="statesBarChart"></div>



    <p class="centerContent biggerText"> The above bar puts an emphasis on how much of an outlier California is. It is
        easy to see that it has more than two times the amount of records of the second state.
        <br>
        This brings me to the next set of questions: Is there a factor, such as
        population or geographical size, which makes a state more likely to have a lot of observations? Is there a
        relation between the population density in a state and the number of records? Is there a relation between the
        area of a state and the number of records? If there are such relations, which is the stronger one?
        <br>
        I would recommend moving on to <a href="{{ route('densityVsArea') }}" >Population Density vs State Area</a>, but
        feel free to explore at will.
    </p>



    <script type="text/javascript">
        var countries = {!! json_encode($countryNames) !!};
        var recordsPerCountry = {!! json_encode($perCountryCounter) !!};
        var barChartData = []
        //draw countries bar chart
        for (i = 0; i < countries.length; i++) {
            barChartData.push({"Country": countries[i], "Records": recordsPerCountry[i]});
        }

        var svg = dimple.newSvg("#countriesBarChart", "100%", 600);

        var chart = new dimple.chart(svg, barChartData);
        var x = chart.addCategoryAxis("x", "Country");
        chart.addMeasureAxis("y", "Records");
        chart.addSeries(null, dimple.plot.bar);
        chart.draw();

        //draw countries map
        var countriesToPlot = {
            "AU": {
                "value": recordsPerCountry[0],
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + countries[0] + "<\/span><br \/>Records : " + recordsPerCountry[0]
                }
            },
            "CA": {
                "value": recordsPerCountry[1],
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + countries[1] + "<\/span><br \/>Records : " + recordsPerCountry[1]
                }
            },
            "DE": {
                "value": recordsPerCountry[2],
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + countries[2] + "<\/span><br \/>Records : " + recordsPerCountry[2]
                }
            },
            "GB": {
                "value": recordsPerCountry[3],
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + countries[3] + "<\/span><br \/>Records : " + recordsPerCountry[3]
                }
            },
            "US": {
                "value": recordsPerCountry[4],
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + countries[4] + "<\/span><br \/>Records : " + recordsPerCountry[4]
                }
            }
        };
        $(function () {
            $(".mapcontainer").mapael({
                map: {
                    name: "world_countries",
                    zoom: {
                        enabled: true,
                        maxLevel: 10
                    },
                    defaultArea: {
                        attrs: {
                            fill: "#f4f4e8",
                            stroke: "#ced8d0",
                            "stroke-width": 1
                        }
                    }
                },
                /* attrs will be applied to legend AND map elements whereas legendSpecificAttrs will onlybe applied to legend elements */
                legend: {
                    area: {
                        title: "Countries records",
                        slices: [
                            {
                                max: 100,
                                attrs: {
                                    fill: "#6aafe1"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Less than 100 records"
                            },
                            {
                                min: 100,
                                max: 1000,
                                attrs: {
                                    fill: "#459bd9"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 100 and 1000 records"
                            },
                            {
                                min: 1000,
                                max: 2000,
                                attrs: {
                                    fill: "#2579b5"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 1000 and 2000 records"
                            },
                            {
                                min: 2000,
                                max: 3000,
                                attrs: {
                                    fill: "#1a527b"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 2000 and 3000 records"
                            },
                            {
                                min: 3000,
                                max: 10000,
                                attrs: {
                                    fill: "#144366"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 3000 and 10000 records"
                            }, {
                                min: 10000,
                                attrs: {
                                    fill: "#132b51"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "More than 10000 records"
                            }
                        ]
                    },
                },
                areas: countriesToPlot

            });
        });

        //draw states map
        var usStates = {!! json_encode($statesAndCounts) !!};

        var statesToPlot = [];
        var barChartData = [];
        $.each(usStates, function (key, value) {
            statesToPlot[key.toUpperCase()] = {
                "value": value,
                "attrs": {
                    "href": "#"
                },
                "tooltip": {
                    "content": "<span style=\"font-weight:bold;\">" + key + "<\/span><br \/>Records : " + value
                },
                "text": {
                    "content": value
                }
            }

            barChartData.push({"State": key, "Records": value});
        });

        $(function () {
            $(".mapcontainerUSA").mapael({
                map: {
                    name: "usa_states",
                    zoom: {
                        enabled: true,
                        maxLevel: 10
                    },
                    defaultArea: {
                        attrs: {
                            fill: "#f4f4e8",
                            stroke: "#ced8d0",
                            "stroke-width": 1
                        }
                    }
                },
                /* attrs will be applied to legend AND map elements whereas legendSpecificAttrs will onlybe applied to legend elements */
                legend: {
                    area: {
                        title: "State records",
                        slices: [
                            {
                                max: 1000,
                                attrs: {
                                    fill: "#7fb4db"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Less than 100 records"
                            },
                            {
                                min: 1000,
                                max: 2000,
                                attrs: {
                                    fill: "#459bd9"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 100 and 1000 records"
                            },
                            {
                                min: 2000,
                                max: 3000,
                                attrs: {
                                    fill: "#1f679b"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 1000 and 2000 records"
                            },
                            {
                                min: 3000,
                                max: 4000,
                                attrs: {
                                    fill: "#1a527b"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "Between 2000 and 3000 records"
                            }, {
                                min: 4000,
                                attrs: {
                                    fill: "#132b51"
                                },
                                legendSpecificAttrs: {
                                    stroke: '#505050',
                                    "stroke-width": 2,
                                    width: 50,
                                    height: 50
                                },
                                label: "More than 10000 records"
                            }
                        ]
                    },
                },
                areas: statesToPlot

            });
        });

        //draw states bar chart
        svg = dimple.newSvg("#statesBarChart", "100%", 600);

        chart = new dimple.chart(svg, barChartData);
        x = chart.addCategoryAxis("x", "State");
        chart.addMeasureAxis("y", "Records");
        chart.addSeries(null, dimple.plot.bar);
        chart.draw();
    </script>

@endsection
