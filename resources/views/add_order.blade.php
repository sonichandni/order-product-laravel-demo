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
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Add Order</h2>
                    </div>
                    <form id="add_order_form" class="repeater">
                        @csrf
                        <div class="mt-3 mx-3">
                            <input data-repeater-create type="button" class="btn btn-warning" value="Add Product" />
                        </div>

                        <div class="card-body">
                            <div class="mb-3">
                                <div class="col-12">
                                    @if(!empty($customers))
                                    <select class="form-control" name="customer_name">
                                        <option value="">Select Customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>

                                <div data-repeater-list="products">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="product_name" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                                            </div>
                                            <div class="col-3">
                                                <label for="product_price" class="form-label">Product Price</label>
                                                <input type="number" class="form-control"  name="product_price" placeholder="Enter Product Price" step="any">
                                            </div>
                                            <div class="col-3">
                                                <label for="product_quantity" class="form-label">Product
                                                    Quantity</label>
                                                <input type="number" class="form-control total_price"
                                                    name="product_quantity" 
                                                    placeholder="Enter Product Quantity">
                                            </div>
                                            <div class="col-2">
                                                <label for="product_total" class="form-label">Product Total</label>
                                                <input type="number" class="form-control product_total" 
                                                    name="product_total" placeholder="Product Total" readonly>
                                            </div>
                                            <div class="col-1 mt-4">
                                                <input data-repeater-delete type="button" class="btn btn-danger" value="Delete" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <label for="order_total" class="form-label">Order Total</label>
                                        <input type="number" class="form-control" id="order_total" name="order_total" placeholder="Order Total" readonly>
                                    </div>
                                    <div class="col-3">
                                        <label for="total_products" class="form-label">Total Products</label>
                                        <input type="number" class="form-control" id="total_products" name="total_products" placeholder="Total PRoducts" readonly>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary" id="submit" > Place order </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="{{asset('js/jquery.repeater.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this product?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {

            }
        });

        $(document).on('blur', '.total_price', function () {
            let price =  $(this).val();
            let price_name =  $(this).attr('name');
            let quantity_name = price_name.replace("product_quantity", "product_price");
            let total_name = price_name.replace("product_quantity", "product_total");
            let quantity = $(`input[name='${quantity_name}']`).val();
            let total = price * quantity;
            $(`input[name='${total_name}']`).val(total);

            let order_total = 0;
            $(".product_total").each(function() {
                order_total = parseFloat(order_total) +  parseFloat($(this).val());
            })

            let total_products = 0;
            $(".total_price").each(function() {
                total_products = parseFloat(total_products) +  parseFloat($(this).val());
            })

            $('#order_total').val(order_total)
            $('#total_products').val(total_products)

        })

        $("#add_order_form").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('add_order') }}",
                data: $("#add_order_form").serialize(),
                success: function (result) {
                    if (result.status) {
                        window.location = result.redirect;
                    } else {
                    }
                }
            });
        });
    });
</script>

</html>