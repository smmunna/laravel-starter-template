<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    // functions will be here
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
   
}
