@extends('layouts.master')

@section('content')

    <!--Main layout-->
    <main>
            <div class="container-fluid text-center">
                <!-- Grid row -->
                <form class="absentSearch" action="{{route('absent.list')}}" method="get">
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
                        <input type="text" id="defaultFormCardEmailEx" class="form-control" name="student" placeholder="Student Name or Reg" value="{{request()->student}}">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mt-0 mb-0" style="width:100%">Search</button>


                    </div>
                </div>
                </form>

                <div class="row">



                    <div class="com-md-4"> </div>
                    @if(Auth::user()->role == 2)
                        <div class="com-md-4"> <b style="color:white"> Class : {{Auth::user()->teacherClass->classMain->name}} </b> </div>
                        <div class="com-md-4 pl-5"> <b style="color:white"> Level : {{Auth::user()->teacherClass->levelMain->name}} </b> </div>
                        @endif


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
                                            <th class="th-sm">From
                                            </th>
                                            <th class="th-sm">To
                                            </th>
                                            <th class="th-sm">Reason
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($absent_letters as $absent_letter)
                                            <tr>

                                                <td>{{$absent_letter->id}}</td>
                                                <td>{{$absent_letter->reg_no}}</td>
                                                <td>{{$absent_letter->student->name}}</td>
                                                <td>{{$absent_letter->from}}</td>
                                                <td>{{$absent_letter->to}}</td>
                                                <td>{{$absent_letter->reason}}</td>
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

@endsection


