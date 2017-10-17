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

        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            
        ];
    
        $response = $this->call('POST', 'add_ajax', $request);
        
        $this->assertDatabaseHas('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
        // $this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberSuccessHasImage()
    {
            copy('public\demo2\1\1.jpg','public\demo2\1.jpg');   
         $image
            = new UploadedFile(base_path('public\demo2\1.jpg'),
            '1.png', 'image/png', 111, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];
    
        $response = $this->call('POST', 'add_ajax', $request);
        
        $this->assertDatabaseHas('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
        // $this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testAddMemberNotIsImage()
    {

         $image
            = new UploadedFile(base_path('public\demo2\abc.png'),
            'Document.txt', 'text/txt', 200, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'add_ajax', $request);
        
        $this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
        
    }
    public function testAddMemberWrongFormatImage()
    {

         $image
            = new UploadedFile(base_path('public\demo2\Picture5.bmp'),
            'Picture5.bmp', 'images/bmp', 200, $error = null, $test = true);
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
    	];

    	$response = $this->call('POST', 'add_ajax', $request);
        
    	$this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
    	
    }
    public function testAddMemberImageEqual10Mb()
    {

         $image
            = new UploadedFile(base_path('..\1.jpg'),
            'Document.txt', 'text/txt', 200, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'add_ajax', $request);
        
        $this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
        
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
    public function testAddMemberAddressNotAlphabeticCharacters()
    {
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'abc#',
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
