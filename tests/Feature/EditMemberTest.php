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
    	$request = [
    		'c_name' => 'hoa',
    		'c_address' => 'ha noi',
    		'c_age' => 23,
    	];

    	$response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
    	$this->assertDatabaseHas('tbl_member', $request);
    	// $this->assertDatabaseMissing('tbl_member', $request);
    }
    public function testEditMemberSuccessHasImage()
    {
        $member = factory(M_member::class)->create();
        $image
            = new UploadedFile(base_path('public\demo2\2.jpg'),
            '2.png', 'image/png', 111, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
        $this->assertDatabaseHas('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
    }
    public function testEditMemberNotIsImage()
    {
        $member = factory(M_member::class)->create();
        $image
            = new UploadedFile(base_path('public\demo2\abc.png'),
            'Document.txt', 'text/txt', 200, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
        $this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
    }
    public function testEditMemberWrongFormatImage()
    {
        $member = factory(M_member::class)->create();
        $image
            = new UploadedFile(base_path('public\demo2\Picture5.bmp'),
            'Picture5.bmp', 'images/bmp', 200, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
        $this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
    }
    public function testEditMemberImageEqual10Mb()
    {
        $member = factory(M_member::class)->create();
        $image
            = new UploadedFile(base_path('..\1.jpg'),
            'Document.txt', 'text/txt', 200, $error = null, $test = true);
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
            'c_photo' => $image,
        ];

        $response = $this->call('POST', 'edit_ajax/'.$member->id, $request);
        $this->assertDatabaseMissing('tbl_member', [
            'c_name' => 'hoa',
            'c_address' => 'ha noi',
            'c_age' => 23,
        ]);
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
    public function testEditMemberAddressNotAlphabeticCharacters()
    {
        $member = factory(M_member::class)->create();
        $request = [
            'c_name' => 'hoa',
            'c_address' => 'abc#',
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
