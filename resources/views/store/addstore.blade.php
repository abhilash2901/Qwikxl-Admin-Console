@extends('layouts.app')

@section('content')



<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Store Information</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>

            <li class="active">
                <strong>Store Information</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-5">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>General Information

                    </h5>

                </div>
               
                <div class="ibox-content">
                    <div class="row">
                        <div class="updatemessage" tabindex='1'></div>
                        <form class="form-horizontal" id="store">
                            <div class="form-group"><label class="col-sm-2 control-label">Store ID</label>

                                <div class="col-sm-8"><input  type="text" name="unique_id"  placeholder="002456" value="<?php echo  rand(); ?>" readonly="" class="form-control"> <span
                                        class="help-block m-b-none">Generated automatically</span>
                                </div>
                            </div>
                            <!--div class="form-group"><label class="col-sm-2 control-label">Store Type</label>
    
        <div class="col-sm-4"><select class="form-control m-b" name="account">
                                        <option selected="selected">Select Store Type</option>
            <option>Single Store</option>
            <option>Chain Store</option>
            
        </select>
        </div>
    </div-->
                            <div class="form-group"><label class="col-sm-2 control-label">Store name</label>

                                <div class="col-sm-8"><input type="text"  name ="name" class="form-control" required></div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Store Number</label>

                                <div class="col-sm-8"><input type="text" class="form-control" name="corporateidentifier" required> <span
                                        class="help-block m-b-none">Corporate Store identifier #</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Address</label>

                                <div class="col-sm-8"><input type="text" class="form-control" name="address"  required> 
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Address2</label>

                                <div class="col-sm-8"><input type="text" class="form-control" name="address2" > 
                                </div>
                            </div>


                            <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="country" class="form-control m-b country"  style="width:275px;" tabindex="4" required>
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $key => $users)
                                                    <option value="{{ $users -> id}}">{{ $users -> name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="form-group"><label class="col-sm-2 control-label">State</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="state" class="form-control m-b state" style="width:275px;" tabindex="4" required>
                                                    <option value="">Select State</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" ><label class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <div class="">
                                        <div class="col-md-8 form-group">       
                                            <div class="input-group">
                                                <select  name="city" class="form-control m-b city" style="width:275px;" tabindex="4">
                                                    <option value="">Select City</option>

                                                </select>



                                                <div class="field_wrapper" align="right">                        
                                                    <a href="javascript:void(0);" class="add_button" title="Add City">
                                                        <span class="fa fa-plus-circle fie" aria-hidden="true"></span></a>

                                                    <!--                                                  <fieldset class="answer">
                                                                                                        <label for="coupon_field"></label>
                                                                                                        <input type="text" name="city" id="coupon_field" style="width:275px; height:30px" />
                                                                                                    </fieldset>
                                                                                                          <fieldset class="question">
                                                                                                        <label for="coupon_question"></label>
                                                                                                        <input class="coupon_question" type="checkbox" name="coupon_question" value="1" />
                                                                                                        <span class="item-text">Add City</span>
                                                                                                    </fieldset>-->        
                                                </div> 

                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>


                            <!--             <div class="field_wrapper">
                                <div>
                                    <input type="text" name="city" value=""/>
                                    <a href="javascript:void(0);" class="add_button" title="Add field"><span class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>               -->








                            <div class="form-group" id='TextBoxesGroup'>
                            </div>

<!--                                <input type='button' class="btn btn-primary" value='Add city' id='addButton'>-->
                 <!--<input type='button' class="btn btn-primary" value='Remove' id='removeButton'>-->
<!--                             <input type='button' class="btn btn-primary" value='save' id='save'>-->

                            <div class="form-group"><label class="col-sm-2 control-label">Zip</label>
                                <div class="col-md-4"><input name="zip"  type="text" placeholder="30350"
                                                             class="form-control" id="valid"></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" data-mask="(999) 999-9999" placeholder="" name="phone" id="valid" >
                                    <span class="help-block">(999) 999-9999</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-8"><input type="email" placeholder="store@email.com" class="form-control" name="mail"  required></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label class="col-sm-2 control-label">Store website</label>

                                <div class="col-sm-8"><input type="text" placeholder="www.redstore.com" class="form-control" name="website"  ></div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="button" onClick="Addstore()">Save</button>							
                                </div>
                            </div>
                        </form>





                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Store users </h5>
                </div>
                <div class="usersres"></div>
                <div class="ibox-content" ng-app="app" ng-controller="search">
                    <?php
                    $store_id = "0";
                    if (Session::get('store_id')) {
                        $ss = "#myModal";
                        $store_id = Session::get('store_id');
                    } else {
                        $ss = "#myModaladdstore";
                    }
                    ?>
                    <a ui-sref="settings.add_users" class="btn btn-primary" data-toggle="modal" data-target="#myModaladdstore">Add users  </a>
                    <input type="hidden" value="<?php echo $store_id; ?>" ng-model="myuser" id="store_id">
                    <table class="table table-bordered topspace" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>

                                <th>Email</th>
                                <th>Role</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">No Users</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Store Departments</h5>
            </div>
            <div class="dptsucess"></div>
            <div class="ibox-content">
                <form class="form-horizontal" id="dept" >


                    <div class="form-group " id="add_dpt"><label class="col-lg-2 control-label">Dept 1</label>

                        <div class="col-lg-8"><input type="text" placeholder="Department 1" class="form-control" name="name[]" required> 
                        </div>
                    </div>
                    <div class="input_fields_wrap">
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button class="btn btn-white" id="add" type="button">Add </button>
                            <a ui-sref="settings.add_users" class="btn btn-primary" data-toggle="modal" data-target="#myModaladdstore">Save  </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Create user</h5>


                        </div>
                        <div class="ibox-content">
                            <div class="usersucess"></div>
                            <form class="form-horizontal create_user">

                                <div class="form-group"><label class="col-lg-2 control-label">User Id</label>

                                    <div class="col-lg-8"><input type="text" name="unique_id" readonly placeholder="User Id" class="form-control" value="<?php echo ( rand() + $users->id ); ?>"> <span
                                            class="help-block m-b-none">User Id is generated automatically</span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">User role</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="role_id" required>
                                            <?php
                                            foreach ($roles as $role) {
                                                ?>
                                                <option value="<?php echo $role->id; ?>"><?php echo $role->display_name; ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                                    <div class="col-lg-8"><input type="text" placeholder="first name" name ="firstname" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                                    <div class="col-lg-8"><input type="text" placeholder="last name" name ="lastname" class="form-control" required> 
                                        <input type="hidden"  name="store_id" value="<?php echo $store_id; ?>" class="form-control" required id="store_id"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                    <div class="col-lg-8"><input type="email" placeholder="email" name ="email" class="form-control" id="ghghgh" required> 
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label"> Confirm Email</label>

                                    <div class="col-lg-8"><input type="email" placeholder="email" class="form-control" data-parsley-equalto="#ghghgh" data-parsley-equalto-message="Email confirmation must match the Email." required=""> 
                                        <input type="hidden" placeholder="email" class="form-control" value="1" name="type"> 
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8">
                                        <button class="btn btn-md btn-primary" type="button" onClick="Create()">Create User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>



<a  class="btn btn-primary edit" data-toggle="modal" data-target="#myModal2" style="display:none">edit users  </a>

<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit user</h5>


                    </div>
                    <div class="ibox-content">
                        <div class="editsucess"></div>
                        <form class="form-horizontal edituser">

                            <div class="form-group"><label class="col-lg-2 control-label">User Id</label>

                                <div class="col-lg-8"><input type="text" name="unique_id" id="uneaque_id" readonly placeholder="User Id" class="form-control" value="<?php echo ( rand() + $users->id ); ?>"> <span
                                        class="help-block m-b-none">User Id is generated automatically</span>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">User role</label>

                                <div class="col-sm-4"><select class="form-control m-b" name="role_id" required id="role_id">
                                        <?php
                                        foreach ($roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">First Name</label>

                                <div class="col-lg-8"><input type="text" placeholder="first name" name ="firstname" class="form-control" required id="firstname">
                                    <input type="hidden" placeholder="first name" name ="id" class="form-control" required id="id">

                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                                <div class="col-lg-8"><input type="text" placeholder="last name" name ="lastname" id="lastname" class="form-control" required> 
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                                <div class="col-lg-8"><input type="email" placeholder="email" id="email" name ="email" class="form-control" id="ghghgh" required> 
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-8">
                                    <button class="btn btn-md btn-primary" type="button" onClick="editCreated()">Create User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModaladdstore" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Add</h5>


                    </div>
                    <div class="ibox-content">
                        Please add Store Details
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection