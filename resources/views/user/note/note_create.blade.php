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

                        <form action="{{ route('note.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="example-text-input" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tags</label>
                                <div class="col-sm-10">
                                    <select class="form-select js-example-basic-multiple" aria-label="Default select example" name="tag_ids[]" multiple="multiple">
                                        @php
                                            $auth_tags = App\Models\Tag::where('user_id', Auth::user()->id)->latest()->get();
                                        @endphp
                                        @foreach ($auth_tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                        @endforeach
                                    </select>   
                                </div>
                            </div>
                            <!-- end row -->
                            
                            <div class="row mb-3">
                                <textarea id="summernote" name="body">{{ old('body') }}</textarea>
                            </div>
                            <!-- end row -->
                            
                            <input type="submit" class="btn btn-primary waves-effect waves-light" value="Create">
                             
                        </form>

                    
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            
        </div>
        <!-- end row -->
        
    </div>     
</div>

@endsection
