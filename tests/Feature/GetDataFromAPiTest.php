<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetDataFromAPiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_api_data()
    {
         $response = $this->get(route('graph_view'),
            ['symbol'=>'AMRN',
             'start_date'=>'2022-04-01',
             'end_date'=>'2022-09-01',
           ]
        );
        $response->assertStatus(200);
    }
}