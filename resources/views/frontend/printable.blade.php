<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>نظام التقسيط</title>
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('dist/css/style.min.css')}}" media=print rel="stylesheet">


    <style> 
        td {
            border-top: 1px solid #565a5e !important; 
        }
    </style>
</head>

<body onload="window.print()">
    <div class=container>
        <div class="row m-t-40">
            <div class="col-12 ">
                <div>
                    <h1 style="text-align: center">نظام التقسيط</h1>
                </div>
            </div>
        </div>
        <div class=row>
            <div class=col-12>
                <div class=card>
                    <div class=card-body>
                        <div class="table-responsive m-t-5">
                            <table class="table color-bordered-table dark-bordered-table" data-display-length='-1' data-order="[]">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>تفـــاصبــل نظــام التــقـسيط</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody style="font-weight: bold; border: 3px">
                                    <tr>
                                        <td>Car Model</td>
                                        <td>{{$car->model->brand->BRND_NAME}} {{$car->model->MODL_NAME}} {{$car->CAR_CATG}} {{$car->model->MODL_YEAR}}</td>
                                        <td>موديل السياره</td>
                                    </tr>
                                    <tr>
                                        <td>Car Price</td>
                                        <td>{{number_format($car->CAR_PRCE)}}</td>
                                        <td>سعر السياره</td>
                                    </tr>
                                    <tr>
                                        <td>Bank</td>
                                        <td>{{$bank->BANK_NAME}}</td>
                                        <td>البنك</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Guarantee</td>
                                        <td>{{$loanGuarantee}}</td>
                                        <td>قرض بضمان</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Downpayment</td>
                                        <td>{{$downPayment}}</td>
                                        <td>المقدم</td>
                                    </tr>
                                    <tr>
                                        <td>Remaining</td>
                                        <td>{{$remaining}}</td>
                                        <td>المتبقي للتقسيط</td>
                                    </tr>
                                    <tr>
                                        <td>Interest Rate</td>
                                        <td>{{$interestRate}}</td>
                                        <td>نسبه الفائده السنويه</td>
                                    </tr>
                                    <tr>
                                        <td>Installament Years</td>
                                        <td>{{$years}}</td>
                                        <td>عـدد سـنـوات الـتـقـسـيـط</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Installament</td>
                                        <td>{{$install}}</td>
                                        <td>الـقـسـط الـشـهـرى</td>
                                    </tr>
                                    <tr>
                                        <td>Bank Administrative Fees</td>
                                        <td>{{$adminFees}}</td>
                                        <td>مـصـاريـف اداريــة</td>
                                    </tr>
                                    <tr>
                                        <td>Insurance Company</td>
                                        <td>{{$insuranceComp}}</td>
                                        <td>شـركـه الـتـأمـيـن</td>
                                    </tr>
                                    <tr>
                                        <td>Insurance Fees</td>
                                        <td>{{$insuranceFees}}</td>
                                        <td>تـأمـيـن اجـبـارى</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>