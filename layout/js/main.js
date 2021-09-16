//function to make bytes easier to read
function formatSizeUnits(bytes){
    if      (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(2) + " GB"; }
    else if (bytes >= 1048576)    { bytes = (bytes / 1048576).toFixed(2) + " MB"; }
    else if (bytes >= 1024)       { bytes = (bytes / 1024).toFixed(2) + " KB"; }
    else if (bytes > 1)           { bytes = bytes + " bytes"; }
    else if (bytes == 1)          { bytes = bytes + " byte"; }
    else                          { bytes = "0 bytes"; }
    return bytes;
  }
 
//function to hide a elemnt by pressing an other elemnt
// or the elemnt him self  attribute are just classes names
//first is your button seconde attribute is element to toggel
//can choose the display type and none is possibel too   
function ToggelElement2btn(hide,show,element,DisplayType="block"){
    var b = document.getElementById(hide);
    var c = document.getElementById(show);
   if(b!=undefined || c!=undefined){
    b.addEventListener("click",()=>{
    var hide = document.getElementById(element);
    hide.style.display="none";
   })
   c.addEventListener("click",()=>{
    var hide = document.getElementById(element);
    hide.style.display=DisplayType;
   })
}
}
//========================================================



// start write in input field and print it live in the card
// ************************************************************************************************************
//******write in a div and paste it live in an other div                                                      *
// *****all Selectore must be only >>>>>>>id                                                                  *
// ************************************************************************************************************
function write_and_paste(clavier,screen){
if(clavier != undefined && screen != undefined){
    clavier.addEventListener("keyup",()=>{
        var text = clavier.value;
        screen.innerText= text;
         clavier.title=text;

    })
}   
}
//end
// ************************************************************************************************************
// *****start upload from device and print it in screen befor upload to data base                             *
// *****accept only extention  that you choose but defualt is "JPG","GIF","PNG","JPEG";                       *
// *****max default size of uploaded file is 10Mb = 10485760 Octet you can edit it but value must be in Octet * 
// *****all Selectore must be only >>>>>>>id                                                                  *
// ************************************************************************************************************
function viewImageInScreen(image_up,img_screen,allow_exts=["JPG","GIF","PNG","JPEG"],max_photo_upload_size=10485760){
     allow_ext = allow_exts.map(name => name.toUpperCase());
     if (image_up != undefined){
     image_up.addEventListener("change",function(){
        const myimg =this.files[0];
        // get file type and uppercase it
        var file_type =myimg.type.toUpperCase().split("/")[myimg.type.toUpperCase().split("/").length -1 ];
        show_file_type=myimg.name.split(".")[myimg.name.toUpperCase().split(".").length -1 ];
        // allowed file extention
                // const allow_ext=["JPG","GIF","PNG","JPEG"];
        //define error array
        var errors = [];
        //deal with type
        if(! allow_ext.includes(file_type)){
            errors.push("Wrong File Format Must be " +allow_ext+" Your File Format is "+show_file_type+" \n ");
        }
        // deal with size
        if(myimg.size>max_photo_upload_size){
            errors.push("Wrong File Size Must be under "+formatSizeUnits(max_photo_upload_size)+" Your File size is "+formatSizeUnits(myimg.size) +"\n");  
        }

            if(myimg && errors.length==0){
                    const reader = new FileReader();
                        reader.readAsDataURL(myimg);
                            reader.addEventListener("load",function(){
                                img_screen.setAttribute("src",this.result)
                        })
                    
            }else{
                    //here your costum error display
                    alert(errors);
            }
        
    })
}
}
//end********************************************************************************************************************************************************************

var prod_name = document.getElementById("prod_name");
var card_prod_name = document.getElementById("card_name");
write_and_paste(prod_name,card_prod_name);

var desc = document.getElementById("desc");
var card_desc = document.getElementById("card-desc");
write_and_paste(desc,card_desc);



var price = document.getElementById("price");
var card_price = document.getElementById("money");
write_and_paste(price,card_price);
// end write in input field and print it live in the card



//starting view photo befor upload
var image_ups = document.getElementById("image-up");
var img_screens=document.getElementById("img_display_add");
viewImageInScreen(image_ups,img_screens);

//end view photo befor upload

//start save inputed data when refreching

window.onbeforeunload = function() {
   if(prod_name.value!=""){localStorage.setItem("titel", prod_name.value);}
   if(desc.value!=""){localStorage.setItem("prod_descriptions", desc.value);}
   if(price.value!=""){localStorage.setItem("price_of_prod", price.value);}
}



window.onload=function(){
if(prod_name != undefined ){
if(localStorage.getItem("titel")!=null){prod_name.value=localStorage.getItem("titel");}

if(localStorage.getItem("prod_descriptions")!=null){desc.value=localStorage.getItem("prod_descriptions");}

if(localStorage.getItem("price_of_prod")!=null){price.value=localStorage.getItem("price_of_prod");}
}
}





//clear my localstorage
var my_clear_btn=document.getElementById("clear-input-field");
if (my_clear_btn != undefined){
my_clear_btn.addEventListener("click",()=>{
    prod_name.value="";
    desc.value="";
    price.value="";
    localStorage.setItem("titel", "");
    localStorage.setItem("prod_descriptions", "");
    localStorage.setItem("price_of_prod","");
    localStorage.clear();
    location.reload();
})
    

}
// =================================================================
ToggelElement2btn("admin","user","selcet_admin");
// =================================================================






//=== start show categories ========= block V 2.0 =========
let my_li = document.getElementsByClassName("my-cat-I");

//loop the element i to show or hide the body
for (let i = 0; i < my_li.length; i++) {
//get cats header
let cat_name_plus_I = my_li[i].parentElement;
    // add event to each single i tag in categories
cat_name_plus_I.addEventListener("click",function(){

// get the categoeies body parent
let cats_body = this.parentElement.nextElementSibling;
cats_body.classList.toggle("d-none");
my_li[i].classList.toggle('fa-angle-right');
my_li[i].classList.toggle('fa-angle-down');
})//end addEventListener

}//end for loop
// =============== end show categories
