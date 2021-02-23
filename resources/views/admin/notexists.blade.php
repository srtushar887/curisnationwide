@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <style>


        .dataTables_wrapper .dataTables_length{
            display: none;
        }

        .table.dataTable tbody th, table.dataTable tbody td{
            white-space: nowrap; overflow: hidden; text-overflow:ellipsis;
        }

        .table .thead-light th{
            background-color: #4267B2;
            color: white;
            font-weight: bold;

        }

        thead{
            background-color: #4267B2;
            color: white;
        }




        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }


    </style>
@endsection
@section('admin')
    {{--    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#importDocument" style="margin-top: -32px;">Import Excel</button>--}}

    <br>

    <div class="row" style="margin-top: -50px;">
        <div class="col-lg-12">
            <div class="card" style="margin-top: -32px">

                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control type" name="type1" >
                        <option value="0">----SELECT TYPE----</option>
                        <option value="Demo">DEMO</option>
                        <option value="Super Bill">SUPER BILL</option>
                        <option value="Insurance Payment">INS.PAY</option>
                        <option value="Denial">DENIAL</option>
                        <option value="Medical Record">M.R</option>
                        <option value="Patient Payment">PPAY</option>
                        <option value="Refund">REFUND</option>
                        <option value="Authorization">AUTH</option>
                        <option value="Error">ERROR</option>
                        <option value="Referal">REFERAL</option>
                    </select>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered mb-0" id="demo1">

                        <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Account Number</th>
                            <th>Dos</th>
                            <th>Document Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>

                </div>

            </div>
        </div>
    </div>



@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>


    <script>
        $('.type').change(function () {


            var type_name = $(this).val();

                $('#demo1').hide();
                $('#demo1').DataTable().destroy();
                $('#demo1').DataTable({
                    "pageLength": 20,
                    "lengthMenu": [[25, 50,75, -1], [25, 50,75, "All"]],
                    "processing": true,
                    "serverSide": true,
                    "bSort": false,
                    "responsive": true,
                    "ajax": {
                        "type": "POST",
                        data:{
                            '_token' : "{{csrf_token()}}",
                            type_name: type_name,
                        },
                        "url": "{{route('admin.get.practice.filter.notexist')}}"
                    },
                    columns: [
                        { data: 'patient_name', name: 'patient_name',class : 'text-left' },
                        { data: 'account_number', name: 'account_number',class : 'text-left' },
                        { data: 'dos', name: 'dos',class : 'text-left' },
                        { data: 'document_name', name: 'document_name',class : 'text-left' },
                        { data: 'status', name: 'status',class : 'text-left' },
                        {data: 'action', name: 'action', orderable: false, searchable: false,},
                    ],
                });
                $('#demo1').show();





        });


    </script>


@endsection
