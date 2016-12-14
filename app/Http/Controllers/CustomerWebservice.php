<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\Customer;
use App\Creditcard;

use App\Role;
use App\Departments;
use DB;
use Session;
use App\Category;
use App\Order;
use App\Country;
use App\Product;
use App\Store;
use Stripe\Stripe;
use Mail;
use Hash;

class CustomerWebservice extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerLogin(Request $request) {
	   $input = $request->all();
		
		$user = Customer::where('email',$input['email'])->where('password',$input['password'])->get();
		
		if(count($user)==1){
			
			/*if (Hash::check($input['password'], $user[0]->password)) {
                
                $data = array("status"=>'Login Successful','Mobile'=>$user[0]->mobile);
            } else {
               $data = array("status"=>'Login failed');
            }*/
			$data = array("Status"=>'Login Successful','Mobile'=>$user[0]->mobile);
		}else{
			$data = array("Status"=>'Login failed');
		}
		print_r(json_encode($data));



	} 
	 public function customerRegister(Request $request) {
		 $inputs = $request->all(); 
		 $input = json_decode($inputs['User_details']);
		 //$input['password'] = Hash::make($input['password']);
		
		 $user = Customer::where('email',$input->email)->get();
		 $inputdetails=array(
		 'firstname'=>$input->firstname, 
		 'lastname'=>$input->lastname,
		 
		 'email'=>$input->email,
		 'country_code'=>$input->country_code,
		 'mobile'=>$input->mobile,
		// 'zipcode'=>$input->zipcode, 
		'address'=>$input->address,
		 'country'=>$input->country,
		 'password'=>$input->password
		 );
		 if(count($user)==0){
		      $customer=Customer::insert($inputdetails);
		      $data = array("Status"=>'Registration Success');
		 }else{
			 $data = array("Status"=>'Email ID Already Exist'); 
		 }
		 print_r(json_encode($data));
	 } 
	 public function customerDetails(Request $request) {
		 $input = $request->all();
		
		 $customer=Customer::leftJoin('customer_shipping_address', 'customer_shipping_address.customer_id', '=', 'customers.id')
		        ->select('customers.*','customer_shipping_address.shipping_name','customer_shipping_address.shipping_address','customer_shipping_address.shipping_mobile')
			   ->where('customers.email', '=', $input['email'])->get();
		
		 $data = array("customerDetails"=>$customer);
		 print_r(json_encode($data));
	 }
	 public function updateCustomer(Request $request) {
		  $inputs = $request->all(); 
		 $input = json_decode($inputs['User_details']);
		 $inputdetails=array(
		 'firstname'=>$input->firstname, 
		 'lastname'=>$input->lastname,
		 'email'=>$input->email,
		 'country_code'=>$input->country_code,
		 'mobile'=>$input->mobile,
		// 'zipcode'=>$input->zipcode, 
		 'address'=>$input->address,
		 'country'=>$input->country
		 ); 
		  $customer=Customer::where('email', '=', $input->email)->get();
		
		
		  
		 if(count($customer)>0){
			 $user = Customer::where('email', '=', $input->email);
			// $id =$users[0]->id;
			 //$users = Customer::find($id);
             $user->update($inputdetails);
			 
			  $data = array("Status"=>'Updation Successful' ,"Mobile"=>$input->mobile); 
		 }
		 else{
			  $data = array("Status"=>'Email ID Not Exist'); 
		 }
		 
		 print_r(json_encode($data));
	 }
	 public function updateCreditCardff(Request $request) {
		 $input = $request->all();
		 $inputs =array(
				'creditcardno' =>$input['creditcardno'],
				'month' =>$input['month'],
				'year' =>$input['year'],
				'cvv' =>$input['cvv'],
				'country' =>$input['country'],
				'zipcode' =>$input['zipcode'],
				'modifiedDate' =>$input['modifiedDate'],
			
			);
		 $customer=Customer::where('email', '=', $input['email'])->get();
		 if(count($customer)>0){
			 $user = Customer::where('email', '=', $input['email'])->get();
             $user->update($inputs);
			  $data = array("Status"=>'Updation Successful' ); 
		 }
		 else{
			  $data = array("Status"=>'Email ID Not Exist'); 
		 }
		 
		 print_r(json_encode($data));
	    } public function updateCreditCard(Request $request) {
		 $input = $request->all();
		
		 $stripe_token = htmlspecialchars($input['Stripe_token']);
		 $username = htmlspecialchars($input['username']);
		 \Stripe\Stripe::setApiKey("sk_test_OdihBeOQOiWLAtT5AfxaedN2");
		 try {
			

				
				$customer=Creditcard::where('username', '=', $input['username'])->get();  
		        if(count($customer)>0){
					
					$cu = \Stripe\Customer::retrieve($customer[0]->stripe_customer_id);
                    $cu->email = $input['username'];
					$cu->description = "Customer ";
                    $cu->source = $stripe_token; // obtained with Stripe.js
                    $cu->save();
					$stripe_cstmid =$cu->id;
					
					$inputs =array(
						'username' =>$input['username'],
						'stripe_customer_id' =>$stripe_cstmid,
						
						'country' =>$input['country'],
						'zipcode' =>$input['zipcode']
						
					
					);
				 $user = Creditcard::where('username', '=', $input['username']);
				 $user->update($inputs);
				  $data = array("Status"=>'Your Card has been saved Successfully' ); 
		        }
		        else{
					$customer = \Stripe\Customer::create(array(
				  "email" => $username,
				  "source" => $stripe_token));
				  //$d =  \Stripe\Customer::retrieve("cus_9jfhcOMjKrmDTP");
				  //var_dump(json_encode($d));
				  //exit;
				  $stripe_cstmid =$customer->id;
				  $inputs =array(
						'username' =>$input['username'],
						'stripe_customer_id' =>$stripe_cstmid,
						
						'country' =>$input['country'],
						'zipcode' =>$input['zipcode']
						
					
					);
					 $customer=Creditcard::insert($inputs);
					
			        $data = array("Status"=>'Your Card has been saved Successfully' );
		        }
			
			}
			catch (\Stripe\Error\InvalidRequest $e) {
				$body = $e->getJsonBody();
				$err  = $body['error'];
				  
				$data = array("Status"=>$err['message']);
				print_r(json_encode($data));
				exit;	             

			}catch (Exception $e) {
				
				$data = array("Status"=>$e->getMessage()); 
					print_r(json_encode($data));
			  
			}
		
		 
		 
		 print_r(json_encode($data));
	    }public function getCreditCarddetails(Request $request) {
			$input = $request->all();
			$customer=Creditcard::where('username', '=', $input['username'])->get(); 
			
            \Stripe\Stripe::setApiKey("sk_test_OdihBeOQOiWLAtT5AfxaedN2");
		 try {
			 if(count($customer)>0){
			  $carddetails=  \Stripe\Customer::retrieve($customer[0]->stripe_customer_id);
			  $data=json_encode($carddetails->sources->data);
			  //var_dump(json_encode($carddetails));
			  //exit;
			  $card=json_decode($data);
			 //var_dump($s[0]->brand);
			  //exit;
			  $details=array([
			       'card_type' =>$card[0]->brand,
				   'exp_month' =>$card[0]->exp_month,
				   'exp_year' =>$card[0]->exp_year,
				   'card_last4' =>$card[0]->last4,
				   'stripe_customer_id' =>$customer[0]->stripe_customer_id
				  
		 ]);
			  $data = array('Status'=>"Success","data"=>$details);
				print_r(json_encode($data));
			  }else{
				$data = array("Message"=>"No cards added",'Status'=>"Failed");
				print_r(json_encode($data));
			}
		    }
			catch (\Stripe\Error\InvalidRequest $e) {
				$body = $e->getJsonBody();
				$err  = $body['error'];
				  
				$data = array("Message"=>$err['message'],'Status'=>"Failed");
				print_r(json_encode($data));
				exit;	             

				}
			catch (Exception $e) {
				
				$data = array("Status"=>$e->getMessage()); 
					print_r(json_encode($data));
			  
			}	
						
		        
		}
	    public function updatePassword(Request $request) {
			$input = $request->all();
			$input['passwords'] = $input['password'];
			$inputs =array(
				'password' =>$input['passwords']
			
			);
		 $customer=Customer::where('email', '=', $input['email'])->get();
		 if(count($customer)>0){
			 $user = Customer::where('email', '=', $input['email']);
             $user->update($inputs);
			  $data = array("Status"=>'Password Changed Successfully' ); 
		 }
		 else{
			  $data = array("Status"=>'Email ID Not Exist'); 
		 }
		 
		 print_r(json_encode($data));
			
		}
		public function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}
		public function customerImage(Request $request) {
				 $input = $request->all();
				 //$inputs =array(
				//	'image' =>$input['image']
				
				//);
			 $customer=Customer::where('email', '=', $input['email'])->get();
			 if(count($customer)>0){
				 $filename_path = md5(time().uniqid()).".jpg"; 
					$decoded=base64_decode($input['image']);
					file_put_contents("uploadapp/".$filename_path,$decoded);

       
		/* $encodedData = str_replace(' ','+',$input['image']);
            $image = base64_decode($encodedData);
            $filename = time().'.png';
           // $name = Input::file('image')->getClientOriginalName();
            $extension = 'png';
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $fileName = rand(11111, 99999) . '.png';
            $path = public_path('uploadapp/' . $filename);

            file_put_contents($path, $image);*/
            //$image->move($path, $fileName);
			$inputs['image']="uploadapp/".$filename_path;
		$user = Customer::where('email', '=', $input['email']);
				 $user->update($inputs);
				  $data = array("Status"=>'Profile Picture Uploaded' ,"imagepath"=>$inputs['image']); 
			    }
			 else{
				  $data = array("Status"=>'Email ID Not Exist'); 
			    }
			 
			 print_r(json_encode($data));
			
		 }
		 public function sentPassword(Request $request) {
			 ini_set('max_execution_time', 123456);
			 $input = $request->all();
			
			 $password=mt_rand(100000,999999);
			 $inputs =array(
				'password' =>$password
				);
			 $user = Customer::where('email', '=', $input['email']);
				 $user->update($inputs);
			 $customer=Customer::where('email', '=', $input['email'])->get();
			 if(count($customer)>0){
				  $emails =  $request->input('email');
				  Mail::send('email.welcome', ['custname' => $customer[0]->firstname, 'password' => $customer[0]->password], function ($message) use($emails){
						$message->from('us@example.com', 'QwikXL');

						$message->to($emails);
						$message->subject("Your QwikXL Password Information");

			        }); 
					$data = array("Status" => "Check Your Email"); 
			        print_r(json_encode($data));
			    }else{
					$data = array("Status" => "Email Doesn't Exist"); 
			        print_r(json_encode($data));
				}
			
			
			
		}
		public function getCountryList(Request $request) {
			$country=Country::get();
			$data = array("countryDetails"=>$country); 
			print_r(json_encode($data));
		}
}
