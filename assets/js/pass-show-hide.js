const pwsField = document.querySelector(".form input[type='password']");
var btn = document.querySelector(".form .field i");

btn.addEventListener("click",function(){
if(pwsField.type=="password"){
    pwsField.type="text"
    btn.classList.add("active")
}else{
    pwsField.type="password"
    btn.classList.remove("active")
}
})