<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\M_member;


class DeleteMemberTest extends TestCase
{

	use WithoutMiddleware;
	use DatabaseMigrations;

   
    public function testDeleteMemberSuccess()
    {
    	$member = factory(M_member::class)->create([
    		'c_name' => 'hoa',
    		'c_address' => 'hanoi',
    		'c_age' => 23,
    	]);
        $request = [
            'id' => $member->id,
        ];

    	$response = $this->call('GET', 'delete_member',$request);
        // $this->assertEquals(200, $response->status());
    	$this->assertDatabaseMissing('tbl_member', [
    		'c_name' => 'hoa',
    		'c_address' => 'hanoi',
    		'c_age' => 23,
    	]);
    	
    }

    public function testDeleteMemberFailed()
    {
        $member = factory(M_member::class)->create([
            'c_name' => 'hoa',
            'c_address' => 'hanoi',
            'c_age' => 23,
        ]);
        $request = [
            'id' => 3,
        ];

        $response = $this->call('GET', 'delete_member',$request);
        $this->assertEquals(500, $response->status());
        
    }
    
    
}
