@extends('main')


@section('body')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%;">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">Employees</span>
        </a>

        <div class="list-group list-group-flush border-bottom scrollarea">
            @foreach($employees as $employee)
                <a href="/employees/{{ $employee->eid }}" class="list-group-item list-group-item-action  py-3 lh-sm" aria-current="true">
                   @if (isset($employee->manager_id))
                       <h1>HELLO</h1>
                        <div class="d-flex w-100 align-items-center  active justify-content-between ">
                    @else
                        <div class="d-flex w-100 align-items-center justify-content-between">
                    @endif
                        <div class="col-sm-1">
                            <strong>{{ $employee->eid }}</strong>
                        </div>
                        <div class="col-sm-8">
                            <strong class="mb-1">{{$employee->last_name}}   {{ $employee->first_name }}</strong>
                            <div class="col-10 mb-1 small"> {{ $employee->email }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{ $employee->department_name }}
                        </div>

                        <div class="col-sm-1">
                            {{$employee->birth_date}}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
