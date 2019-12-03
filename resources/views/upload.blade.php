<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<form method="POST" action="{{route('upload_file')}}"  enctype="multipart/form-data">
  {{ csrf_field() }}
        <div class="form-group">
          <input type="file" name="file" accept="image/*" >
                 <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</body>

</html>