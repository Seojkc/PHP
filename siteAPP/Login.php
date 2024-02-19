<!--  Seo James, 000872976. This is my own work and no outside help was required unless stated next to the code -->

<?php

//session start
session_start();

//importing the data
include 'file_storage.php';

//rederecting to the main pge
$_SESSION['menuPage']='index.php';





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompStore</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
     crossorigin="anonymous">
     <link rel="stylesheet" href="index.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" 
     integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
     crossorigin="anonymous">
    </script>

</head>

<body>
      <nav class="  sticky-top  ">
        <div class="navbar  u-nav-container d-flex justify-content-between  navbar-expand-lg navbar-dark bg-dark px-3 ">
          <div >
            <h4 class="text-white">EoCart</h4>
          </div>
          <div class="" >
            <div   id=" navbarText ">
              <ul class=" navbar-nav inline list-group list-group-horizontal-sm">
                <li class="nav-item active">
                    <a class="nav-link" href="#cartSession">Cart <span class="sr-only">(current)</span></a>
                  </li>
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                <div class="form-inline">
                      <form action="details.php">
                            <input class="form-control mr-sm-2" type="search" name='searchValue' placeholder="Search productID" aria-label="Search">
                            <input class="btn px-2  btn-outline-success my-2 my-sm-0" type="submit" value = 'Submit'>  
                      </form> 
                </div>
                </li>
                <li class="nav-item">
                    <div class=" px-2 d-flex flex-row-reverse ">
                        <a href="Login.php"> <button  class="btn btn-outline-success my-2 my-sm-0" type="submit">login</button> </a> 
                      </div>
                </li>
              </ul>
            </div>
          </div>

        </div>
        <div class="sticky-top pt-1 px-1 ">
          <div width="100%" height="100" class="px-1 d-flex bg-white  text-center justify-content-around">
            <div class=""><a href="index.php?category=Laptop" ><button class="bg-white border-0"><img src="logo/Laptop.jpg" width="50" alt="logo"></button><p>Laptop</p></a> </div>
            <div class=""><a href="index.php?category=Desktop"> <button class="border-0 bg-white "><img src="logo/Desktop.jpg" width="50" alt="logo"></button><p>Desktop</p></a></div>
            <div class=""><a href="index.php?category=Monitor"> <button class="border-0 bg-white"><img src="logo/Monitor.png" width="50" alt="logo"></button><p>Monitor</p></a></div>
            <div class=""><a href="index.php?category=Gaming"><button class="border-0 bg-white "><img src="logo/Gaming.jpg" width="50" alt="logo"></button><p>Gaming</p></a></div>
            <div class=""><a href="index.php?category=Everything&page=<?php $count=1; echo $_SESSION['page']; ?>"><button class="border-0 bg-white "><img src="logo/Mouse.jpg" width="50" alt="logo"></button><p>Everything</p></a></div>
          </div>
        </div>
        

      </nav>
      
      
      <!-- sliding the images -->
      <div class="container" id="sliderSession">
        <button class="leftButton"><</button>
        <img id="sliderImages" src="sliderImage//main.jpg" alt="'$currentImage'" width="100%">
        <button class="rightButton">></button>
      </div>


      <div class="container ">
        <div class="row ">
          <div class="col-7 pt-2 pb-2 pl-2  pr-0">

          <?php
          
              echo " 

                <div class='bg-danger p-2 '>
                  <div class='bg-light p-1'>
                    <div class='bg-warning p-2'>
                    <br>
                    <div class='d-flex justify-content-center' >
                      <h2>Login</h2>
                    </div>
                    <form action='Login.php'><br>
                      <label>Username</label>
                      <input class='form-control mr-sm-2' type='search' name='username' placeholder='Username'>
                      <br><label>Password</label>
                      <input class='form-control mr-sm-2' type='search' name='password' placeholder='password'>
                      <br>
                      <div class='d-flex justify-content-center'>
                        <input class='bg-success btn px-2 d-flex text-white justify-content-center btn-outline-white my-2 my-sm-0' type='submit' value = 'Login'>  

                      </div>
                    </form> 

                    
                    


                    </div> 
                  </div> 
                </div>
                  ";

                  

                 
          



          ?>
          </div>

         
       
        

      </div>











   <script src="index.js"></script> 

   <div class="spaceFooter"></div>
   <?php include 'footer.php'; ?>


</body>


</html>   

