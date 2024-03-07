let navsBtn = document.querySelectorAll(".tag1");
let information = document.querySelectorAll(".adding-inner");

for(let i = 0; i < navsBtn.length; i++){
    navsBtn[i].addEventListener("click", () =>{
        changeContent(i);
        changeBtn(i);
    })
}

function changeContent(index){
    for(let i = 0; i < information.length; i++){
        if(i == index){
            information[i].classList.add("active");
        }else{
            information[i].classList.remove("active");
        }
    }
}

function changeBtn(index){
    for(let i = 0; i < navsBtn.length; i++){
        if(i == index){
            navsBtn[i].classList.add("activeBtn");
        }else{
            navsBtn[i].classList.remove("activeBtn");
        }
    }
}