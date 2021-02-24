<?php

function getFlight($departure) {
    global $db;
    $query = 'SELECT * 
                FROM flights
                WHERE departure = :departure
                ORDER BY Flight_No desc';
    $statement = $db->prepare($query);
    $statement->bindValue(':departure', $departure);
    $values = $statement->fetchAll();
    $statement->closeCursor();
}

function insertFlight($flight_no, $departure, $arrival, $payload, $total_fuel, $pushback, $engine_start, $takeoff, $landing, $shutdown, $fuel_remaining, $express, $comments, $aircraft) {
    global $db;
    $count = 0;
    $insertquery = 'INSERT INTO flights
                    (flight_no, departure, arrival, payload, total_fuel, pushback, engine_start, takeoff, landing, shutdown, fuel_remaining, express, comments, aircraft)
                        VALUES
                    (:flight_no, :departure, :arrival, :payload, :total_fuel, :pushback, :engine_start, :takeoff, :landing, :shutdown, :fuel_remaining, :express, :comments, :aircraft)';
    $insertstatement = $db->prepare($insertquery);
    $insertstatement->bindValue(':flight_no', $flight_no);
    $insertstatement->bindValue(':departure', $departure);
    $insertstatement->bindValue(':arrival', $arrival);
    $insertstatement->bindValue(':payload', $payload);
    $insertstatement->bindValue(':total_fuel', $total_fuel);
    $insertstatement->bindValue(':pushback', $pushback);
    $insertstatement->bindValue(':engine_start', $engine_start);
    $insertstatement->bindValue(':takeoff', $takeoff);
    $insertstatement->bindValue(':landing', $landing);
    $insertstatement->bindValue(':shutdown', $shutdown);
    $insertstatement->bindValue(':fuel_remaining', $fuel_remaining);
    $insertstatement->bindValue(':express', $express);
    $insertstatement->bindValue(':comments', $comments);
    $insertstatement->bindValue(':aircraft', $aircraft);
    if ($insertstatement->execute()) {
        $count = $insertstatement->rowCount();
    }
    $insertstatement->closeCursor();
    return $count;
}

function deleteFlight($flight_id) {
    global $db;
    $count = 0;
    $deletequery = 'DELETE FROM flights
                WHERE Flight_ID = :flight_id';
    $deletestatement = $db->prepare($deletequery);
    $deletestatement->bindValue(':flight_id', $flight_id);
    if ($deletestatement->execute()) {
        $count = $deletestatement->rowCount();
    }
    $deletestatement->closeCursor();
    return $count;
}

include('./index.php');