<?php

/**
 * @see https://github.com/codemix/yii2-localeurls#yii2-locale-urls
 */

return [
    'class' => 'codemix\localeurls\UrlManager',
    // 'enableLocaleUrls' => false,
    //'languages' => ['en', 'ru'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [

        //'' => '',
        // Account controller
        'account' => 'account/index',

        // Main controller
        'page/<page:\d+>' => 'main/index',
        '<action:[A-Za-z0-9-]+>' => 'main/<action>',

        '<controller:(\w|-)+>'=>'<controller>/index',
        //'post/' => 'post/index',

    ],
];
