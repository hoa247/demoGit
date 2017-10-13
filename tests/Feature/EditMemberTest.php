<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\M_member;


class EditMemberTest extends TestCase
{

	use WithoutMiddleware;
	use DatabaseMigrations;

   
    public function testEditMemberSuccess()
    {
    	$member = factory(M_member::class)->create();
        UploadedFile::fake()->image('avatar.jpg');
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];

    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseHas('tbl_member', $request);
    	// $this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberNameNotAlphabeticCharacters()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa12',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberNameGreaterThan100Characters()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'aabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabca',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberAddressGreaterThan300Characters()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaa',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberAgeIsNotNumeric()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => '1a',
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberAgeGreaterThan2Characters()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => 233,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberNameEmpty()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => '',
    		'c_address' => 'abc',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberAddressEmpty()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => '',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberAgeEmpty()
    {
    	$member = factory(M_member::class)->create();
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => '',
    	];
    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    
}
