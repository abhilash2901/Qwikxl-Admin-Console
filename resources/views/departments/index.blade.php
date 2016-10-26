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
        <li class="active" ><a href="{{Request::root()}}/departments">Manage Departments</a></li>
        <li><a href="{{Request::root()}}/departments/add-departments">Add Departments</a></li>
      </ul>
  </div>
</nav>

<div class="container">

  <h2>Manage Departments</h2>

@if(Session::has('message'))
  <div class="alert alert-success">
                    <strong><span class="glyphicon glyphicon-ok"></span>{{  Session::get('message') }}</strong>
                </div>
@endif


  
@if(count($departmentss)>0)
  <table class="table table-hover">
    <thead>
      <tr>
        <th>SL No</th>
        <th>id</th>
       <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php $i=1 ?>
@foreach($departmentss as $departments)
      <tr>
        <td>{{$i}} </td>
        <td> <a href="{{Request::root()}}/departments/view-departments/{{$departments->id}}" > {{$departments->id }}</a> </td>

        <td>
        <a href="{{Request::root()}}/departments/change-status-departments/{{$departments->id }}" > @if($departments->status==0) {{"Activate"}}  @else {{"Dectivate"}} @endif </a>
        <a href="{{Request::root()}}/departments/edit-departments/{{$departments->id}}" >Edit</a>
        <a href="{{Request::root()}}/departments/delete-departments/{{$departments->id}}" onclick="return confirm('are you sure to delete')">Delete</a>
        </td>

      </tr>
    <?php $i++;  ?>
    @endforeach
    </tbody>
  </table>
   @else
  <div class="alert alert-info" role="alert">
                    <strong>No Departmentss Found!</strong>
                </div>
 @endif
</div>

</body>
</html>