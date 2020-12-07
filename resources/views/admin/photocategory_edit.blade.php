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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{  URL("/admin/photocategory/edit")}}">
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
                                                <input type="text" name="title[]" class="form-control" value="{{ $val->title }}" id="regular2">
                                                <label for="regular2">title</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="Description[]" class="form-control" value="{{ $val->Description }}" id="regular2">
                                                <label for="regular2">Description</label>
                                            </div>



                                            <div class="form-group floating-label">
                                                <input type="file" name="cover" class="form-control"  id="regular2">
                                                <label for="regular2">cover</label>
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
                                                <input type="text" name="Description[]" class="form-control" value="{{ $val->Description }}" id="regular2">
                                                <label for="regular2">description</label>
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
