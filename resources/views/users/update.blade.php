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
                                            <h5 class="m-0">{{ __('Edit User') }}</h5>
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
                                <form class="needs-validation">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="name">Firstname</label>
                                            <div class="input-group mb-3 ">
                                                <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ $user->firstname }}"
                                                       placeholder="{{ __('Enter Firstname') }}" required autocomplete="firstname" autofocus>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                                @error('firstname')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="name">Lastname</label>
                                            <div class="input-group mb-3 ">
                                                <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ $user->lastname }}"
                                                       placeholder="{{ __('Enter Lastname') }}" required autocomplete="lastname" autofocus>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                                @error('lastname')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="email_address">Email Address</label>
                                            <div class="input-group mb-3">
                                                <input type="email" name="email" id="email"  class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"
                                                       placeholder="{{ __('Ex. Patient@mail.com') }}" required autocomplete="email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                                @error('email')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        
                                        <div class="col-md-6">
                                            <label for="userType">Account Type</label>
                                            <div class="input-group mb-3">
                                                <select id="userType" class="form-control" >
                                                    <option disabled selected value="">---------- Select Account Type ----------</option>
                                                    <option {{ $user->userType == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                                    <option {{ $user->userType == 'Moderator' ? 'selected' : '' }}>Moderator</option>
                                                    <option {{ $user->userType == 'Editor' ? 'selected' : '' }}>Editor</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-id-card"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="password">Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ $user->password }}"
                                                       placeholder="{{ __('Enter Password') }}" required autocomplete="new-password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                                @error('password')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" name="password_confirmation"
                                                       id="password_confirmation"
                                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                                       placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" value="{{ $user->password }}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                <span class="error invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="accountStatus">Account Status</label>
                                            <div class="input-group mb-3">
                                                <select id="accountStatus" class="form-control">
                                                    <option disabled selected value="">---------- Select User Account Status ----------</option>
                                                    <option {{ $user->accountStatus == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option {{ $user->accountStatus == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    <option {{ $user->accountStatus == 'Banned' ? 'selected' : '' }}>Banned</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fa fa-check-square"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nav-btn-grp">
                                        <button type="button" class="btn btn-danger" id="swalCancel" data-toggle="tooltip" data-placement="bottom" title="Return to Services" style="margin-right: 5px" onclick="returnTo()"><i class='bx bx-x-circle'></i> Cancel</button>
                                        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Save" onclick="update()"><i class='bx bxs-save'></i> Save</button>
                                    </div>
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
                title: 'Are you sure you want to return to users?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('users.index') }}";  // Redirect to the "patients" page
                }
            })
        }

        function update() {
        // Get the serviceID from the route URL
        var id = window.location.pathname.split('/').pop();
        
        // Get the updated values from the form inputs
        var firstname = document.getElementById('firstname').value;
        var lastname = document.getElementById('lastname').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;
        var userType = document.getElementById('userType').value;
        var accountStatus = document.getElementById('accountStatus').value;
        

        if (password !== confirmPassword) {
        // Show an error message
        Swal.fire('Validation Error', 'The password and password confirmation do not match', 'error');
        return; // Stop the function execution
    }

        // Create an object with the updated data
        var data = {
            firstname: firstname,
            lastname: lastname,
            password: password,
            email: email,
            userType: userType,
            accountStatus: accountStatus
        };
        
        // Send a PUT request using Axios
        axios.post('{{ route('update_user', ['id' => $user->id]) }}', data)
            .then(function(response) {
                if (response.status === 200) {
                    // Show success alert
                    Swal.fire({
                        title: 'Success',
                        text: 'User updated successfully',
                        icon: 'success',
                        showConfirmButton: false  // Hide the "OK" button
                    });
        
                    // Redirect to the "services" page after a delay
                    setTimeout(function() {
                        window.location.href = "{{ route('users.index') }}";
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