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
        <li><a href="{{Request::root()}}/departments/manage-departments">Manage Departments</a></li>
        <li><a href="{{Request::root()}}/departments/add-departments">Add Departments</a></li>
      </ul>
  </div>
</nav>


<div class="container">

 <div class="row">
  <div class="col-xs-12 col-md-10 well">
   id  :  <?php echo $departments->id ?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-10 well">
   name  :  <?php echo $departments->name ?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-10 well">
   description  :  <?php echo $departments->description ?>
  </div>
</div>

</div>

</body>
</html>