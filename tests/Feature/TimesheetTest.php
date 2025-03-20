<?php

use App\Models\Timesheet;
use App\Services\TimesheetService;

it('can create a timesheet', function () {
    
    $request = [
        'task_date' => '2021-01-01',
        'task_name' => 'Test Task',
        'task_duration_minutes' => '60',
    ];

    $this->post('/timesheets', $request)
        ->assertStatus(200);

    $this->assertDatabaseHas('timesheets', $request);
});

it('displays all timesheets', function () {
    $timesheets = Timesheet::factory()->count(3)->create();

    $response = $this->get('/timesheets');

    $response->assertInertia(fn ($assert) => $assert
        ->component('timesheets/index')
        ->has('timesheets', 3)
        ->where('timesheets.0.task_name', $timesheets->first()->task_name)
    );
});
