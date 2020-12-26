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
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{ route('video.update', $grp_id) }}">
      @csrf
      @method('put')
      <input type="hidden" name="group" value="{{ $grp_id }}">
      <div class="card-body tab-content">
        @foreach($languages as $key =>$language)
        @if($key == 0)

        @foreach($model as $val)

        @if($val->language_id ==$language->id)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <select class="form-control" name="category_id" id="category_id">
                @foreach($category as $value)
                <option value="{{ $value->group }}" selected="{{ $val->event_category_id == $value->group }}">
                  {{ $value->title }}</option>
                @endforeach
              </select>
              <label for="category_id">Video category</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" value="{{ $val->name }}" id="names">
              <label for="names">name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="{{ $val->description }}"
                id="descriptions">
              <label for="descriptions">description</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" id="links" value="{{ $val->youtube_link }}">
              <label for="links">youtube link id</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @else
        @foreach($model as $val)
        @if($val->language_id ==$language->id)
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" value="{{ $val->name }}" id="names">
              <label for="names">name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="{{ $val->description }}"
                id="descriptions">
              <label for="descriptions">description</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" value="{{ $val->youtube_link }}" id="links">
              <label for="links">youtube link id</label>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <a href="{{ route('video.index') }}" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->

@endsection