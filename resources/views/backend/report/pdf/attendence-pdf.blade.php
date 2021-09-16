<!DOCTYPE html>

    <head>
        <title>Employee Attendence Report</title>
          <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
        <style>
            *{
                margin:0;
                padding: 0;
            }
            table{
                border-collapse:collapse;
            }
            h2 h3{
                margin:0;
                padding: 0;
            }
            .table{
                width:100%;
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
                            <td width="33%" class="text-center"><img src="{{url('public/upload/download.jpg')}}" alt="" style="width:60px; height:60px"></td>
                            <td width="63%" class="text-center">
                                <h4><strong>ABS School</strong></h4>
                                <h5><strong>Dhaka mirpur 12</strong></h5>
                                <h6><strong>www.micreowebit.con</strong></h6>
                            </td>
                            <td class="text-center">
                                <img src="{{(!empty($allData['0']['employee']['image']))?url('public/upload/employee_images/'.$allData['0']['employee']['image']):url('public/upload/noimage.jpg')}}" alt="" style="width:60px; height:60px">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Employee Attendence Report <strong>{{$month}}</strong></h5>
                </div>
                <div class="col-md-12">
                    <strong>Empoloyee Name : </strong>{{$allData['0']['employee']['name']}} <strong style="margin-left:50px !important; padding-left:50px !important">ID No : </strong> {{$allData['0']['employee']['id_no']}} <strong style="margin-left:50px">Month : </strong> {{$month}} <br>

                    <table border="1" width="100%" style="margin-top:10px">
                    <thead>
                        <tr>
                            <th style="width=10%">SL</th>
                            <th style="width=40%">Date</th>
                                <th>Attend Status</th>
                        </tr>
                    </thead>    
                    <tbody>
                        @foreach($allData as $key => $data)
                            <tr>
                                <td style="width=10%">{{$key+1}}</td>
                                <td style="width=40%">{{date('d-M-Y',strtotime($data->date))}}</td>
                                <td>{{$data->attend_status}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>
                                    <span style="margin-right:5px !important"><Strong>Total Absent : </Strong>{{$absent}}</span>
                                </td>
                                <td>
                                    <span><Strong>Total Leave : </Strong>{{$leave}}</span>
                                </td>
                            </tr>
                        
                        </tbody>
                        
                    </table>
                    <i style=" float:right;">Print Date: {{date('d m Y')}}</i>
                </div>
                <div class="col-md-12" style="margin-top:-5px !important">
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