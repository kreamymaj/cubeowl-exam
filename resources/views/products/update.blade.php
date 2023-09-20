@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="alert alert-info">
                         <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="row-title">
                                            <h5 class="m-0">{{ __('Edit Products') }}</h5>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->
                    </div>
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="form-section">
                                {{-- form --}}
                                <form class="needs-validation">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="image">Product Image</label>
                                            <div class="service-img-upload" id="image-container">
                                                <img src="{{ $product->image ? asset('storage/images/' . $product->image) : asset('images/no_image_available.png') }}" alt="Product Image" class="service_image hoverable">
                                                <div class="image-buttons">
                                                    <button type="button" class="btn btn-sm btn-danger delete-image" data-toggle="tooltip" data-placement="bottom" title="Remove this image" onclick="deleteImage()"><i class='bx bx-trash'></i></button>
                                                    <button type="button" class="btn btn-sm btn-success add-image" data-toggle="tooltip" data-placement="bottom" title="Upload an image" onclick="uploadImage()"><i class='bx bx-plus-circle'></i></button>
                                                </div>
                                                <input type="file" class="form-control-file" id="hidden-image-input" name="image" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="productName">Product Name</label>
                                            <input type="text" class="form-control"  id="productName" placeholder="Enter Product Name" value="{{ $product->productName }}">
                                        </div>
                                   
                                        <div class="form-group col-md-6">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" rows="3" placeholder="Enter Product Description" >{{ $product->description }}</textarea>
                                          </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="price">Price</label>
                                            <div class="input-range-group">
                                                <input type="range" id="price" min="0" max="10000"  style="width:100%;margin-right: 10px;" value="{{ $product->price }}"> 
                                                <p>Value: <span id="showPrice"></span></p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="quantity">Quantity</label>
                                            <input type="text" class="form-control"  id="quantity" placeholder="Enter Product Quantity" value="{{ $product->quantity }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="productStatus">Product Status</label>
                                            <select id="productStatus" class="form-control">
                                                <option disabled selected value="">---------- Select Product Status ----------</option>
                                                <option {{ $product->productStatus == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option {{ $product->productStatus == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="nav-btn-grp">
                                        <button type="button" class="btn btn-danger" id="swalCancel" data-toggle="tooltip" data-placement="bottom" title="Return to Services" style="margin-right: 5px" onclick="returnTo()"><i class='bx bx-x-circle'></i> Cancel</button>
                                        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Save" onclick="update()"><i class='bx bxs-save'></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<script>
        
    var priceSlider = document.getElementById("price");
    var priceOutput = document.getElementById("showPrice");
    priceOutput.innerHTML = priceSlider.value; 
    priceSlider.oninput = function() {
        priceOutput.innerHTML = this.value;
    }

    function returnTo() {
            Swal.fire({
                title: 'Are you sure you want to return to Products?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('products') }}";  // Redirect to the "products" page
                }
            })
        }

    
        function uploadImage() {
            document.getElementById('hidden-image-input').click();
        }

        document.getElementById('hidden-image-input').addEventListener('change', function (event) {
            var imageElement = document.querySelector('.service_image');
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                imageElement.src = e.target.result;
                checkImagePresence(); // Check the image presence after updating the image
                saveImage(); // Save the image using the updated function
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                imageElement.src = "{{ asset('images/no_image_available.png') }}";
                checkImagePresence(); // Check the image presence after updating the image
                saveImage(); // Save the image using the updated function
            }
        });

        function saveImage() {
            // Get the serviceID from the route URL
            var serviceID = window.location.pathname.split('/').pop();

            // Create a FormData object to send the image file
            var formData = new FormData();
            formData.append('image', document.getElementById('hidden-image-input').files[0]);

            // Send a POST request to upload the image
            axios.post('{{ route('change_image', ['productID' => ':productID']) }}'.replace(':productID', productID), formData)
                .then(function(response) {
                    if (response.status === 200) {
                        setTimeout(function() {
                            Swal.close();
                        }, 1500);
                    } else if (response.status === 401) {
                        // Show unauthorized alert
                        Swal.fire('Unauthorized', 'You are not authorized to perform this action', 'error');
                    } else {
                        // Show unknown error alert
                        Swal.fire('Error', 'An unknown error occurred', 'error');
                    }
                })
                .catch(function(error) {
                    console.log(error);
                    // Show error alert
                    Swal.fire('Error', 'Failed to insert the image', 'error');
                });
        }


    document.getElementById('hidden-image-input').addEventListener('change', function (event) {
        var imageElement = document.querySelector('.service_image');
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            imageElement.src = e.target.result;
            checkImagePresence(); // Check the image presence after updating the image
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            imageElement.src = "{{ asset('images/no_image_available.png') }}";
            checkImagePresence(); // Check the image presence after updating the image
        }
    });

    function toggleDeleteButton(show) {
        var deleteButton = document.querySelector('.delete-image');
        var imageElement = document.querySelector('.service_image');
        
        if (deleteButton && imageElement.src !== "{{ asset('images/no_image_available.png') }}") {
            deleteButton.style.display = show ? 'inline-block' : 'none';
        } else {
            deleteButton.style.display = 'none';
        }
    }

    function toggleUploadButton(show) {
        var uploadButton = document.querySelector('.add-image');
        var imageElement = document.querySelector('.service_image');
        
        if (uploadButton && imageElement.src === "{{ asset('images/no_image_available.png') }}") {
            uploadButton.style.display = show ? 'inline-block' : 'none';
        } else {
            uploadButton.style.display = 'none';
        }
    }

    function checkImagePresence() {
        var imageElement = document.querySelector('.service_image');
        var deleteButton = document.querySelector('.delete-image');
        var uploadButton = document.querySelector('.add-image');
        
        if (imageElement.src === "{{ asset('images/no_image_available.png') }}") {
            deleteButton.style.display = 'none';
            uploadButton.style.display = 'inline-block';
        } else {
            deleteButton.style.display = 'inline-block';
            uploadButton.style.display = 'none';
        }
    }

    // Call checkImagePresence initially to set the initial state of the buttons
    checkImagePresence();

    function deleteImage() {
    var imageElement = document.querySelector('.service_image');
    var hiddenImageInput = document.getElementById('hidden-image-input');

    // Clear the image preview
    imageElement.src = "{{ asset('images/no_image_available.png') }}";
    hiddenImageInput.value = '';

    // Remove the image from the database and storage
    axios.post('{{ route('delete_image', ['productID' => $product->productID]) }}')
        .then(function(response) {
            if (response.status === 200) {
                setTimeout(function() {
                    Swal.close();
                }, 1200);
            } else if (response.status === 401) {
                // Show unauthorized alert
                Swal.fire('Unauthorized', 'You are not authorized to perform this action', 'error');
            } else {
                // Show unknown error alert
                Swal.fire('Error', 'An unknown error occurred', 'error');
            }
        })
        .catch(function(error) {
            console.log(error);
            // Show error alert
            Swal.fire('Error', 'Failed to delete the image', 'error');
        });

    checkImagePresence(); // Check the image presence after deleting the image
    }


    //File upload
    document.getElementById('hidden-image-input').addEventListener('change', function (event) {
        var imageElement = document.getElementsByClassName('service_image')[0];
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            imageElement.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });

    function update() {
        // Get the productID from the route URL
        var productID = window.location.pathname.split('/').pop();

        // Get the updated values from the form inputs
        var productName = document.getElementById('productName').value;
        var description = document.getElementById('description').value;
        var price = document.getElementById('price').value;
        var quantity = document.getElementById('quantity').value;
        var productStatus = document.getElementById('productStatus').value;

        // Create an object with the updated data
        var formData = new FormData();
        formData.append('productName', productName);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('quantity', quantity);
        formData.append('productStatus', productStatus);

    // Send a PUT request using Axios
    axios.post('{{ route('update_products', ['productID' => $product->productID]) }}', formData)
        .then(function(response) {
            if (response.status === 200) {
                // Show success alert
                Swal.fire({
                    title: 'Success',
                    text: 'Product updated successfully',
                    icon: 'success',
                    showConfirmButton: false  // Hide the "OK" button
                });

                // Redirect to the "services" page after a delay
                setTimeout(function() {
                    window.location.href = "{{ route('products') }}";
                }, 1500); // Adjust the delay as needed
            } else if (response.status === 401) {
                // Show unauthorized alert
                Swal.fire('Unauthorized', 'You are not authorized to perform this action', 'error');
            } else {
                // Show unknown error alert
                Swal.fire('Error', 'An unknown error occurred', 'error');
            }
        })
        .catch(function(error) {
            // Handle error response
            if (error.response && error.response.status === 422) {
                console.log(error.response.data);
                // Show validation errors alert
                Swal.fire('Validation Error', 'Please fix the form errors', 'error');
            } else if (error.response && error.response.status === 500) {
                // Show server error alert
                Swal.fire('Server Error', 'An internal server error occurred', 'error');
            } else {
                console.log(error);
                // Show unknown error alert
                Swal.fire('Error', 'An unknown error occurred', 'error');
            }
        });
    }
</script>
@endsection