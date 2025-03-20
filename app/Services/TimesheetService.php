<?php

namespace App\Services;

use App\Models\Timesheet;
use App\Repositories\TimesheetRepositoryInterface;
use Illuminate\Support\Collection;

class TimesheetService
{
    public function __construct(protected TimesheetRepositoryInterface $timesheetRepository)
    {
        $this->timesheetRepository = $timesheetRepository;
    }

    public function createEntry(array $data): Timesheet
    {
        return $this->timesheetRepository->save($data);
    }

    public function getAll(): Collection
    {
        return $this->timesheetRepository->getAll();
    }
    
}