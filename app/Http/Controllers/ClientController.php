<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegisterRequest;
use App\Services\ClientService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * @param ClientRegisterRequest $request
     * @param ClientService $clientService
     * @return Application|ResponseFactory|Response|object
     */
    public function registerClient(ClientRegisterRequest $request, ClientService $clientService)
    {
        $clientService->register($request->validated());
        return response()->json([
            'message' => 'Created'
        ], 201);
    }

    public function accounts(Request $request, ClientService $clientService): \App\Http\Resources\ClientCollection
    {
        return $clientService->accounts($request);
    }
}
