<?php
 /*
    |--------------------------------------------------------------------------
    | GraphConroller.php
    |--------------------------------------------------------------------------
    | @author Noman Amin <numanamin11@gmil.com>
    | @date 17/09/22
    |--------------------------------------------------------------------------
 */
namespace App\Services;

class ApiService
{
	private $symbol,$start_date,$end_date,$return_data;

	public function __construct($symbol,$start_date,$end_date)
    {
    	$this->symbol=$symbol;
    	$this->start_date=strtotime($start_date);
    	$this->end_date=strtotime($end_date);
    }


    public function getData() /* get data from api method and save in cache for future use */
    {
       $cache_name=	'get_repid_api_'.$this->symbol.'_'.$this->start_date.'_'.$this->end_date;/* dynamic cache name */
       return \Cache::remember($cache_name, 12, function () {
         		return $this->getRepidApiData();
       });	
       
    }


    private function getRepidApiData() /* get data from api */
    {
    	$symbol = $this->symbol;
       
	    $chartData = [];
	    $chartData['dates'] = [];
	    $chartData['open'] = [];
	    $chartData['close'] = [];
	    $chartData['all_data'] = [];
        $data = \Http::withHeaders(["X-RapidAPI-Key" => config('services.rapidapi.key'), "X-RapidAPI-Host" => "yh-finance.p.rapidapi.com"])->get(config('services.rapidapi.end_point')."/get-historical-data?symbol=$symbol&region=US");
        if(!empty($data->body()))
        {
            $data = json_decode($data->body(), true);

            $prices = $data['prices'];

            foreach($prices as $index => $value)
            {	
                $date = $value['date'];

                if($date >= $this->start_date && $date <= $this->end_date)
                {
                    array_push($chartData['dates'], date("d F, Y", $value['date']));
                    array_push($chartData['open'], (!empty($value['open']) ? $value['open'] : 0));
                    array_push($chartData['close'], (!empty($value['open']) ? $value['open'] : 0));
                   
                    $value['date']=date("d F, Y", $value['date']);
                    array_push($chartData['all_data'], $value);
                }
            } 
        }
        $chartData['dates']=array_reverse($chartData['dates']);
        $chartData['open']=array_reverse($chartData['open']);
        $chartData['close']=array_reverse($chartData['close']);
        $chartData['all_data']=array_reverse($chartData['all_data']);
        return $chartData;
    }
    
}