@extends("admin.layout.template")
@section("content")
<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <form action="{{URL('admin/menu/edits')}}" method="get">
        <div class="input-group">
          <div class="form-group floating-label">
            <select class="form-control" name="id">
              <option value="null"></option>
              @foreach($menues as $keyone=>$value)
              <?php
                $modelsx = DB::table("menumakers")
                  ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                  ->where("parent_id","=",$value->group)
                  ->orderBy("orders")->get(); 
              ?>
              @if(count($modelsx) >0)

              <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>

              <ul>
                @foreach($modelsx as $keytwo=>$valuex)
                <?php $modelsxs = DB::table("menumakers")
                                                    ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                                    ->where("parent_id","=",$valuex->group)
                                                    ->orderBy("orders")->get(); ?>
                @if(count($modelsxs) >0)

                <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                </option>

                @foreach($modelsxs as $keythree=>$valuexx)
                <option value="{{ $valuexx->group }}">{{ ($keyone+1).".".($keytwo+1).".".($keythree+1) }})
                  {{ $valuexx->menu_name }}</option>
                @endforeach

                @else
                <option value="{{ $valuex->group }}">{{ ($keyone+1).".".($keytwo+1) }}) {{ $valuex->menu_name }}
                </option>
                @endif

                @endforeach
                @else
                <option value="{{ $value->group }}">{{ $keyone+1 }}){{ $value->menu_name }}</option>
                @endif
                @endforeach
            </select>
            <label for="regular2">Type</label>
          </div>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">EDIT</button>
          </div>
        </div>
      </form>
    </div>

    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <td>№</td>
            <td>Названия</td>
            <td>Действия</td>
          </tr>
        </thead>
        @foreach($menues as $keyone=>$value)
        <?php $modelsx = DB::table("menumakers")
                            ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                            ->where("parent_id","=",$value->group)
                            ->orderBy("orders")->get(); ?>
        @if(count($modelsx) >0)

        <tr>
          <td>{{ $keyone+1 }}</td>
          <td>{{ $value->menu_name }} | {{ $value->orders }}</td>
          <td>
            <span><a href="{{ URL( "/admin/menuchange?id=".$value->group."&p=up") }}"> <i
                  class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL( "/admin/menuchange?id=".$value->group."&p=down") }}"> <i
                  class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL( "/admin/menudelete?id=".$value->group) }}"> <i
                  class="fa fa-trash btn btn-danger"></i></a></span>
          </td>
        </tr>

        @foreach($modelsx as $keytwo=>$valuex)
        <?php $modelsxs = DB::table("menumakers")
                                        ->where("language_id","=",\App\Http\Controllers\NewsController::getlangid())
                                        ->where("parent_id","=",$valuex->group)
                                        ->orderBy("orders")->get(); ?>
        @if(count($modelsxs) >0)

        <tr>
          <td>"{{ ($keyone+1).'.'.($keytwo+1) }}"</td>
          <td style="padding-left: 25px;"><span style="background-color: #e1fcff">-{{ $valuex->menu_name }} |
              {{ $valuex->orders }}</span></td>
          <td>
            <span><a href="{{ URL( "/admin/menuchange?id=".$valuex->group."&p=up") }}"> <i
                  class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL( "/admin/menuchange?id=".$valuex->group."&p=down") }}"> <i
                  class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL( "/admin/menudelete?id=".$valuex->group) }}"> <i
                  class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr>

        @foreach($modelsxs as $keythree=>$valuexx)
        <tr>
          <td>{{ $keythree+1 }}</td>
          <td style="padding-left: 50px;"><span style="background-color: #daf9d1">--{{ $valuexx->menu_name }} |
              {{ $valuexx->orders }}</span></td>
          <td>
            <span><a href="{{ URL("/admin/menuchange?id=".$valuexx->group."&p=up") }}"> <i
                  class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL("/admin/menuchange?id=".$valuexx->group."&p=down") }}"> <i
                  class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL( "/admin/menudelete?id=".$valuexx->group) }}"> <i
                  class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr>
        @endforeach

        @else
        <tr>
          <td>{{ $keytwo+1 }}</td>
          <td style="padding-left: 25px;"><span style="background-color: #e1fcff">-{{ $valuex->menu_name }} |
              {{ $valuex->orders }}</span></td>
          <td>
            <span><a href="{{ URL("/admin/menuchange?id=".$valuex->group."&p=up") }}"> <i
                  class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL("/admin/menuchange?id=".$valuex->group."&p=down") }}"> <i
                  class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL( "/admin/menudelete?id=".$valuex->group) }}"> <i
                  class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr>
        @endif

        @endforeach

        @else

        <tr>
          <td>{{ $keyone+1 }}</td>
          <td>{{ $value->menu_name }} | {{ $value->orders }}</td>
          <td>
            <span><a href="{{ URL("/admin/menuchange?id=".$value->group."&p=up") }}"> <i
                  class="fa fa-arrow-circle-o-up btn btn-primary"></i></a></span>
            <span><a href="{{ URL("/admin/menuchange?id=".$value->group."&p=down") }}"> <i
                  class="fa fa-arrow-circle-o-down btn btn-warning"></i></a></span>
            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')"
                href="{{ URL( "/admin/menudelete?id=".$value->group) }}"> <i
                  class="fa fa-trash btn btn-danger"></i></a></span>

          </td>
        </tr>

        @endif
        @endforeach
      </table>
    </div>

  </div>
</div>

@endsection