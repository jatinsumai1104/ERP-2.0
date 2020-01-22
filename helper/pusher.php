<?php
require __DIR__ . '/vendor/autoload.php';

$options = array(
    'cluster' => 'ap2',
    'useTLS' => true,
);
$pusher = new Pusher\Pusher(
    '7ffa8cb2cffceaf91350',
    'a278005b3608f7152e6c',
    '931569',
    $options
);

$data['message'] = 'Hello Varun';
$pusher->trigger('my-channel', 'my-event', $data);
?>