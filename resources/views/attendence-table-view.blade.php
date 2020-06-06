@extends('layouts.master')

@section('content')

    <!--Main layout-->
    <main>
        <div class="container-fluid text-center">
            <!-- Grid row -->
            <div class="row pb-4">
            @if(Auth::user()->role == 2)
                <div class="col-md-2"> <b style="color:white"> Class : {{Auth::user()->teacherClass->classMain->name}} </b> </div>
                <div class="col-md-2"> <b style="color:white"> Level : {{Auth::user()->teacherClass->levelMain->name}} </b> </div>
            @endif
            </div>
            <form class="absentSearch" action="{{route('attendence.table.list')}}" method="get">
                <div class="row">
                    @if(Auth::user()->role == 1)
                        <div class="col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1" name="class" style="display: block !important;">
                                <option value="" >All</option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{ request()->class == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1" name="level" style="display: block !important;">
                                <option value="" >All</option>
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}" {{ request()->level == $level->id ? 'selected' : ''}}>{{$level->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif
                        <div class="col-md-3">
                            {{--<label for="defaultFormCardEmailEx" class="grey-text font-weight-light"> <b style="color:white">Date</b>  </label>--}}
                            <input type="date" id="defaultFormCardEmailEx" class="form-control" onchange="loadStudents(this)" name="date" value="{{request()->date ? request()->date : date('d-m-Y')}}" placeholder="Date">
                        </div>
                    <div class="col-md-3">
                        <input type="text" id="defaultFormCardEmailEx2" class="form-control" name="student" placeholder="Student Name or Reg" value="{{request()->student}}">

                    </div>

                </div>
                <div class="row pt-3">

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-0 mb-0" style="width:100%">Search</button>
                    </div>
                </div>
            </form>

            <div class="row">







            </div>
            <div class="row" style="display:flow-root">
                <div class="row" style="margin-top: 25px">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <div id="loading" style="display: none;">Loading..</div>
                                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">Auto Incriment Id
                                        </th>
                                        <th class="th-sm">Reg No
                                        </th>
                                        <th class="th-sm">Name
                                        </th>
                                        <th class="th-sm">Attendence
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attendences as $attendence)
                                        <tr>
                                            <td>{{$attendence->id}}</td>
                                            <td>{{$attendence->reg_no}}</td>
                                            <td>{{$attendence->name}}</td>
                                            <td>{{$attendence->attend_arranged}}</td>

                                        </tr>
                                    @endforeach
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <!--/Main layout-->
    </tbody><br>
<script>
    document.getElementById('defaultFormCardEmailEx').valueAsDate = new Date();


</script>
@endsection


