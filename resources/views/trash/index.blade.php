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
                                            <h5 class="m-0">{{ __('Trash') }}</h5>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            {{-- TABS --}}
                            <div class="trash-tabs">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-product-tab" data-toggle="tab" data-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="false">Products</button>
                                        <button class="nav-link" id="nav-store-tab" data-toggle="tab" data-target="#nav-store" type="button" role="tab" aria-controls="nav-store" aria-selected="false">Stores</button>
                                        <button class="nav-link" id="nav-user-tab" data-toggle="tab" data-target="#nav-user" type="button" role="tab" aria-controls="nav-user" aria-selected="false">Users</button>
                                    </div>
                                </nav>
                                <div class="trash-tabs-content">
                                    <div class="tab-content" id="nav-tabContent">
                                       {{-- Products --}}
                                        <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                                            <div class="table-responsive-sm">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>Date Created</th>
                                                            <th>Date Deleted</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($products as $product)
                                                            <tr>
                                                                <td>{{ $product->productID }}</td>
                                                                <td>{{ $product->productName }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($product->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($product->deleted_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                                <td class="action-btn">
                                                                    {{-- Restore --}}
                                                                    <form class="restore-service-form" action="{{ route('restore_product', ['productID' => $product->productID]) }}" method="POST">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Restore" style="margin-right: 5px">
                                                                            <i class='bx bx-rotate-left bx'></i>
                                                                        </button>
                                                                    </form>
                                                                    {{-- Destroy --}}
                                                                    <form class="destroy-service-form" action="{{ route('destroy_product', ['productID' => $product->productID]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Permanent Delete">
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
                                                    {{ $products->links() }}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Stores --}}
                                        <div class="tab-pane fade" id="nav-store" role="tabpanel" aria-labelledby="nav-store-tab">
                                            <div class="table-responsive-sm">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Store Name</th>
                                                            <th>Date Created</th>
                                                            <th>Date Deleted</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($stores as $store)
                                                            <tr>
                                                                <td>{{ $store->storeID }}</td>
                                                                <td>{{ $store->storeName }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($store->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($store->deleted_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                                <td class="action-btn">
                                                                    {{-- Restore --}}
                                                                    <form class="restore-store-form" action="{{ route('restore_stores', ['storeID' => $store->storeID]) }}" method="POST">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Restore" style="margin-right: 5px">
                                                                            <i class='bx bx-rotate-left bx'></i>
                                                                        </button>
                                                                    </form>
                                                                    {{-- Destroy --}}
                                                                    <form class="destroy-store-form" action="{{ route('destroy_stores', ['storeID' => $store->storeID]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Permanent Delete">
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

                                        {{-- Users --}}
                                        <div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                                            <div class="table-responsive-sm">
                                                <table class="table table-striped">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Firstname</th>
                                                        <th>Lastname</th>
                                                        <th>Role</th>
                                                        <th>Date Created</th>
                                                        <th>Date Deleted</th>
                                                        <th>Actions</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($users as $user)
                                                        <tr >
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->firstname }}</td>
                                                            <td>{{ $user->lastname }}</td>
                                                            <td>{{ $user->userType }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($user->deleted_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                                            <td class="action-btn">
                                                                {{-- Restore --}}
                                                                <form class="restore-user-form" action="{{ route('restore_user', ['id' => $user->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Restore" style="margin-right: 5px">
                                                                        <i class='bx bx-rotate-left bx'></i>
                                                                    </button>
                                                                </form>
                                                                {{-- Destroy --}}
                                                                <form class="destroy-user-form" action="{{ route('destroy_user', ['id' => $user->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Permanent Delete">
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
                                                    {{ $users->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
     // Submit the delete form with confirmation
    $('.restore-service-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Restore Deleted Item',
            text: 'Do you want to restore this item?',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Restored!',
                'Successfully restored.',
                'success'
                )
                setTimeout(function() {
                    form.submit();
                }, 1500); 
            }
        });
    });

    $('.destroy-service-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to permanently delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been permanently deleted.',
                'success'
                )
                setTimeout(function() {
                    form.submit();
                }, 1500); 
            }
        });
    });

    $('.restore-store-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Restore Deleted Item',
            text: 'Do you want to restore this item?',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Restored!',
                'Successfully restored.',
                'success'
                )
                setTimeout(function() {
                    form.submit();
                }, 1500); 
            }
        });
    });

    $('.destroy-store-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to permanently delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been permanently deleted.',
                'success'
                )
                setTimeout(function() {
                    form.submit();
                }, 1500); 
            }
        });
    });

    $('.restore-user-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Restore Deleted Item',
            text: 'Do you want to restore this item?',
            icon: 'info',
            confirmButtonColor: '#3085d6',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Restored!',
                'Successfully restored.',
                'success'
                )
                setTimeout(function() {
                    form.submit();
                }, 1500); 
            }
        });
    });

    $('.destroy-user-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to permanently delete this?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Deleted!',
                'Your file has been permanently deleted.',
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