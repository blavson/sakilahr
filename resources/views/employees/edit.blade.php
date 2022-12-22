@extends('main')


@section('body')
    <form method='POST' action="{{ route('employee.update', $employee) }}">
        @csrf
        @method('patch')
        <div class='col-md-6 ml-4 mt-3 mx-10'>
            <div class="form-group mx-8 mb-4">
                <label for="employee_first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="First Name"
                       value="{{ $employee->first_name }}">
            </div>
            <div class="form-group mx-8 mb-4">
                <label for="employee_last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                       value="{{ $employee->last_name }}">
            </div>
            <div class="form-group mx-8 mb-4">
                <label for="employee_birth_date">Birth Date</label>
                <input type="date" class="form-control" name="birth_date" value="{{$employee->birth_date}}">
            </div>


            <div class="form-group mx-8 mb-4">
                <div class="form-check">
                    @if ($employee->gender == "M")
                     <input type="radio" id="male" checked name="gender" value="M">
                    @else
                     <input type="radio" id="male" name="gender" value="M">
                    @endif
                    <label for="male">Male</label>
                </div>
                <div class="form-check">
                    @if ($employee->gender == "F")
                        <input type="radio" id="female"  checked name="gender" value="F">
                    @else
                       <input type="radio" id="female"  name="gender" value="F">
                    @endif
                    <label for="female">Female</label>
                </div>

            </div>
            <div class="form-group">
                <label for="department">Select Department:</label>
                <select class="form-control" name="department">
                    @foreach($departments as $department)
                        @if ( $employee->deptemp->first()->department_id ==  $department['department_id']  )
                            <option value="{{ $department['department_id'] }}"
                                    selected='selected'>{{ $department['department_name'] }}</option>
                        @else
                            <option
                                value="{{ $department['department_id'] }}">{{ $department['department_name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group mx-8 mt-4 mb-3">
                <label for="role_id">Select Roles:</label>
                <select class="form-control" name="role_id">
                    @foreach($roles as $role)
                        @if ( $employee->role_id ==  $role['id']  )
                            <option value="{{ $role['id'] }}" selected='selected'>{{ $role['label'] }}</option>
                        @else
                            <option value="{{ $role['id'] }}">{{  $role['label'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-lg btn-primary mt-2">Save</button>
        </div>
    </form>
@endsection
