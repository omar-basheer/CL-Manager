<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };

        $client = new Client($request->all());
        $client->setPassword($request->input('password'));
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }
}
