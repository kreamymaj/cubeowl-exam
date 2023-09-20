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
                                            <h5 class="m-0">{{ __('Products') }}</h5>
                                                <a href="{{ route('create_products') }}">
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
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Date Created</th>
                                        <th>Product Status</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr id="product-{{ $product->productID }}">
                                            <td>{{ $product->productID }}</td>
                                            <td>
                                                @if ($product->image)
                                                <div > 
                                                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="service_image">
                                                </div>
                                                @else
                                                    <img src="{{ asset('images/no_image_available.png') }}" alt="No Image Available" class="service_image">
                                                @endif
                                            </td>
                                            
                                            <td>{{ $product->productName }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                            <td>{{ $product->productStatus }}</td>
                                            <td class="action-btn">
                                                <button type="button" class="btn btn-dark btn-sm view-details-btn" data-placement="bottom" title="View Details" style="margin-right: 5px" data-toggle="modal" data-target="#detailsModal-{{ $product->productID }}">
                                                    <i class='bx bx-show'></i>
                                                </button>

                                                <a href="{{ route('update_products', ['productID' => $product->productID]) }}">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit" style="margin-right: 5px" >
                                                        <i class='bx bx-edit bx'></i>
                                                    </button>
                                                </a>
                                                <form class="delete-form" action="{{ route('delete_products', ['productID' => $product->productID]) }}" method="POST">
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
                                    {{ $products->links() }}
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
    @foreach ($products as $product)
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="detailsModal-{{ $product->productID }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-{{ $product->productID }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel-{{ $product->productID }}">Product Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>product ID</th>
                                    <td>{{ $product->productID }}</td>
                                </tr>
                                <tr>
                                    <th>Product Image</th>
                                    <td>
                                       @if ($product->image)
                                        <img src="{{ asset('images/'  . $product->image) }}" alt="Product Image" class="service_image_details">
                                        @else
                                            <img src="{{ asset('images/no_image_available.png') }}" alt="No Image Available" class="service_image_details">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $product->productName }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>₱{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $product->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Date Created</th>
                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $product->productStatus }}</td>
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
