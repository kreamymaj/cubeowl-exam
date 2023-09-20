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
                                            <h5 class="m-0">{{ __('Edit Store') }}</h5>
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
                                        <div class="form-group col-md-6">
                                            <label for="storeName">Store Name</label>
                                            <input type="text" class="form-control"  id="storeName" placeholder="Enter Store Name" value="{{ $store->storeName }}">
                                        </div>
                                   
                                        <div class="form-group col-md-6">
                                            <label for="address">Store Address</label>
                                            <textarea class="form-control" id="address" rows="3" placeholder="Enter Store Address" >{{ $store->address }}</textarea>
                                          </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control"  id="email" placeholder="Enter Store Email" value="{{ $store->email }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="landline">Landline</label>
                                            <input type="text" class="form-control"  id="landline" placeholder="Enter 10-Digit Landline Number" value="{{ $store->landline }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="mobileNum">Mobile Number</label>
                                            <input type="text" class="form-control"  id="mobileNum" placeholder="i.e 639XXXXXXXXX" value="{{ $store->mobileNum }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="storeStatus">Store Status</label>
                                            <select id="storeStatus" class="form-control">
                                                <option disabled selected value="">---------- Select Product Status ----------</option>
                                                <option {{ $store->storeStatus == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option {{ $store->storeStatus == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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
        
    function returnTo() {
            Swal.fire({
                title: 'Are you sure you want to return to Store Page?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('stores') }}";  // Redirect to the "products" page
                }
            })
        }

    function update() {
        // Get the productID from the route URL
        var storeID = window.location.pathname.split('/').pop();

        // Get the updated values from the form inputs
        var storeName = document.getElementById('storeName').value;
        var address = document.getElementById('address').value;
        var landline = document.getElementById('landline').value;
        var email = document.getElementById('email').value;
        var mobileNum = document.getElementById('mobileNum').value;
        var storeStatus = document.getElementById('storeStatus').value;

        // Create an object with the updated data
        var formData = new FormData();
        formData.append('storeName', storeName);
        formData.append('address', address);
        formData.append('landline', landline);
        formData.append('email', email);
        formData.append('mobileNum', mobileNum);
        formData.append('storeStatus', storeStatus);

    // Send a PUT request using Axios
    axios.post('{{ route('update_stores', ['storeID' => $store->storeID]) }}', formData)
        .then(function(response) {
            if (response.status === 200) {
                // Show success alert
                Swal.fire({
                    title: 'Success',
                    text: 'Store Record updated successfully',
                    icon: 'success',
                    showConfirmButton: false  // Hide the "OK" button
                });

                // Redirect to the "services" page after a delay
                setTimeout(function() {
                    window.location.href = "{{ route('stores') }}";
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