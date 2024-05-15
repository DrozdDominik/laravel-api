<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Pet;

class PetController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('services.petstore.api_url')]);
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
        $petId = $this->validatePetId($request);

        try {
            $petData = $this->fetchPet($petId);
            $pet = new Pet($petData);

            return view('pet.pet', ['pet' => $pet]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->handleClientException($e);
        }
    }

    public function getPetsByStatus(Request $request): \Illuminate\View\View
    {
        $statuses = $this->validateStatuses($request);

        try {
            $petsData = $this->fetchPetsByStatus($statuses);
            $pets = $this->createPetObjects($petsData);

            return view('pet.pets_by_status', ['pets' => $pets]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->handleClientException($e);
        }
    }

    private function validatePetId(Request $request): int
    {
        $validated = $request->validate([
            'petId' => 'required|integer',
        ]);

        return $validated['petId'];
    }

    private function fetchPet(int $petId): array
    {
        $response = $this->client->request('GET', "pet/{$petId}");
        return json_decode($response->getBody()->getContents(), true);
    }

    private function createPetObjects(array $petsData): array
    {
        $pets = [];

        foreach ($petsData as $petData) {
            $pets[] = new Pet($petData);
        }

        return $pets;
    }

    private function handleClientException(\GuzzleHttp\Exception\ClientException $e): \Illuminate\View\View
    {
        Log::error($e->getMessage());
        $response = $e->getResponse();
        $responseBodyAsString = $response->getBody()->getContents();
        $error = json_decode($responseBodyAsString, true);
        $err = $error['message'];
        return view('pet.error', ['message' => $err]);
    }

    private function validateStatuses(Request $request): array
    {
        $validated = $request->validate([
            'status' => 'required|array|min:1|max:3',
            'status.*' => 'in:available,pending,sold',
        ]);

        return $validated['status'];
    }

    private function fetchPetsByStatus(array $statuses): array
    {
        $apiEndpoint = 'pet/findByStatus';
        foreach ($statuses as $index => $status) {
            $index == 0 ? $apiEndpoint .= '?status=' . $status : $apiEndpoint .= '&status=' . $status;
        }

        $response = $this->client->request('GET', $apiEndpoint);
        return json_decode($response->getBody()->getContents(), true);
    }
}