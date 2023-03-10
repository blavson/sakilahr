<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {

//        $queryStringLeft  = '(SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name,
//                                   employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
//                                 from employees
//                                      left outer join dept_manager on dept_manager.employee_id = employees.employee_id
//                                       left  join dept_emp on dept_emp.employee_id = employees.employee_id
//                                       join departments on departments.department_id = dept_emp.department_id ';
//
//        $queryStringRight = " (SELECT employees.employee_id as eid, employees.first_name, employees.last_name, employees.gender, employees.birth_date, departments.department_name ,
//                        employees.email , dept_manager.employee_id as manager_id, dept_manager.department_id
//                         from employees
//                           right outer join dept_manager on dept_manager.employee_id = employees.employee_id
//                             join dept_emp on dept_emp.employee_id = employees.employee_id
//                            join departments on departments.department_id = dept_emp.department_id";


        $employeesLeft = \Illuminate\Support\Facades\DB::table('employees')->
        select('employees.employee_id as eid', 'employees.first_name', 'employees.last_name', 'employees.gender', 'employees.birth_date', 'departments.department_name','employees.email' , 'dept_manager.employee_id as manager_id', 'dept_emp.department_id' ) ->
        leftjoin('dept_manager', 'employees.employee_id', '=', 'dept_manager.employee_id')->
        leftjoin('dept_emp', 'employees.employee_id', '=', 'dept_emp.employee_id')->
        leftjoin('departments', 'departments.department_id', '=', 'dept_emp.department_id');

        $employees = \Illuminate\Support\Facades\DB::table('employees')->
        select('employees.employee_id as eid', 'employees.first_name', 'employees.last_name', 'employees.gender', 'employees.birth_date','departments.department_name','employees.email' , 'dept_manager.employee_id as manager_id', 'dept_emp.department_id' ) ->
        leftJoin('dept_manager', 'employees.employee_id', '=', 'dept_manager.employee_id')->
        rightJoin('dept_emp', 'employees.employee_id', '=', 'dept_emp.employee_id')->
        leftjoin('departments', 'departments.department_id', '=', 'dept_emp.department_id')->union($employeesLeft)->orderBy('eid')->paginate(20);

//        dd($employees);
//       if (!empty($searchString)) {
//           $queryStringLeft .= " WHERE employees.last_name like '%" . $searchString . "%' ";
//           $queryStringRight .= " WHERE employees.last_name like '%" . $searchString . "%' ";
//       }
//
//        $employees = DB::SELECT($queryStringLeft . " ORDER BY employees.employee_id ) " .
//                                        " union " .
//                                      $queryStringRight . " ORDER BY employees.employee_id ) " .
//                            " ORDER BY eid LIMIT 20");

//        $employees = $this->arrayPaginator($employees, $request);
//        $page =  $request->input('page', 1);
////        dd($page, $request->url(), $request->query());
//        $perPage = 20;
//        $offset = ($page  -1 ) * $perPage;
////        $employees = new  LengthAwarePaginator(array_slice($employees, $offset, $perPage, false), count($employees), $perPage, $page,
////            ['path' => $request->url() , 'query' => $request->query()]);
        $searchString = "";
        return view('employees.all', ['employees' => $employees, 'searchString' => $searchString ]);
    }

    public function arrayPaginator($array, $request):LengthAwarePaginator
    {
        $page =  $request->input('page', 1);
//        dd($page, $request->url(), $request->query());
        $perPage = 20;
        $offset = ($page  -1 ) * $perPage;
        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url() , 'query' => $request->query()]);
    }
    public function show(Employee $employee)
    {
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
        $searchString = $request->get('searchString');
        return Redirect::route('employees.index', ['searchString' => $searchString])->withInput();
    }
}
