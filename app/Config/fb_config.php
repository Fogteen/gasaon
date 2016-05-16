<?php
/**
 * Created by PhpStorm.
 * User: hoang
 * Date: 10/03/2016
 * Time: 08:50
 */

define('FACEBOOK_LOGIN_SUCCESS', 'Facebook Login Successfully');
define('FACEBOOK_LOGIN_FAILURE', 'Something went wrong !!!');

//base path của web
define('BASE_PATH', 'http://gasaon.gmo/');

//thông tin facebook app
define('FACEBOOK_APP_ID', '1044940168912905'); // bạn hãy thay XYZ bằng App ID trước đó đã lấy được
define('FACEBOOK_APP_SECRET', '63ea8b3dfa58011f61221931a845fe52'); // tiếp đó là thay ABC bằng App Secret của bạn
define('FACEBOOK_REDIRECT_URI', 'http://gasaon.gmo/users/fb_login');

define('FACEBOOK_SDK_V4_SRC_DIR','../Vendor/facebook/php-sdk-v4/src/Facebook/');

require_once(APP . 'Vendor' . DS . 'facebook' . DS . 'autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
