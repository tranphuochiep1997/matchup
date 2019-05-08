document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("join-left").addEventListener("click", function () {
        removeSibling(function () {
            document.getElementById("join-left").classList.add('btn-selected');
            addPlayer("team-left");
            document.getElementById("idTeam").value = 1;
        })
    });
    document.getElementById("join-right").addEventListener("click", function () {
        removeSibling(function () {
            document.getElementById("join-right").classList.add('btn-selected');
            addPlayer("team-right");
            document.getElementById("idTeam").value = 2;
        })
    });

    function removeSibling(callback) {
        var x = document.getElementsByClassName("btn-join");
        for (i = 0; i < x.length; i++) {
            x[i].classList.remove('btn-selected');
        }
        callback();
    }
    function addPlayer(idUl) {

        var matches = document.querySelectorAll("ul li.new");
        for (var i = 0; i < matches.length; i++) {
            matches[i].style.display = 'none';
        }

        var node = document.createElement('li');
        node.classList.add('new');
        var textnode = document.createTextNode("Tran Tien Hiep");
        node.appendChild(textnode);
        document.getElementById(idUl).appendChild(node);
    }
});