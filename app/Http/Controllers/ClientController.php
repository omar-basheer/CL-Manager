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
        // Validate incoming request data
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

    public function destroy($email)
    {
        // Find the client using the email
        $client = Client::where('email', $email)->first();
        Log::info('client', [$client]);
    
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }
    
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }


    public function show(Client $client)
    {
        Log::info('client', [$client]);
        return response()->json($client, 200);
    }

    public function update(Request $request, Client $client)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), Client::$rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Update the client with the new data
        $client->update($request->all());

        return response()->json(['message' => 'Client updated successfully'], 200);
    }
}
