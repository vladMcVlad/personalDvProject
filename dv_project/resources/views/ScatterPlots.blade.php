@extends('layouts.app')

@section('title', 'Population Density vs State Area')

@section('content')
    <h1 class="centerContent">Geographical Distribution of the Sightings</h1>

    <p class="centerContent biggerText">The graphs in this page have been created with the incorporation of a second
    dataset containing information about the population density (in population per square kilometer) and
    the land area (in square kilometers) of each state.

    <h3 class="centerContent">Question: Is there a relation between the population density in a state and the number of
        records?</h3>

    <div id="scatterDensity"></div>
    <p class="centerContent biggerText">
        Displaying the correlation between population density and number of records per state in hopes of finding a
        relation between records and population density vs the relation between records and area over which a state
        spans. </p>
    <p class="centerContent biggerText"> California and District Columbia seem to be rather significant outliers, which
        actually make the graph seem pointless. Filtering them out in order to try and find some relations amongst
        the rest of the states.
    </p>
    <div id="scatterDensityFiltered"></div>
    <p class="centerContent biggerText">
        The picture has definitely changed after the filtering out.
        <br>
        There is not a very strong relation between population density and number of records, as there are plenty of
        states with a high density and low number of records and also a plenty of states, which have a high number of
        records and a low population density. Still, I would say that there is *some* relation between these features.
    </p>
    <hr>
    <h3 class="centerContent">Question:Is there a relation between the area of a state and the number of records? </h3>
    <div id="scatterArea"></div>
    <p class="centerContent biggerText">Displaying the correlation between state area and number of records per state in
        hopes of showing the importance of the relation between records and population density vs the relation between
        records and area over which a state spans. Once again, there are some significant outliers, so I will be
        filtering them out again.</p>
    <div id="scatterAreaFiltered"></div>
    <p class="centerContent biggerText">The relation between state area and number of records seems even yankier, as
        there are plenty of states with a huge area and a low number of records and also some states, which
        are small, but have plenty of records.</p>

    <br><br>
    <p class="centerContent biggerText">
        In conclusion, there are some definite relations between state size/population density and the amount of UFO
        sightings in a state, but neither of the relations is very strong.
        <br>
        I would still say that the relation between population density and number of records seems stronger to me
        personally.
        <br>
        <br>
        I would recommend moving on to <a href="{{ route('timeDistribution') }}" >Population Density vs State Area</a>, but
        feel free to explore at will.
    </p>


    <script>
        var stateInfo = {!! json_encode($stateRowsAsObjects) !!};
        var stateRecordCounts = {!! json_encode($statesAndCounts) !!};

        var completeStateInfo = [];

        function drawScatterPlot(inDiv, fromList, xAxisName) {
            svg = dimple.newSvg(inDiv, "100%", 600);

            chart = new dimple.chart(svg, fromList);
            chart.addMeasureAxis("x", xAxisName);
            chart.addMeasureAxis("y", "Records");
            chart.addSeries(["State"], dimple.plot.bubble);
            chart.draw();
        }

        $.each(stateInfo, function (key, value) {
            completeStateInfo.push({
                "State": key,
                "Records": stateRecordCounts[key],
                "Density": value[0],
                "Area": value[1]
            });
        });

        drawScatterPlot("#scatterDensity", completeStateInfo, "Density");

        var densityFiltered = [];

        $.each(stateInfo, function (key, value) {
            if (key != 'ca' && key != 'dc') {
                densityFiltered.push({
                    "State": key,
                    "Records": stateRecordCounts[key],
                    "Density": value[0],
                    "Area": value[1]
                });
            }
        });

        drawScatterPlot("#scatterDensityFiltered", densityFiltered, "Density");

        drawScatterPlot("#scatterArea", completeStateInfo, "Area");

        var densityFiltered = [];

        $.each(stateInfo, function (key, value) {
            if (key != 'ca' && key != 'ak' && key != 'tx') {
                densityFiltered.push({
                    "State": key,
                    "Records": stateRecordCounts[key],
                    "Density": value[0],
                    "Area": value[1]
                });
            }
        });

        drawScatterPlot("#scatterAreaFiltered", densityFiltered, "Area");


    </script>
@endsection