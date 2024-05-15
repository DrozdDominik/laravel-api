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

    public function update(): \Illuminate\View\View
    {
        return view('pet.update');
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

    public function store(Request $request)
    {
        $validated = $this->validateCreateRequest($request);

        try {
            $response = $this->createPet($validated);
            return $this->handleResponse($response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->handleClientException($e);
        }
    }

    private function validateCreateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string',
            'status' => ['nullable', 'string', Rule::in(['available', 'pending', 'sold'])],
            'photoUrls' => 'required|array|min:1',
            'photoUrls.*' => 'url',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'category' => 'nullable|string',
        ]);
    }

    private function createPet(array $data)
    {
        $pet = new Pet($data);
        return $this->client->request('POST', 'pet', ['json' => $pet->toArray()]);
    }

    private function handleResponse($response)
    {
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        if ($statusCode === 200) {
            return view('pet.success', ['message' => $content]);
        }

        return view('pet.error', ['message' => $content]);
    }

    public function editData(Request $request)
    {
        $validated = $this->validateEditRequest($request);

        try {
            $response = $this->editPet($validated);
            return $this->handleResponse($response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->handleClientException($e);
        }
    }

    private function validateEditRequest(Request $request)
    {
        return $request->validate([
            'petId' => 'required|integer',
            'name' => 'sometimes|required|string',
            'status' => ['sometimes', 'required', 'string', Rule::in(['available', 'pending', 'sold'])],
        ]);
    }

    private function editPet(array $data)
    {
        $petId = $data['petId'];
        $apiEndpoint = 'pet/' . $petId;
        return $this->client->request('POST', $apiEndpoint, ['form_params' => $data]);
    }

    public function updateData(Request $request)
    {
        $validated = $this->validatePetData($request);

        try {
            $response = $this->updatePet($validated);
            return $this->handleResponse($response);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->handleClientException($e);
        }
    }

    private function validatePetData(Request $request)
    {
        return $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'status' => ['nullable', 'string', Rule::in(['available', 'pending', 'sold'])],
            'photoUrls' => 'required|array|min:1',
            'photoUrls.*' => 'url',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string',
            'category' => 'nullable|string',
        ]);
    }

    private function updatePet(array $data)
    {
        $pet = new Pet($validated);
        $response = $this->client->request('PUT', 'pet', ['json' => $pet->toArray()]);
    }
}