<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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
        'first_name' => 'required | string | max:255',
        'middle_name' => 'nullable | string | max:255',
        'last_name' => 'required | string | max:255',
        'email' => 'required | email | unique: clients  max:255',
        'phone' => 'required | string | max:20',
        'company' => 'nullable | string | max:255',
        'website' => 'nullable | string | max:255',
        'password' => 'required | string | min:6 | confirmed',
        'city' => 'required | string | max:255',
        'coutry' => 'required | string | max:255',
        'avatar'=> 'nullable | image | mimes:jpeg, png, jpg, gif | max:2048'
    ];
}
 