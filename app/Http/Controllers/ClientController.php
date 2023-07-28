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


    public function show($data)
    {
        // return $data;
        // Log::info('client', [$client]);
        $client = Client::where("email", $data)->first();  //fetch data which matches email
        return response()->json($client, 200);
        // return response()->json(["client" => $client] );
    }

    public function update(Request $request,  $email,)
    {
        // Define the specific validation rules for updating a client
        $updateRules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ];

        // Validate the incoming request data
        $validator = Validator::make($request->all(), $updateRules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Find the client by email
        $client = Client::where('email', $email)->first();

        // Update the client with the new data
        try {
            $client->update($request->all());
            return response()->json(['message' => 'Client updated successfully'], 200);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
