<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Client::$rules);
        Log::info('validator', [$validator]);
        if ($validator->fails()) {
            Log::info('Validation failed', ['errors' => $validator->errors()]);
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json(['errors' => $validator->errors()], 422);
        };

        $client = new Client($request->all());
        $client->setPassword($request->input('password'));
        Log::info('Client created successfully', ['client' => $client]);
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }
}
