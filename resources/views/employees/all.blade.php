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
                <a href="{{route('employee.create')}}" >
                    <button class='btn btn-lg btn-primary d-inline-flex justify-content-center align-items-center' type='submit'>Add User
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                    </svg>
                    </button>
                </a>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
                                            <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                                            <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                                            <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                    </div>
        </div>

@endsection
