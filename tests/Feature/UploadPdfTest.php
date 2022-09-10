<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\File;


class UploadPdfTest extends TestCase
{


    /**
     * @test
     * Upload PDF File
     */
    public function testUploadPdfFile()
    {
        //Create user
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //Attempt login
        $response = $this->json('POST',route('api.authenticate'),[
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ]);
        $accessToken = $response['access_token'];


        $fileData = [
            'pdf' => UploadedFile::fake()->create('fakefile.pdf', 100)
        ];    
        $data = [];  
        $url = '/api/upload-pdf';    

        $response = $this->call('POST', $url, $data, [], $fileData, 
        $this->transformHeadersToServerVars([
            'Authorization' => "Bearer".$accessToken
          ]));    

        $response->assertStatus(200);

        //Delete file & Delete user//
        $userId = User::where('email','test@gmail.com')->value('id');
        $file   = File::where('user_id',$userId)->first();
        $fileUrl = \Storage::disk('pdf')->path($file->file_name);
        \Storage::disk('pdf')->delete($file->file_name); 
        $file->delete();
        User::where('email','test@gmail.com')->delete();
    }
    

     /**
     * @test
     * Negative Scenarios........
     */
     //..........
}
