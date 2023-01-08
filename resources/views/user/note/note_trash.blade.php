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
                                @foreach ($notes as $note)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$note->title}}</td>
                                        <td>    
                                            <a href="{{ route('note.show', $note->id) }}" class="btn btn-primary sm" title="Show"> <i class="fas fa-eye" ></i></a>

                                            <a href="{{ route('note.restore', $note->id) }}" class="btn btn-success sm" title="Restore" id="swal-restore"> <i class="fas fa-trash-restore" ></i></a>
                                            
                                            <a href="{{ route('note.destroy', $note->id) }}" class="btn btn-danger sm" title="Delete Forever" id="delete"> <i class="mdi mdi-delete-forever "></i></a>
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
