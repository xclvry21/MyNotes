@extends('admin.admin_master')
@section('admin')
   
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        
                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>
                                            <img src="{{ $admin->profile_image ?  asset('storage/admin_images\/') . $admin->profile_image : asset('images/no-image.jpg') }}" alt="{{ $admin->profile_image }}" style="width: 80px; height:80px" class="rounded avatar-md">
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.destroy', $admin->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div>
    
</div>

@endsection
