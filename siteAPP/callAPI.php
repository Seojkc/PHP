<?PHP
session_start();

$path = isset($_POST["path"]) ? $_POST["path"] : "";//setting the path

$body = isset($_POST["body"]) ? $_POST["body"] : "";//setting the body

$operation = isset($_POST["operation"]) ? $_POST["operation"] : "";//setting the operation

$method = isset($_POST["method"]) ? $_POST["method"] : "";//setting the method


/**
 * Calls a restapi using the curl php module. You will have
 * to change the $APIcall method to match your own path. You
 * will also have to change it when you upload it to csunix.
 * 
 * @param $path The path within the web service
 * @param $method "PUT", "DELETE", "GET", or "POST"
 * @param $body The body of the request (should be json encoded)
 * 
 * @return ["data"=>associative array of contents, "response"=>http response code]
 */

function callAPI($path,$method, $body = "") {
    // change this to match your setup

    //setting the path for api call
	$APIcall = "http://localhost:1080/Assignment3/siteAPI". str_replace ( ' ', '%20',$path);

	$ch = curl_init();                              // initialize the curl handler
    curl_setopt($ch, CURLOPT_URL, $APIcall);        // set the url
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // make it return the body instead of echoing it

if ($method == "POST") {                        // set the method
  curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
} elseif ($method == "PUT" ) {
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
} elseif ($method == "DELETE" ) {
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    // set the body
}


  $output = curl_exec($ch);                       // send the request
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

// note: remove the optional "true" below to decode to an object
// instead of to an associative array
	return array('data'=>json_decode($output, true),'response'=>$httpCode); 
}

//data will be  called and stored
$detail = callAPI($path, $method, $body);


$data = $detail["data"];


