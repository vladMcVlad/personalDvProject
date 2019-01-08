@extends('layouts.app')

@section('title', 'What do people see in the sky?')

@section('content')
    <p class="centerContent biggerText">And last but not least...</p>

    <h1 class="centerContent">What do people actually see in the sky?</h1>

    <p class="centerContent biggerText">On the following graph you will see what are the most commonly reported shapes
        of UFOs observed as a percentage of the total number of reports.</p>

    <!--I am displaying the data in two ways - as a pie and as a bar chart - to show how many times
        has every shape been reported in total and what percentage of the final number of reports is this.-->

    <div id="pieHolder"></div>

    <div id="barHolder"></div>

    <script type="text/javascript">

        function drawPieChart(data) {
            const margin = 25;
            const width = 800;
            const height = 600;

            var svg = dimple.newSvg("#pieHolder", width, height);
            const myChart = new dimple.chart(svg, data);
            myChart.setBounds(margin, margin, width - 2 * margin, height - 2 * margin);
            myChart.addMeasureAxis("p", "Percentage of All Reports");
            myChart.addSeries("UFO Shape", dimple.plot.pie);
            myChart.addLegend(width - 5 * margin, margin, 90, 300, "left");
            myChart.draw();
        }

        d3.csv("storage\\datasets\\percentage_ufo_shape.csv", drawPieChart);


    </script>

@endsection

