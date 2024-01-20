<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Register</h2>
                    </div>
                    <form id="registration_form">
                        @csrf
                        <div id="errors-list"></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Enter your password again">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" id="form_submit">Register</button>
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
<script>
    $(function () {

        $('form').validate({
            rules: {
                first_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },

            },
            messages: {
                email: {
                    email: 'Enter a valid email',
                },
                password: {
                    minlength: 'Password must be at least 8 characters long'
                }
            }
        });

        $("#registration_form").on("submit", function (e) {
            e.preventDefault();
            if ($("#registration_form").valid()) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('register') }}",
                    data: $("#registration_form").serialize(),
                    success: function (result) {
                        if (result.status) {
                            window.location = result.redirect;
                        } else {
                            $(".alert").remove();
                            $.each(result.errors, function (key, val) {
                                $("#errors-list").append("<div class='alert alert-danger'>" + val + "</div>");
                            });
                        }
                    }
                });
            }
        });

    });

</script>

</html>