<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
{
    use HandlesAuthorization;


    public function view(Employee $employee)
    {
        $managers = Manager::where('employee_id', $employee->empoleye_id,)->pluck('employee_id')->to_array();
        return in_array($employee->employee_id, $managers);
    }
}
