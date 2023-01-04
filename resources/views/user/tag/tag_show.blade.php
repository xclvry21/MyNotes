@extends('user.user_master')
@section('user')

<div class="page-content">
    <div class="container-fluid">

         <!-- start page title -->
         <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{$title}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        {{-- NOTES --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Notes</h4>
                        
                        <table id="datatable-notes" class="table dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_tag as $note)
                                    <tr>
                                        @if ($note)
                                            <td>{{$i++}}</td>
                                            <td>{{$note->title}}</td>
                                            <td>{!! Str::limit(decrypt($note->body), 80) !!}</td>
                                            <td>          
                                                <a href="{{ route('note.edit', $note->id) }}" id="show" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                                <a href="{{ route('note.archive', $note->id) }}" class="btn btn-secondary sm" title="Archive" id="archive"> <i class="mdi mdi-archive-arrow-down-outline"></i></a>

                                                <a href="{{ route('note.delete', $note->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

        {{-- ARCHIVES --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Archives</h4>
                        
                        <table id="datatable-archives" class="table dt-responsive nowrap w-100">
                            
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_archive as $note)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$note->title}}</td>
                                        <td>{!! Str::limit(decrypt($note->body), 80) !!}</td>
                                        <td>          
                                            <a href="{{ route('note.edit', $note->id) }}" title="Edit" id="show" class="btn btn-primary sm waves-effect waves-light"><i class="far fa-edit" ></i></a>

                                            <a href="{{ route('note.unarchive', $note->id) }}" class="btn btn-success sm" title="Unarchive" id="unarchive"> <i class="ri-inbox-unarchive-line"></i></a>

                                            <a href="{{ route('note.delete', $note->id) }}" class="btn btn-danger sm" title="Delete" id="delete"> <i class="fas fa-trash" ></i></a>
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

        
        

         {{-- TRASH --}}
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Trash</h4>
                        
                        <table id="datatable-trash" class="table dt-responsive nowrap w-100">
                           
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($note_trash as $note)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$note->title}}</td>
                                        <td>{!! Str::limit(decrypt($note->body), 80) !!}</td>
                                        <td>          
                                            <a href="{{ route('note.restore', $note->id) }}" class="btn btn-success sm" title="Restore" id="swal-restore"> <i class="fas fa-trash-restore" ></i></a>
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
