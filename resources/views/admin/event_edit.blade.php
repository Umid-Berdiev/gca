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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{  URL("/admin/event/edit")}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="group" value="{{ $grp_id }}">
                <div class="card-body tab-content">
                    @foreach($languages as $key =>$language)
                        @if($key == 0)

                            @foreach($model as $val)

                                @if($val->language_id ==$language->id)
                                    <div class="tab-pane active" id="{{$language->id}}">
                                        <div class="form" role="form">

                                            <input type="hidden" name="language_id[]" value="{{$language->id}}">

                                            <div class="form-group floating-label">
                                                <select class="form-control" name="event_category_id">
                                                    @foreach($category as $value)
                                                            @if($val->event_category_id == $value->group)
                                                        <option value="{{ $value->group }}" selected>{{ $value->category_name }}</option>
                                                            @else
                                                            <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                                                                @endif
                                                    @endforeach
                                                </select>
                                                <label for="post_category_id">Event category</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="title[]" class="form-control" value="{{ $val->title }}" id="regular2">
                                                <label for="regular2">title</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="description[]" class="form-control" value="{{ $val->description }}" id="regular2">
                                                <label for="regular2">description</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <textarea  name="content[]" class="form-control"  id="regular2">{{ $val->content }}</textarea>
                                            </div>

                                            <div class="form-group floating-label">
                                                <input type="date" name="datestart" class="form-control" value="{{ $val->datestart }}" id="regular2">
                                                <label for="regular2">datestart</label>
                                            </div>


                                            <div class="form-group floating-label">
                                                <input type="date" name="dateend" class="form-control" value="{{ $val->dateend }}" id="regular2">
                                                <label for="regular2">dateend</label>
                                            </div>

                                            <div class="form-group floating-label">
                                                <input type="file" name="cover" class="form-control"  id="regular2">
                                                <label for="regular2">cover</label>
                                            </div>


                                            <div class="form-group floating-label">
                                                <input type="text" name="organization[]" class="form-control" value="{{ $val->organization }}" id="regular2">
                                                <label for="regular2">organization</label>
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

                                            <input type="hidden" name="language_id[]" value="{{$language->id}}">
                                            <div class="form-group floating-label">
                                                <input type="text" name="title[]" class="form-control" value="{{ $val->title }}" id="regular2">
                                                <label for="regular2">title</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="description[]" class="form-control" value="{{ $val->description }}" id="regular2">
                                                <label for="regular2">description</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <textarea  name="content[]" class="form-control" id="regular2">{{ $val->content }}</textarea>
                                                <label for="regular2">content</label>
                                            </div>




                                            <div class="form-group floating-label">
                                                <input type="text" name="organization[]" class="form-control" value="{{ $val->organization }}" id="regular2">
                                                <label for="regular2">organization</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



@endsection
