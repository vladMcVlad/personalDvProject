<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App;
use League\Csv\Reader;
use File;

class FileReaderController extends Controller
{
    public function GetAllAmericanRecordsAndRedirectToPlayground()
    {
        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }

        $perDayCounter = array(0, 0, 0, 0, 0, 0, 0);

        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);

        //13 fields
        //sighting_id,datetime,city,state,country,shape,duration,duration,comments,date posted,latitude,longitude,sighting day of week

        $allRows = array();
        $header = explode(",", $allRowsAsStrings[0]);

        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            if ($row[4] == "us") {
                array_push($allRows, $row);
                $perDayCounter[intval($row[12])]++;
            }
        }

        return view('welcome2', compact('header', 'allRows', 'perDayCounter'));
    }

    public function GetAllAmericanRecordsAndDisplayThemOnMap()
    {
        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }


        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);

        //13 fields
        //sighting_id,datetime,city,state,country,shape,duration,duration,comments,date posted,latitude,longitude,sighting day of week

        $allRows = array();
        $header = explode(",", $allRowsAsStrings[0]);

        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            if ($row[4] == "us") {
                array_push($allRows, $row);
            }
        }

        return view('plot', compact('header', 'allRows'));
    }

    public function GetNumbersOfSightsPerCountryAndState()
    {
        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }


        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);
        $perCountryCounter = [0, 0, 0, 0, 0, 0];
        $countryNames = ['Australia', 'Canada', 'Germany', 'Great Britain', 'USA', 'Other or missing'];
        $countryNamesAbridged = ['AU', 'CA', 'DE', 'GB', 'US', 'Other or missing'];

        //13 fields
        //sighting_id,datetime,city,state,country,shape,duration,duration,comments,date posted,latitude,longitude,sighting day of week

        $statesAndCounts = array("dc" => 0, "nj" => 0, "pr" => 0, "ri" => 0, "ma" => 0, "ct" => 0,
            "md" => 0, "de" => 0, "ny" => 0, "fl" => 0, "pa" => 0, "oh" => 0, "ca" => 0, "il" => 0,
            "hi" => 0, "va" => 0, "nc" => 0, "in" => 0, "ga" => 0, "mi" => 0, "sc" => 0, "tn" => 0,
            "nh" => 0, "ky" => 0, "la" => 0, "wa" => 0, "wi" => 0, "tx" => 0, "al" => 0, "mo" => 0,
            "wv" => 0, "mn" => 0, "vt" => 0, "ms" => 0, "az" => 0, "ar" => 0, "ok" => 0, "ia" => 0,
            "co" => 0, "me" => 0, "or" => 0, "ut" => 0, "ks" => 0, "nv" => 0, "ne" => 0, "id" => 0,
            "nm" => 0, "sd" => 0, "nd" => 0, "mt" => 0, "wy" => 0, "ak" => 0);


        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            switch ($row[4]) {
                case "au":
                    $perCountryCounter[0]++;
                    break;
                case "ca":
                    $perCountryCounter[1]++;
                    break;
                case "de":
                    $perCountryCounter[2]++;
                    break;
                case "gb":
                    $perCountryCounter[3]++;
                    break;
                case "us":
                    $perCountryCounter[4]++;
                    $statesAndCounts[$row[3]]++;

                    break;
                default:
                    $perCountryCounter[5]++;
                    break;
            }
        }

        return view('GeoDistribution', compact('perCountryCounter', 'countryNames', 'countryNamesAbridged', 'statesAndCounts'));
    }

    public function GetNumberOfSightsAndInfoPerUSState()
    {
        $statesAndCounts = array("dc" => 0, "nj" => 0, "pr" => 0, "ri" => 0, "ma" => 0, "ct" => 0,
            "md" => 0, "de" => 0, "ny" => 0, "fl" => 0, "pa" => 0, "oh" => 0, "ca" => 0, "il" => 0,
            "hi" => 0, "va" => 0, "nc" => 0, "in" => 0, "ga" => 0, "mi" => 0, "sc" => 0, "tn" => 0,
            "nh" => 0, "ky" => 0, "la" => 0, "wa" => 0, "wi" => 0, "tx" => 0, "al" => 0, "mo" => 0,
            "wv" => 0, "mn" => 0, "vt" => 0, "ms" => 0, "az" => 0, "ar" => 0, "ok" => 0, "ia" => 0,
            "co" => 0, "me" => 0, "or" => 0, "ut" => 0, "ks" => 0, "nv" => 0, "ne" => 0, "id" => 0,
            "nm" => 0, "sd" => 0, "nd" => 0, "mt" => 0, "wy" => 0, "ak" => 0);

        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
            $csvStates = File::get('storage/datasets/us_state_info.csv');

        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("A file doesn't exist");
        }


        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);
        $stateRowsAsStrings = $array = preg_split('/$\R?^/m', $csvStates);

        $stateRowsAsObjects = [];
        for ($x = 1; $x < count($stateRowsAsStrings); $x++) {
            $row = explode(",", $stateRowsAsStrings[$x]);
           // array_push($stateRowsAsObjects, $row);
            $stateRowsAsObjects[$row[0]] = [$row[1], $row[2]];
        }


        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            if ($row[4] == "us") {
                $statesAndCounts[$row[3]]++;
            }
        }

        ksort($stateRowsAsObjects);
        ksort($statesAndCounts);

        return view('ScatterPlots', compact('stateRowsAsObjects', 'statesAndCounts'));
    }

    public function DisplayAllRecords()
    {
        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }

        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);

        //13 fields
        //sighting_id,datetime,city,state,country,shape,duration,duration,comments,date posted,latitude,longitude,sighting day of week

        $allRows = array();
        $header = explode(",", $allRowsAsStrings[0]);

        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            array_push($allRows, $row);
        }

        return view('allRecordsShown', compact('header', 'allRows'));
    }

    public function GetTimeDistributionData()
    {
        ini_set('memory_limit', '-1');

        try {
            $csv = File::get('storage/datasets/scrubbedRealHard.csv');
        } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
            die("The file doesn't exist");
        }


        $allRowsAsStrings = $array = preg_split('/$\R?^/m', $csv);

        //14 fields
        //sighting_id,datetime,city,state,country,shape,duration,duration,comments,date posted,latitude,longitude,sighting day of week, year

        $header = explode(",", $allRowsAsStrings[0]);

        $perDayCounter = array(0, 0, 0, 0, 0, 0, 0);
        $yearlyRecordNumbers = [];
        $usRows = [];

        for ($x = 1; $x < count($allRowsAsStrings); $x++) {
            $row = explode(",", $allRowsAsStrings[$x]);

            if ($row[4] != "us" || $row[13] == 2014) {
                continue;
            }

            array_push($usRows, $row);
            $perDayCounter[intval($row[12])]++;
            $year = intval($row[13]);
            if (array_key_exists($year, $yearlyRecordNumbers)) {
                $yearlyRecordNumbers[$year]++;
            } else {
                $yearlyRecordNumbers[$year] = 1;
            }
        }

        return view('TimeDistribution', compact('yearlyRecordNumbers', 'usRows', 'perDayCounter'));

    }


}
