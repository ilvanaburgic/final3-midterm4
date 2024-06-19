<?php

require_once 'MidtermService.php';

// Service instance
$midtermService = new MidtermService();

Flight::route('GET /midterm/connection-check', function() use ($midtermService) {
    /** TODO
    * This endpoint prints the message from constructor within MidtermDao class
    * Goal is to check whether connection is successfully established or not
    * ENDPOINT IS NOT GRADED; YOU CAN USE IT IF YOU NEED TO TEST CONNECTION, OTHERWISE YOU CAN LEAVE IT EMPTY
    * This endpoint does not have to return output in JSON format
    */
    echo "Connection check endpoint";  // Or any other message that indicates success
});

Flight::route('POST /midterm/input_data', function() use ($midtermService) {
    /** TODO
    * This endpoint is used to insert IP2LOCATION.json file content to database table locations
    * This endpoint should return output in JSON format
    * 10 points
    */
    $data = Flight::request()->data->getData();
    try {
        $midtermService->input_data($data);
        Flight::json(['status' => 'success']);
    } catch (Exception $e) {
        Flight::json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

Flight::route('GET /midterm/summary/@country', function($country) use ($midtermService) {
    /** TODO
    * This endpoint is used to return total number of regions and cities from locations table
    * by country given as parameter
    * This endpoint should return output in JSON format
    * 30 points
    */
    try {
        $summary = $midtermService->summary($country);
        Flight::json($summary);
    } catch (Exception $e) {
        Flight::json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

Flight::route("GET /midterm/encoded", function() use ($midtermService) {
    /** TODO
    * This endpoint is used to create report that lists first 10 countries and their hashed values
    * Sample data for one country: ['country' => 'United States', 'encoded' => 'VW5pdGVkIFN0YXRlcw=='];
    * There is php function used to encode string
    * This endpoint should return output in JSON format
    * 30 points
    */
    try {
        $encodedData = $midtermService->encoded();
        $encodedResults = array_map(function($item) {
            return [
                'country' => $item['country'],
                'encoded' => base64_encode($item['country'])
            ];
        }, array_slice($encodedData, 0, 10));
        Flight::json($encodedResults);
    } catch (Exception $e) {
        Flight::json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

Flight::route("GET /midterm/ip", function() use ($midtermService) {
    /** TODO
    * This endpoint is used to return location(s) based on ip address given as parameter
    * There is a php function to convert ip address to number, therefore you can use this number to
    * match with those 'from' and 'to' in database
    * This endpoint should return output in JSON format
    * 30 points
    */
    $ip_address = Flight::request()->query['ip'];
    try {
        $location = $midtermService->ip($ip_address);
        Flight::json($location);
    } catch (Exception $e) {
        Flight::json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
});

?>
