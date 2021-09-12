<!DOCTYPE html>

    <head>
        <title>Employee Monthly Salary</title>
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
            @php
                $date = date('Y-m', strtotime($totalattendgroupbyib['0']->date));
                if($date != ''){
                    $where[] = ['date','like',$date. '%'];
                    
                }

                $totalattend = App\Model\EmployeeAttendence::with('employee')->where($where)->where('employee_id',$totalattendgroupbyib['0']->employee_id)->get();
                $singlesalry = $totalattendgroupbyib['0']['employee']['salary'];
                
                $salaryperday = (float)$singlesalry/30;
                $absentcount = count($totalattend->where('attend_status','absent'));
                $totalsalaryminus = (int)$absentcount*(float)$salaryperday;
                $totalsalary = (int)$singlesalry-(int)$totalsalaryminus;
            
            @endphp
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
                                <img src="{{(!empty($totalattendgroupbyib['0']['employee']['image']))?url('public/upload/employee_images/'.$totalattendgroupbyib['0']['employee']['image']):url('public/upload/noimage.jpg')}}" alt="" style="width:60px; height:60px">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Employee Monthly Salary</h5>
                </div>
                <div class="col-md-12">

                


                    <table border="1" width="100%">
                        <tbody>
                            <tr>
                                <td style="width=50%">Employee ID</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['id_no']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Employee Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Father's Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['fname']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Mother's Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['mname']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Basic Salary</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['salary']}} Tk </td>
                            </tr>
                            <tr>
                                <td style="width=50%">Total Absent this Month</td>
                                <td> {{$absentcount}} Days</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Month</td>
                                <td> {{date('M Y',strtotime($totalattendgroupbyib['0']->date))}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Salary for this Month</td>
                                <td> {{$totalsalary}} Tk</td>
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
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table width="80%">
                        <tr>
                            <td width="33%" class="text-center"><img src="{{url('public/upload/download.jpg')}}" alt="" style="width:60px; height:60px"></td>
                            <td width="63%" class="text-center">
                                <h4><strong>ABS School</strong></h4>
                                <h5><strong>Dhaka mirpur 12</strong></h5>
                                <h6><strong>www.micreowebit.com</strong></h6>
                            </td>
                            <td class="text-center">
                                <img src="{{(!empty($totalattendgroupbyib['0']['employee']['image']))?url('public/upload/employee_images/'.$totalattendgroupbyib['0']['employee']['image']):url('public/upload/noimage.jpg')}}" alt="" style="width:60px; height:60px">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Employee Monthly Salary</h5>
                </div>
                <div class="col-md-12">

                


                    <table border="1" width="100%">
                        <tbody>
                            <tr>
                                <td style="width=50%">Employee ID</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['id_no']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Employee Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['name']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Father's Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['fname']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Mother's Name</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['mname']}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Basic Salary</td>
                                <td>{{$totalattendgroupbyib['0']['employee']['salary']}} Tk </td>
                            </tr>
                            <tr>
                                <td style="width=50%">Total Absent this Month</td>
                                <td> {{$absentcount}} Days</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Month</td>
                                <td> {{date('M Y',strtotime($totalattendgroupbyib['0']->date))}}</td>
                            </tr>
                            <tr>
                                <td style="width=50%">Salary for this Month</td>
                                <td> {{$totalsalary}} Tk</td>
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