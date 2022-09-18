<?php
 /*
    |--------------------------------------------------------------------------
    | GraphConroller.php
    |--------------------------------------------------------------------------
    | @author Noman Amin <numanamin11@gmil.com>
    | @date 17/09/22
    |--------------------------------------------------------------------------
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService; /* custom class for get api data */

class GraphConroller extends Controller
{
    public function index(Request $request)
    {
      /* get request values  */  
      $symbol="";
      if($request->has('symbol'))
      {
         $symbol=$request->get('symbol');
      }


      $start_date="";
      if($request->has('start_date'))
      {
         $start_date=$request->get('start_date');
      }


      $end_date="";
      if($request->has('end_date'))
      {
         $end_date=$request->get('end_date');
      }

      /* call custom class */
      $data=(new ApiService($symbol,$start_date,$end_date))->getData();

      
      return view('charts',compact('data'));
    }
}