<?php

namespace App\Http\Controllers\Api\v1;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

session_start();

class FbAuthController extends Controller
{

//    public function fbauth()
//    {
//        $fb = new Facebook([
//            'app_id' => env('FB_ID'), // Replace {app-id} with your app id
//            'app_secret' => env('FB_SECRET'),
//            'default_graph_version' => 'v3.2',
//        ]);
//
//        $helper = $fb->getRedirectLoginHelper();
//
//        $permissions = ['email']; // Optional permissions
//        $loginUrl = $helper->getLoginUrl('https://livelove.test/callback', $permissions);
//
//        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
//    }
//
//    public function fbcallback()
//    {
//        $fb = new Facebook([
//            'app_id' => env('FB_ID'), // Replace {app-id} with your app id
//            'app_secret' => env('FB_SECRET'),
//            'default_graph_version' => 'v3.2',
//        ]);
//
//        $helper = $fb->getRedirectLoginHelper();
//
//        try {
//            $accessToken = $helper->getAccessToken();
//        } catch(FacebookResponseException $e) {
//            // When Graph returns an error
//            echo 'Graph returned an error: ' . $e->getMessage();
//            exit;
//        } catch(FacebookSDKException $e) {
//            // When validation fails or other local issues
//            echo 'Facebook SDK returned an error: ' . $e->getMessage();
//            exit;
//        }
//
//        if (! isset($accessToken)) {
//            if ($helper->getError()) {
//                header('HTTP/1.0 401 Unauthorized');
//                echo "Error: " . $helper->getError() . "\n";
//                echo "Error Code: " . $helper->getErrorCode() . "\n";
//                echo "Error Reason: " . $helper->getErrorReason() . "\n";
//                echo "Error Description: " . $helper->getErrorDescription() . "\n";
//            } else {
//                header('HTTP/1.0 400 Bad Request');
//                echo 'Bad request';
//            }
//            exit;
//        }
//
//        // Logged in
//        echo '<h3>Access Token</h3>';
//        var_dump($accessToken->getValue());
//
//        // The OAuth 2.0 client handler helps us manage access tokens
//        $oAuth2Client = $fb->getOAuth2Client();
//
//        // Get the access token metadata from /debug_token
//        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
//        echo '<h3>Metadata</h3>';
//        var_dump($tokenMetadata);
//
//        // Validation (these will throw FacebookSDKException's when they fail)
//        $tokenMetadata->validateAppId(env('FB_ID')); // Replace {app-id} with your app id
//        // If you know the user ID this access token belongs to, you can validate it here
//        //$tokenMetadata->validateUserId('123');
//        $tokenMetadata->validateExpiration();
//
//        if (! $accessToken->isLongLived()) {
//            // Exchanges a short-lived access token for a long-lived one
//            try {
//                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
//            } catch (Facebook\Exceptions\FacebookSDKException $e) {
//                echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
//                exit;
//            }
//
//            echo '<h3>Long-lived</h3>';
//            var_dump($accessToken->getValue());
//        }
//
//        $_SESSION['fb_access_token'] = (string) $accessToken;
//
//        // User is logged in with a long-lived access token.
//        // You can redirect them to a members-only page.
//        //header('Location: https://example.com/members.php');
//    }

    public function fbauth(){
        return Socialite::driver('facebook')->redirect();
    }

    public function fbcallback(){
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }
}
