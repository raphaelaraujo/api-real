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

            $jsonResponse = sportsApingRequest($appKey, $sessionToken, 'listEventTypes', '{"filter":{}}');

            return $jsonResponse[0]->result;
        }

        function extractHorseRacingEventTypeId($allEventTypes) {
            foreach ($allEventTypes as $eventType) {
                if ($eventType->eventType->name == 'Horse Racing') {
                    var_dump($eventType);
                    return $eventType->eventType->name;
                }
            }
        }
        
        echo extractHorseRacingEventTypeId(getAllEventTypes($appKey, $sessionToken));
        ?>
    </body>
</html>
