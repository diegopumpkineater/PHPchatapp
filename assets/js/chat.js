const form = document.querySelector(".typing-area")
var inputField = form.querySelector(".input-field")
var sendBtn = form.querySelector("button")
var chatBox = document.querySelector(".chat-box");
var lastscrollTop = chatBox.scrollTop;
var fullscroll;

form.addEventListener("submit",function(e){
    e.preventDefault();
})

sendBtn.addEventListener("click",()=>{
    //ajax start
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST","php/insert-chat.php",true)
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data= xhr.response;
                inputField.value = "" //once message is sent clear input field
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    scrollBottom();
})

chatBox.addEventListener('scroll',function(){
    if(lastscrollTop > chatBox.scrollTop){
        chatBox.classList.add("active")
    }
    lastscrollTop = chatBox.scrollTop
    if(lastscrollTop == fullscroll){
        chatBox.classList.remove("active")
    }
})

var oldData;
setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/get-chat.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!(oldData === data)){
                    chatBox.innerHTML = data
                    oldData = data;
                    if(!chatBox.classList.contains("active")){
                    scrollBottom();
                    }
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500); //this function will run frequently after 500ms




function scrollBottom(){
    chatBox.scrollTop = chatBox.scrollHeight
    fullscroll = chatBox.scrollTop
}