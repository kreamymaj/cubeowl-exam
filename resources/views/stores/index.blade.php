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
                                            <h5 class="m-0">{{ __('Store Management') }}</h5>
                                                <a href="{{ route('create_stores') }}">
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
                                        <th>Store Name</th>
                                        <th>Address</th>
                                        <th>Landline</th>
                                        <th>Mobile Num.</th>
                                        <th>Date Created</th>
                                        <th>Store Status</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($stores as $store)
                                        <tr id="store-{{ $store->storeID }}">
                                            <td>{{ $store->storeID }}</td>
                                            <td>{{ $store->storeName }}</td>
                                            <td>{{ $store->address }}</td>
                                            <td>{{ $store->landline }}</td>
                                            <td>{{ $store->mobileNum }}</td>
                                            <td>{{ \Carbon\Carbon::parse($store->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                            <td>{{ $store->storeStatus }}</td>
                                            <td class="action-btn">
                                                <button type="button" class="btn btn-dark btn-sm view-details-btn" data-placement="bottom" title="View Details" style="margin-right: 5px" data-toggle="modal" data-target="#detailsModal-{{ $store->storeID }}">
                                                    <i class='bx bx-show'></i>
                                                </button>

                                                <a href="{{ route('update_stores', ['storeID' => $store->storeID]) }}">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" style="margin-right: 5px" >
                                                        <i class='bx bx-edit bx'></i>
                                                    </button>
                                                </a>
                                                <form class="delete-form" action="{{ route('delete_stores', ['storeID' => $store->storeID]) }}" method="POST">
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
                                <div class="d-flex justify-content-center">
                                    <!-- Pagination links -->
                                    {{ $stores->links() }}
                               </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{-- nothing here --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Details Modal -->
    @foreach ($stores as $store)
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="detailsModal-{{ $store->storeID }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-{{ $store->storeID }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel-{{ $store->storeID }}">Store Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Store ID</th>
                                    <td>{{ $store->storeID }}</td>
                                </tr>
                                <tr>
                                    <th>Store Name</th>
                                    <td>{{ $store->storeName }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $store->address }}</td>
                                </tr>
                                <tr>
                                    <th>Landline</th>
                                    <td>{{ $store->landline }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td>{{ $store->mobileNum }}</td>
                                </tr>
                             
                                <tr>
                                    <th>Date Created</th>
                                    <td>{{ \Carbon\Carbon::parse($store->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $store->storeStatus }}</td>
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
                text: 'Do you want to move this file to the Trash Bin?',
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
                    setTimeout(function() {
                        form.submit();
                    }, 1500); 
                }
            });
        });
    </script>
@endsection
