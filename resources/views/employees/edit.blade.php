@extends('main')


@section('body')
    <form>
        <div class='col-md-6 ml-4 mt-3 mx-10'>
            <div class="form-group mx-8 mb-4">
                <label for="employee_first_name">First Name</label>
                <input type="text" class="form-control" name="employee_first_name" placeholder="First Name" value="{{ $employee->first_name }}">
            </div>
            <div class="form-group mx-8 mb-4">
                <label for="employee_last_name">Last Name</label>
                <input type="text" class="form-control" name="employee_last_name" placeholder="Last Name" value="{{ $employee->last_name }}">
            </div>
            <div class="form-group mx-8 mb-4">
                <label for="employee_birth_date">Birth Date</label>
                <input type="date" class="form-control" name="employee_birth_date" value="{{$employee->birth_date}}">
            </div>
            <div class="form-group">
                <label for="sel1">Select Department:</label>
                <select class="form-control" name="selDepts">
                    @foreach($departments as $department)
                        @if ( $employee->deptemp->first()->department_id ==  $department['department_id']  )
                             <option value="{{ $department['department_id'] }}" selected='selected'>{{ $department['department_name'] }}</option>
                        @else
                            <option value="{{ $department['department_id'] }}" >{{ $department['department_name'] }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
