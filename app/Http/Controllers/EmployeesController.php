<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function all()
    {
        $employees = Employee::all()->take(50);
        return view('employees.all', ['employees' => $employees ]);
    }
}
