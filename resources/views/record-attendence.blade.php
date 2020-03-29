@extends('layouts.master')

@section('content')

    <!--Main layout-->
    <main>
        <form id="attendence-create" method="post" action="{{route('attendence.store')}}">
            @csrf
        <div class="container-fluid text-center">
            <!-- Grid row -->
            <div class="row">

                <div class="com-md-4">
                    <label for="defaultFormCardEmailEx" class="grey-text font-weight-light"> <b style="color:white">Date</b>  </label>
                    <input type="date" id="defaultFormCardEmailEx" class="form-control" onchange="loadStudents(this)" name="date" value="{{date('d-m-Y')}}">
                </div>

                <div class="com-md-4"> </div>

                <div class="com-md-4"> <b style="color:white"> Class : {{Auth::user()->teacherClass->classMain->name}} </b> </div>

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

                                            <th class="th-sm">Attend
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->id}}</td>
                                            <td>{{$student->reg_no}}</td>
                                            <td>{{$student->name}}</td>

                                            <td>

                                                <!-- Group of default radios - option 1 -->
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="example{{$student->id}}" name="attend[{{$student->id}}]" value="yes" {{isset($student->attendenceByDate(\Carbon\Carbon::today())->first()->attend) ? ($student->attendenceByDate(\Carbon\Carbon::today())->first()->attend == 1) ? 'checked' : '' : ''}}>
                                                    <label class="custom-control-label" for="example{{$student->id}}">yes</label>
                                                </div>

                                                <!-- Group of default radios - option 2 -->
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" id="example{{$student->id}}{{$student->id}}" name="attend[{{$student->id}}]" value="no" {{isset($student->attendenceByDate(\Carbon\Carbon::today())->first()->attend) ? ($student->attendenceByDate(\Carbon\Carbon::today())->first()->attend == 0) ? 'checked' : '' : ''}}>
                                                    <label class="custom-control-label" for="example{{$student->id}}{{$student->id}}">No</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <div class="text-center py-4 mt-3">
                                        <button class="btn btn-outline-blue" type="button" onclick="recordAttendence()">Submit <i
                                                class="fa fa-paper-plane-o ml-2"></i></button>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </main>
    <!--/Main layout-->
    </tbody><br>
    <script>
        document.getElementById('defaultFormCardEmailEx').valueAsDate = new Date();
        function loadStudents(e) {
           var date = $(e).val();
            $("#loading").show();
            $('#dtBasicExample').find('tbody').empty();
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/load-attendence',
                dataType: 'json',
                data:{date:date},
                success: function (data) {
                    console.log(data);
                    $("#loading").hide();
                    $.each(data, function(k, v) {
                        //display the key and value pair
                        console.log(v.attend_arranged);
                        if(v.attend_arranged == 1){
                            var attend_yes = 'checked';
                            var attend_no = '';
                        }else{
                            var attend_yes = '';
                            var attend_no = 'checked';
                        }

                        var myRow = '<tr><td>' + v.id + '</td><td>' + v.reg_no + '</td><td>' + v.name + '</td><td>' +
                            '<div class="custom-control custom-radio"> ' +
                        '<input type="radio" class="custom-control-input" id="example'+v.id+'" name="attend['+v.id+']" value="yes" '+attend_yes+'>' +
                        '<label class="custom-control-label" for="example'+v.id+'">yes</label> ' +
                        '</div>'+
                            '<div class="custom-control custom-radio">'+
                            '<input type="radio" class="custom-control-input" id="example'+v.id+''+v.id+'" name="attend['+v.id+']" value="no" '+attend_no+'>'+
                        '<label class="custom-control-label" for="example'+v.id+''+v.id+'">No</label>'+
                            '</div></td></tr>';
                        $('#dtBasicExample').find('tbody').append(myRow);
                    });
                },error:function(){
                    console.log(data);
                }
            });

        }


        function recordAttendence() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.btn-outline-blue').html('Sending..');
            $.ajax({
                url: 'record-attendence/store' ,
                type: "POST",
                data: $('#attendence-create').serialize(),
                success: function( response ) {
                    $('.btn-outline-blue').html('Submit');
                    Swal.fire(
                        response.status,
                        response.status,
                        'success'
                    );
                }
            });
        }
    </script>
@endsection


