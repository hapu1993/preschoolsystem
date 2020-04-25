@extends('layouts.master')

@section('content')

    <main>

        <div class="container-fluid text-center">
            <!-- Grid row -->
            <div class="row">
                <div class="col-md-2 "></div>
                <div class="col-md-8 ">

                    <div class="card mx-xl-5 ">

                        <!-- Card body -->
                        <div class="card-body ">
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    Succefully added absent letter
                                </div>

                            @endif

                            <!-- Default form subscription -->
                            <form method="post" action="{{route('absent.store')}}">
                                @csrf
                                <p class="h4 text-center py-4">Create Absence Letter</p>

                                <!-- Default input name -->
                                <label for="defaultFormCardNameEx" class="black-text font-weight-light">Register Number</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="student_id" style="display: block !important;">
                                    @foreach($students as $student)
                                        <option value="{{$student->id}}">{{$student->name}} | {{$student->reg_no}}</option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>

                                <!-- Default input email -->
                                <label for="defaultFormCardEmailEx" class="black-text font-weight-light">Absent Date</label><br>
                                <label for="defaultFormCardEmailEx" class="grey-text font-weight-light">From</label>
                                <input type="date" id="defaultFormCardEmailEx" class="form-control" name="from">

                                @error('from')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="defaultFormCardEmailEx" class="grey-text font-weight-light">To</label>
                                <input type="date" id="defaultFormCardEmailEx" class="form-control" name="to">

                                @error('to')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
                                <div class="form-group">
                                    <label for="defaultFormCardEmailEx" class="black-text font-weight-light">Absent Reason</label>
                                    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="reason"></textarea>
                                    @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="text-center py-4 mt-3">
                                    <button class="btn btn-outline-blue" type="submit">Send <i
                                            class="fa fa-paper-plane-o ml-2"></i></button>
                                </div>
                            </form>
                            <!-- Default form subscription -->

                        </div>
                        <!-- Card body -->

                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

    </main><br>
@endsection


