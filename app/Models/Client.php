<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'website',
        'password',
        'city',
        'country',
        'avatar'
    ];

    public static $rules = [
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients|max:255',
        'phone' => 'required|string|max:20',
        'company' => 'nullable|string|max:255',
        'website' => 'nullable|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required|string|min:6',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'avatar'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];
    
    public function setPassword($value){
        $this->attributes['password'] = Hash::make($value);
    }
}
 