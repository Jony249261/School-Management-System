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
            .image{
                boder:1px solid blue !important;
                border-radius:100%  !important;
            }

        </style>
    </head>
    <body>
        <div class="container">
            @foreach($data as $row)
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-3" style="border: 1px solid #000; margin:0px 110px 0px 110px">
                    <table border="0" width="100%" style="background-color:blue">
                        <tbody>
                            <tr>
                                <td width="30%" style="padding:10px">
                                    <img src="{{url('public/upload/download.jpg')}}" style="height:73px; width:63px; border-radious:5px" alt="">
                                </td>
                                <td width="40%" class="text-center">
                                    <p style="color:red; font-size:20px;margin-botom:5px !important"><strong>ABC School</strong></p><br>
                                    <p class="btn btn-primary" style="padding:5px ; font-size:20px">Student ID Card</p>
                                </td>
                                <td width="30%" class="text-right image" style="padding:10px">
                                    <img src="{{url('public/upload/student_images/'.$row->student->image)}}"  alt="" style="height:73px; width:63px; border-radious:5px">
                                </td>
                            </tr>
                            <tr>
                                <td width="45%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>Name :</strong> {{$row->student->name}}</p>
                                </td>
                                <td width="10%" style="padding:10px 3px 10px 5px"></td>
                                <td width="45%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>ID No :</strong> {{$row->student->id_no}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>Session :</strong> {{$row->studentYear->name}}</p>
                                </td>
                                <td width="20%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>Class :</strong> {{$row->studentClass->name}}</p>
                                </td>
                                <td width="40%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>Roll :</strong> {{$row->roll}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td width="33%" style="padding:15px 3px 5px 3px"></td>
                                <td width="33%" style="padding:15px 3px 5px 3px"></td>
                                <td width="33%" style="padding:15px 3px 5px 3px"></td>
                            </tr>
                            <tr>
                                <td width="40%" style="padding:10px 3px 10px 5px">
                                    <p style="font-size:16px"><strong>Mobile :</strong> {{$row->student->mobile}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="text-center">
                                    <hr style="border:solid 1px; width:50%; color:#000; margin-left:290px">
                                    <p style="text-align:center"><strong>Headmaster</strong></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </body>
</html>