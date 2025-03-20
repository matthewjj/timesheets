<?php

namespace App\Repositories;

use App\Models\Timesheet;
use App\Dto\TimesheetDto;
use Illuminate\Support\Collection;

class TimesheetRepository implements TimesheetRepositoryInterface
{
    public function save(array $data): Timesheet
    {
        return Timesheet::create([
            'task_date' => $data['task_date'],
            'task_name' => $data['task_name'],
            'task_duration_minutes' => $data['task_duration_minutes']
        ]);
    }

    public function getAll(): Collection
    {
        return Timesheet::all();
    }
}
