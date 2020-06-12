<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TopLevelDomains;
use App\Http\Requests\OverviewIndexRequest;

class OverviewController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth:api');
    }
    
    /**
     * Daten für Übersichtsseite bereitstellen
     * 
     * @param [array] columnFilters
     * @param [string] page
     * @param [string] per_page
     * @return [array] rows
     * @return [string] totalRows
     */
    public function index(OverviewIndexRequest $request)
    {
        $params = request(['columnFilters', 'page', 'per_page']);

        $tlds = new TopLevelDomains();

        if ( ( $jsonResponse = $tlds->getFromApi($params) ) === false ) {
            return response()->json([
                'message' => 'Sorry something went wrong.' 
            ], 500);
        }
        
        $response = json_decode($jsonResponse, TRUE);
        
        return response()->json([
            'rows' => $response['data'],
            'totalRows' => $response['total']
        ]);
    }
}
