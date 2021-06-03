<?php

namespace App\Observers;

use App\Models\Client;

class ClientObserver
{
    /**
     * Handle the Client "creating" event.
     *
     * @param Client $client
     * @return void
     */
    public function creating(Client  $client)
    {
        if(is_null($client->status))
        {
            $client->setInactive();
        }
    }
}
