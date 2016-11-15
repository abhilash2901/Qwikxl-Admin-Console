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
    }
	public function getOrders(Request $request) {
		 $ids = Session::get('store_userid');
      
			$numss =Order::
			join('orderdetails', 'orderdetails.orderid', '=', 'Orders.id' )
			->join('products', 'products.id', '=', 'orderdetails.itemid')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('customers', 'customers.email', '=', 'orders.username')
			->leftjoin('order_status_histories', 'order_status_histories.order_id', '=', 'orders.id')
			
			->leftjoin('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			
			
		    ->select(DB::raw('sum(orderdetails.quantity) AS quantity'),'order_status.status as o','orders.createddate',DB::raw('sum(orderdetails.price) AS price'),'customers.firstname','orders.unique_id','orders.transaction_id','customers.lastname', 'orders.id as order_id', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('productinventories.store_id', $ids)
			->where('order_status_histories.current_status_flag', 1)
			
		
			->groupBy('orderdetails.orderid')
			->orderBy('orderdetails.id' ,'DESC')
			
            
		    
			->get();
			$status =Status::get();
			print_r(json_encode(array('orders'=>$numss,'statuss'=>$status)));
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
			
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select('products.name','orderdetails.price','orderdetails.quantity')
			->where('orders.id', $input['id'])
			->get();
			$items = Product::
		     join('orderdetails', 'orderdetails.itemid', '=', 'products.id')
			->join('productinventories', 'products.id', '=', 'productinventories.product_id')
			
			->join('orders', 'orderdetails.orderid', '=', 'orders.id')
			->join('stores', 'stores.id', '=', 'productinventories.store_id')
			->join('customers', 'customers.email', '=', 'orders.username')
		    ->select(DB::raw('sum(orderdetails.quantity*orderdetails.price) AS total'))
			->where('orders.id', $input['id'])
			->get();
			$status=DB::table('order_status_histories')
			->join('order_status', 'order_status.id', '=', 'order_status_histories.status_id')
			 ->select('order_status.status')
			->orderBy('order_status_histories.id', 'desc')->first();
			print_r(json_encode(array('single'=>$nums[0],'itemlist'=>$item ,'statuss'=>$status,'total'=>$items[0]->total)));
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
	}
}
