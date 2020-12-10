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
        @if($key == 0)
        <li class="active"><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @else
        <li><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endif

        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{ route("video.store") }}">
      @csrf
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <select class="form-control" name="category_id" id="category_id">
            @foreach($category as $value)
            <option value="{{ $value->group }}">{{ $value->title }}</option>
            @endforeach
          </select>
          <label for="category_id">Video category</label>
        </div>
        @foreach($languages as $key => $language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="names">
              <label for="names">name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="descriptions">
              <label for="descriptions">description</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" id="links">
              <label for="links">youtube link id</label>
            </div>
            {{-- <div class="form-group floating-label">
              <input type="file" name="cover" class="form-control" id="cover">
            </div> --}}
          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">

            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" id="names">
              <label for="names">name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="descriptions">
              <label for="descriptions">description</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" id="links">
              <label for="links">youtube link id</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('video.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection