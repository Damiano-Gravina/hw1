function removeText(event){
    title = event.currentTarget;
    if(title.value == "Titolo annuncio"){
        title.value = "";
    }
}

function addText(event){
    title = event.currentTarget;
    if(title.value == ""){
        title.value = "Titolo annuncio";
    }
}

function checkPublish(event){
   title = document.querySelector("#postTitle");
   text = document.querySelector("#postText");
   titleError = document.querySelector("#title_error");
   textError = document.querySelector("#text_error");
   let titleFlag = true;

   if(title.value.length > 25 || title.value == "Titolo annuncio" || title.value == ""){
        titleError.classList.remove("hide");
        titleError.parentNode.parentNode.classList.remove("hide");
        event.preventDefault();
        titleFlag = false; 
        
   }
   else{
        titleError.classList.add("hide");
        titleError.parentNode.parentNode.classList.add("hide");
        titleFlag = true; 
   }


   if(text.value.length > 250 || text.value.length == 0 || text.value == ""){
        textError.classList.remove("hide");
        textError.parentNode.parentNode.classList.remove("hide");
        event.preventDefault()
    }else{
        textError.classList.add("hide");
        if(titleFlag == true){
            textError.parentNode.parentNode.classList.add("hide");
        }
    }
}


document.querySelector("#postTitle").addEventListener("focus", removeText);
document.querySelector("#postTitle").addEventListener("blur", addText);
document.querySelector('#publish').addEventListener("click", checkPublish);



