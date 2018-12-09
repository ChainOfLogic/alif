<script src="{{ asset('/js/jquery.min.js') }}"></script>
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"><table class="table">
    <link href="{{ asset('css/links.css') }}" rel="stylesheet">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="getCourses({{ $stud_id }})">Add</button>
        </th>
        <th scope="col">
            <div class="wrapper">
                <a class="fourth before after" href="/students" style="font-size: medium; top: 3px;">Students</a>
                <img src="{{ asset('svg/user.svg') }}" style="border: solid;"/>
            </div>
        </th>
    </tr>
    </thead>
    <tbody id="c">
    @foreach($courses as $course)
        <tr id="t{{ $course['student_id'] }}">
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $course['id'] }}</span>
                </div>
            </td>
            <td>
                <div class="col-xs-2">
                    <span class="label label-info">{{ $course['name'] }}</span>

                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="del({{$course['student_id'] }}, {{$course['id']}})">Delete</button>
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
                url:'/students/delcourse/' + stud_id + '/' + course_id,
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
                url:'/students/addcourse/' + stud_id + '/' + course_id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                    document.getElementById('stud' + course_id).innerHTML = '';
                }
            })
        }
    }
    function getCourses(stud_id) {
        $.ajax({
            type:'POST',
            url:'/students/getCourses/' + stud_id,
            data:{_token: "{{ csrf_token() }}"
            },
            success: function( msg ) {
                msg.msg.forEach(function (value) {

                    var el = document.createElement('tr');
                    el.id = 'stud' + value['id'];

                    document.getElementById('modalcourses').appendChild(el).innerHTML = '<td>' + value['id'] + '</td>' + '<td>' + value['name'] + '</td>' +
                        '<a onclick="add(' + stud_id + ', ' + value['id'] + ')"' + 'class="btn badge-info" style="font-size:15" role="button">Add</a>';

                });
            }
        })
    }


</script>
@extends('modal_add_course')
@show
