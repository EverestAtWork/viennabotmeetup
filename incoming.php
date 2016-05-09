<?php

include_once 'helper.php';

$token = '<your_token>';

$payload = json_decode(file_get_contents('php://input'), true);
$prettyJson = json_encode($payload, JSON_PRETTY_PRINT);
logger($prettyJson);

if (array_key_exists('inline_query', $payload)) {
    handleInline($payload['inline_query']);
} elseif (array_key_exists('message', $payload)) {
    handleMessage($payload['message']);
}

http_response_code(202);

function handleInline($query)
{
    global $token;

    $results = getResults();

    $payload = [
        'inline_query_id' => $query['id'],
        'results' => json_encode(
            array_slice($results, 0, strlen($query['query']))
        ),
    ];

    sendAPIRequest($token, 'answerInlineQuery', $payload);
}

function handleMessage($message)
{
    global $token;

    $payload = [
        'chat_id' => $message['chat']['id'],
        'text' => $message['text'],
    ];

    $payload['reply_markup'] = json_encode(
        ['keyboard' => [
                ['row 1 col 1', 'row 1 col 2'],
                ['row 2'],
            ],
        'resize_keyboard' => true, ]
    );

    sendAPIRequest($token, 'sendMessage', $payload);
}
