@extends('main')


@section('body')
<form method='POST' action="{{ route('employee.store') }}">
    @csrf
    <div class='col-md-6 ml-4 mt-3 mx-10'>
        <div class="form-group mx-8 mb-4">
            <label for="employee_first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="First Name" >
        </div>
        <div class="form-group mx-8 mb-4">
            <label for="employee_last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group mx-8 mb-4">
            <label for="employee_birth_date">Birth Date</label>
            <input type="date" class="form-control" name="birth_date" >
        </div>

        <div class="form-group mx-8 mb-4">
            <div class="form-check">
                <input type="radio" id="male" name="gender" value="M">
                <label for="male">Male</label>
            </div>
            <div class="form-check">
                <input type="radio" id="female"  name="gender" value="F">
                <label for="female">Female</label>
            </div>

        </div>
        <div class="form-group">
            <label for="department">Select Department:</label>
            <select class="form-control" name="department">
            @foreach($departments as $department)
                <option
                    value="{{ $department['department_id'] }}">{{ $department['department_name'] }}</option>
            @endforeach
            </select>
        </div>
        <div class="form-group mx-8 mt-4 mb-3">
            <label for="role_id">Select Roles:</label>
            <select class="form-control" name="role_id">
                @foreach($roles as $role)
                    <option value="{{ $role['id'] }}">{{  $role['label'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-lg btn-primary mt-2">Save</button>
    </div>
</form>
        <a href="/"><button  class="btn btn-lg btn-secondary mt-2">Cancel</button></a>
@endsection
