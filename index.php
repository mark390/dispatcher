<?php
    require('model/database.php');
    require('model/flight_db.php');

    $action = filter_input(INPUT_POST, 'action');
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action');
        if (!$action) {
            $action = 'list_flights';
        }
    }

    switch ($action) {
        case 'list_flights':
            $departure = filter_input(INPUT_POST, 'departure', FILTER_VALIDATE_STRING);
            if (!$departure) {
                $departure = filter_input(INPUT_GET, 'departure', FILTER_VALIDATE_STRING);
                if (!$departure) {
                    $departure = "*";
            }
            }
            $flights = getFlight($departure);
            include('request_form.php');
            break;
        case 'add_flight':
            $departure = filter_input(INPUT_POST, 'departure', FILTER_VALIDATE_STRING);
            $arrival = filter_input(INPUT_POST, 'arrival', FILTER_VALIDATE_STRING);
            $flight_no = filter_input(INPUT_POST, 'flight_no', FILTER_VALIDATE_STRING);
            $flight_type = filter_input(INPUT_POST, 'flight_type', FILTER_VALIDATE_STRING);
            $payload = filter_input(INPUT_POST, 'payload', FILTER_VALIDATE_STRING);
            $total_fuel = filter_input(INPUT_POST, 'total_fuel', FILTER_VALIDATE_INT);
            $pushback = filter_input(INPUT_POST, 'pushback', FILTER_VALIDATE_STRING);
            $enginestart = filter_input(INPUT_POST, 'enginestart', FILTER_VALIDATE_STRING);
            $to_time = filter_input(INPUT_POST, 'to_time', FILTER_VALIDATE_STRING);
            $landing_time = filter_input(INPUT_POST, 'landing_time', FILTER_VALIDATE_STRING);
            $shutdown_time = filter_input(INPUT_POST, 'shutdown_time', FILTER_VALIDATE_STRING);
            $fuel_remaining = filter_input(INPUT_POST, 'fuel_remaining', FILTER_VALIDATE_INT);
            $express = filter_input(INPUT_POST, 'express', FILTER_VALIDATE_BOOLEAN);
            $comments = filter_input(INPUT_POST, 'comments', FILTER_VALIDATE_STRING);
            $aircraft = filter_input(INPUT_POST, 'aircraft', FILTER_VALIDATE_STRING);
            if (!$departure) || (!$arrival) || (!$flight_no) || (!$flight_type) || (!$payload) || (!$total_fuel) || (!$pushback) || (!$enginestart) || (!$to_time) || (!$landing_time) || (!$shutdown_time) || (!$fuel_remaining) || (!$express) || (!$comments) || (!$aircraft)
                {
                $error = "Missing Data. Complete All Fields and Re-submit!"
                include('view/error.php');
            } else {
                insertFlight($flight_no, $departure, $arrival, $payload, $total_fuel, $pushback, $engine_start, $takeoff, $landing, $shutdown, $fuel_remaining, $express, $comments, $aircraft);
            }
            break;
        case 'delete_flight':
            $flight_id = filter_input(INPUT_POST, 'flight_id', FILTER_VALIDATE_INT);
            if (!$flight_id) {
                echo "Enter Valid Flight ID and Try again!";
            }
            deleteFlight($flight_id);
            break;
    }
    
    function fuelUsed() {
        return ($total_fuel - $fuel_remaining);
    }
    if ($fuel_remaining && $total_fuel) {
        $fuelused = fuelUsed();
    } else {
        echo "Enter Total Fuel and Fuel remaining to continue!";
    }