///this wil check the opearion and print all the catalogues
if ($operation == "getProductDetail") {

	$line=0;
	$output = "<div class='row mw-50'>
          <div class='col-7 pt-2  pl-2 pr-0'>
              <div class='bg-danger p-2'>
         " ;

          //printing each item"
          foreach($data as $SysData ){
            

            if(isset(($SysData)["product_category"]) && (isset($_GET['category']) || isset($_SESSION['Category']))){
             $category=true;
              $count+=1;//this will count the items and checking prev next buttons is needed

          $product_id=$SysData['product_id'];
          $product_image = $SysData["product_image"];
          $product_name = $SysData["product_name"];
          $product_price=$SysData["product_price"];
                  
          $output .="
                <a style='text-decoration: none; color: black;' href='details.php?action='$product_id'> 
                  <div class='bg-danger pt-2 mb-0'>
                    <div class='bg-white pt-1 my-0 container' >
                      <div class='row'>
                        <div class='col'>
                          <img src='$product_image' width='100%'>
                        </div>
                      </div>
                      <div class='row'>
                        <div class='col'>
                        <p class='pr-3'>Quantity :"; if($SysData["product_quantity"]==0){ $output .= "out of stock";}else{
                          $output .= $SysData["product_quantity"] ;
                        } $output .="
                        </p>
                      </br>  
                        </div>
                      </div>
                      
                      <div class='row px-3'>
                        <p> Product ID:  $product_id</p></br>  
                      </div>
                      <div class='row px-3'>  
                        <h4>$product_name</h4>
                      </div>
                      <div class='row px-3'>  
                        <h3 class='font-weight-bold'>$ $product_price</h3>
                      </div>
                    </div>
                    <br></a>
                    <div class='pb-5 pt-0 '>                            
                      <button type='button' class='w-100  bg-success session-btn' data-toggle='modal' data-target='#addtoCartBtn' data-var='$product_id";   if($SysData["product_quantity"]==0){ $output.="disabled  style=' color:red; '";} else{ $output.=" style=' color:white' >";}  if($SysData["product_quantity"]==0){ $output.=" 'out of stock'";}else{$output.="Add to Cart";}$output.="</button>
                    </div>
                  </div>
                    <div>
                      </div>";   
              } }
        $output.="
        //importing the cart session
        <div id='cartSESSION'></div>
        
        </div></div> </div></div></div>";
}//for cart 
else if ($operation == "getCart") {

$cart = "      <!-- Cart session   -->
<!--  Seo James, 000872976. This is my own work and no outside help was required unless stated next to the code -->
<!-- this part of the code work for the shopping cart for the project -->
<div id='cartSession' class='col-5 p-2'>
        <div class='bg-danger text-center'>
              <h3 class='text-white'>Cart</h3>
              <br><br>
              <ul class='px-5'>";
              
                //data will be saved as each columns in table. session_id	product_id	product_name	product_price are the keys in table
                foreach($data as $SysData ){

                  $product_id=$SysData['product_id'];
                  $product_image = $SysData["product_image"];
                  $product_name = $SysData["product_name"];
                  $product_price=$SysData["product_price"];
                  $totalPrice+=$SysData["product_price"];
                  $session_id = $SysData["session_id"];

                    //$SysData contain single item as array
                        
                    $cart = "    
                        <!-- printing the details on the page-->
                        <div class='py-3'>
                          <div class='d-flex  justify-content-start px-1'>
                              <p class='font-weight-bold'>$product_id</p>
                            </div>
                          <div class='d-flex  justify-content-between px-1'>
                            <div>
                              <p>$product_name</p>
                            </div>
                            <div class='d-flex '>
                              <div class='px-1'>

                                <!-- total price will store in the variable    -->
                                <p>$product_price</p>

                              </div>
                              <div >

                              <!-- form is used for asking again do you want to remove item from cart -->
                                <form action='index.php' method='get'>            
                                  <input class='w-100  bg-white' type='submit' value='X' name=$session_id />
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>";
                        ///variable is used to hide or show the 'are you sure ?' part 
                        $_SESSION['clearQuestion']=false;
                        if(isset($_GET[$SysData["session_id"]]) || isset(($_GET['positive'.$SysData["session_id"]]))){
                          $cart.="
                          <div id='ClearQuestion'>
                          <div class='row' >
                          <h3>Are you Sure ?</h3>
                          </div>
                          <div class='row'>
                            <div class='col'>
                            <!--  yesa button will call the ajax request for the remove the correct item from the list -->
                            <button type='button' class='w-100  bg-white session-btn1' data-toggle='modal' data-target='#removeCartBtn' data-var=$session_id style=' color:red; ' >YES</button>
                            </div>
                            <div class='col'>
                            <!--  no button will ignore the call and hide the question -->
                            <button type='button' class='w-100  bg-white session-btn2' data-toggle='modal' style=' color:rgb(0, 218, 146); ' >NO</button>
                            </div>
                          </div></div>
                          ";
                        }      
                }
                $cart+= "
                <!--  this will print the total price using the variable -->
              <h4>Total : ";
              if($totalPrice>0){
                $cart+= $totalPrice;
              }
              else{
                $cart+="0";
              }
              $cart+= "
              <!--  pay button used for thew decoration -->
              </h4>
              <button class='border rounded-right border-white border-left bg-warning px-5'>Pay</button>
              <br><br>
          </div>";
          $output = $cart;
}//for detail product
else if ($operation == "getEachProductDetail") {

  $out="
  <!-- Back to menu button .redirect to the menu where pressed the catalog  -->
        



      
      <div class='container '>
        <div class='row'>
          <div class='col-7 pt-2 pb-2 pl-2  pr-0'>";

         
              $tempProductID=$_SESSION['productID_Details'];

            $exist=false;
            $SysData=$data;
            $product_image=$SysData['product_image'];
            $product_id= $SysData["product_id"];  
            $product_price = $SysData["product_price"];
            $product_name = $SysData["product_name"];
            $product_description = $SysData["product_description"];
         
            //checking the product id exists 
            if( isset($SysData["product_id"]) && $tempProductID == $SysData["product_id"]){
            
              $out.="
                 <div class='bg-danger p-2 '>
                  <div class='bg-white p-1 container' >
                    <div class='row'>
                      <div class='col'>
                        <img src=$product_image width='100%'>
                      </div>
                      
                    </div>
                    <div class='row col-10'>
                      <div class='col'>
                        <div>                            
                          <button type='button' class='w-100  bg-success session-btn' data-toggle='modal' data-target='#addtoCartBtn' data-var=$product_id "; if($SysData["product_quantity"]==0){ $out.="disabled  style=' color:red; '"; } else{  $out.="style=' color:white'>";} if($SysData["product_quantity"]==0){ $out.="out of stock";}else{$out.="Add to Cart";}$out.="</button>
                        </div>
                      </div>
                      <div>
                      <p class='pr-3'>Quantity :"; if($SysData["product_quantity"]==0){ $out.="out of stock"; }else{
                         $SysData["product_quantity"];
                      }$out.="</p></br>  
                      </div>
                    </div>
                  </div>
                  <br></div>

                  ";
          
                  ///track the product is exist or not
                  $exist=true;
                }
                //if not exist, not found
                if(!$exist){

                  $out.="<h1>Not Found</h1>";
                }


                $out.="
          </div>


        

          

          //importing the cart session
          <div id='cartSESSION'></div>
          
          //highlighting the price 
          ";if( isset($SysData["product_id"]) && $tempProductID == $SysData["product_id"]){
            $out.="
            <div class='row px-3'>  
                <h3>PRICE : </h3>
              <h2 class='font-weight-bold text-warning'>$$product_price</h2>
          </div>";
           }
          
           $out.="</div>

        <div>


        ";


        //if the product id exist, display the item in detail  
        if($exist){

          $out.="
        <div class='w-100 p-3 m-1 text-white'>
        <div class='w-100 bg-danger p-5'>
            <div class=' w-100 row px-3'>
                <p> Product ID: $product_price</p></br>  
            </div>
            <div class='row px-3'>  
                <h4>$product_name</h4>
            </div>
            
            <div class='row px-3'>
                <h5>Description</h5>  
            </div>
            <div class='row px-3'>  
                <p>$product_description</p>
            </div>
            <div class='row px-3'>  
                <h3 class='font-weight-bold'>$ $product_price</h3>
            </div>
        </div></div>";
         }
        $out.="
        </div>
        </div>
      </div>";

      $output = $out;
}
//outputting the data
echo $output;

?>

