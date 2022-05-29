const postURL = "http://localhost/progetti/postFetch.php"



function onPostsJson(json){
    console.log(json);

    let i = 0;
    const main = document.querySelector("main")
    console.log("SONO QUI")

    while(json[i]){
    let name = json[i].userNome;
    let surname = json[i].userCognome;
    let userName = json[i].userUsername;
    let time = json[i].postsTime;
    let postTitle = json[i].postsTitle;
    let postText = json[i].postsText;


    const sectionPost = document.createElement('section');
    sectionPost.classList.add("post");


    const section = document.createElement('section');
    sectionPost.appendChild(section);
    const PostUserImage = document.createElement('div');
    PostUserImage.classList.add("post_user_image");
    section.appendChild(PostUserImage);
    const PostUserInitials = document.createElement('span');
    PostUserInitials.classList.add("post_user_initials");
    PostUserInitials.textContent = name[0]+surname[0];
    PostUserImage.appendChild(PostUserInitials);

    
    const form = document.createElement('form');
    form.action = 'userPage.php';
    form.classList.add("post_user_username");
    form.method = 'get';
    section.appendChild(form);

    const labelText = document.createElement('label');
    labelText.classList.add("hide");
    form.appendChild(labelText);

    const inputText = document.createElement('input');
    inputText.type = 'text';
    inputText.name = 'username';
    inputText.value = userName;
    labelText.appendChild(inputText);

    const labelSub = document.createElement('label');
    form.appendChild(labelSub);

    const inputSub = document.createElement('input');
    inputSub.type = 'submit';
    inputSub.classList.add("noButtonEsthetic");
    inputSub.value = userName;
    labelSub.appendChild(inputSub);
    

    const divTitle = document.createElement('div');
    divTitle.classList.add('postTitle');
    divTitle.textContent = postTitle;
    sectionPost.appendChild(divTitle);

    const p = document.createElement('p');
    p.textContent = postText;
    sectionPost.appendChild(p);

    const divToolBar = document.createElement('div');
    divToolBar.classList.add('toolbar');
    const span1 = document.createElement('span')
    span1.textContent = time;
    divToolBar.appendChild(span1);

    sectionPost.appendChild(divToolBar);

    main.appendChild(sectionPost);

    i = i + 1;
    }
}

function OnResponse(response){
    return response.json();
}


function fetchPosts(){
    fetch(postURL).then(OnResponse).then(onPostsJson);
}


fetchPosts();
