<?php

return [
    'app_id' => 'wxc1a4660d4cb81f64',
    'app_secret' => '838d67cabfc21bc089f87decb7bc57b0',
    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" . 'appid=%s&secret=%s&js_code=%s&grant_type=authorization_code'
];
