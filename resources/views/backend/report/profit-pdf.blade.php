<!DOCTYPE html>

    <head>
        <title>Monthly Or Yearly Profit</title>
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
                                <h6><strong>www.micreowebit.com</strong></h6>
                            </td>
                            <td class="text-center">
                                
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 text-center">
                    <h5 style="font-weight:bold; padding-top:-25px">Monthly Or Yearly Profit</h5>
                </div>
                <div class="col-md-12">
                    @php
                        $student_fee = App\Model\AccountStudentFee::whereBetween('date',[$sdate,$edate])->sum('amount');
                        $other_cost = App\Model\AccountOtherCost::whereBetween('date',[$start_date,$end_date])->sum('amount');
                        $emp_salary = App\Model\AccountEmployeeSalary::whereBetween('date',[$sdate,$edate])->sum('amount');
                        $totat_cost = $emp_salary + $other_cost;
                        $profit = $student_fee - $totat_cost;
                    @endphp
                    <table border="1" width="100%">
                        <tbody>
                            <tr>
                                <td colspan="2" style="text-align:center"><h4>Reporting Date: {{date('d M Y',strtotime($start_date))}} - {{date('d M Y',strtotime($end_date))}};</h4></td>
                            </tr>
                            <tr>
                                <td style="width:50%"><h4>Purpose</h4></td>
                                <td><h4>Amount</h4></td>
                            </tr>
                            <tr>
                                <td>Student Fee</td>
                                <td>{{$student_fee}} Tk</td>
                            </tr>
                            <tr>
                                <td>Employee Salary</td>
                                <td>{{$emp_salary}} Tk</td>
                            </tr>
                            <tr>
                                <td>Other Cost</td>
                                <td>{{$other_cost}} Tk</td>
                            </tr>
                            <tr>
                                <td>Total Cost</td>
                                <td>{{$totat_cost}} Tk</td>
                            </tr>
                            <tr>
                                <td>Profit</td>
                                <td>
                                    {{$profit}} Tk 
                                    @if($profit>=0) Profit @else Lose @endif
                            </td>
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