@extends('main')


@section('body')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%;">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <svg class="bi pe-none me-2" width="30" height="24">
                <use xlink:href="#bootstrap"/>
            </svg>
            <span class="fs-5 fw-semibold">Employees</span>
        </a>

        <div class="list-group list-group-flush border-bottom scrollarea">
            @foreach($employees as $employee)
                <a href="#" class="list-group-item list-group-item-action  py-3 lh-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <div class="col-sm-1">
                            <strong>{{ $employee->employee_id }}</strong>
                        </div>
                        <div class="col-sm-8">
                            <strong class="mb-1">{{$employee->last_name}}   {{ $employee->first_name }}</strong>
                            <div class="col-10 mb-1 small">Some placeholder content in a paragraph below the heading and
                                date.
                            </div>
                        </div>
                        <div class="col-md-2">
                            {{ $employee->dept_name }}
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
