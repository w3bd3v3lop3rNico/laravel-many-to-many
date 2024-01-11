@extends('layouts.app')

@section('content')
    <section class="py-3">
      <div class="container">
        <h1>{{ $project->title }}</h1>
      </div>
    </section>
    <section>
      <div class="container">
        <form action="{{ route('admin.projects.update',$project) }}" method="POST">
      
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Titolo del progetto" value="{{ old('title',$project->title) }}">
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" readonly required class="form-control" name="slug" id="slug" placeholder="Titolo del progetto" value="{{ old('slug',$project->slug) }}">
        </div>

        {{-- <div class="mb-3">
          <label for="category_id" class="form-label">Categories</label>
          <select name="category_id" class="form-control" id="category_id">
            <option>Seleziona una categoria</option>
            @foreach($categories as $category)
              <option @selected( old('category_id', optional($project->category)->id ) == $category->id ) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div> --}}

        <div class="form-group mb-3">
          <p>Seleziona Tecnologie:</p>
          <div class="d-flex flex-wrap gap-4 ">
            @foreach ($technologies as $technology)
              <div class="form-check">
                <input name="technologies[]" class="form-check-input" type="checkbox" value="{{$technology->id}}" id="technology-{{$technology->id}}" @checked( in_array($technology->id, old('technologies',$project->technologies->pluck('id')->all()) ) ) >
                <label class="form-check-label" for="technology-{{$technology->id}}">
                  {{ $technology->name }}
                </label>
              </div>
            @endforeach
          </div>
        </div>

        <div class="mb-3">
          <label for="content"  class="form-label">Post content</label>
          <textarea class="form-control" id="content" name="content" rows="3">{{ old('description',$project->description) }}</textarea>
        </div>

        <div class="mb-3">
          <input type="submit" class="btn btn-primary " value="Save">
        </div>
      </form>

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      </div>
    </section>
@endsectionproject