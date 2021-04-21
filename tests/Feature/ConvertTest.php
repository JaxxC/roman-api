<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ConvertTest extends TestCase
{
    use DatabaseTransactions;

    protected $testOk = [
        1 => 'I',
        3999 => 'MMMCMXCIX',
        198 => 'CXCVIII',
        1000 => 'M'
    ];

    protected $testError = [
        0,
        5000,
        'hello',
    ];
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConvertingGoodRequests()
    {
        foreach($this->testOk as $number => $roman){
            $response = $this->json('POST', '/api/convert', ['number' => $number]);
            $response->assertSuccessful()
                ->assertJsonPath('data.number', $number)
                ->assertJsonPath('data.roman', $roman)
                ->assertJsonStructure([
                    'data' => [
                        'number','roman'
                    ]
                ]);
        }
    }

    public function testConvertingBadRequests()
    {
        foreach($this->testError as $number){
            $response = $this->json('POST', '/api/convert', ['number' => $number]);
            $response->assertStatus(422);
        }
    }
}
