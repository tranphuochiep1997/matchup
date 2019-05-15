document.addEventListener("DOMContentLoaded", function () {
    // let count = 1;
    // document.getElementById("loadMore").addEventListener("click", function () {
    //     function getAjax(url, success) {
    //         var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //         xhr.open('GET', url);
    //         xhr.onreadystatechange = function () {
    //             if (xhr.readyState > 3 && xhr.status == 200) success(xhr.responseText);
    //         };
    //         xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    //         xhr.send();
    //         return xhr;
    //     }

    //     // example request
    //     getAjax('../api/matches?page=' + (++count), function (data) {
    //         var elements = JSON.parse(data).data;
    //         for (let i = 0; i < elements.length; i++) {
    //             // Get a reference to the table
    //             let tableRef = document.getElementById("withAjax");

    //             // Insert a row at the end of the table
    //             let newRow = tableRef.insertRow(-1);

    //             let cell1 = newRow.insertCell(0);
    //             const node = document.createElement('a');
    //             node.setAttribute("href", "#");
    //             node.innerHTML = elements[i].title;
    //             cell1.appendChild(node);

    //             let cell2 = newRow.insertCell(1);
    //             let node2 = document.createTextNode(elements[i].startTime);
    //             cell2.className = 'line';
    //             cell2.appendChild(node2);
    //         }

    //     });
    // });

    let page = 1;
    const limit = 5;
    const bodyTable = document.getElementById('recent-matches-body');

    fetchMatches();

    function fetchMatches() {
        callApi(`../api/matches?page=${page++}&limit=${limit}`, onSucess);
    }

    function onSucess(response) {

        const matches = response.responseXML.getElementsByTagName('match');

        for(let i = 0; i < matches.length; i++) {
            appendNewMatch(matches[i]);
        }

        if (matches.length !== limit) {
            document.getElementById('loadMore').classList.add('hidden');
        }
    }

    function appendNewMatch(match) {
        const title = match.getElementsByTagName('title')[0].firstChild.nodeValue;
        const startTime = match.getElementsByTagName('startTime')[0].firstChild.nodeValue;
        const match_id = match.getElementsByTagName('match_id')[0].firstChild.nodeValue;

        const tr = document.createElement('tr');

        // Title
        const titleElement = document.createElement('td');
        const link = `<a href='/matchup/match_detail/index.php?id=${match_id}&readOnly=true'>${title}</a>`;
        titleElement.innerHTML = link;

        // Start time
        const timeElement = document.createElement('td');
        timeElement.className = 'line';
        timeElement.innerHTML = startTime;

        tr.appendChild(titleElement);
        tr.appendChild(timeElement);
        bodyTable.appendChild(tr);
    }

    // Add event loadmore
    document.getElementById('loadMore').addEventListener('click', fetchMatches);
});