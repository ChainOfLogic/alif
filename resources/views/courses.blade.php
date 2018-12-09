<script src="{{ asset('/js/jquery.min.js') }}"></script>
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"><table class="table">
<link href="{{ asset('css/links.css') }}" rel="stylesheet">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Number of students</th>
        <th scope="col">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Add</button>
        </th>
        <th scope="col">
            <div class="wrapper">
                <a class="fourth before after" href="/dashboard" style="font-size: medium; top: 3px;">Main Page</a>
                <img src="{{ asset('svg/user.svg') }}" style="border: solid;"/>
            </div>
        </th>
    </tr>
    </thead>
    <tbody id="main">
        @foreach($courses as $course)
            <tr id="t{{ $course['id'] }}">
                <td>
                    <div class="col-xs-2">
                        <span class="label label-info">{{$course['id']}}</span>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex{{ $course['id'] }}" type="text" value={{$course['name']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <span class="label label-info">{{$course['amount']}}</span>

                    </div>

                </td>
                <td>
                    <a href="courses/members/{{ $course['id'] }}" class="btn btn-dark" style="font-size: 15" role="button">Show students</a>
                <button type="button" class="btn btn-danger" onclick="del({{ $course['id'] }})">Delete</button>
                <button type="button" class="btn btn-success" onclick="mod({{ $course['id'] }})">Edit</button>
                </td>

            </tr>
        @endforeach

    </tbody>
</table>

<script>
    function del(id) {
        if(confirm("Are you sure?"))
        {
            $.ajax({
                type:'POST',
                url:'/delcourse/' + id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                    document.getElementById('t' + id).innerHTML = '';
                }
            })
        }
    }

    function mod(id, name) {
        name = document.getElementById('ex' + id).value;
        if(confirm("Are you sure?"))
        {
            $.ajax({
                type:'POST',
                url:'/modcourse/' + id + '/' + name,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                }
            })
        }
    }
    function add(name) {
        $.ajax({
            type:'POST',
            url:'/addcourse/' + name,
            data:{_token: "{{ csrf_token() }}"
            },
            success: function( msg ) {
                location.reload();
            }
        })

    }
</script>
@extends('modalcourse')
@show
