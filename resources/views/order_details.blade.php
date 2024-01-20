<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        form label {
            display: inline-block;
        }

        form div {
            margin-bottom: 10px;
        }

        .error {
            color: red;
            margin-left: 5px;
        }

        label.error {
            display: inline;
        }
    </style>
</head>

<body>
    @if ($errors->has('message'))
    <div class="alert alert-danger">
        {{ $errors->first('message') }}
    </div>
    @endif

    <div class="container">
        
        <div class="row d-flex mt-4 min-vh-100">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>Order Details</h2>
                        <a href="{{route('dashboard')}}" class="btn btn-primary"  > Back </a>
                    </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-3">
                                            <b>Customer Name: </b> 
                                        </div>
                                        <div class="col-9">
                                            {{$order->customer_name}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <b>Total Products: </b> 
                                        </div>
                                        <div class="col-9">
                                            {{$order->product_count}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <b>Total Order Amount: </b> 
                                        </div>
                                        <div class="col-9">
                                            {{$order->amount}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <b>Order Date: </b> 
                                        </div>
                                        <div class="col-9">
                                            {{$order->date}}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @php
                                    $count = 1;
                                @endphp
                                @if(!empty($order->products))
                                    <h4>Product Details</h4>
                                    @foreach($order->products as $product)
                                    <h5> Product {{$count}}</h5>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-3">
                                                    Product Name:
                                                </div>
                                                <div class="col-9">
                                                    {{$product->name}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    Product Price:
                                                </div>
                                                <div class="col-9">
                                                    {{$product->price}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    Product Quantity:
                                                </div>
                                                <div class="col-9">
                                                    {{$product->quantity}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    Product Total:
                                                </div>
                                                <div class="col-9">
                                                    {{$product->quantity * $product->price}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @php
                                        $count++;
                                    @endphp
                                    @endforeach
                                    
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {

    });
</script>

</html>