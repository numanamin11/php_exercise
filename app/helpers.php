<?php 
 /*
    |--------------------------------------------------------------------------
    | Helper.php for custom helper methods
    |--------------------------------------------------------------------------
    | @author Noman Amin <numanamin11@gmil.com>
    | @date 17/09/22
    |--------------------------------------------------------------------------
 */
if (!function_exists("get_symbols")) { /* get all symbols from json file and save in cache */
    function get_symbols()
    {

    	return Cache::remember('get_symbols', 3600, function () {
         	$symbolsAll = [];
            $symbols = [];
          
            $data = Http::get(config('services.symbols.file_url'));
           
            if(!empty($data->body()))
            {
                $symbolsArr = json_decode($data->body(), true);

                foreach($symbolsArr as $index => $value)
                {
                    /* simplfy the array*/
                    $symbolsAll[$value['Symbol']] = $value;
                    $symbols[]=$value['Symbol'];
                }
            }
	       
	        return ['symbols_all'=>$symbolsAll,'symbols'=>$symbols]; 
       });
    }
}