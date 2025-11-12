<?php
// Twilio API credentials - REPLACE WITH YOUR ACTUAL CREDENTIALS
define('TWILIO_ACCOUNT_SID', 'your_twilio_account_sid_here');
define('TWILIO_AUTH_TOKEN', 'your_twilio_auth_token_here');
define('TWILIO_PHONE_NUMBER', 'your_twilio_phone_number_here'); // Your Twilio phone number

// Function to send SMS with better error handling for trial accounts
function send_sms($to, $message) {
    $url = "https://api.twilio.com/2010-04-01/Accounts/" . TWILIO_ACCOUNT_SID . "/Messages.json";

    $data = array(
        "To" => $to,
        "From" => TWILIO_PHONE_NUMBER,
        "Body" => $message
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Basic " . base64_encode(TWILIO_ACCOUNT_SID . ":" . TWILIO_AUTH_TOKEN)
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if($httpCode == 201){
        return true;
    }else{
        // Decode the JSON response to get error details
        $errorData = json_decode($response, true);

        // Log detailed error for debugging
        error_log('Twilio API Error: HTTP ' . $httpCode . ' - ' . $response);

        // Return specific error message based on Twilio error code
        if (isset($errorData['code'])) {
            switch ($errorData['code']) {
                case 21608: // Unverified number error for trial accounts
                    return array(
                        'success' => false,
                        'error_code' => 'unverified_number',
                        'message' => 'Cannot send SMS to this number. This number is not verified in your Twilio account. Please verify it at twilio.com/user/account/phone-numbers/verified or upgrade to a paid Twilio account.'
                    );
                case 21211: // Invalid phone number
                    return array(
                        'success' => false,
                        'error_code' => 'invalid_number',
                        'message' => 'The phone number is invalid. Please check the number format.'
                    );
                case 21612: // Account suspended
                    return array(
                        'success' => false,
                        'error_code' => 'account_suspended',
                        'message' => 'Your Twilio account is suspended. Please contact Twilio support.'
                    );
                default:
                    return array(
                        'success' => false,
                        'error_code' => 'api_error',
                        'message' => 'SMS sending failed. Error: ' . ($errorData['message'] ?? 'Unknown error')
                    );
            }
        } else {
            return array(
                'success' => false,
                'error_code' => 'curl_error',
                'message' => 'SMS sending failed. Network error: ' . $curlError
            );
        }
    }
}
?>
