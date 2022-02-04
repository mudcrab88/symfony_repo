    let changeBtns = document.querySelectorAll("button.btn-sm");
    let changeModal = document.getElementById("change-modal");
    let closeSpan = document.getElementById("close-span");
    let closeBtn = document.getElementById("close-btn");

    console.log(closeBtn);

    for (let i = 0; i < changeBtns.length; i++) {
        changeBtns[i].onclick = function() {
            changeModal.style.display = "block";
            changeModal.style.opacity = 1;
        };
    }


    closeBtn.onclick = closeSpan.onclick = function() {
        changeModal.style.display = "none";
        changeModal.style.opacity = 0;
    };