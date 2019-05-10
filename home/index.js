document.addEventListener("DOMContentLoaded", function () {
    let count = 1;
    document.getElementById("loadMore").addEventListener("click", function () {
        function getAjax(url, success) {
            var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            xhr.open('GET', url);
            xhr.onreadystatechange = function () {
                if (xhr.readyState > 3 && xhr.status == 200) success(xhr.responseText);
            };
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send();
            return xhr;
        }

        // example request
        getAjax('http://localhost/matchup/api/matches?page=' + (count++), function (data) {
            var elements = JSON.parse(data).data;
            for (let i = 0; i < elements.length; i++) {
                // Get a reference to the table
                let tableRef = document.getElementById("withAjax");

                // Insert a row at the end of the table
                let newRow = tableRef.insertRow(-1);

                let cell1 = newRow.insertCell(0);
                const node = document.createElement('a');
                node.setAttribute("href", "#");
                node.innerHTML = elements[i].title;
                cell1.appendChild(node);

                let cell2 = newRow.insertCell(1);
                let node2 = document.createTextNode(elements[i].startTime);
                cell2.className = 'line';
                cell2.appendChild(node2);
            }

        });
    });
});