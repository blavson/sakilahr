<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function list()
    {
//        $employees = Employee::all()->take(50);
//        $employees = DB::SELECT('select * from employees left join dept_emp using(employee_id) inner join departments on departments.department_id = dept_emp.department_id and dept_emp.to_date="9999-01-01" limit 10');
        $employees = DB::SELECT('(SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
                         from employees
                          left outer join dept_manager on dept_manager.employee_id = employees.employee_id
                          left  join dept_emp on dept_emp.employee_id = employees.employee_id
                           join departments on departments.department_id = dept_emp.department_id
                          ORDER BY employees.employee_id)
                        union
                        (SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name ,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
                         from employees
                           right outer join dept_manager on dept_manager.employee_id = employees.employee_id
                             join dept_emp on dept_emp.employee_id = employees.employee_id
                            join departments on departments.department_id = dept_emp.department_id
                           ORDER BY employees.employee_id
                        )
                        ORDER BY eid');
        return view('employees.all', ['employees' => $employees]);
    }

    public function show($id)
    {
        $employee = Employee::where('employee_id', $id)->first();
        return view('employees.show', ['employee' => $employee]);
    }
}
