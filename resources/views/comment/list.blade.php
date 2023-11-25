@extends('layouts.app')
@section('content')
@section('page', 'Comments')
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
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">{{$blog->title}}</h3>
            </div> <!-- /.card-body -->
            <div class="card-body">
              <p>{{$blog->description}}</p>              
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Comments</h3>
              
              <div class="card-tools">
                <a href="{{ route('blogs.add-comment', $id) }}" class="btn btn-block btn-outline-primary btn-sm">Add New Comment</a>
              </div>
            </div>            
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <div class="timeline">
            @forelse ($comments as $comment)
            
            <div>
              <i class="fas fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{ date('j M Y H:i a, l', strtotime($comment->created_at)) }}</span>
                <h3 class="timeline-header"> <strong>{{$comment->user->name}}</strong> </h3>

                <div class="timeline-body">
                  {{$comment->description}}
                </div>
                
              </div>
            </div>  
            @empty
              
            @endforelse
            
          </div>
        </div>
      </div>
    </div>
</section>
<!-- /.content -->
<script>
  $(document).ready(function(){
    $('div.alert').delay(3000).slideUp(300);
  })
</script>
@endsection