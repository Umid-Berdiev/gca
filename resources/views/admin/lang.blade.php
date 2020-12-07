@extends("admin.layout.template")


@section("content")

    <div class="col-md-12" style="background-color: white;padding: 25px;">
        <div class="col-md-12">
            <p><button type="button" class="btn ink-reaction btn-floating-action btn-lg btn-primary" onclick="window.location.href='{{ URL("/admin/language/create") }}'"><i class="fa fa-plus"></i></button></p>
            <div class="col-md-2">


         </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="180px">Language name</td>
                    <td width="180px">Language prefix</td>

                    <td width="80px"> </td>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($table);$i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $table[$i]->language_name }}</td>
                        <td>{{ $table[$i]->language_prefix }}</td>

                        <td>
                            <span><a href="{{ URL("/admin/language/edit?id=".$table[$i]->id) }}"><i class="fa fa-edit"></i></a></span>
                            <span><a href="{{ URL("/admin/language/delete?id=".$table[$i]->id) }}" onclick="return confirm('Are you sure you want to delete this thing into the database?')"><i class="fa fa-remove"></i></a></span>

                        </td>
                    </tr>
                @endfor

                </tbody>
            </table>

            {{ $table->links() }}
        </div>
    </div>

@endsection

