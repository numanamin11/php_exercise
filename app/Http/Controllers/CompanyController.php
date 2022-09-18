<?php
 /*
    |--------------------------------------------------------------------------
    | CompanyController
    |--------------------------------------------------------------------------
    | @author Noman Amin <numanamin11@gmil.com>
    | @date 17/09/22
    |--------------------------------------------------------------------------
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company; /* Company Model*/
use App\Notifications\SendEmail; /* Notification class */
use Illuminate\Validation\Rule; /* Laravel Cutomized rule*/

class CompanyController extends Controller
{
    
    /* home page form */
    public function index()
    {

        $symbols= get_symbols();
        return view('create_company',compact('symbols'));
    }

    /* validation,store data and email will be send */
    public function store(Request $request)
    {
       
        $data=get_symbols(); /* get symbols from cache */
        
        $validatedData = $request->validate([
                'symbol' => ['required',Rule::in($data['symbols'])],
                'start_date' => ['required','date_format:Y-m-d','before:end_date'],
                'end_date' => ['required','date_format:Y-m-d','after:start_date'],
                'email' => ['required','email'],
        ]);

        /* save data in database*/
        $company=Company::create($request->all());

        /* send notification*/
        $company->notify(new SendEmail());

        /* redirect to the graph view */
        return redirect(route('graph_view',['symbol'=>$company->symbol,'start_date'=>$company->start_date,'end_date'=>$company->end_date]))->with('success', 'Email sent successfully');   
    }
}
