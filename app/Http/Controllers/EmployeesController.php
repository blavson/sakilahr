<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
//        $employees = Employee::all()->take(50);
//        $employees = DB::SELECT('select * from employees left join dept_emp using(employee_id) inner join departments on departments.department_id = dept_emp.department_id and dept_emp.to_date="9999-01-01" limit 10');

        if (isset($request)) {
            $searchString = $request->query('searchString');
        }

        $queryStringLeft  = '(SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
                         from employees
                          left outer join dept_manager on dept_manager.employee_id = employees.employee_id
                          left  join dept_emp on dept_emp.employee_id = employees.employee_id
                           join departments on departments.department_id = dept_emp.department_id ';

        $queryStringRight = " (SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name ,
                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
                         from employees
                           right outer join dept_manager on dept_manager.employee_id = employees.employee_id
                             join dept_emp on dept_emp.employee_id = employees.employee_id
                            join departments on departments.department_id = dept_emp.department_id";
       if (!empty($searchString)) {
           $queryStringLeft .= " WHERE employees.last_name like '%" . $searchString . "%' ";
           $queryStringRight .= " WHERE employees.last_name like '%" . $searchString . "%' ";
       }
//       dd($queryStringLeft . " ORDER BY employees.employee_id) " .
//           " union " .
//           $queryStringRight . " ORDER BY employees.employee_id) " .
//           " ORDER BY eid LIMIT 20') ");
        $employees = DB::SELECT($queryStringLeft . " ORDER BY employees.employee_id ) " .
                                        " union " .
                                      $queryStringRight . " ORDER BY employees.employee_id ) " .
                            " ORDER BY eid LIMIT 20");

        return view('employees.all', ['employees' => $employees]);
    }

    public function show(Employee $employee)
    {
//        $employee = Employee::where('employee_id', $id)->first();
        return view('employees.show', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        $this->authorize('edit_employees');
        $departments = Department::all()->toArray();
        $roles = Role::all()->toArray();
        return view('employees.edit', ['employee' => $employee, 'departments' => $departments, 'roles' => $roles]);
    }


    public function create()
    {
        $this->authorize('edit_employees');
        $departments = Department::all();
        $roles = Role::all();
        return view('employees.create', ['departments' => $departments, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->authorize('edit_employees');
        $request->validate(['first_name' => ['max:255', 'string'],
            'last_name' => ['max:255', 'string'],
            'birth_date' => ['date'],
            'gender' => ['string', 'max:10'],
            'department' => ['integer'],
            'role_id' => ['integer']]);

        $employee = new Employee(['first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'birth_date' => $request->get('birth_date'),
            //  'deptemp->f'irst()->department_id = $request->get('department');
            'gender' => $request->get('gender'),
            'role_id' => $request->get('role_id')]);
        $employee->deptemp()->create(['department_id' => $request->get('department')]);
        $employee->save();

    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('edit_employees', 'GTFO');
        $request->validate([
            'first_name' => ['max:255', 'string'],
            'last_name' => ['max:255', 'string'],
            'birth_date' => ['date'],
            'gender' => ['string', 'max:2'],
            'role_id' => ['integer'],
            'department' => ['integer'],
        ]);
        $employee->first_name = $request->get('first_name');
        $employee->last_name = $request->get('last_name');
        $employee->birth_date = $request->get('birth_date');
        $employee->deptemp->first()->department_id = $request->get('department');
        $employee->gender = $request->get('gender');
        $employee->role_id = $request->get('role_id');
        $employee->push();

        return redirect('/dashboard')->with('success', 'Employee updated.');
    }

    public function search(Request $request)
    {
//        $this->validate([
//                        'searchString' => ['string','max:40']
//        ]);
        $searchString = $request->get('searchString');
        return Redirect::route('employees.index', ['searchString' => $searchString])->with('message', 'Everything is OK');

    }
}
