<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function all()
    {
//        $employees = Employee::all()->take(50);
        $employees = DB::SELECT('select * from employees left join dept_emp using(employee_id) inner join departments on departments.dept_no = dept_emp.dept_no and dept_emp.to_date="9999-01-01" limit 10');
        return view('employees.all', ['employees' => $employees ]);
    }
}
