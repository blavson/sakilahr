<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function setDepartments()
    {
        $employees = Employee::all();
        $query = "INSERT INTO "
        foreach ($employees as $employee) {
            $dept_id = 100 + rand(0, 10);

        }

    }
}
