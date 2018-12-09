<script src="{{ asset('/js/jquery.min.js') }}"></script>
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"><table class="table">
    <link href="{{ asset('css/links.css') }}" rel="stylesheet">
    <thead class="thead-dark">
    <tr>
        <th scope="col">First name</th>
        <th scope="col">Second_name</th>
        <th scope="col">Birth_date</th>
        <th scope="col">Email</th>
        <th scope="col">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="getStudents({{ @$course_id}})">Add</button>
        </th>
        <th scope="col">
            <div class="wrapper">
                <a class="fourth before after" href="/courses" style="font-size: medium; top: 3px;">Courses</a>
                <img src="{{ asset('svg/user.svg') }}" style="border: solid;"/>
            </div>
        </th>
    </tr>
    </thead>
    <tbody id="c{{ @$stud[0]['course_id'] }}">
    @foreach($stud as $st)
        <tr id="t{{ $st['id'] }}">
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $st['first_name'] }}</span>
                </div>
            </td>
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $st['second_name'] }}</span>

                </div>

            </td>
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $st['birth_date'] }}</span>

                </div>

            </td>
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $st['email'] }}</span>

                </div>

            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="del({{ $st['id'] }}, {{ $st['course_id'] }})">Delete</button>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>

<script>
    function del(stud_id, course_id) {
        if(confirm("Are you sure?"))
        {
            $.ajax({
                type:'POST',
                url:'/courses/delmember/' + stud_id + '/' + course_id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                    document.getElementById('t' + stud_id).innerHTML = '';
                }
            })
        }
    }

    function add(stud_id, course_id) {
        if(confirm("Are you sure?"))
        {
            $.ajax({
                type:'POST',
                url:'/courses/addmember/' + stud_id + '/' + course_id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                    document.getElementById('stud' + stud_id).innerHTML = '';
                }
            })
        }
    }

    function getStudents(course_id) {
        $.ajax({
            type:'POST',
            url:'/courseStudents/' + course_id,
            data:{_token: "{{ csrf_token() }}"
            },
            success: function( msg ) {
                msg.msg.forEach(function (value) {
                    var el = document.createElement('tr');
                    el.id = 'stud' + value['id'];

                    document.getElementById('modalstudents').appendChild(el).innerHTML = '<td>' + value['first_name'] +
                            '</td><td>' + value['second_name'] + '</td><td>' + value['birth_date'] + '</td><td>' + value['email'] + '</td>' +
                        '<a onclick="add(' + value['id'] + ', ' + course_id + ')"' +
                        ' class="btn badge-info" style="font-size:15" role="button">Add</a>';
                });
            }
        })
    }
</script>
@extends('modal_add_stud')
@show
