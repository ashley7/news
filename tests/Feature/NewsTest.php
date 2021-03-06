<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\NewContent;
use Faker\Generator as Faker;

class NewsTest extends TestCase
{
    public function test_news_post()
    {
		$this->withoutMiddleware();
    	Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
 
     	$response = $this->json("POST","/news",['title'=>'Uganda develops factories','description'=>'The class provides a fake method which may be used to generate dummy files or images for testing','file_url'=>$file]);

     	$response->assertStatus(302);
    }

    public function test_count_articals()
    {
      $check_count = $this->get('/number_of_articals');
      $check_count->assertSuccessful();
    }

    public function test_whole_artical()
    {
    	$response = $this->get('/news/2');
    	$response->assertOk();
    }

    public function test_delete_artical()
    {
    	$this->withoutMiddleware();
    	$response = $this->call("DELETE","/news/39");
    	$response->assertStatus(302);    	 
    }
}
