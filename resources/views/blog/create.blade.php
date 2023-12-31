@extends('layouts.app')
@section('content')
@section('page', 'Blogs')
@section('subpage', 'Create')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <form method="POST" action="{{ route('blogs.store') }}">
        @csrf
      <div class="card-body">
        
          <div class="row">
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Title <span>*</span></label>
                <input type="text" name="title" class="form-control" maxlength="150" placeholder="Enter title ..." value="{{old('title')}}">
              </div>
              @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
            </div>            
          </div>
          <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>Description <span>*</span></label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter description...">{{old('description')}}</textarea>
              </div>
              @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
            </div>            
          </div>
         
        
      </div>  
      <div class="card-footer">
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('blogs.list') }}" class="btn btn-danger">Back</a>
      </div>   
    </form> 
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection