    let changeBtns = document.querySelectorAll("button.btn-sm");
    let changeModal = document.getElementById("change-modal");
    let changeSpan = document.getElementById("close-span");
    console.log(changeModal);

    for (let i = 0; i < changeBtns.length; i++) {
        changeBtns[i].onclick = function() {
            changeModal.style.display = "block";
            changeModal.style.opacity = 1;
        };
    }


    changeSpan.onclick = function() {
        changeModal.style.display = "none";
        changeModal.style.opacity = 0;
    };