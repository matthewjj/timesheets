<?php

use App\Models\Timesheet;
use App\Repositories\TimesheetRepositoryInterface;
use App\Services\TimesheetService;
use Mockery;
use Illuminate\Support\Collection;

it('can create a timesheet', function () {
    
    $date = now()->format('Y-m-d');
    $name = 'Test Task';
    $duration = 60;
    
    $timesheetReport = Mockery::mock(TimesheetRepositoryInterface::class);
    $timesheetReport->shouldReceive('save')->andReturn(new Timesheet([
        'task_date' => $date,
        'task_name' => $name,
        'task_duration_minutes' => $duration,
    ]));

    $timesheetService = new TimesheetService($timesheetReport);

    $timesheet = $timesheetService->createEntry([
        'task_date' => $date,
        'task_name' => $name,
        'task_duration_minutes' => $duration,
    ]);

    expect($timesheet)->toBeInstanceOf(Timesheet::class);
    expect($timesheet->task_date)->toBe($date);
    expect($timesheet->task_name)->toBe($name);
    expect($timesheet->task_duration_minutes)->toBe($duration);
});

it('can get all timesheets', function () {

    $timesheetReport = Mockery::mock(TimesheetRepositoryInterface::class);
    $timesheetReport->shouldReceive('getAll')->andReturn(collect([
        new Timesheet(['task_date' => '2021-01-01', 'task_name' => 'Task 1', 'task_duration_minutes' => 60]),
        new Timesheet(['task_date' => '2021-01-02', 'task_name' => 'Task 2', 'task_duration_minutes' => 30]),
    ]));

    $timesheetService = new TimesheetService($timesheetReport); 
    $timesheets = $timesheetService->getAll();

    expect($timesheets)->toBeInstanceOf(Collection::class);
});

