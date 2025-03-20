<?php

namespace App\Repositories;

use App\Models\Timesheet;
use Illuminate\Support\Collection;
interface TimesheetRepositoryInterface
{
    public function save(array $data): Timesheet;

    public function getAll(): Collection;
}