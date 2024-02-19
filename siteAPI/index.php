<?php 


$folder = "siteAPI";



$pdn = "mysql:database=phpproject;host=localhost";
$username = 'root';
$password = '';
try {
	//connecting the the database
	$db = new PDO($pdn,$username,$password);
	
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} 
catch (Exception $e) 
{

}

// Get the method and the path
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "";
$path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";


if (str_starts_with($path,"/$folder/product/item/")){
    if(str_starts_with($path, "/$folder/product/quantity/")){
        if($method =='PUT'){
            $product_id = substr($path, strlen("/$folder/product/quantity/"));
            $detail = json_decode(file_get_contents('php://input'), true);
            if(isset($detail["product_quantity"])){
                $cursor = $db -> prepare( "UPDATE catalogue
                    SET product_quantity=product_quantity-1
                    WHERE product_id = ?;" );
                $cursor ->execute(array($product_id["product_id"]));
            
            if ($cursor->rowCount() == 0) {
                //not successfull
                http_response_code(404);
                
            } else {
                //  successfull
                http_response_code(204);
            }
        }else {
            // body error
            http_response_code(400);
        }
        }else {
            // wrong method 
            http_response_code(405);
        }
    }

    else if (/**$path == "/$folder/product/categories/" ||**/ $path =="/$folder/product/categories"  ) {
        // Request cxategories
        if ($method == 'GET') { //get method

            $cursor =  $db -> prepare("SELECT distinct product_category FROM catalogue");
            $cursor -> execute(array($productID));
            $SysData = $cursor -> fetchAll();

            header("Content-Type: application/json");
            http_response_code(200);
            echo json_encode($SysData);
        } else {
            // method PUT, POST, DELETE ...
            http_response_code(405);
        }
    }


} else if (str_starts_with($path, "/$folder/products/")) {

    if ($method == "GET") {
        $splitString = explode("&", substr($path, strlen("/$folder/products/")));
        if ( str_starts_with($splitString[0], "start=") && str_starts_with($splitString[1], "length=" &&  sizeof($splitString) == 2)) {
            // category is not included and options are well formed

            $length = explode("=", $splitString[1])[1];
            $start = explode("=", $splitString[0])[1];
            
            $cursor = $db -> prepare("SELECT * FROM catalogue  LIMIT $start_from,7 ;");
            $cursor ->execute(array());
            $data= $cursor -> fetchAll();

            

            $cursor = $db ->query("SELECT * FROM catalogue;");
            $data= $cursor -> fetchAll();
            $row = count($data);

            if ($data != false) {

                http_response_code(200);

                header("Content-Type: application/json");

                echo (json_encode(["current_page" => floor($start / $length) + 1, "total_pages" => floor($product_count / $length) + 1, "products" => $data]));
            } 
            else {

                // not found
                http_response_code(404);
            }
        }
        
        
        else if ( sizeof($splitString) == 3 && str_starts_with($splitString[2], "category=")   ) {

            $length = explode("=", $splitString[1])[1];
            
            $start = explode("=", $splitString[0])[1];
           
            $product_category = urldecode(explode("=", $splitString[2])[1]);

            $cursor = $db -> prepare("SELECT * FROM catalogue WHERE product_category=? LIMIT $start_from,7 ;");
            $cursor ->execute(array($_GET["category"]));
            $data= $cursor -> fetchAll();

           
           
           
           

            $cursor = $db ->query("SELECT * FROM catalogue;");
            $data= $cursor -> fetchAll();
            $row = count($data);

            if ($data != false) {

                http_response_code(200);

                header("Content-Type: application/json");

                echo (json_encode(["current_page" => floor($start / $length) + 1, "total_pages" => floor($product_count / $length) + 1, "products" => $data]));
            }
             else {
                // not found
                http_response_code(404);
            }
        } else {
            // request rejected
            http_response_code(400);
        }



    }

    else {
    
        http_response_code(405);
    }


}

else if (str_starts_with($path, "/$folder/cart/")) {


    $SESSION_id = substr($path, strlen("/$folder/cart/"));


    if ($method == "GET") 
    {

        $queryS='SELECT * FROM shopping_cart ;';
        $cursor = $db ->query($queryS);
        $dataCart= $cursor -> fetchAll();

        http_response_code(200);

        header("Content-Type: application/json");
        echo (json_encode($dataCart));

    } 
    else if ($method == "POST") 
    {
        $detail = json_decode(file_get_contents('php://input'), true);


        if (isset($detail["product_id"])) {
            //finding the data from the table where all catalogue stored and using the product id 
            $cursor =  $db -> prepare("SELECT * FROM catalogue WHERE product_id= ?");
            $cursor -> execute(array($detail["product_id"]));
            $SysData = $cursor -> fetchAll();

            //storing into the variable
            $SysData = $SysData[0];

            if ($SysData == false || $SysData->product_quantity == 0) {
                // out of stock or not exist
                http_response_code(304);
            }
            else {


                //updating the catalogue table quantity (by minus 1)
                $cursor = $db -> prepare( "UPDATE catalogue
                SET product_quantity=product_quantity-1
                WHERE product_id = ?;" );
                $cursor ->execute(array($SysData["product_id"]));

                //inserting the data into shopping cart table using the $SysData variable
                $cursor = $db -> prepare("INSERT INTO shopping_cart VALUES (?,?,?,?)");
                $cursor ->execute(array(SESSION_id,$SysData["product_id"],$SysData['product_name'],$SysData['product_price']));

                if ($cursor->rowCount()!=0) {
                    http_response_code(200);
                    header("Content-Type: application/json");
                }
            }
        } else {
            // error body
            http_response_code(400);
        }
    } 

    
    else if ($method == "DELETE") {

        $detail = json_decode(file_get_contents('php://input'), true);

        if (isset($detail["product_id"])) {

            //finding the data from the table where all catalogue stored and using the product id 
            $cursor =  $db -> prepare("SELECT * FROM catalogue WHERE product_id= ?");
            $cursor -> execute(array($detail["product_id"]));
            $SysData = $cursor -> fetchAll();

            //storing into the variable
            $SysData = $SysData[0];

            
            //updating the catalogue table quantity (by minus 1)
            $cursor = $db -> prepare( "UPDATE catalogue
            SET product_quantity=product_quantity+1
            WHERE product_id = ?;" );
            $cursor ->execute(array($SysData["product_id"]));


            //deleting the item from the shopping cart table
            $cursor = $db -> prepare( "DELETE FROM shopping_cart
            WHERE product_id = ?;" );
            $cursor ->execute(array($SysData["product_id"]));


            $sql = "DELETE FROM shopping_cart where shopping_cart_item_id= :shopping_cart_item_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["shopping_cart_item_id" => $detail["shopping_cart_item_id"]]);
			
            if($stmt->rowCount()!=0){
				http_response_code(204);
			}else{

				// no record found for this id
				http_response_code(304);
			}
        } else {
            // error body
            http_response_code(400);
        }
    } else {
        // // method eoor
        http_response_code(405);
    }
} else {
    // other urls are not supported bad request
    http_response_code(400);
}






?>