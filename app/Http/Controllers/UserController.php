<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //first function for using into the api
    public function index()
    {
        return [
            [
                "success" => true,
                "message" => "Welcome to Server Starter",
                "Developer" => "Minhazul Abedin Munna",
                "Social" => [
                    "Facebook" => "https://www.facebook.com/smmunna21",
                    "GitHub" => "https://www.github.com/smmunna",
                ],
                "Version" => "1.0.0",
                "Date" => "2024-01-01"
            ]
        ];
    }

    // write others functions here


    // Global Route Error Handler
    public function globalError()
    {
        return [
            "success" => false,
            "message" => '404 Not Found'
        ];
    }
}
