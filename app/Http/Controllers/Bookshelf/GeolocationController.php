<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use NominatimLaravel\Content\Nominatim;

class GeolocationController extends Controller
{
    private $nominatim;
    
    /**
     * Instantiate a new SettingsController instance.
     */
    public function __construct()
    {
        
        $this->nominatim = new Nominatim(config('nominatim.url'));
    }

    /**
     * Get geofence from User Address
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getGeolocation(Request $request)
    {
        $this->validate($request, [
            'address_postcode' => 'required',
            'address_country' => 'required'
        ]);
        
        $search = $this->nominatim->newSearch();

        if($request->input('address_country')) $search->country($request->input('address_country'));
        if($request->input('address_postcode')) $search->postalcode($request->input('address_postcode'));
            
        $search
            ->polygon('geojson')
            ->addressDetails();

        $result = $this->nominatim->find($search);
        
        return response()->json($result);
    }

    
    /**
     * Get address from geolocation.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAddress(Request $request)
    {

        $this->validate($request, [
            'country' => 'required',
            'lat' => 'required',
            'lon' => 'required'
        ]);

        $search = $this->nominatim->newReverse()
                    ->latlon($request['lat'], $request['lon']);

        $result = $this->nominatim->find($search);
        
        return response()->json($result);
    }
}
