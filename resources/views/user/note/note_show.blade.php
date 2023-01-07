@extends('user.user_master')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ $title }}</h4>
                        <p ><i class="text-danger">*Data here cannot be submitted. Remove this note from trash to be able to edit and update.</i></p>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="example-text-input" value="{{ $note->title }}" name="title" readonly>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <select class="form-select js-example-basic-multiple" aria-label="Default select example" name="tag_ids[]" multiple="multiple" >
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $note_tags) ? 'selected' : 'disabled' }}>{{ $tag->title }}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <div class="row mb-3">
                                <textarea id="elm1" name="body" readonly>{!! decrypt($note->body) !!}</textarea>
                            </div>
                            <!-- end row -->
                              
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            
        </div>
        <!-- end row -->
        
    </div>     
</div>

@endsection
