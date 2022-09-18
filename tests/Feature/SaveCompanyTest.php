<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Company;

class SaveCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * test if symbol is missing
     * test if symbol is invalid
     * test if have valid symbol
     * test if start_date is missing 
     * test if start_date formate is not correct 
     * test if start_date is greater then the end_date
     * test if end_date is missing
     * test if end_date formate is not correct 
     * test if end_date is less from start date 
     * test if email is missing 
     * test if email is not valid 
     * validation if everything is valid and data can save 
     * test email notification is working
     */

    /* validation if symbol is missing */
    public function test_symbol_missing() 
    {
        $response = $this->post(route('store_company'));
        $response->assertSessionHasErrors(['symbol']);
    }

    /* validation if symbol is invalid */
    public function test_symbol_invalid() 
    {
        $response = $this->post(route('store_company'),
            ['symbol'=>'AMRN1']
        );
        $response->assertSessionHasErrors(['symbol']);
    }


    /* validation if start_date is missing */
    public function test_start_date_missing() 
    {
        $response = $this->post(route('store_company'));
        $response->assertSessionHasErrors(['start_date']);
    }


     /* validation if start_date is invalid formate */
    public function test_start_date_invalid_formate()
    {
        $response = $this->post(route('store_company'),
            ['start_date'=>'03-09-2022']
        );
        $response->assertSessionHasErrors(['start_date']);
    }


     /* validation if start_date is greater from end_date */
    public function test_start_date_greater_from_end_date()
    {
        $response = $this->post(route('store_company'),
            ['start_date'=>now()->addDay()->toDateString(),'end_date'=>now()->toDateString()]
        );
        $response->assertSessionHasErrors(['start_date']);
    }

    /* validation if end_date is missing */
    public function test_end_date_missing() 
    {
        $response = $this->post(route('store_company'));
        $response->assertSessionHasErrors(['end_date']);
    }


    /* validation if end_date is invalid formate */
    public function test_end_date_invalid_formate() 
    {
       $response = $this->post(route('store_company'),
        ['end_date'=>'03-09-2022']
        );
       $response->assertSessionHasErrors(['end_date']); 
    }

    /* validation if end_date is less from start_date */
    public function test_end_date_less_from_start_date() 
    {
        $response = $this->post(route('store_company'),
            ['end_date'=>now()->toDateString(),'start_date'=>now()->addDay()->toDateString()]
        );
        $response->assertSessionHasErrors(['end_date']);
    }


    /* validation if email is missing */
    public function test_email_missing() 
    {
        $response = $this->post(route('store_company'));
        $response->assertSessionHasErrors(['email']);
    }


    /* validation if email is valid */
    public function test_email_valid() 
    {
         $response = $this->post(route('store_company'),
            ['email'=>'name123']
        );
        $response->assertSessionHasErrors(['email']);
    }



    /* validation if everything is valid and data can save */
    public function test_company_info_save() 
    {
        $save_info=[
            'symbol'=>'AMRN',
            'start_date'=>now()->toDateString(),
            'end_date'=>now()->addDay()->toDateString(),
            'email'=>'numanamin111@gmail.com'
            ];

        $response = $this->post(route('store_company'),
            $save_info
        );


        $response->assertRedirect(route('graph_view',
            ['symbol'=>$save_info['symbol'],
             'start_date'=>$save_info['start_date'],
             'end_date'=>$save_info['end_date']
           ])
        );
    }

}
