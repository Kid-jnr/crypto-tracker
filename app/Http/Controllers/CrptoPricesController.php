<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrptoPricesController extends Controller
{
    public function displayPrices(){

        $prices = Price::where('time_period','day')->get();
        return view('welcome', compact('prices'));
    }

    public function getSortedPrices($period){

        $prices = Price::where('time_period', $period)->get();
        return  response()->json($prices);
    }

    public function getPrices()
    {

        try {
            DB::beginTransaction();

            $base_url = "https://api.coincap.io/v2/";

            // Define time periods
            $time_periods = array(
                'day' => '1',
                'yesterday' => '2',
                'week' => '7',
                'month' => '30',
                'year' => '365'
            );

            // Set up cURL request
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Get top 10 cryptocurrencies by market cap
            $url = $base_url . "assets?limit=10";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
            $response = curl_exec($ch);
            $data = json_decode($response, true);
            $assets = $data['data'];

            // Get prices for each coin
            $coin_prices = array();
            foreach ($assets as $asset) {
                $asset_id = $asset['id'];
                $name = $asset['name'];
                $symbol = $asset['symbol'];
                $url = $base_url . "assets/" . $asset_id . "/history?interval=d1";
                curl_setopt($ch, CURLOPT_URL, $url);
                $response = curl_exec($ch);
                $data = json_decode($response, true);
                $prices = array_column($data['data'], 'priceUsd');
                $coin_prices[$symbol] = $prices;
            }

            // Delete all old records from the `prices` table
            DB::table('prices')->delete();

            // Calculate average prices for each time period and display results
            foreach ($time_periods as $time_period => $days) {
                foreach ($coin_prices as $symbol => $prices) {
                    $average_price = array_sum(array_slice($prices, -$days)) / $days;
                    DB::table('prices')->insert(
                        ['symbol' => $symbol, 'time_period' => $time_period, 'average_price' => $average_price]
                    );
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
        }
    }
}
