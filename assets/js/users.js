//ELEMETN SELECTORS
const searchBar = document.querySelector(".users .search input")
const searchBtn = document.querySelector(".users .search button")
var userList = document.querySelector(".users .users-list")
var alluser = true

//

//FUNCTIONS
searchBtn.addEventListener("click",function(){
    searchBar.classList.toggle("active")
    searchBar.focus()
    searchBtn.classList.toggle("active")
    searchBar.value=""
    alluser =true
})


var oldData;
setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("GET","php/users.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!(oldData === data) && alluser){
                    userList.innerHTML = data
                    oldData = data;
                }
            }
        }
    }
    xhr.send();
}, 500); //this function will run frequently after 500ms

var oldData2;
searchBar.addEventListener("input",()=>{
    let searchTerm = searchBar.value
    if(searchTerm !=""){
        alluser=false
        oldData = ""
    }else{
        alluser=true
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/search.php",true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!(oldData2 === data) || (data=="No users found related to your search term" && !alluser)){
                    userList.innerHTML = data
                    oldData2 = data;
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
})

