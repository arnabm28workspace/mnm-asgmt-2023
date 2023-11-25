@extends('layouts.app')
@section('content')
@section('page', 'Comment')
@section('subpage', 'Create')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <form method="POST" action="{{ route('blogs.save-comment', $id) }}">
        @csrf
      <div class="card-body">
        
          
          <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>Comments <span>*</span></label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter comments...">{{old('description')}}</textarea>
              </div>
              @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
            </div>            
          </div>
         
        
      </div>  
      <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('blogs.list-comments', $id) }}" class="btn btn-danger">Back</a>
      </div>   
    </form> 
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection