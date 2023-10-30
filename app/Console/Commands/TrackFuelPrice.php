<?php

namespace App\Console\Commands;

use App\Models\FuelPrice;
use App\Models\FuelStation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TrackFuelPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fuel:track-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track fuel price.';

    /**
     * Execute the console command.
     * @throws \Throwable
     */
    public function handle(): void
    {
        $api_key = config('fuel.api_key');
        $lat = config('fuel.lat');
        $lng = config('fuel.lng');
        $rad = config('fuel.rad');
        $type = config('fuel.type');
        $sort = config('fuel.sort');

        $result = Http::get("https://creativecommons.tankerkoenig.de/json/list.php?lat=$lat&lng=$lng&rad=$rad&sort=$sort&type=$type&apikey=$api_key");

        $result = json_decode($result->body());

        throw_if($result->status !== 'ok', new \Exception('bad result status.'));

        foreach ($result->stations as $station) {
            $database_station = FuelStation::query()->whereKey($station->id)->first();
            if(!($database_station instanceof FuelStation)) {
                FuelStation::firstOrCreate([
                    'id' => $station->id,
                    'name' => $station->name,
                    'brand' => $station->brand,
                    'street' => $station->street,
                    'place' => $station->place,
                    'house_number' => $station->houseNumber,
                    'post_code' => $station->postCode,
                    'lat' => $station->lat,
                    'lng' => $station->lng,
                    'dist' => $station->dist,
                ]);
            }

            FuelPrice::create([
                'station_id' => $station->id,
                'diesel' => $station->diesel,
                'e5' => $station->e5,
                'e10' => $station->e10,
                'open' => $station->isOpen,
            ]);
        }
    }
}
