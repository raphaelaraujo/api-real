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
        $sessionToken = "8X0+Sye9YuXmiiT+xtLtIqoM5bflwKlK+mjhA0OzS50=";
        $url = "https://api.betfair.com/exchange/betting/json-rpc/v1";

        $operationCompetition = "listCompetitions";
        $paramsCompetition = '{"filter" : {
                                          "eventTypeIds" : ["1"],
                                          "marketCountries": ["BR"]                                          
                                          },
                               "locale" : "pt"          
                    }';

        $operationEvent = "listEvents";
        $paramsEvent = '{"filter" : {
                                    "eventTypeIds" : ["1"],
                                    "marketCountries": ["BR"],
                                    "competitionIds":["3583988","",""]
                                    },
                         "locale" : "pt"      
                    }';

        $operationMarket = "listMarketCatalogue";
        $paramsMarket = '{"filter" : {
                                    "eventIds" : ["30160414"],
                                    "marketCountries": ["BR"],
                                    "marketTypeCodes": ["MATCH_ODDS"]
                                     },
                          "maxResults" : 10,
                          "locale" : "pt"
                    }';

        $operationBook = "listMarketBook";
        $paramsBook = '{
                        "marketIds" : ["1.176232899"],
                        "locale" : "pt"
                       }';


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:',
            'X-Application: ' . $appKey,
            'X-Authentication: ' . $sessionToken,
            'Accept: application/json',
            'Content-Type: application/json'
        ));

        $postData = '[{ "jsonrpc": "2.0", "method": "SportsAPING/v1.0/' . $operationCompetition . '", "params" :' . $paramsCompetition . ', "id": 1}]';

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = json_decode(curl_exec($ch));
        //var_dump($response);
        foreach ($response[0]->result as $evento) {
            var_dump($evento);
//            echo "<b>Preço(vitória mandante):</b> " . $evento->runners[0]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Preço(vitória visitante):</b> " . $evento->runners[1]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Preço(empate):</b> " . $evento->runners[2]->lastPriceTraded . "<br/>" . " | ";
//            echo "<b>Nome Mercado:</b> " . $evento->marketName . "<br/>" . " | ";
//            echo "<b>Qtd de mercados estão na comp: </b>" . $evento->marketCount ."<br/>". " | ";
//            echo "<b>Região: </b>" . $evento->competitionRegion ."<br/>". " | ";
            //echo "<hr>";
        }

        curl_close($ch);



        if (isset($response[1]->error)) {
            echo 'Call to api-ng failed: ' . "\n";
            echo 'Response: ' . json_encode($response);
            exit(-1);
        } else {
            //var_dump($response);
            return $response;
        }
        ?>
    </body>
</html>
