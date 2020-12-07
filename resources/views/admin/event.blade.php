@extends("admin.layout.template")

@section("content")

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <div class="form-group">
                <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='{{ URL("/admin/event/create") }}'"><i class="fa fa-plus"></i></button></p>
                <form action="{{URL('admin/event')}}" method="get">
                    <div class="input-group">
                        <div class="input-group-content">
                            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
                            <label for="groupbutton9"></label>
                        </div>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </div>

                    </div>
                </form>
            </div>
            <table class="table table-condensed no-margin">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="80px">title</td>
                    <td width="80px">datestart</td>
                    <td width="80px">dateend</td>
                    <td width="80px">category_name</td>

                    <td width="80px"></td>
                </tr>
                </thead>
                <tbody>
                @foreach($table as $key => $page)
                    <tr>
                        <td>{{$key+1}}</td>

                        <td>{{$page->title}}</td>
                        <td>{{$page->datestart}}</td>
                        <td>{{$page->dateend}}</td>
                        <td>{{$page->category_name}}</td>
                        <td>
                            <span><a href="{{URL('/admin/event/edit?id='.$page->group)}}"><i class="fa fa-edit"></i></a></span>
                            <span><a onclick="return confirm('Are you sure you want to delete this thing into the database?')" href="{{URL('/admin/event/delete?id='.$page->group)}}"><i class="fa fa-remove"></i></a></span>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $table->links() }}
        </div>
    </div>

@endsection
