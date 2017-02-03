<?php

class linkedinoauth {

    function getAuthorizationCode() {
        $params = array('response_type' => 'code',
            'client_id' => API_KEY,
            'client_secret' => API_SECRET,
            'scope' => SCOPE,
            'state' => uniqid('', true), // unique long string
            'redirect_uri' => REDIRECT_URI,
        );
        
      
        

// Authentication request
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);

// Needed to identify request when it returns to us
        $_SESSION['state'] = $params['state'];

// Redirect user to authenticate
        header("Location: $url");
        exit;
    }

    function getAccessToken() {
        $params = array('grant_type' => 'authorization_code',
            'client_id' => API_KEY,
            'client_secret' => API_SECRET,
            'code' => $_GET['code'],
            'redirect_uri' => REDIRECT_URI,
        );
  $url = 'https://www.linkedin.com/uas/oauth2/accessToken';

    $c = curl_init();

    curl_setopt($c, CURLOPT_URL, $url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_POST,true);
curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($params));

    $response = curl_exec($c); // on execute la requete
//pr($params);
    curl_close($c);

    // Native PHP object, please
    $token = json_decode($response);
// Access Token request
//        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
//
//// Tell streams to make a POST request
//        $context = stream_context_create(
//                array('http' =>
//                    array('method' => 'POST',
//                    )
//                )
//        );
//
//// Retrieve access token information
//        $response = file_get_contents($url, false, $context);

// Native PHP object, please
//        $token = json_decode($response);
//pr($response);

// Store access token and expiration time
        $_SESSION['access_token'] = $token->access_token; // guard this! 
        $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time
        return true;
    }

    function fetch($method, $resource, $body = '') {
        $params = array('oauth2_access_token' => $_SESSION['access_token'],
            'format' => 'json',
        );

// Need to use HTTPS
        $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
// Tell streams to make a (GET, POST, PUT, or DELETE) request
        $context = stream_context_create(
                array('http' =>
                    array('method' => $method,
                    )
                )
        );


// Hocus Pocus
        $response = file_get_contents($url, false, $context);

// Native PHP object, please
        return json_decode($response);
    }

}

?>