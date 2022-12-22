@extends('main')


@section('body')
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 100%;">
        <div class='row'>

            <div class='col-md-8'>
                <a href="/"
                   class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                    <span class="fs-5 fw-semibold">Employees</span>
                </a>
            </div>
            <div class='col-md-4'>
                <a href="{{route('employee.create')}}" ><button class='btn btn-primary py-3 mx-8 btn-block w-100 h-100' type='submit'>Add User</button></a>
            </div>
        </div>

        <div class="list-group list-group-flush border-bottom scrollarea">
            @foreach($employees as $employee)
                @if (isset($employee->manager_id))
                    <h1>HELLO</h1>
                    <div class="d-flex w-100 align-items-center  active justify-content-between ">
                        @else
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                @endif
                                <div class="col-sm-1">
                                    <strong>{{ $employee->eid }}</strong>
                                </div>
                                <div class="col-sm-7">
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

                                <div class="col-sm-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#EE12AC"
                                         class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                    <a href="/employee/{{ $employee->eid }}/edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                                            <path
                                                d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                    </div>
        </div>

@endsection
