@extends("admin.layout.template")

@section("content")

<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      @include('partials.alerts')
    </div>
  </div>
</div>

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        @foreach($languages as $key =>$language)
        <li @if($key==0) class="active" @endif>
          <a href="#{{$language->id}}">{{$language->language_name}}</a>
        </li>
        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ route('pages.update', $page_group->id) }}">
      @csrf
      @method('put')

      <div class="card-body tab-content">
        {{-- @if ($page_group->photo_url && $page_group->photo_url != "null")
        <img height="100" src="{{ asset('storage/pages/' . $page_group->photo_url) }}" alt="page-photo">
        <input type="checkbox" name="remove_cover" id="remove-cover">
        <label for="remove-cover">Remove cover</label>
        @else <span>No image</span>
        @endif --}}
        {{-- <div class="form-group floating-label">
          <input type="file" name="photos" value="{{ $page_group->photo_url }}" class="form-control" accept="image/*">
        <input type="hidden" name="page_group_id" value="{{ $page_group->id }}">
      </div> --}}
      <div class="form-group">
        <select class="form-control" id="select1" name="category_id">
          @foreach($categories as $key =>$categories)
          <option @if($categories->category_group_id == $page_group->page_category_group_id) selected @endif
            value="{{ $categories->category_group_id }}">
            {{ $categories->category_name }}
          </option>
          @endforeach
        </select>
        <label for="select1">Categories</label>
      </div>
      @foreach($languages as $key => $val)
      @if($key == 0)
      <div class="tab-pane active" id="{{ $languages[$key]->id }}">
        <div class="form" role="form">
          <input type="hidden" name="language_ids[]" value="{{ $languages[$key]->id }}">
          <input type="hidden" name="page_ids[]" value="{{ $pages[$key]->id }}">
          <div class="form-group floating-label">
            <input type="text" name="titles[]" value="{{ $pages[$key]->title }}" class="form-control" id="title">
            <label for="title">Title</label>
          </div>
          {{-- <div class="form-group floating-label">
              <input type="text" name="descriptions[]" value="{{ $pages[$key]->description }}" class="form-control"
          id="desc">
          <label for="desc">Description</label>
        </div> --}}
        <div class="form-group floating-label">
          <textarea name="contents[]" class="form-control">{{ $pages[$key]->content }}</textarea>
        </div>
      </div>
  </div>
  @else
  <div class="tab-pane" id="{{ $languages[$key]->id }}">
    <div class="form" role="form">
      <input type="hidden" name="language_ids[]" value="{{ $languages[$key]->id }}">
      <input type="hidden" name="page_ids[]" value="{{ $pages[$key]->id }}">
      <div class="form-group floating-label">
        <input type="text" name="titles[]" value="{{ $pages[$key]->title }}" class="form-control" id="title">
        <label for="title">Title</label>
      </div>
      {{-- <div class="form-group floating-label">
            <input type="text" name="descriptions[]" value="{{ $pages[$key]->description }}" class="form-control"
      id="desc">
      <label for="desc">Description</label>
    </div> --}}
    <div class="form-group floating-label">
      <textarea name="contents[]" class="form-control">{{ $pages[$key]->content }}</textarea>
    </div>
  </div>
</div>
@endif
@endforeach

<div class="card-actionbar-row">
  <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back</a>
  <button type="submit" class="btn btn-primary ink-reaction">Update</button>
</div>
</div>
</form>
</div>
</div>
@endsection