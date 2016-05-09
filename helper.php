<?php

function sendAPIRequest($token, $method, $payload)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/$method");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    $result = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    logger($result);
}

function logger($data)
{
    $data = var_export($data, true);
    file_put_contents('application.log', $data.PHP_EOL, FILE_APPEND);
}

function getResults() {
    return [
        [
            'type' => 'article',
            'id' => '0',
            'title' => 'How does eCommerce currently sell on mobile?',
            'input_message_content' =>
                [
                    'message_text' => 'https://orat.io/blog/how-does-ecommerce-currently-sell-on-mobile/'
                ]
        ],
        [
            'type' => 'article',
            'id' => '1',
            'title' => 'Facebook Messenger will shake up eCommerce Businesses around the World',
            'input_message_content' =>
                [
                    'message_text' => 'https://orat.io/blog/facebook-messenger-will-shake-up-ecommerce-businesses-around-the-world/'
                ]
        ],
        [
            'type' => 'article',
            'id' => '2',
            'title' => 'Facebook’s Messenger Platform — everything new?',
            'input_message_content' =>
                [
                    'message_text' => 'https://orat.io/blog/facebooks-messenger-platform-everything-new/'
                ]
        ],
        [
            'type' => 'article',
            'id' => '3',
            'title' => 'Current Numbers for Mobile Messengers (Q1 2016)',
            'input_message_content' =>
                [
                    'message_text' => 'https://orat.io/blog/current-numbers-for-mobile-messengers-q1-2016/'
                ]
        ]
    ];

}
