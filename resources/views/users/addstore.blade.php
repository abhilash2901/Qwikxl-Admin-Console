@extends('layouts.app')
 
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Create Store</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
           
            <li class="active">
                <strong>Create Store</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Information
                        
                    </h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form method="get" class="form-horizontal">
						
						<div class="form-group"><label class="col-sm-2 control-label">Store ID</label>

                            <div class="col-sm-8"><input type="text" placeholder="002456" disabled="" class="form-control"> <span
                                    class="help-block m-b-none">Generated automatically</span>
                            </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Store Type</label>

                            <div class="col-sm-4"><select class="form-control m-b" name="account">
							    <option selected="selected">Select Store Type</option>
                                <option>Single Store</option>
                                <option>Chain Store</option>
                                
                            </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store name</label>

                            <div class="col-sm-8"><input type="text" class="form-control"></div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Store Number</label>

                            <div class="col-sm-6"><input type="text" class="form-control"> <span
                                    class="help-block m-b-none">Corporate Store identifier #</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                            <div class="col-sm-8"><input type="text" class="form-control"> 
                            </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">Address2</label>

                            <div class="col-sm-8"><input type="text" class="form-control"> 
                            </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">City</label>

                            <div class="col-sm-6"><input type="text" class="form-control"> 
                            </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">State</label>

                            <div class="col-sm-10">
                                <div class="">
								
                                    
                                   <div class="col-md-4 form-group">       

                                     <div class="input-group">
                                      <select chosen id="states" class="chosen-select" style="width:280px;" tabindex="4" ng-model="state" ng-options="s for s in main.states">
                                       </select>
                                     </div>
                                    </div>
								<div class="form-group"><label class="col-sm-2 control-label">Zip</label>
                                    <div class="col-md-4"><input type="text" placeholder="30350"
                                                                 class="form-control"></div>
																 </div>
                                </div>
                            </div>
                        </div>
						
                        <div class="hr-line-dashed"></div>
                       <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" ng-model="dataInput6">
                        <span class="help-block">(999) 999-9999</span>
                    </div>
                </div>
						<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-8"><input type="email" placeholder="store@email.com" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store website</label>

                            <div class="col-sm-8"><input type="text" placeholder="www.redstore.com" class="form-control"></div>
                        </div>
                        
                        
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                    </div>
					
                </div>
            </div>
			
			<div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create user</h5>

                    
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                       
						<div class="form-group"><label class="col-lg-2 control-label">User Id</label>

                            <div class="col-lg-8"><input type="email" disabled=""placeholder="User Id" class="form-control"> <span
                                    class="help-block m-b-none">User Id is generated automatically</span>
                            </div>
                        </div>
					<div class="form-group"><label class="col-sm-2 control-label">User role</label>

                            <div class="col-sm-4"><select class="form-control m-b" name="account">
                                <option>User</option>
                                <option>Manager</option>
                                
                            </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                            <div class="col-lg-8"><input type="text" placeholder="first name" class="form-control">
                            </div>
                        </div>
						 <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                            <div class="col-lg-8"><input type="text" placeholder="last name" class="form-control"> 
                            </div>
                        </div>
						 <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                            <div class="col-lg-8"><input type="email" placeholder="email" class="form-control"> 
                            </div>
                        </div>
						 <div class="form-group"><label class="col-lg-2 control-label"> Confirm Email</label>

                            <div class="col-lg-8"><input type="email" placeholder="email" class="form-control"> 
                            </div>
                        </div>
                        
                       
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
                                <button class="btn btn-md btn-primary" type="submit">Create User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			
        </div>
		
		
		
        <div class="col-lg-5">
		
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <h5>Store Contact</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        

                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <div class="row">
                                    
                                    <div class="col-md-4"><input type="text" placeholder="First"
                                                                 class="form-control"></div>
                                    <div class="col-md-4"><input type="text" placeholder="last"
                                                                 class="form-control"></div>
                                </div>
                            </div>
                        </div>
						 <div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-lg-2 control-label">Position</label>

                            <div class="col-lg-8"><input type="text" placeholder="Manager" class="form-control">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-8"><input type="email" placeholder="store@email.com" class="form-control"></div>
                        </div>
						<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-sm-2 control-label"> Verify Email</label>

                            <div class="col-sm-8"><input type="email" placeholder="" class="form-control"></div>
                        </div>
						<div class="hr-line-dashed"></div>
                       <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" ng-model="dataInput6">
                        <span class="help-block">(999) 999-9999</span>
                    </div>
                </div>
						<div class="hr-line-dashed"></div>
						<div class="form-group"><label class="col-lg-2 control-label">Address</label>

                            <div class="col-lg-8"><input type="text"  class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">City</label>

                            <div class="col-lg-8"><input type="text"  class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-sm-2 control-label">State</label>

                            <div class="col-sm-10">
                                <div class="">
								
                                    
                                   <div class="col-md-4 form-group">       

                                     <div class="input-group">
                                      <select chosen id="states" class="chosen-select" style="width:180px;" tabindex="4" ng-model="state" ng-options="s for s in main.states">
                                       </select>
                                     </div>
                                    </div>
								<div class="form-group"><label class="col-sm-2 control-label">Zip</label>
                                    <div class="col-md-4"><input type="text" placeholder="30350"
                                                                 class="form-control"></div>
																 </div>
                                </div>
                            </div>
                        </div>
						<div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                
                                <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add Contact</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
		
		
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <h5>Store Departments</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        

                        <div class="form-group"><label class="col-lg-2 control-label">Dept 1</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 1" class="form-control"> 
                            </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Dept 2</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 2" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 3</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 3" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 4</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 4" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 5</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 5" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 6</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 6" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 7</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 7" class="form-control">
                            </div>
                        </div>
						<div class="form-group"><label class="col-lg-2 control-label">Dept 8</label>

                            <div class="col-lg-8"><input type="text" placeholder="Department 8" class="form-control">
                            </div>
                        </div>
						 <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                               
                                <button class="btn btn-primary" type="submit">Save Departments</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
			
        </div>
    </div>
  <!--  <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Inline form</h5>

                    <div ibox-tools></div>
                </div>
                <div class="ibox-content">
                    <form role="form" class="form-inline">
                        <div class="form-group">
                            <label for="exampleInputEmail2" class="sr-only">Email address</label>
                            <input type="email" placeholder="Enter email" id="exampleInputEmail2"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2" class="sr-only">Password</label>
                            <input type="password" placeholder="Password" id="exampleInputPassword2"
                                   class="form-control">
                        </div>
                        <div class="checkbox m-r-xs">
                            <input type="checkbox" id="checkbox1">
                            <label for="checkbox1">
                                Remember me
                            </label>
                        </div>
                        <button class="btn btn-white" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Modal form
                        <small>Example of login in modal box</small>
                    </h5>
                    <div ibox-tools></div>
                </div>
                <div class="ibox-content" ng-controller="modalDemoCtrl">
                    <div class="text-center">
                        <button class="btn btn-primary" ng-click="open()">Form in simple modal box</button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    
</div>

	
	
@endsection