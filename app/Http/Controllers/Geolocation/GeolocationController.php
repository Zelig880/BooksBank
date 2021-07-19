<?php

namespace App\Http\Controllers\Geolocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NominatimLaravel\Content\Nominatim;

class GeolocationController extends Controller
{
    private $nominatim;

    /**
     * Instantiate a new SettingsController instance.
     * @throws \NominatimLaravel\Exceptions\NominatimException
     */
    public function __construct()
    {
        $this->nominatim = new Nominatim(config('nominatim.url'));
    }

    /**
     * Get address points, by user input query
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGeolocationByUserQuery(Request $request)
    {
        $this->validate($request, [
            'postcode' => 'required',
        ]);

        $search = $this->nominatim->newSearch();
        
        $search->query($request->input('postcode'));

        $result = $this->nominatim->find($search);
        
        if( $request->input('city') && (!$result || !$result[0])){
            
            $search->query($request->input('city'));
            
            $result=$this->nominatim->find($search);
   
        }

        return response()->json($result);
    }


    /**
     * Get address from geolocation.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAddressFromGeolocation(Request $request)
    {

        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $search = $this->nominatim->newReverse()
                    ->latlon($request['latitude'], $request['longitude']);

        $result = $this->nominatim->find($search);

        return response()->json($result);
    }
}
