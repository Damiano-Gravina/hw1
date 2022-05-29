function visualizePassword(){
    if (visible == false){
        visibility = document.querySelector(".material-symbols-outlined");
        visibility.textContent = "visibility_off";
        password = document.querySelector("#label_password");
        password.type = "text";
        visible = true;
    }
    else{
        visibility = document.querySelector(".material-symbols-outlined");
        visibility.textContent = "visibility";
        password = document.querySelector("#label_password");
        password.type = "password";
        visible = false;
    }
}


document.querySelector(".material-symbols-outlined").addEventListener("click", visualizePassword )

visible = false;


