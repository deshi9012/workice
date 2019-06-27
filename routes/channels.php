<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('workice-user-{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('order.{order}', function ($user, Order $order) {
    return $user->id === $order->user_id;
});
