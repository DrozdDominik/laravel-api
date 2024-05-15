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
}