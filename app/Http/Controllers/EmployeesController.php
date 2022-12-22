<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function index()
    {
//        $employees = Employee::all()->take(50);
//        $employees = DB::SELECT('select * from employees left join dept_emp using(employee_id) inner join departments on departments.department_id = dept_emp.department_id and dept_emp.to_date="9999-01-01" limit 10');

//      dd(auth()->user());
        $employees = DB::SELECT('(SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id , dept_emp.department_id as empdeptid
                         from employees
                          left outer join dept_manager on dept_manager.employee_id = employees.employee_id
                          left  join dept_emp on dept_emp.employee_id = employees.employee_id
                           join departments on departments.department_id = dept_emp.department_id
                          ORDER BY employees.employee_id)
                        union
                        (SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name ,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id ,  dept_emp.department_id as empdeptid
                         from employees
                           right outer join dept_manager on dept_manager.employee_id = employees.employee_id
                             join dept_emp on dept_emp.employee_id = employees.employee_id
                            join departments on departments.department_id = dept_emp.department_id
                           ORDER BY employees.employee_id
                        )
                        ORDER BY eid');
        return view('employees.all', ['employees' => $employees]);
    }

    public function show(Employee $employee)
    {
//        $employee = Employee::where('employee_id', $id)->first();
        return view('employees.show', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all()->toArray();
        $roles = Role::all()->toArray();
        return view('employees.edit', ['employee' => $employee, 'departments' => $departments, 'roles' => $roles]);
    }

//    public function store(Request $request) {
//        $request->validate([
//            'first_name' => ['max:255' , 'string'],
//            'last_name' => ['max:255' , 'string'],
//            'birth_date' => ['date'],
//            'gender' => ['string', 'max:10'],
//            'department_id' => ['integer'],
//            'role_id' => ['integer']
//        ]);
//
//        $emp = new Employee($request->only('first_name', 'last_name', 'birth_date', 'gender', 'department', 'role'));
//        $emp->save();
//        return redirect('dashboard', 201);
//    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => ['max:255' , 'string'],
            'last_name' => ['max:255' , 'string'],
            'birth_date' => ['date'],
            'gender' => ['string', 'max:2'],
            'role_id' => ['integer'],
//            'department_id' => ['integer'],
        ]);

        // Getting values from the blade template form
        $employee->first_name =  $request->get('first_name');
        $employee->last_name =  $request->get('last_name');
        $employee->birth_date = $request->get('birth_date');
//        $deptID = $request->get('department_id');
        $employee->gender = $request->get('gender');
        $employee->role_id = $request->get('role_id');
//        dd($employee);
        $employee->save();

        return redirect('/dashboard')->with('success', 'Employee updated.');
    }
}
