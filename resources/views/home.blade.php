@extends('layouts.app')

@section('content')
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
                                            <h5 class="m-0">{{ __('Dashboard') }}</h5>
                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                        <!-- /.content-header -->
                    </div>
                </div>
            </div>
        </div>
    </div> 
  
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
         {{-- Dashboard Colored Cards --}}
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="total-products">Loading...</h3>
                            <p>Active Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="total-stores">Loading...</h3>
                            <p>Active Store</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('stores') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="inactive-products">Loading...</h3>
                            <p>Inactive Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="inactive-stores">Loading...</h3>
                            <p>Inactive Store</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('stores') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div>    
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        axios.get('{{ route('products.count') }}')
            .then(response => {
                document.getElementById('total-products').textContent = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    }); 

    document.addEventListener('DOMContentLoaded', function () {
        axios.get('{{ route('stores.count') }}')
            .then(response => {
                document.getElementById('total-stores').textContent = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    });

    document.addEventListener('DOMContentLoaded', function () {
        axios.get('{{ route('products.inactive') }}')
            .then(response => {
                document.getElementById('inactive-products').textContent = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    });

    document.addEventListener('DOMContentLoaded', function () {
        axios.get('{{ route('stores.inactive') }}')
            .then(response => {
                document.getElementById('inactive-stores').textContent = response.data;
            })
            .catch(error => {
                console.error(error);
            });
    });

    
  
</script>
@endsection