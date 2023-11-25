@extends('layouts.app')
@section('content')
@section('page', 'Blogs')
@section('subpage', 'Edit')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <form method="POST" action="{{ route('blogs.update', $id) }}">
        @csrf
      <div class="card-body">
        
          <div class="row">
            <div class="col-sm-12">
              <!-- text input -->
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" maxlength="150" placeholder="Enter title ..." value="{{$data->title}}">
              </div>
              @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
            </div>            
          </div>
          <div class="row">
            <div class="col-sm-12">
              <!-- textarea -->
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Enter description...">{{$data->description}}</textarea>
              </div>
              @error('description') <p class="small text-danger">{{ $message }}</p> @enderror
            </div>            
          </div>
         
        
      </div>  
      <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('blogs.list') }}" class="btn btn-danger">Back</a>
      </div>   
    </form> 
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection