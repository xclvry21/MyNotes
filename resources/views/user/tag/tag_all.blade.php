@extends('user.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{$title}}</h4>
                        
                        <table id="datatable" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($tags as $tags)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$tags->title}}</td>
                                        <td>          
                                            <a href="javascript:void(0)" id="show-admin" data-url="{{ route('admin.show', $tags->id) }}" class="btn btn-primary sm waves-effect waves-light"><i class="fas fa-eye" ></i></a>

                                            <a href="{{ route('tag.destroy', $tags->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
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

        {{-- DATA MODAL --}}
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="modal fade bs-example-modal-center" tabindex="-1" id="adminShowModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center>
                                <img src="" alt="" style="width: 120px; height:120px" class="rounded avatar-md" id="imgsrc">
                            </center>
                            <p><strong>Name:</strong> <span id="admin-name"></span></p>
                            <p><strong>Email:</strong> <span id="admin-email"></span></p>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>

    </div>
    
</div>

@endsection
