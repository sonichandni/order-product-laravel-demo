<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

</head>
<body>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('message'))
    <div class="alert alert-danger">
        {{ $errors->first('message') }}
    </div>
@endif

<div class="container mt-4">
    @php
        $user = auth()->user();
    @endphp
    <div class="row">
        <div class="text-center">
            <h2>Orders</h2>
        </div>
        <div class="col-12 table-responsive">
            <table class="table table-bordered order_datatable">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Products</th>
                        <th>Total Order Amount</th>
                        <th>Order Date</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


<script type="text/javascript">
    var table;
    $(function () {
        table = $('.order_datatable').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            order: [[0, 'desc']],
            buttons: [
                {
                    text: 'Add Order',
                    class: 'btn',
                    action: function ( e, dt, node, config ) {
                        window.location = "{{ route('add_order') }}";
                    }
                },
                {
                    text: 'Logout',
                    class: 'btn',
                    action: function ( e, dt, node, config ) {
                        window.location = "{{ route('logout') }}";
                    }
                }
            ],
            ajax: "{{ route('dashboard') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'customer_name', name: 'customer_name'},
                {data: 'product_count', name: 'product_count'},
                {data: 'amount', name: 'amount'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

</script>
</html>
