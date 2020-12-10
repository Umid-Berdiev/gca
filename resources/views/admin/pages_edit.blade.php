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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{route('pages_update')}}">
      <div class="card-body tab-content">
        <div class="form-group floating-label">
          <img height="50" src="{{'/storage/app/public/photos/1/'.$page_group->photo_url}}" alt="">
          <input type="file" name="photos" value="{{$page_group->photo_url}}" class="form-control" accept="image/*">
          <input type="hidden" name="page_group_id" value="{{$page_group->id}}">
        </div>
        <div class="form-group">
          <select class="form-control" id="select1" name="categories">
            @foreach($page_categories as $key =>$categories)
            @if($categories->category_group_id == $page_group->page_category_group_id)
            <option selected value="{{$categories->category_group_id}}">
              {{$categories->category_name}}
            </option>
            @else
            <option value="{{$categories->category_group_id}}">
              {{$categories->category_name}}
            </option>
            @endif
            @endforeach
          </select>
          <label for="select1">Categories</label>
        </div>
        @foreach($languages as $key =>$val)
        @if($key == 0)
        <div class="tab-pane active" id="{{$languages[$key]->id}}">
          <div class="form" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="language_ids[]" value="{{$languages[$key]->id}}">
            <input type="hidden" name="page_id[]" value="{{$pages[$key]->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" value="{{$pages[$key]->title}}" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="description[]" value="{{$pages[$key]->description}}" class="form-control"
                id="regular2">
              <label for="regular2">Description</label>
            </div>

            <div class="form-group floating-label">
              <textarea name="content[]" class="form-control" id="regular2">
                                            {{$pages[$key]->content}}
                                        </textarea>
            </div>

          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$languages[$key]->id}}">
          <div class="form" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="language_ids[]" value="{{$languages[$key]->id}}">
            <input type="hidden" name="page_id[]" value="{{$pages[$key]->id}}">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" value="{{$pages[$key]->title}}" class="form-control" id="regular2">
              <label for="regular2">Title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="description[]" value="{{$pages[$key]->description}}" class="form-control"
                id="regular2">
              <label for="regular2">Description</label>
            </div>

            <div class="form-group floating-label">
              <textarea name="content[]" class="form-control" id="regular2">
                                            {{$pages[$key]->content}}
                                        </textarea>
            </div>

          </div>
        </div>
        @endif
        @endforeach

        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection