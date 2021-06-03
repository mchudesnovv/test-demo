<?php


namespace App\Services;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    /**
     * @param Client $client
     * @param array $data
     * @return Model
     */
    public function storeFor(Client $client, array $data): Model
    {
        return $client->users()->create([
            'client_id' => $data['client_id'] ?? null,
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone' => $data['phone'],
            'profile_uri' => $data['profile_uri'] ?? null,
            'last_password_reset' => Carbon::now(),
            'status' => $data['status'] ?? null
        ]);
    }
}
