<?php

if (!function_exists('getCurrencySymbol')) {
    function getCurrencySymbol($curuencyName)
    {
        $curuencies = [
            "NOK" => ""
        ];

        return $curuencies[$curuencyName];
    }
}

if (!function_exists('imageUpload')) {
    function imageUpload($file = null, $path = null, $setName = null)
    {
        $orginalFileName  = $file->getClientOriginalName();
        $fileExtension    = $file->getClientOriginalExtension();
        $orginalExtension = $file->guessClientExtension();
        $getSize          = $file->getClientSize();

        if (isset($setName)) {
            $newName = $setName . '.' . $fileExtension;
        } else {
            $newName = base64_encode($file->getClientOriginalName()) . '.' . $fileExtension;
        }

        $uploaded = $path . '/' . $newName;
//        dd($uploaded, $file);
        try {
            return $file->store($path, ['disk' => 's3']);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}

if (!function_exists('send_sms')) {
    function send_sms($messages) {

        $username = 'matias123';
        $password = 'kawasaki123';

        $result = send_message( json_encode($messages), 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30', $username, $password );

        if ($result['http_status'] != 201) {
          return false;
        } else {
          return true;
        }

    }
}

if (!function_exists('send_message')) {
    function send_message ( $post_body, $url, $username, $password) {
        $ch = curl_init( );
        $headers = array(
        'Content-Type:application/json',
        'Authorization:Basic '. base64_encode("$username:$password")
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_body );
        // Allow cUrl functions 20 seconds to execute
        curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
        // Wait 10 seconds while trying to connect
        curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
        $output = array();
        $output['server_response'] = curl_exec( $ch );
        $curl_info = curl_getinfo( $ch );
        $output['http_status'] = $curl_info[ 'http_code' ];
        $output['error'] = curl_error($ch);
        curl_close( $ch );
        return $output;
    }
}

if (!function_exists('country_calling_codes')) {
    function country_calling_codes () {
        $codes = [
           "USA (+1)" => "1" ,
           "UK (+44)" => "44",
           "Algeria (+213)"  => "213",
           "Andorra (+376)"  => "376",
           "Angola (+244)"   => "244",
           "Anguilla (+1264)" => "1264" ,
           "Antigua &amp; Barbuda (+1268)" => "1268" ,
           "Argentina (+54)" => "54",
           "Armenia (+374)" => "374",
           "Aruba (+297)" => "297",
           "Australia (+61)" => "61",
           "Austria (+43)" => "43",
           "Azerbaijan (+994)" => "994",
           "Bahamas (+1242)" => "1242",
           "Bahrain (+973)" => "973",
           "Bangladesh (+880)"=> "880" ,
           "Barbados (+1246)"=> "1246" ,
           "Belarus (+375)"=> "375" ,
           "Belgium (+32)"=> "32" ,
           "Belize (+501)"=> "501" ,
           "Benin (+229)"=> "229" ,
           "Bermuda (+1441)"=> "1441" ,
           "Bhutan (+975)"=> "975" ,
           "Bolivia (+591)"=> "591" ,
           "Bosnia Herzegovina (+387)"=> "387" ,
           "Botswana (+267)"=> "267" ,
           "Brazil (+55)"=> "55" ,
           "Brunei (+673)"=> "673" ,
           "Bulgaria (+359)"=> "359" ,
           "Burkina Faso (+226)"=> "226" ,
           "Burundi (+257)"=> "257" ,
           "Cambodia (+855)"=> "855" ,
           "Cameroon (+237)"=> "237" ,
           "Canada (+1)"=> "1" ,
           "Cape Verde Islands (+238)"=> "238" ,
           "Cayman Islands (+1345)"=> "1345" ,
           "Central African Republic (+236)"=> "236" ,
           "Chile (+56)"=> "56" ,
           "China (+86)"=> "86" ,
           "Colombia (+57)"=> "57" ,
           "Comoros (+269)"=> "269" ,
           "Congo (+242)"=> "242" ,
           "Cook Islands (+682)"=> "682" ,
           "Costa Rica (+506)"=> "506" ,
           "Croatia (+385)"=> "385" ,
           "Cyprus - North (+90)"=> "90" ,
           "Cyprus - South (+357)"=> "357" ,
           "Czech Republic (+420)"=> "420" ,
           "Denmark (+45)"=> "45" ,
           "Djibouti (+253)"=> "253" ,
           "Dominica (+1809)"=> "1809" ,
           "Dominican Republic (+1809)"=> "1809" ,
           "Ecuador (+593)"=> "593" ,
           "Egypt (+20)"=> "20" ,
           "El Salvador (+503)"=> "503" ,
           "Equatorial Guinea (+240)"=> "240" ,
           "Eritrea (+291)"=> "291" ,
           "Estonia (+372)"=> "372" ,
           "Ethiopia (+251)"=> "251" ,
           "Falkland Islands (+500)"=> "500" ,
           "Faroe Islands (+298)"=> "298" ,
           "Fiji (+679)"=> "679" ,
           "Finland (+358)"=> "358" ,
           "France (+33)"=> "33" ,
           "French Guiana (+594)"=> "594" ,
           "French Polynesia (+689)"=> "689" ,
           "Gabon (+241)"=> "241" ,
           "Gambia (+220)"=> "220" ,
           "Georgia (+7880)"=> "7880" ,
           "Germany (+49)"=> "49" ,
           "Ghana (+233)"=> "233" ,
           "Gibraltar (+350)"=> "350" ,
           "Greece (+30)"=> "30" ,
           "Greenland (+299)"=> "299" ,
           "Grenada (+1473)"=> "1473" ,
           "Guadeloupe (+590)"=> "590" ,
           "Guam (+671)"=> "671" ,
           "Guatemala (+502)"=> "502" ,
           "Guinea (+224)"=> "224" ,
           "Guinea - Bissau (+245)"=> "245" ,
           "Guyana (+592)"=> "592" ,
           "Haiti (+509)"=> "509" ,
           "Honduras (+504)"=> "504" ,
           "Hong Kong (+852)"=> "852" ,
           "Hungary (+36)"=> "36" ,
           "Iceland (+354)"=> "354" ,
           "India (+91)"=> "91" ,
           "Indonesia (+62)"=> "62" ,
           "Iraq (+964)"=> "964" ,
           "Ireland (+353)"=> "353" ,
           "Israel (+972)"=> "972" ,
           "Italy (+39)"=> "39" ,
           "Jamaica (+1876)"=> "1876" ,
           "Japan (+81)"=> "81" ,
           "Jordan (+962)"=> "962" ,
           "Kazakhstan (+7)"=> "7" ,
           "Kenya (+254)"=> "254" ,
           "Kiribati (+686)"=> "686" ,
           "Korea - South (+82)"=> "82" ,
           "Kuwait (+965)"=> "965" ,
           "Kyrgyzstan (+996)"=> "996" ,
           "Laos (+856)"=> "856" ,
           "Latvia (+371)"=> "371" ,
           "Lebanon (+961)"=> "961" ,
           "Lesotho (+266)"=> "266" ,
           "Liberia (+231)"=> "231" ,
           "Libya (+218)"=> "218" ,
           "Liechtenstein (+417)"=> "417" ,
           "Lithuania (+370)"=> "370" ,
           "Luxembourg (+352)"=> "352" ,
           "Macao (+853)"=> "853" ,
           "Macedonia (+389)"=> "389" ,
           "Madagascar (+261)"=> "261" ,
           "Malawi (+265)"=> "265" ,
           "Malaysia (+60)"=> "60" ,
           "Maldives (+960)"=> "960" ,
           "Mali (+223)"=> "223" ,
           "Malta (+356)"=> "356" ,
           "Marshall Islands (+692)"=> "692" ,
           "Martinique (+596)"=> "596" ,
           "Mauritania (+222)"=> "222" ,
           "Mayotte (+269)"=> "269" ,
           "Mexico (+52)"=> "52" ,
           "Micronesia (+691)"=> "691" ,
           "Moldova (+373)"=> "373" ,
           "Monaco (+377)"=> "377" ,
           "Mongolia (+976)"=> "976" ,
           "Montserrat (+1664)"=> "1664" ,
           "Morocco (+212)"=> "212" ,
           "Mozambique (+258)"=> "258" ,
           "Myanmar (+95)"=> "95" ,
           "Namibia (+264)"=> "264" ,
           "Nauru (+674)"=> "674" ,
           "Nepal (+977)"=> "977" ,
           "Netherlands (+31)"=> "31" ,
           "New Caledonia (+687)"=> "687" ,
           "New Zealand (+64)"=> "64" ,
           "Nicaragua (+505)"=> "505" ,
           "Niger (+227)"=> "227" ,
           "Nigeria (+234)"=> "234" ,
           "Niue (+683)"=> "683" ,
           "Norfolk Islands (+672)"=> "672" ,
           "Northern Marianas (+670)"=> "670" ,
           "Norway (+47)"=> "47" ,
           "Oman (+968)"=> "968" ,
           "Pakistan (+92)"=> "92" ,
           "Palau (+680)"=> "680" ,
           "Panama (+507)"=> "507" ,
           "Papua New Guinea (+675)"=> "675" ,
           "Paraguay (+595)"=> "595" ,
           "Peru (+51)"=> "51" ,
           "Philippines (+63)"=> "63" ,
           "Poland (+48)"=> "48" ,
           "Portugal (+351)"=> "351" ,
           "Puerto Rico (+1787)"=> "1787" ,
           "Qatar (+974)"=> "974" ,
           "Reunion (+262)"=> "262" ,
           "Romania (+40)"=> "40" ,
           "Russia (+7)"=> "7" ,
           "Rwanda (+250)"=> "250" ,
           "San Marino (+378)"=> "378" ,
           "Sao Tome &amp; Principe (+239)"=> "239" ,
           "Saudi Arabia (+966)"=> "966" ,
           "Senegal (+221)"=> "221" ,
           "Serbia (+381)"=> "381" ,
           "Seychelles (+248)"=> "248" ,
           "Sierra Leone (+232)"=> "232" ,
           "Singapore (+65)"=> "65" ,
           "Slovak Republic (+421)"=> "421" ,
           "Slovenia (+386)"=> "386" ,
           "Solomon Islands (+677)"=> "677" ,
           "Somalia (+252)"=> "252" ,
           "South Africa (+27)"=> "27" ,
           "Spain (+34)"=> "34" ,
           "Sri Lanka (+94)"=> "94" ,
           "St. Helena (+290)"=> "290" ,
           "St. Kitts (+1869)"=> "1869" ,
           "St. Lucia (+1758)"=> "1758" ,
           "Suriname (+597)"=> "597" ,
           "Sudan (+249)"=> "249" ,
           "Swaziland (+268)"=> "268" ,
           "Sweden (+46)"=> "46" ,
           "Switzerland (+41)"=> "41" ,
           "Taiwan (+886)"=> "886" ,
           "Tajikistan (+992)"=> "992" ,
           "Thailand (+66)"=> "66" ,
           "Togo (+228)"=> "228" ,
           "Tonga (+676)"=> "676" ,
           "Trinidad &amp; Tobago (+1868)"=> "1868" ,
           "Tunisia (+216)"=> "216" ,
           "Turkey (+90)"=> "90" ,
           "Turkmenistan (+993)"=> "993" ,
           "Turks &amp; Caicos Islands (+1649)"=> "1649" ,
           "Tuvalu (+688)"=> "688" ,
           "Uganda (+256)"=> "256" ,
           "Ukraine (+380)"=> "380" ,
           "United Arab Emirates (+971)"=> "971" ,
           "Uruguay (+598)"=> "598" ,
           "Uzbekistan (+998)"=> "998" ,
           "Vanuatu (+678)"=> "678" ,
           "Vatican City (+379)"=> "379" ,
           "Venezuela (+58)"=> "58" ,
           "Vietnam (+84)"=> "84" ,
           "Virgin Islands - British (+1)"=> "1" ,
           "Virgin Islands - US (+1)"=> "1" ,
           "Wallis &amp; Futuna (+681)"=> "681" ,
           "Yemen (North)(+969)"=> "969" ,
           "Yemen (South)(+967)"=> "967" ,
           "Zambia (+260)"=> "260" ,
           "Zimbabwe (+263)"=> "263"
        ];

        return $codes;
    }

}
