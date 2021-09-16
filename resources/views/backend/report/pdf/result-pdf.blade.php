<!DOCTYPE html>

    <head>
        <title>Student Result</title>
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table width="80%">
                        <tr>
                            <td width="33%" class="text-center"><img src="{{url('public/upload/download.jpg')}}" alt="" style="width:100px; height:100px"></td>
                            <td width="63%" class="text-center">
                                <h4><strong>ABC School</strong></h4>
                                <h5><strong>Dhaka mirpur 12</strong></h5>
                                <h6><strong>www.micreowebit.com</strong></h6>
                            </td>
                            <td class="text-center">
                                
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Result of {{$data['0']['examType']['name']}}</h5>
                </div>
                <div class="col-md-12">   
                    <table border="0" width="100%" cellpadding="1" cellspacing="2" class="text-center">
                        <tbody>
                            <tr>
                                <td><strong>Session : </strong>{{$data[0]['year']['name']}}</td>
                                <td></td>
                                <td></td>
                                <td><strong>Class : </strong>{{$data[0]['studentClass']['name']}}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <hr style="border:1px solid; width:100%;margin-bottom:0px;color:#DDD">
                </div><br>
                
                <div class="col-md-12">
                    
                    <table border="1" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th>Student Name</th>
                                <th>ID No</th>
                                <th width="10%">Letter Grade</th>
                                <th width="10%">Grade Point</th>
                                <th width="15%">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $row)
                            @php 
                                $allMarks = App\Model\StudentMark::where('year_id',$row->year_id)->where('class_id',$row->class_id)->where('exam_type_id',$row->exam_type_id)->where('student_id',$row->student_id)->get();
                                
                                $total_mark = 0;
                                $total_point = 0;

                                foreach($allMarks as $value){
                                $count_fail = App\Model\StudentMark::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->where('marks','<','33')->get()->count();
                                $get_mark = $value->marks;
                                $grade_marks = App\Model\MarkGrade::where([['start_mark','<=',(int)$get_mark],['end_mark','>=',(int)$get_mark]])->first();
                                $grade_name = $grade_marks->grade_name;
                                $grade_point = number_format((float)$grade_marks->grade_point,2);
                                $total_point = (float)$total_point + (float)$grade_point;
                                }

                                @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row->student->name}}</td>
                                <td>{{$row->student->id_no}}</td>
                                @php 
                                    $total_subject = App\Model\StudentMark::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->get()->count();
                                    $total_grade = 0;
                                    $point_for_letter_grade =(float)$total_point/(float)$total_subject;
                                    $total_grade = App\Model\MarkGrade::where('start_point','<=',$point_for_letter_grade)->where('end_point','>=',$point_for_letter_grade)->first();
                                    $grade_point_avg = (float)$total_point/(float)$total_subject;
                                @endphp
                                <td>
                                    @if($count_fail >0)
                                        F
                                    @else
                                    {{$total_grade->grade_name}}
                                    @endif
                                </td>
                                <td>
                                    @if($count_fail >0)
                                        0.00
                                    @else
                                    {{number_format((float)$grade_point_avg,2)}}
                                    @endif
                                </td>
                                <td>
                                    @if($count_fail >0)
                                        Fail
                                    @else
                                    {{$total_grade->remarks}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p style="text-align:left;"><i>Print Date:</i>{{date("d M Y")}}</p>
                </div>
                <br>
                
                <div class="col-md-12">
                    <table border="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="width:30%"></td>
                                <td style="width:30%"></td>
                                <td style="width:40%; text-align:center">
                                    <hr style="border:1px solid; width:60%; color:#000; margin-bottom:0px">
                                    <p style="text-align:center">Principal/Headmaster</p>                           
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>