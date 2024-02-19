
///<!--  Seo James, 000872976. This is my own work and no outside help was required unless stated next to the code -->


/**
 *this javascript file deal with sliderimage in the heading 
**/


//initialising the slider image index of the array
var sliderIndex=0;

//storing the each image location 
var array=["sliderImage\\main.jpg","sliderImage\\main1.jpg","sliderImage\\main2.jpg","sliderImage\\main3.jpg","sliderImage\\main4.jpg"];

//getting the element of the image tag the document
let image=document.getElementById("sliderImages");

//function used to change the index of the array
function indexChanger(x){
    if(x==1){
        if((array.length-1)==sliderIndex){
            sliderIndex=0;
        }
        else{
            sliderIndex+=1;
        }
    }
    else{
        if(0==sliderIndex){
            sliderIndex=(array.length-1);
        }
        else{
            sliderIndex-=1;
        }
    }
    
}

//function used to change the src of image to previous
function rightScreen(){
        indexChanger(1);
        
        image.src=array[sliderIndex];     
}

//function used to change the src of image to next
function leftScreen(){
    indexChanger(0);
    image.src=array[sliderIndex];     
}

//setting interval for slider image
setInterval(rightScreen,2000)

document.querySelector(".rightButton").addEventListener("click",rightScreen);
document.querySelector(".leftButton").addEventListener("click",leftScreen);

var productId = document.querySelector(" .container").id;




function getEachProductDetail() {

    let formData = new FormData();

    formData.append("path", `product/${productId}`);

    formData.append("method", "GET");

    formData.append("operation", "getEachProductDetail");

    formData.append("body", "");

    

    return fetch("./callAPI.php", {
      method: "POST",

      body: formData,

    }).then((response) => response.text());

  }


function getProductDetail(stpoint, len = 7, catelogue = "") {
    let formData = new FormData();

    formData.append(

      "path",

      catelogue

        ? `products/start=${stpoint}&length=${len}&category=${catelogue}`
        : `products/start=${stpoint}&length=${len}`
    );

    formData.append("method", "GET");
    
    formData.append("operation", "getProductDetail");

    formData.append("body", "");

    document.getElementById("cartSESSION").innerHTML = getShoppingCart();
    
    return fetch("./callAPI.php", {
      method: "POST",
      body: formData,
    }).then((response) => response.text());
  }


function getShoppingCart() {

    let formData = new FormData();

    formData.append("path", "cart/");

    formData.append("method", "GET");

    formData.append("body", "");

    formData.append("operation", "getCart");

    return fetch("./callAPI.php", {

        method: "POST",

        body: formData,

    }).then((response) => response.text());
}



function getCategories() {

    let formData = new FormData();

    formData.append("path", "product/categories/");

    formData.append("method", "GET");

    formData.append("body", "");

    formData.append("operation", "getCategories");

    document.getElementById("cartSESSION").innerHTML = getShoppingCart();

    return fetch("./callAPI.php", {

        method: "POST",

        body: formData,

    }).then((response) => response.text());
}

window.document.onload(getProductDetail);

  