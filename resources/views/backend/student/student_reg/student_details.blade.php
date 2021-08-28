<!DOCTYPE html>

    <head>
        <title>Student Details Information</title>
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
                                <h4><strong>ABS School</strong></h4>
                                <h5><strong>Dhaka mirpur 12</strong></h5>
                                <h6><strong>www.micreowebit.con</strong></h6>
                            </td>
                            <td class="text-center">
                                <img src="{{url('public/upload/student_images/'.$data->student->image)}}" alt="" style="width:100px; height:100px">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Student Details Information</h5>
                </div>
                <div class="col-md-12">
                    <table border="1" width="100%">
                        <tbody>
                            <tr>
                            <td style="width=50%">Student Name</td>
                            <td>{{$data->student->name}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Father's Name</td>
                            <td>{{$data->student->fname}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Mother's Name</td>
                            <td>{{$data->student->mname}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Year</td>
                            <td>{{$data->studentYear->name}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Class</td>
                            <td>{{$data->studentClass->name}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Discount</td>
                            <td>{{$data->discount->discount}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Group</td>
                            <td>{{$data->group->name}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Shift</td>
                            <td>{{$data->studentShift->name}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Mobile Number</td>
                            <td>{{$data->student->mobile}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Address</td>
                            <td>{{$data->student->address}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Gender</td>
                            <td>{{$data->student->gender}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Religion</td>
                            <td>{{$data->student->religion}}</td>
                        </tr>
                        <tr>
                            <td style="width=50%">Date of Birth</td>
                            <td>{{$data->student->dob}}</td>
                        </tr>
                        </tbody>
                        
                    </table>
                    <br>
                    <i style="font-size:12px; float:right; padding-top:100px">Print Date: {{date('d m Y')}}</i>
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