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
use App\Country;
use App\Product;
use App\Orderdetail;
use App\Productinventory;
use App\Store;
use Stripe\Stripe;

use Mail;
use Hash;

class OrderWebservice extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 public function saveOrderDetails(Request $request) {
			$inputs = $request->all();
			//var_dump($inputs);
			//exit;
			$input =json_decode($inputs['order_detail']);
			//var_dump($input->username);
			//exit;
			$username = htmlspecialchars($input->username);
			$pick_type = htmlspecialchars($input->pick_type);
			$delivery_phone = htmlspecialchars($input->phone);
			$total = htmlspecialchars($input->total);
			//$rewardPoint = htmlspecialchars($input['rewardPoint']);
			//$rewardPoint = (double)$rewardPoint;
			$grand_total = htmlspecialchars($input->grand_total);
			 $stripe_token = htmlspecialchars($input->Stripe_token);
			$status_init = "processing";
			
			$createddate = date("d-M-Y H:i a");
			\Stripe\Stripe::setApiKey("sk_test_WemfYo9pOD8TjkwerI1XNhxo");
			
				
			try {
			//	\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");
		/*$t = \Stripe\Token::create(array( "card" => array(
"number" => "4242424242424242",
"exp_month" => 11,
"exp_year" => 2016,
"cvc" => "314"  )));
var_dump($t->id);
exit;*/
$customer = \Stripe\Customer::create(array(
  "description" => $username,
  "source" => $stripe_token));

			
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => intval($total),
				'currency' => 'usd'
			));
			
			
			$status = json_encode($charge ->status);
			if($status != '"succeeded"') {
				//echo '{"status":"Transaction Failed","Orderid":"null"}';
				//exit;
				$data = array("Status"=>"Transaction Failed","Orderid"=>"null"); 
				print_r(json_encode($data));
		            exit;
			}else {
				 $emails =Customer::where('email', '=', $username)->get();
				
				$transaction_id = json_encode($charge ->created);
				$inputs=array(
				'username'=>$username,
				'customer_id'=>$emails[0]->id,
				'pick_type'=>$pick_type,
				'delivery_phone'=>$delivery_phone,
				'total'=>$total,
				'status'=>trim($status,'"'),
				'createddate'=>$createddate,
				
				'grand_total'=>$grand_total,
				'stripe_token'=>$stripe_token,
				'transaction_id'=>$transaction_id
				);
				$order = Order::insert($inputs);
				 $data = Order::orderBy('id', 'desc')->first();

				$order_id = $data->id;
				/*$sql = "SELECT reward_point FROM customers WHERE email = '".$username."'";	
				$result = mysql_query( $sql );
				$balanceReward = intval(mysql_fetch_assoc($result)['reward_point'])-$rewardPoint;
				$rewardedpoint = ($grand_total*25/100)+$balanceReward;
				
				$sql = "UPDATE customers SET reward_point = '$rewardedpoint' WHERE email = '".$username."'";
				$result = mysql_query( $sql );*/
				
				foreach ($input->cart as $item)
				{
				    $inputdetails=array(
						'orderid'=>$order_id,
						'itemid'=>$item->item_id,
						'quantity'=>$item->quantity,
						'price'=>$item->price,
						
						'createddate'=>$createddate,
						
					);
				    $orderdetails = Orderdetail::insert($inputdetails);
					//$sql2 = "INSERT INTO orderdetails (orderid, itemid, quantity, price, createddate)  VALUES ('$order_id', '".$item->item_id."', '".$item->quantity."', '".$item->price."', '$createddate')";
					//$result2 = mysql_query($sql2 );
					
					$qnty=Productinventory::where('product_id',$item->item_id)->get();
					/*$sql3 = "SELECT quantity FROM item 
							WHERE id = '".$item->item_id."'";	
					$result = mysql_query( $sql3 );*/
					//var_dump($qnty[0]->quantity);
					//exit;
					$remainingQuantity = $qnty[0]->quantity - $item->quantity ;
					if($remainingQuantity < 0) {
						$remainingQuantity = 0;
					}
					$quantitysinpt=array(
						
						'quantity'=>$remainingQuantity
						
						
					);
					$quantitys = Productinventory::where('product_id',$item->item_id);
                    $quantitys->update($quantitysinpt);
					/*$sql4 = "update item set quantity = '$remainingQuantity' where id = '".$item->item_id."'";
					$result3 = mysql_query( $sql4 );*/
					
				}
					
				if ($qnty && $quantitys)
				{	
				    $data = array("Status"=>"Ordering Successful","Orderid"=>$order_id, "transaction_id"=>$transaction_id); 
					//echo '{"status":"Ordering Successful","Orderid":'.$order_id.', "transaction_id":'.$transaction_id.'}';
					// $result32 = $gcm->send_notification($registatoin_ids, $message);	
                    print_r(json_encode($data));
		            exit;					
				}
				else
				{
					//echo '{"status":"Ordering Failed","Orderid":"null", "transaction_id":"null"}';
					$data = array("Status"=>"Ordering Failed","Orderid"=>null, "transaction_id"=>null); 
					print_r(json_encode($data));
		            exit;
				}
			}
			
		}catch (Exception $e) {
		// echo '{"status":"Ordering Successful","Orderid":"null", "transaction_id":"null"}';
		//echo '{"status":"'.$e->getMessage().'","Orderid":"null"}';
		$data = array("Status"=>$e->getMessage(),"Orderid"=>null); 
		print_r(json_encode($data));
		exit;
	}
	
	 }
	  public function orderDetails(Request $request) {
		  $inputs = $request->all();
		 $num = Order::select('id', 'createddate')->where('username',$inputs['userid'])->get();
		  //print_r($num);
		 // echo count($num);
           if(count($num)>0){
			   $data =array('orderDetails'=>$num ,'Status'=>'Success');
		   }else{
			   $data =array('Status'=>'No Record found !' );
			   
		   }
		  print_r(json_encode($data));
	  } public function orderData(Request $request) {
		  $inputs = $request->all();
		 $num = Order::join('orderdetails', 'orderdetails.orderid', '=', 'orders.id')
		    ->join('products', 'products.id', '=', 'orderdetails.itemid')
			
			->select('orderdetails.quantity', 'orderdetails.price', 'orderdetails.price', 'products.name', 'orders.status' ,'orders.grand_total')
			->where('orders.id', $inputs['orderid'])
			
			->get();
			$nums = Orderdetail::selectRaw('sum(price) as sum')->where('orderid', $inputs['orderid'])->get();
		 // print_r($nums);
		 // echo count($nums);
           if(count($num)>0){
			   $data =array('orderDetails'=>$num ,'Status'=>'Success','Total'=>$nums[0]->sum);
		   }else{
			   $data =array('Status'=>'No Record found !' );
			   
		   }
		  print_r(json_encode($data));
	  }
    
}
