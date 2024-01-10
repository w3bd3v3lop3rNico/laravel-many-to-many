@extends('layouts.app')

@section('content')
    <section>
      <div class="container">
        <h1>{{ $project->title }}</h1>
        {{-- @if($project->category)
        <p>
          <strong>
          {{ $project->category->name }}
          </strong>
        </p>
        @endif --}}
        {{-- @dump($post->category()) --}}

        <ul class="d-flex gap-2 ps-0">
          @foreach ($project->technologies as $technology)
            <li class="badge rounded-pill text-bg-primary">{{ $technology->name }}</li>
          @endforeach 
        </ul>

        <p>{{ $project->slug }}</p>
        <p>{{ $project->created_at->format('d/m/Y') }}</p>
      </div>
      <div class="container mb-3">
        <div class="row">
          <div class="col-auto">
            <a href="{{ route('admin.projects.edit',$project)}}">modifica</a>
          </div>
          <div class="col-auto">
            <form action="{{ route('admin.projects.destroy',$project)}}" method="POST">
              @csrf
              @method('DELETE')

              <input class="btn btn-danger btn-sm" type="submit" value="delete">
            </form>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        {!! $project->content !!}
      </div>
    </section>
@endsection