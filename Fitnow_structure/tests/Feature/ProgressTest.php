<?php

namespace Tests\Feature;

use App\Models\Progress;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgressTest extends TestCase
{
    use RefreshDatabase;

    public function test_Show_user_progress(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/api/progress/history');

        $response->assertStatus(200);
    }

    public function test_Add_progress():void{
        $user = User::factory()->create();
        $this->actingAs($user);   
        $response = $this->post('api/progress', [
            'userID' => $user->id,
            'weight' => 12,
            'height' => 12,
            'waist_line' => 12,
            'bicep_thickness' => 12,
            'pec_width' => 12,
            'calve_thickness' => 12,
        ]);
        $response->assertStatus(200);
    }

    public function test_Update_progress():void{
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);   
        $response = $this->put('api/progress/'.$progress->id, [
            'weight' => 2,
            'height' => 12,
            'waist_line' => 1,
            'bicep_thickness' => 1,
            'pec_width' => 12,
            'calve_thickness' => 12,
        ]);
        $response->assertStatus(200);
    }

    public function test_Patch_progress():void{
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);   
        $response = $this->patch('api/progress/'.$progress->id, [
            'status' => 'finished',
        ]);
        $response->assertStatus(200);
    }
    
    public function test_Delete_progress():void{
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);   
        $response = $this->delete('api/progress/'.$progress->id);
        $response->assertStatus(200);
    }


}
