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
                                            <h5 class="m-0">{{ __('Activity Logs') }}</h5>
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
                                            <th>Activity</th>
                                            <th>User ID</th>
                                            <th>Activity Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($histories as $history)
                                        <tr>
                                            <td>{{ $history->id }}</td>
                                            <td>{{ $history->activity }}</td>
                                            <td>{{ $history->user->id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($history->created_at)->setTimezone('Asia/Manila')->format('M-d-Y, h:i A') }}</td>
                                            {{-- <td>
                                                {{-- View Button 
                                                <a href="{{ route('history.view', ['week' => $history->created_at->weekOfYear]) }}" class="btn btn-secondary btn-sm view-details-btn" data-toggle="tooltip" data-placement="bottom" title="View Details">
                                                    <i class='bx bx-show'></i>
                                                </a>                                                
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                <div class="d-flex justify-content-center">
                                     <!-- Pagination links -->
                                     {{ $histories->links() }}
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
   

</script>
@endsection