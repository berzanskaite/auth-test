    <?php
        $oauthConsumerKey = 'xvz1evFS4wEEPTGEFPHBog';
        $oauthToken = '370773112-GmHxMAgYyLbNEtIKZeRNFsMKPR9EyMZeS9weJAEb';
        $signingKey = 'kAcSOqF21Fu85e7zjz7ZN2U4ZRhfV3WpwPAoE3Z7kBw&LswwdoUaIvS8ltyTt5jkRh4J50vUPVVHtR2YPi5kE';

        //variables from params
        $url = $_GET["url"];
        $oauthNonce = $_GET["oauthNonce"];
        $timestamp = $_GET["timestamp"];
        
        //constructing parameter string
        $parameterString = "include_entities=true&oauth_consumer_key={$oauthConsumerKey}&oauth_nonce={$oauthNonce}&oauth_signature_method=HMAC-SHA1&oauth_timestamp={$timestamp}&oauth_token={$oauthToken}&oauth_version=1.0&status=Hello%20Ladies%20%2B%20Gentlemen%2C%20a%20signed%20OAuth%20request%21";

        //percent encode
        $percentEncodedUrl = rawurlencode($url);
        $percentEncodedString = rawurlencode($parameterString);

        //constructing signature base string
        $signatureBaseString = "POST&{$percentEncodedUrl}&{$percentEncodedString}";

        //sha1 encryption
        $hashed = hash_hmac('sha1', $signatureBaseString, $signingKey);

        //returning json
        $data = array("signature" => "{$hashed}");
        header("Content-Type: application/json");
        echo json_encode($data);
    ?>
