@extends('layouts.app')

@section('content')
<section>
    <div class="container">
      <h1>Projects index</h1>
    </div>
  </section>
  <section>
    <div class="container">
      <table class="table table-stripped">
        <thead>
          <tr>
            <td></td>
            <td>
              <form action="{{ route('admin.projects.index') }}" method="GET">
                <input placeholder="filtra per titolo" class="form-control" type="text" name="title" value="{{ request()->get('title') }}">
              </form>
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th></th>
            <th>
              <a class="btn btn-primary btn-sm" href="{{ route('admin.projects.create') }}">Nuovo</a>
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($projects as $project)
              <tr>
                <td>{{ $project->id}}</td>
                <td>
                  <a href="{{ route('admin.projects.show',$project) }}">
                  {{ $project->title  }}
                </a>
                </td>
                <td>{{ $project->slug }}</td>
                {{-- <td>
                  {{ isset($project->category) ?  $project->category->name : '-' }}
                  {{ optional($post->category)->name  }}
                </td> --}}
                <td>
                  <a href="{{ route('admin.projects.edit',$project) }}">edit</a>
                </td>
                <td>
                  <form action="{{ route('admin.projects.destroy',$project)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <input class="btn btn-danger btn-sm" type="submit" value="delete">
                  </form>
                </td>

              </tr>
          @empty
              <tr>
                <td>Nessun progetto</td>
              </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>
@endsection