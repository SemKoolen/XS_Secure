
<?php
// compnents/request.php
$url = "134.209.126.193:5004";

// check if variable is sent through post to start correct function
if (isset($_POST['userLogin'])){
    //get data from post request
    $username = $_POST['username'];
    $password = $_POST['password'];
    //put all the data in an array
    $array = [$username, $password];
    //encode the array in json format
    $json = json_encode($array);
    //call Curl request function and put HTTP/HTTPS response in variable
    $result = DoCurl($url, "/api/auth/login", $json);
    //returns data to ajax method
    echo $result;
}


function DoCurl($url, $service, $requestData) {
    //splits url and service
    $url .= $service;

    //sets complete url for curl request
    $ch = curl_init( $url );
    //sets multiple options for the curl request
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => 1,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POSTFIELDS => $requestData,
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    //Excecutes curl request and puts data in array (data is formatted in json most of the time)
    $content = curl_exec( $ch );

    //Error handling...
    $err = curl_errno( $ch );
    $errmsg = curl_error( $ch );
    $header = curl_getinfo( $ch , CURLINFO_HEADER_OUT);
    $info = curl_getinfo($ch);

    //close curl request
    curl_close( $ch );
    // Return response to caller function
    return $content;
}
?>