<!DOCTYPE html>

    <head>
        <title>Student ID Card</title>
          <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
        <style>
            table{
                border-collapse:collapse;
            }
            h2 h3{
                margin:0;
                padding: 0;
            }
            .table{
                width:100%;
                margin-bottom:1rem;
                background-color:transparent;
            }
            .table th,
            .table td{
                padding:0.75rem;
                vertical-align:top;
                border-top:1px solid #dee2e6;
            }
            .table thead th{
                vertical-align:bottom;
                boder-bottom:2px solid #dee2e6;
            }
            .table tbody + tbody{
                border-top:2px solid #dee2e6;
            }
            .table{
                background-color:#fff;
            }
            .table-bodered{
                border:1px solid #dee2e6;
            }
            .table-bodered th,
            .table-bodered td{
                border:1px solid #dee2e6;
            }
            .table-bodered thead th,
            .table-bodered thead td{
                border-bottom-width:2px;

            }
            .text-center{
                text-align:center;
            }
            .text-right{
                text-align:right;
            }

            table tr td{
                padding:5px;
            }
            .table-bodered thead th, .table-bodered td, .table-bodered th{
                boder:1px solid black !important;
            }

        </style>
    </head>
    <body>
        <div class="card-body">
                  <div style="border:solid 2px; padding:7px">
                    <div class="row">
                        <div class="col-md-2 text-center" style="float:right">
                            <img src="{{url('public/upload/download.jpg')}}" alt="" style="width:100px; height:100px">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-center" style="float:left">
                                <h4><strong>ABC School</strong></h4>
                                <h5><strong>Dhaka mirpur 12</strong></h5>
                                <h6><strong>www.micreowebit.com</strong></h6>
                                <h6><strong>Academic Transcript</strong></h6>
                                <h6><strong>{{$allMarks['0']['examType']['name']}}</strong></h6>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr style="border:1px solid; width:100%;margin-bottom:0px;color:#DDD">
                        <p style="text-align:right;"><u><i>Priont Date:</i>{{date("d M Y")}}</u></p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table border="1" width="100%" cellpadding="9" cellspacing="1"  >
                                @php 
                                    $assign_student = App\Model\AssignStudent::where('year_id',$allMarks['0']->year_id)->where('class_id',$allMarks['0']->class_id)->first();

                                @endphp
                                <tr>
                                    <td width="50%">Student Id</td>
                                    <td width="50%">{{$allMarks['0']->id_no}}</td>
                                </tr>
                                 <tr>
                                    <td width="50%">Roll No</td>
                                    <td width="50%">{{$assign_student->roll}}</td>
                                </tr>
                                 <tr>
                                    <td width="50%">Name</td>
                                    <td width="50%">{{$allMarks['0']['student']->name}}</td>
                                </tr>
                                 <tr>
                                    <td width="50%">Class</td>
                                    <td width="50%">{{$allMarks['0']['studentClass']->name}}</td>
                                </tr>
                                 <tr>
                                    <td width="50%">Session</td>
                                    <td width="50%">{{$allMarks['0']['year']->name}}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6">
                            <table border="1" width="100%" cellpadding="1" cellspacing="2" class="text-center">
                                @php 
                                    $assign_student = App\Model\AssignStudent::where('year_id',$allMarks['0']->year_id)->where('class_id',$allMarks['0']->class_id)->first();

                                @endphp
                                <tr>
                                    <td width="33%"><strong>Letter Grade</strong></td>
                                    <td width="33%"><strong>Marks Interval</strong></td>
                                    <td width="33%"><strong>Grade Point</strong></td>
                                </tr>
                                @foreach($allGrade as $grade)
                                <tr>
                                    <td width="33%">{{$grade->grade_name}}</td>
                                    <td width="33%">{{$grade->start_mark}} - {{$grade->end_mark}}</td>
                                    <td width="33%">{{number_format((float)$grade->grade_point,2)}} - {{($grade->grade_point == 5)?(number_format((float)$grade->grade_point,2)):(number_format((float)$grade->grade_point+1,2)-(float)0.01)}}</td>
                                </tr>
                                @endforeach
                                 

                            </table>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table border="1" cellpadding="1" cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Subjects</th>
                                        <th class="text-center">Full Marks</th>
                                        <th class="text-center">Get Marks</th>
                                        <th class="text-center">Letter Grade</th>
                                        <th class="text-center">Grade Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $total_marks = 0;
                                        $total_point = 0;
                                    @endphp
                                    @foreach($allMarks as $key => $mark)
                                    @php 
                                        $get_mark = $mark->marks;
                                        $total_marks = (float)$total_marks+(float)$get_mark;
                                        $total_subject = App\Model\StudentMark::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_type_id',$mark->exam_type_id)->where('student_id',$mark->student_id)->get()->count();
                                        
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">{{$mark['assign_subject']['subject']['name']}}</td>
                                        <td class="text-center">{{$mark['assign_subject']['full_mark']}}</td>
                                        <td class="text-center">{{$get_mark}}</td>
                                        @php 
                                            $grade_marks = App\Model\MarkGrade::where([['start_mark','<=',(int)$get_mark],['end_mark','>=',(int)$get_mark]])->first();
                                            $grade_name = $grade_marks->grade_name;
                                            $grade_point = number_format((float)$grade_marks->grade_point,2);
                                            $total_point = (float)$total_point + (float)$grade_point;

                                        @endphp
                                        <td class="text-center">{{$grade_name}}</td>
                                        <td class="text-center">{{$grade_point}}</td>
                                    </tr>
                                    

                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong style="padding-left:30px">Total Marks</strong></td>
                                        <td colspan="3"><strong style="padding-left:37px">{{$total_marks}}</strong></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table border="1" width="100%" cellpadding="5" cellspacing="1">
                                <tbody>
                                    @php 
                                        $total_grade = 0;
                                        $point_for_letter_grade =(float)$total_point/(float)$total_subject;
                                        $total_grade = App\Model\MarkGrade::where('start_point','<=',$point_for_letter_grade)->where('end_point','>=',$point_for_letter_grade)->first();
                                        $grade_point_avg = (float)$total_point/(float)$total_subject;
                                    @endphp
                                    <tr>
                                        <td width="50%"><strong>Grade Point Average</strong></td>
                                        <td width="50%">
                                            <strong>
                                            @if($count_fail >0)
                                                0.00
                                            @else
                                            {{number_format((float)$grade_point_avg,2)}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%"><strong>Letter Grade</strong></td>
                                        <td width="50%">
                                            <strong>
                                            @if($count_fail >0)
                                                F
                                            @else
                                            {{$total_grade->grade_name}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%"><strong>Total Marks with Fraction</strong></td>
                                        <td width="50%"><strong>{{$total_marks}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <table border="1" width="100%" cellpadding="10" cellspacing="2">
                                <tbody>
                                    <tr>
                                        <td style="text-align:center"> <strong>Remarks</strong></td>
                                        <td style="text-align:center">
                                            <strong>
                                                @if($count_fail >0)
                                                Fail
                                            @else
                                            {{$total_grade->remarks}}
                                            @endif
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-4">
                            <hr style="border:1px solid; width:60%;color:#000; margin-bottom:-3px;">
                            <div class="text-center">Teacher</div>
                        </div>
                        <div class="col-md-4">
                            <hr style="border:1px solid; width:60%;color:#000; margin-bottom:-3px;">
                            <div class="text-center">Parents/Guardians</div>
                        </div>
                        <div class="col-md-4">
                            <hr style="border:1px solid; width:60%;color:#000; margin-bottom:-3px;">
                            <div class="text-center">Principal/Headmaster</div>
                        </div>
                    </div>
                  </div>
              </div>
    </body>
</html>