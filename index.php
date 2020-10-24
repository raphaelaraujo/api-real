<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consumir API Betfair</title>
    </head>
    <body>
        <?php
        $appKey = "ps7eHG6ouYq6Nc7l";
        $sessionToken = "gWM1/BTfMhq+BLOTQtU7ciaXa2JHkbeJP2BYPCW2/7Q=";
        $operation = "listEventTypes";

        //$params = '{"filter" : {}}';

        function sportsApingRequest($appKey, $sessionToken, $operation, $params) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_URL, "https://api.betfair.com/exchange/betting/json-rpc/v1");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:',
                'X-Application: ' . $appKey,
                'X-Authentication: ' . $sessionToken,
                'Accept: application/json',
                'Content-Type: application/json'
            ));

            $postData = '[{ "jsonrpc": "2.0", "method": "SportsAPING/v1.0/' . $operation . '", "params" :' . $params . ', "id": 1}]';


            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $response = json_decode(curl_exec($ch));
            curl_close($ch);

            if (isset($response[0]->error)) {
                echo 'Call to api-ng failed: ' . "\n";
                echo 'Response: ' . json_encode($response);
                exit(-1);
            } else {
                return $response;
            }
        }

        function getAllEventTypes($appKey, $sessionToken) {

            $jsonResponse = sportsApingRequest($appKey, $sessionToken, 'listEvents', '{"filter":{"eventTypeIds":[ "1"]}}');


//            object(stdClass)#1 (3) {
//  ["jsonrpc"]=>
//  string(3) "2.0"
//  ["result"]=>
//  array(859) {
//    [0]=>
//    object(stdClass)#3 (2) {
//      ["event"]=>
//      object(stdClass)#2 (5) {
//        ["id"]=>
//        string(8) "30073291"
//        ["name"]=>
//        string(17) "Annan v Stranraer"
//        ["countryCode"]=>
//        string(2) "GB"
//        ["timezone"]=>
//        string(3) "GMT"
//        ["openDate"]=>
//        string(24) "2020-10-24T14:00:00.000Z"
//      }
//      ["marketCount"]=>
//      int(24)
//    }
            //

            foreach ($jsonResponse[0]->result as $evento) {

                if (isset($evento->event->countryCode) ) {
                    //echo $evento->event->name . "</br>";
                   // echo "<hr>";
                    
                    var_dump($evento);
                }


                // var_dump($evento);
            }

            //return $jsonResponse[0]->result;
        }

//        function extractHorseRacingEventTypeId($allEventTypes) {
//            foreach ($allEventTypes as $eventType) {
//                if ($eventType->event->countryCode == 'BR') {
//                    var_dump($eventType);
//                    return $eventType->event->name;
//                }
//            }
//        }
        //echo extractHorseRacingEventTypeId(getAllEventTypes($appKey, $sessionToken));
        echo getAllEventTypes($appKey, $sessionToken);
        ?>
    </body>
</html>
