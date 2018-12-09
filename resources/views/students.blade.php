<script src="{{ asset('/js/jquery.min.js') }}"></script>
<link href="{{ asset('css/links.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"><table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">First name</th>
        <th scope="col">Second Name</th>
        <th scope="col">Birth date</th>
        <th scope="col">Phone-number</th>
        <th scope="col">Address</th>
        <th scope="col">Email</th>
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
    <tbody>
        @foreach($students as $stud)
            <tr id="t{{ $stud['id'] }}">
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex1" type="text" value={{$stud['first_name']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex2" type="text" value={{$stud['second_name']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex3" type="text" value={{$stud['birth_date']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex4" type="text" value={{$stud['phone_number']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex5" type="text" value={{$stud['address']}}>
                    </div>
                </td>
                <td>
                    <div class="col-xs-2">
                        <input class="form-control" id="ex6" type="text" value={{$stud['email']}}>
                    </div>
                </td>
                <td>
                    <a href="students/scourses/{{ $stud['id'] }}" class="btn btn-dark" style="font-size: 15" role="button">Show courses</a>
                    <button type="button" class="btn btn-danger" onclick="del({{ $stud['id'] }})">Delete</button>
                    <button type="button" class="btn btn-success" onclick="mod({{ $stud['id'] }})">Edit</button>
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
                url:'/delstud/' + id,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                    document.getElementById('t' + id).innerHTML = '';
                }
            })
        }
    }
    function mod(id) {
        var sep = 'wyrtoe12322';
        var url =  document.getElementById('ex1').value + sep +  document.getElementById('ex2').value +
            sep + document.getElementById('ex3').value + sep + document.getElementById('ex4').value + sep +
            document.getElementById('ex5').value + sep + document.getElementById('ex6').value;
        if(confirm("Are you sure?"))
        {
            $.ajax({
                type:'POST',
                url:'/modstud/' + id + '/' + url,
                data:{_token: "{{ csrf_token() }}"
                },
                success: function( msg ) {
                }
            })
        }
    }
    function add() {
        var sep = 'wyrtoe12322';
        var url =  document.getElementById('first_name').value + sep +  document.getElementById('second_name').value +
             sep + document.getElementById('birth_date').value + sep + document.getElementById('phone_number').value + sep +
             document.getElementById('address').value + sep + document.getElementById('email').value;
        $.ajax({
            type:'POST',
            url:'/addstud/' + url,
            data:{_token: "{{ csrf_token() }}"
            },
            success: function( msg ) {
                location.reload();
            }
        })

    }
</script>

@extends('modalstud')
@show