<?php

namespace App\Http\Controllers;

use App\Models\webservice_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class option_microservice extends Controller
{
    public function getCurrency(Request $request)
    {
        $api_key = "Custom API for connect to your api";
        if($request->get("api") !== $api_key) {
            abort(503);
        }
        // Make the GET request
        $currency = "";
        $update = webservice_setting::where("meta_id", "currency");
        if(!is_null($update->first())) {
            $updatedWithin48Hours = Carbon::parse($update->first()->updated_at)->diffInHours(Carbon::now()) < 1;
            if ($updatedWithin48Hours) {
                $currency = json_decode($update->first()->meta_value);
                return $currency;
            } else {
                $response = Http::get('https://api.navasan.tech/latest/', [
                    'api_key' => "Navasan API",
                    // Add other parameters as needed
                ]);
                $currency = $response->json();
                $update = webservice_setting::updateOrCreate(
                    ['meta_id' => 'currency'], // Condition to find the record
                    [
                        'meta_value' => $response->json(),
                        'updated_at' => Carbon::now()
                    ]
                );
                return $currency;
            }
        } else {
            $response = Http::get('https://api.navasan.tech/latest/', [
                'api_key' => "Navasan API",
                // Add other parameters as needed
            ]);
            $currency = $response->json();
            $new = new webservice_setting;
            $new->meta_id = "currency";
            $new->meta_value = $response->json();
            $new->save();
            return $currency;
        }
    }
}
