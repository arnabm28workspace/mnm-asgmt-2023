@extends('layouts.app')
@section('content')
@section('page', 'Blogs')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      @if (Session::has('message'))
      <div class="alert alert-success" role="alert">
          {{ Session::get('message') }}
          {{ Session::forget('message') }}
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form action="" method="GET" id="searchForm">
              
            <div class="card-header">
              <h3 class="card-title">All Blogs</h3>
              <div class="row">
                <div class="col-md-2">
                  <select name="user_id" class="form-control" id="user_id">
                    <option value="">All Author</option>
                    @forelse ($users as $user)
                    <option value="{{$user->id}}" @if($user_id == $user->id) selected @endif>{{$user->name}}</option>
                    @empty
                      <option value=""> - </option>
                    @endforelse
                    

                  </select>
                </div>
                <div class="col-md-2">
                  <select name="created" class="form-control" id="created">
                    <option value="asc" @if($created == 'asc') selected @endif>CREATED ASC</option>
                    <option value="desc" @if($created == 'desc') selected @endif>CREATED DESC</option>
                  </select>
                </div>
              </div>
              <div class="card-tools">
                
                <div class="input-group input-group-sm">   
                             
                    <a href="{{ route('blogs.create') }}" class="btn btn-block btn-outline-primary btn-sm">Create Blog</a>                 
                </div>
              </div>
            </div>
            </form>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $i = 1;
                  @endphp
                  @forelse ($data as $item)

                  @php
                    $auth = "";
                    if($item->user_id == Auth::user()->id){
                      $auth = "You";
                    } else {
                      $auth = $item->author->name;
                    }
                  @endphp
                  <tr>
                    <td>{{$i}}</td>
                    <td>
                      {{$auth}} <br/>
                      <span>--------</span>
                      <br/>
                      Posted on  {{ date('j M Y, l', strtotime($item->created_at)) }} <br/>
                      @if (!empty($item->updated_at))
                      <span>--------</span> <br/>
                        Last changed at  {{ date('j M Y, l', strtotime($item->updated_at)) }}
                      @endif
                    </td>
                    
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                      <a href="{{route('blogs.edit', $item->id)}}" class="btn btn-block btn-outline-primary btn-sm">Edit</a>
                      <a href="{{route('blogs.list-comments', $item->id)}}" class="btn btn-block btn-outline-primary btn-sm">Comments ({{count($item->comments)}})</a>
                    </td>
                  </tr>

                  @php
                    $i++;
                  @endphp
                  @empty
                    
                  @endforelse
                  
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
        
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script>
  $(document).ready(function(){
    $('div.alert').delay(3000).slideUp(300);
  });

  $('#user_id').on('change', function(){
    $('#searchForm').submit();
  });

  $('#created').on('change', function(){
    $('#searchForm').submit();
  });
</script>
@endsection