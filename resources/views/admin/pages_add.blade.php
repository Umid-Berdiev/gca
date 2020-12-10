@extends("admin.layout.template")

@section("content")

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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{route('pages_store')}}">
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <input type="file" name="photos" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
          <select class="form-control" id="select1" name="categories">
            @foreach($page_categories as $key =>$categories)
            <option value="{{$categories->category_group_id}}">
              {{$categories->category_name}}
            </option>
            @endforeach
          </select>
          <label for="select1">Categories</label>
        </div>
        @foreach($languages as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="description[]" class="form-control" id="regular2">
              <label for="regular2">Description</label>
            </div>

            <div class="form-group floating-label">
              <textarea name="content[]" class="form-control" id="regular2">
                                        </textarea>
            </div>

          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="description[]" class="form-control" id="regular2">
              <label for="regular2">Description</label>
            </div>
            <div class="form-group">
              <textarea name="content[]">
                                        </textarea>
            </div>
          </div>
        </div>
        @endif
        @endforeach

        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection