<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PetController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://petstore.swagger.io/v2/']);
    }

    public function index(): \Illuminate\View\View
    {
        return view('pet.index');
    }

    public function show(): \Illuminate\View\View
    {
        return view('pet.show');
    }

    public function create(): \Illuminate\View\View
    {
        return view('pet.create');
    }

    public function edit(): \Illuminate\View\View
    {
        return view('pet.edit');
    }

    public function delete(): \Illuminate\View\View
    {
        return view('pet.delete');
    }

    public function getPet(Request $request)
    {
        $validated = $request->validate([
            'petId' => 'required|integer',
        ]);
    
        $petId = $validated['petId'];

        try {
            $response = $this->client->request('GET', "pet/{$petId}");
            $pet = json_decode($response->getBody()->getContents(), true);

            $expectedFields = ['id', 'name', 'status', 'photoUrls', 'tags'];
            foreach ($expectedFields as $field) {
                if (!isset($pet[$field])) {
                    return view('pet.error', ['message' => "Expected field {$field} not found in API response"]);
                }
            }

            return view('pet.pet', ['pet' => $pet]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error($e->getMessage());
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $error = json_decode($responseBodyAsString, true);
            $err = $error['message'];
            return view('pet.error', ['message' => $err]);
        }
    }
}