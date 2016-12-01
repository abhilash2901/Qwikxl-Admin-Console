<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Customer;
use App\Role;
use App\Departments;
use DB;
use Session;
use App\Category;
use App\Order;
use App\Status;
use App\Country;
use App\Product;
use App\Orderdetail;
use App\Productinventory;
use App\Store;
use App\Orderstatus;

use Hash;
class OrdersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listOrders() {
		
		
       return view('orders.listorder');
    } public function assignedorders() {
		
		
       return view('orders.assignedorders');
    } public function completeorders() {
		
		
       return view('orders.completeorders');
    }public function fullfillmentorders() {
		
		
       return view('orders.fullfillmentorders');
    }
	public function getOrders(Request $request) {
		 $ids = Session::get('store_userid');
           $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			
			
		    ->select('order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price))  AS price'),DB::raw('sum(orderdetails.quantity) AS quantity'),'customers.firstname','orders.unique_id','orders.transaction_id','customers.lastname', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			
		
			->groupBy('orders.id')
			->orderBy('orders.id' ,'DESC')
			
            
		    
			->get();
			
			$numss =Order::
			join('orderdetails', 'orderdetails.orderid', '=', 'orders.id' )
			->join('products', 'products.id', '=', 'orderdetails.itemid')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
			->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			
			
		    ->select(DB::raw('sum(orderdetails.quantity) AS quantity'),'order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price)) AS price'),'customers.firstname','orders.unique_id','orders.transaction_id','customers.lastname', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			
		
			->groupBy('orderdetails.orderid')
			->orderBy('orderdetails.id' ,'DESC')
			
            
		    
			->get();
			$status =Status::get();
			print_r(json_encode(array('orders'=>$nums,'statuss'=>$status)));
    }public function getnewOrders(Request $request) {
		 $ids = Session::get('store_userid');
           $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			
			
		    ->select('order_status.status as o','orders.createddate','orders.total AS price',DB::raw('sum(orderdetails.quantity) AS quantity'),'customers.firstname','orders.unique_id','orders.transaction_id','orders.pick_type','customers.lastname','customers.mobile', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			->where('order_status_histories.status_id', 1)
			
		
			->groupBy('orders.id')
			->orderBy('orders.id' ,'DESC')
			
            
		    
			->get();
			
			$numss =Order::
			join('orderdetails', 'orderdetails.orderid', '=', 'orders.id' )
			->join('products', 'products.id', '=', 'orderdetails.itemid')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
			->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			
			
		    ->select(DB::raw('sum(orderdetails.quantity) AS quantity'),'order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price)) AS price'),'customers.firstname','orders.unique_id','orders.transaction_id','customers.lastname', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			
		
			->groupBy('orderdetails.orderid')
			->orderBy('orderdetails.id' ,'DESC')
			
            
		    
			->get();
			$status =Status::get();
			print_r(json_encode(array('orders'=>$nums,'statuss'=>$status)));
    }public function getfulfilmentOrders(Request $request) {
		 $ids = Session::get('store_userid');
		 $id = Session::get('id');
           $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			->join('users as table1', 'table1.id', '=', 'order_status_histories.assigned_to')
			
		    ->select('order_status_histories.created_at as osh_created','order_status_histories.date_time','table1.firstname as assigned_touser','order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price))  AS price'),DB::raw('sum(orderdetails.quantity) AS quantity'),'customers.firstname','orders.unique_id','orders.transaction_id','orders.pick_type','customers.lastname','customers.mobile', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			
			->where('order_status_histories.current_status_flag', 1)
			->where('order_status_histories.assigned_to', $id)

			
			
		
			->groupBy('orders.id')
			->orderBy('orders.id' ,'DESC')
			
            
		    
			->get();
			
			
			$status =Status::get();
			print_r(json_encode(array('orders'=>$nums,'statuss'=>$status)));
    }
public function getassignedOrders(Request $request) {
		 $ids = Session::get('store_userid');
		  $input = $request->all();
           $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			->join('users as table1', 'table1.id', '=', 'order_status_histories.assigned_to')
			->join('users as table2', 'table2.id', '=', 'order_status_histories.assigned_by')
			
			
		    ->select('table1.firstname as assigned_touser','order_status_histories.date_time','order_status_histories.created_at as osh_created','table2.firstname as assigned_byuser','table2.lastname as assigned_byuserlast','order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price))  AS price'),DB::raw('sum(orderdetails.quantity) AS quantity'),'customers.firstname','orders.unique_id','orders.transaction_id','orders.pick_type','customers.lastname','customers.mobile', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			->where('order_status_histories.status_id', $input['status'])
			
		
			->groupBy('orders.id')
			->orderBy('orders.id' ,'DESC')
			
            
		    
			->get();
			
			
			$status =Status::get();
			print_r(json_encode(array('orders'=>$nums,'statuss'=>$status)));
    }
	public function getcompletedOrders(Request $request) {
		 $ids = Session::get('store_userid');
		  $input = $request->all();
           $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			->join('users as table1', 'table1.id', '=', 'order_status_histories.assigned_to')
			->join('users as table2', 'table2.id', '=', 'order_status_histories.assigned_by')
			
			
		    ->select('table1.firstname as assigned_touser','order_status_histories.date_time','order_status_histories.created_at as osh_created','table2.firstname as assigned_byuser','table2.lastname as assigned_byuserlast','order_status.status as o','orders.createddate',DB::raw('sum((orderdetails.price))  AS price'),DB::raw('sum(orderdetails.quantity) AS quantity'),'customers.firstname','orders.unique_id','orders.transaction_id','orders.pick_type','customers.lastname','customers.mobile', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			->Where('order_status_histories.status_id', $input['status'])
			->orWhere('order_status_histories.status_id', $input['status1'])
			
		
			->groupBy('orders.id')
			->orderBy('orders.id' ,'DESC')
			
            
		    
			->get();
			
			
			$status =Status::get();
			print_r(json_encode(array('orders'=>$nums,'statuss'=>$status)));
    }

	    public function viewneworder($id) {
			$status =Status::where('id','!=','1')->get();
			$storeuser =User::join('role_user', 'role_user.user_id', '=', 'users.id')
			             ->join('roles', 'role_user.role_id', '=', 'roles.id')
						  ->select('users.*')
						 ->where('roles.name', 'store user')
			             ->get();
						
			return view('orders.viewneworder',['id' => $id,'status' => $status,'storeuser' => $storeuser]);
		}  public function viewfulfillmentorder($id) {
			$status =Status::where('id','!=','1')->where('id','!=','4')->get();
			$storeuser =User::join('role_user', 'role_user.user_id', '=', 'users.id')
			             ->join('roles', 'role_user.role_id', '=', 'roles.id')
						  ->select('users.*')
						 ->where('roles.name', 'store user')
			             ->get();
			$currentstatus=DB::table('order_status_histories')
			->join('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			->join('users', 'users.id', '=', 'order_status_histories.assigned_to')
			 ->select('order_status.*','users.id as userid')
			 ->where('order_status_histories.current_status_flag', 1)
			 ->where('order_status_histories.order_id',$id)
			->orderBy('order_status_histories.id', 'desc')->get();			
			return view('orders.viewfulfillmentorder',['id' => $id,'status' => $status,'assigned_to' => $currentstatus[0]->userid,'currentstatus' => $currentstatus[0]->id,'storeuser' => $storeuser]);
		} 
		public function viewassignedorder($id) {
			$status =Status::where('id','!=','1')->get();
			$storeuser =User::join('role_user', 'role_user.user_id', '=', 'users.id')
			             ->join('roles', 'role_user.role_id', '=', 'roles.id')
						  ->select('users.*')
						 ->where('roles.name', 'store user')
			             ->get();
			$currentstatus=DB::table('order_status_histories')
			->join('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			->join('users', 'users.id', '=', 'order_status_histories.assigned_to')
			 ->select('order_status.*','users.id as userid')
			 ->where('order_status_histories.current_status_flag', 1)
			 ->where('order_status_histories.order_id',$id)
			->orderBy('order_status_histories.id', 'desc')->get();
						
			return view('orders.viewassignedorder',['id' => $id,'status' => $status,'assigned_to' => $currentstatus[0]->userid,'currentstatus' => $currentstatus[0]->id,'storeuser' => $storeuser]);
		}
	    public function deleteOrder(Request $request) {
		 $input = $request->all();
		 $flight = Orderdetail::where('orderid', $input['id']);

         $flight->delete();
		 //Orderdetail::destroy('orderid',$input['id']);
		 Order::destroy($input['id']);


        print_r(json_encode(array('status' => 'success', 'msg' => 'Order Delete Succesfully')));
	}
	public function listCustomer() {
		return view('orders.listcustomer');
	}
	public function neworders() {
		return view('orders.neworders');
	}
	public function editOrder($id) {
		$nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select('orderdetails.createddate as cdate','orderdetails.quantity','orders.total','stores.name','orders.createddate','customers.firstname','customers.email','customers.address','customers.mobile','customers.country','orders.transaction_id','customers.lastname', 'orders.id as order_id','orderdetails.price','orders.transaction_id', 'orderdetails.price', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('orders.id', $id)
			->get();
		$item = Product::
		     join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select('products.name','orderdetails.price','orderdetails.quantity')
			->where('orders.id', $id)
			->get();
		 $status =Status::get();
		return view('orders.editorder',[ 'result' => $nums,'id' => $id,'products'=>$item,'status'=>$status]);
	}
	public function getsingleorder(Request $request) {
		//return view('orders.listcustomer');
		 $input = $request->all();
		 $nums = Product::
			join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select('orderdetails.createddate as cdate','customers.id as customer_id','orderdetails.quantity','orders.total','stores.name','orders.createddate','customers.firstname','customers.email','customers.address','customers.mobile','customers.country','orders.unique_id','orders.transaction_id','customers.lastname', 'orders.id as order_id','orderdetails.price','orders.transaction_id', 'orderdetails.price', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('orders.id', $input['id'])
			->get();
			$item = Product::
		     join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			->join('departments', 'departments.id', '=', 'productinventories.department_id')
			
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select('products.name','products.image','products.description','productinventories.price as productprice','orderdetails.price','orderdetails.quantity','orders.unique_id','departments.name as dptname')
			->where('orders.id', $input['id'])
			->get();
			$items = Product::
		     join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select(DB::raw('sum(orderdetails.price) AS total'))
			->where('orders.id', $input['id'])
			->get();
			$status=DB::table('order_status_histories')
			->join('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			 ->select('order_status.status')
			 ->where('order_status_histories.current_status_flag', 1)
			 ->where('order_status_histories.order_id', $input['id'])
			->orderBy('order_status_histories.id', 'desc')->get();
			print_r(json_encode(array('single'=>$nums[0],'itemlist'=>$item ,'statuss'=>$status[0],'total'=>$items[0]->total)));
	}public function CustomerList(Request $request) {
		//return view('orders.listcustomer');
		 $input = $request->all();
		 $res =Customer::get();
		 print_r(json_encode($res));
	}
	public function customupdate(Request $request) {
		//return view('orders.listcustomer');
		 $input = $request->all();
		 $inputs=array(
		  'mobile'=>$input['mobile'],
		  'address'=>$input['address']
		 );
		 $res =Customer::where('id',$input['id']);
		 
         $res->update($inputs);
		 print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully','id'=>$input['product_id'])));
	}public function updatestatus(Request $request) {
		
		 $input = $request->all();
		 $inputs=array(
		  'order_id'=>$input['order_id'],
		  'description'=>$input['description'],
		  'status_id'=>$input['status_id'],
		  'current_status_flag'=>1
		 ); 
		 $inpt=array(
		  
		  'current_status_flag'=>0
		 );
		 $count =Orderstatus::where('order_id',$input['order_id'])->get();
		 if(count($count)>0){
			$res= Orderstatus::where('order_id',$input['order_id']);
            $res->update($inpt);
			 //DB::update('update order_status_histories set current_status_flag = ? where order_id = ?', ['0',$input['order_id']]);

			$res =Orderstatus::insert($inputs);
		 }else{
			 $res =Orderstatus::insert($inputs);
		 }
		 
		 
         //$res->update($input);
		 print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully')));
	}public function updatestatususer(Request $request) {
		$id = Session::get('id');
		 $input = $request->all();
		 $now='pending';
		  if($input['status_id']==3){
			  $now=date("Y-m-d H:i:s");
		  }
		 $inputs=array(
		  'order_id'=>$input['order_id'],
		  'assigned_to'=>$input['assigned_to'], 
		  'assigned_by'=>$id,
		  'status_id'=>$input['status_id'],
		  'current_status_flag'=>1,
		  'date_time'=>$now
		 ); 
		 $inpt=array(
		  
		  'current_status_flag'=>0
		 );
		 $count =Orderstatus::where('order_id',$input['order_id'])->where('current_status_flag',1)->get();
		
		 
		 if(count($count)>0){
			//complete status
		 if( $count[0]->status_id==3 || $count[0]->status_id==4){
			 //cancelled status
			 if($input['status_id']!=4){
				  print_r(json_encode(array('status' => 'failed ',  'class' => 'alert alert-danger' ,'msg' => 'Failed')));
	
			 }else{
				 $res= Orderstatus::where('order_id',$input['order_id'])->where('current_status_flag',1);
                 $res->update($inpt);
			 //DB::update('update order_status_histories set current_status_flag = ? where order_id = ?', ['0',$input['order_id']]);

			  $res =Orderstatus::insert($inputs);
			  print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully')));
		 
			 }
			
		 }else{
			$res= Orderstatus::where('order_id',$input['order_id'])->where('current_status_flag',1);
            $res->update($inpt);
			 //DB::update('update order_status_histories set current_status_flag = ? where order_id = ?', ['0',$input['order_id']]);

			$res =Orderstatus::insert($inputs);
			 print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully')));
		 
		 }
		 }else{
			 $res =Orderstatus::insert($inputs);
			  print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully')));
		 
		 }
		 
		 
         //$res->update($input);
		 //print_r(json_encode(array('status' => 'success ',  'class' => 'alert alert-success' ,'msg' => 'Updated Sucessfully')));
		 
	}
}
