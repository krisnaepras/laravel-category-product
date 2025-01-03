<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel - Ajax</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <style>
        .navbar {
            background-color: #343a40 !important;
        }

        .navbar-brand {
            color: #fff !important;
        }

        .card-header {
            background-color: #007bff !important;
            color: #fff !important;
        }

        .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-primary:hover {
            background-color: #0056b3 !important;
            border-color: #004085 !important;
        }

        .table thead th {
            background-color: #007bff !important;
            color: #fff !important;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Product List</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header">Table Products</div>
            <div class="card-body">
                <button class="btn btn-primary mb-3" onclick="showModal()">Create</button>
                <table class="table table-bordered table-striped" id="tableProduct">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug URL</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('products.modal')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap5.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#productForm') !!}

    <script>
        let save_method;

        $(document).ready(function() {
            productsTable();
        });

        function productsTable() {
            $('#tableProduct').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: 'products/dataTable',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'slug',
                        name: 'slug',
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            })
        }

        function resetValidation() {
            $('.is-invalid').removeClass('is-invalid');
            $('.is-valid').removeClass('is-valid');
            $('span.invalid-feedback').remove();
        }

        function showModal() {
            $('#productForm')[0].reset();
            resetValidation();
            $('#productModal').modal('show')

            save_method = 'create';

            $('.modal-title').text('Create New Product')
            $('.btnSubmit').text('Create')
        }

        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            let url, method;
            url = 'products';
            method = 'POST';

            if (save_method === 'update') {
                url = 'products/' + $('#id').val();
                formData.append('_method', 'PUT');
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: method,
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: (response) => {
                    $('#productModal').modal('hide');
                    $('#tableProduct').DataTable().ajax.reload();

                    Swal.fire({
                        title: response.title,
                        text: response.text,
                        icon: response.icon,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    console.log(jqXHR.responseText);
                    alert('Error: ' + jqXHR.responseText);
                }
            });
        });

        function editModal(e) {
            let id = e.getAttribute('data-id');

            save_method = "update";

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "products/" + id,
                success: (response) => {
                    let result = response.data;
                    $('#name').val(result.name);
                    $('#description').val(result.description);
                    $('#price').val(result.price);
                    $('#id').val(result.uuid);
                },
                error: (jqXHR, textStatus, errorThrown) => {
                    console.log(jqXHR.responseText);
                    alert('Error displaying data: ' + jqXHR.responseText);
                }
            });

            resetValidation();

            $('#productModal').modal('show')

            $('.modal-title').text('Update New Product')
            $('.btnSubmit').text('Update')
        }

        function deleteModal(e) {
            let id = e.getAttribute('data-id');

            Swal.fire({
                title: 'Delete?',
                text: 'Are you sure?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: "products/" + id,
                        dataTye: 'json',
                        success: (response) => {
                            $('#productModal').modal('hide');
                            $('#tableProduct').DataTable().ajax.reload();

                            Swal.fire({
                                title: "Good job!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        },
                        error: (jqXHR, textStatus, errorThrown) => {
                            console.log(jqXHR.responseText);
                            alert(jqXHR.responseText);
                        }
                    });
                }
            })
        }
    </script>
</body>

</html>