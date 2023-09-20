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
                                            <h5 class="m-0">{{ __('Users') }}</h5>
                                                <a href="{{ route('register') }}">
                                                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Add New Record"><i class='bx bx-plus-circle'></i> Create</button>
                                                </a>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->firstname }}</td>
                                            <td>{{ $user->lastname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->userType }}</td>
                                            <td class="action-btn">
                                                <button type="button" class="btn btn-dark btn-sm view-details-btn" data-toggle="modal" data-target="#detailsModal-{{ $user->id }}" data-placement="bottom" title="View Details" style="margin-right: 5px" >
                                                    <i class='bx bx-show'></i>
                                                </button>

                                                <a href="{{ route('update_user', ['id' => $user->id]) }}">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" style="margin-right: 5px" >
                                                        <i class='bx bx-edit bx'></i>
                                                    </button>
                                                </a>
                                                <form class="delete-form" action="{{ route('delete_user', ['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trash">
                                                        <i class='bx bx-trash bx'></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="d-flex justify-content-center">
                            <!-- Pagination links -->
                            {{ $users->links() }}
                       </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
     <!-- Details Modal -->
     @foreach ($users as $user)
     <div class="modal fade" data-backdrop="static" data-keyboard="false" id="detailsModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-{{ $user->id }}" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="detailsModalLabel-{{ $user->id }}">User Details</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <table class="table table-borderless">
                         <tbody>
                             <tr>
                                 <th>User ID</th>
                                 <td>{{ $user->id }}</td>
                             </tr>
                             <tr>
                                 <th>Username</th>
                                 <td>{{ $user->firstname }}</td>
                             </tr>
                             <tr>
                                <th>Lastname</th>
                                <td>{{ $user->lastname }}</td>
                            </tr>
                             <tr>
                                 <th>Email</th>
                                 <td>{{ $user->email }}</td>
                             </tr>
                             <tr>
                                 <th>Role</th>
                                 <td>{{ $user->userType }}</td>
                             </tr>
                             <tr>
                                 <th>Date Created</th>
                                 <td>{{ \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                             </tr>
                             <tr>
                                <th>Account Status</th>
                                <td>{{ $user->accountStatus }}</td>
                            </tr>
                        
                         </tbody>
                     </table>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                 </div>
             </div>
         </div>
     </div>
 @endforeach
 <!-- End Details Modal -->
 <script>
       // Submit the delete form with confirmation
       $('.delete-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
                form.submit();
            }
        });
    }
);
 </script>
@endsection