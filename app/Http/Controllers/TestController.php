<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function setDepartments()
    {
        $employees = Employee::all();
        $query = "INSERT INTO dept_emp values ";
        $str = '';
        foreach ($employees as $employee) {
            $dept_id = 101 + rand(0, 9);
        $str .= "({$employee->employee_id}, $dept_id, '2016-03-10', '9999-01-01', NOW(), NOW()),";
        }

        $str = rtrim($str, ',');

        $query .= $str;

//        dd($query);
        DB::insert($query);

    }
}
