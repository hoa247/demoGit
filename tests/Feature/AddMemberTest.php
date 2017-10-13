<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AddMemberTest extends TestCase
{

	use WithoutMiddleware;
	use DatabaseMigrations;

   
    public function testAddMemberSuccess()
    {
        UploadedFile::fake()->image('avatar.jpg');
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'ha noi',
            'c_age' => 23,

    		
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseHas('tbl_member', $request);
    	// $this->assertDatabaseMissing('tbl_member', $request);
    }

    public function testAddMemberNameNotAlphabeticCharacters()
    {
    	$request = [
    		'c_name' => 'hoa12',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberNameGreaterThan100Characters()
    {
    	$request = [
    		'c_name' => 'aabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabca',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberAddressGreaterThan300Characters()
    {
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcacabcaabcabacabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaa',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberAgeIsNotNumeric()
    {
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => '1a',
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberAgeGreaterThan2Characters()
    {
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => 233,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberNameEmpty()
    {
    	$request = [
    		'c_name' => '',
    		'c_address' => 'abc',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberAddressEmpty()
    {
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => '',
    		'c_age' => 23,
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberAgeEmpty()
    {
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'abc',
    		'c_age' => '',
    	];
    	$response = $this->call('POST', 'add_ajax', $request);
    	$this->assertDatabaseMissing('tbl_member', $request);
    }
    
}
