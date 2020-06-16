<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopLevelDomains extends Model
{
    /**
     * Anfrage an die Productstore API
     * nach den Top Level Domains
     * 
     * @return mixed
     */
    public function getFromApi(array $params) 
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $this->buildUrl($params));
   
        $response = curl_exec($ch);

        if ( $response === false ) {
            return false;
        }
        
        return $response;
    }

    /**
     * GET Querystring für die Anfrage an
     * die Productstore API generieren
     * 
     * @param [array] columnFilters
     * @param [string] page
     * @param [string] per_page
     * @return string
     */
    protected function buildUrl(array $params) 
    {

        $apiUrl = config('app.API_URL');

        if ( ( $filters = json_decode($params['columnFilters']) ) !== null ) {
            
            unset($params['columnFilters']);
            
            foreach ( $filters as $key => $value ) {
                
                if ( $key == 'label' ) {
                    $params['keyword'] = $value;
                } else {
                    $params[$key] = $value;
                }
            }
        }

//        https://api.autodns.com/productstore/v1/tld/_paginate?page=1&per_page=10&keyword=de&tldType[0]=CCTLD&tldType[1]=NEW_GTLD
        return $apiUrl . http_build_query($params);
    }
}
