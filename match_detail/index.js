document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("join").addEventListener("click", function () {
        document.getElementById("join").classList.add('btn-selected');
        const newElement = document.getElementById('new');
        const value = newElement.innerHTML;
        const teamListId = newElement.parentNode.getAttribute("id");
        newElement.parentNode.removeChild(newElement);

        addPlayer(teamListId === "team-left" ? "team-right" : "team-left", value);
    });

    function addPlayer(idUl, value) {
        document.getElementById("idTeam").value = idUl === "team-left" ? 1 : 2;
        const node = document.createElement('li');
        node.setAttribute("id", "new");
        node.innerHTML = value;
        document.getElementById(idUl).appendChild(node);
    }
});