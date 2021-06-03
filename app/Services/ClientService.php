<?php


namespace App\Services;


use App\Exceptions\GoogleMapsException;
use App\Http\Resources\ClientCollection;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClientService
{
    protected $userService;
    protected $googleMapsService;

    public function __construct(UserService $userService, GoogleMapsService $googleMapsService)
    {
        $this->userService = $userService;
        $this->googleMapsService = $googleMapsService;
    }

    /**
     * @param Request $params
     * @return ClientCollection
     */
    public function accounts(Request $params): ClientCollection
    {
        $data= Client::filter($params->all())->sort($params->all())->paginate(10);
        return new ClientCollection($data);
    }

    /**
     * @param $data
     */
    public function register($data)
    {
        try {
            $address = $data['address1'] . ' ' . $data['state'] . ' ' . $data['country'] . ' ' . $data['zipCode'];
            $address = trim($address);
            $geocoding = Cache::get($address, function () use ($address) {
                return $this->googleMapsService->getByAddress($address);
            });

            $data['latitude'] = $geocoding[0]->geometry->location->lat;
            $data['longitude'] = $geocoding[0]->geometry->location->lng;
        } catch (GoogleMapsException $e){
            Log::error($e->getMessage());
        }

        $client = Client::create([
            'client_name' => $data['name'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'phone_no1' => $data['phoneNo1'],
            'phone_no2' => $data['phoneNo2'] ?? null,
            'zip' => $data['zipCode'],
            'start_validity' => Carbon::now(),
            'end_validity' => Carbon::now()->addDays(15),
            'status' => $data['status'] ?? null
        ]);

        if(!empty($data['user'])) {
            $this->userService->storeFor($client, $data['user']);
        }
        return $client->with('users');
    }
}
