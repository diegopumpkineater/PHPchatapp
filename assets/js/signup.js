//QUERY SELECTORS
const form = document.querySelector(".signup form")
var signBtn = form.querySelector(".button input");
var errorTxt = form.querySelector(".error-txt")

//EVENT LISTENERS
form.addEventListener("submit",function(e){
    e.preventDefault(); //Preventing form from submitting
})

signBtn.addEventListener("click", function(){
//Ajax start
let xhr = new XMLHttpRequest(); //XML Object
xhr.open("POST","php/signup.php",true)
xhr.onload=()=>{
    ///
    if(xhr.readyState===XMLHttpRequest.DONE){
        if(xhr.status === 200){
            let data = xhr.response;
            if(data=="success"){
                location.href="users.php";
            }else{
                errorTxt.style.display = "block";
                errorTxt.textContent = data;
            }
        }
    }
    ///
}
let formData = new FormData(form); //new formdata object
xhr.send(formData); //sending formdata to php
})