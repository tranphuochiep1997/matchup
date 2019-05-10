document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("join").addEventListener("click", function () {
        document.getElementById("join").classList.add('btn-selected');
        const newElement = document.getElementById('new');
        let value = null;
        let teamListId = null;
        if (newElement) {
            value = newElement.innerHTML;
            teamListId = newElement.parentNode.getAttribute("id");
            newElement.parentNode.removeChild(newElement);
        }
        else {
            value = document.getElementById("username").value;
        }

        addPlayer(teamListId === "team-left" ? "team-right" : "team-left", value);
    });

    function addPlayer(idUl, value) {
        document.getElementById("idTeam").value = idUl === "team-left" ? 1 : 2;
        const node = document.createElement('li');
        node.setAttribute("id", "new");
        node.innerHTML = value;
        document.getElementById(idUl).appendChild(node);
    }


    const modal =  document.getElementsByClassName("modal")[0];

    document.getElementById("btn-update-score").addEventListener("click", showModal);

    function showModal() {
        modal.classList.add("show");
    }

    document.getElementsByClassName("close")[0].addEventListener("click", hideModal);
    
    function hideModal() {
        modal.classList.remove("show");
    }
});