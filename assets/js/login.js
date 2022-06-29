const form = document.querySelector(".login form");
var logBtn = document.querySelector(".button input")
var errorTxt = document.querySelector(".error-txt")

form.addEventListener("submit",function(e){
    e.preventDefault(); //Preventing form from submitting
})


logBtn.addEventListener("click", function(){
    let xhr = new XMLHttpRequest(); //XML Object
    xhr.open('POST',"php/login.php",true);

    xhr.onload =()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data = xhr.response;
                if(data=="User exists"){
                    location.href = "users.php";
                }else{
                    errorTxt.style.display = "block";
                    errorTxt.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form); //new formdata object
    xhr.send(formData); //sending formdata to php
})