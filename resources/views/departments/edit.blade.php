<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>



<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">

      </div>
      <ul class="nav navbar-nav">
        <li><a href="{{Request::root()}}/departments">Manage Departments</a></li>
        <li><a href="{{Request::root()}}/departments/add-departments">Add Departments</a></li>
      </ul>
  </div>
</nav>


<div class="container">

  <h2>Update Departments</h2>  
<form role="form" method="post" action="{{Request::root()}}/departments/edit-departments-post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
 <input type="hidden" value="<?php echo $departments->id ?>"   name="departments_id">


      <div class="form-group">
    <label for="id">Id:</label>
    <input type="text" value="<?php echo $departments->id ?>" class="form-control" id="id" name="id">
  </div>
    <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" value="<?php echo $departments->name ?>" class="form-control" id="name" name="name">
  </div>
    <div class="form-group">
    <label for="description">Description:</label>
    <input type="text" value="<?php echo $departments->description ?>" class="form-control" id="description" name="description">
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>