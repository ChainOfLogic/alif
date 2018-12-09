<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</head>
<body>

   <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <a class="fourth before after" style="cursor: pointer;"> <h4 class="modal-title">Add course</h4> </a>
                    <button type="button" class="close" data-dismiss="modal" >&times;</button>

                </div>
                <div class="modal-body">
                    <div class="col-xs-2">
                        <input class="form-control" id="first_name" type="text"   placeholder="first name">
                        <input class="form-control" id="second_name" type="text"  placeholder="second name">
                        <input class="form-control" id="birth_date" type="date"   placeholder="birth date">
                        <input class="form-control" id="phone_number" type="text" placeholder="phone number">
                        <input class="form-control" id="address" type="text"      placeholder="address">
                        <input class="form-control" id="email" type="email"       placeholder="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <a onclick="add()" class="btn badge-info" style="font-size:15" role="button">Add</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
