const database_url = './database.json';
async function getData() {
    const response = await fetch(database_url);
    const data = await response.json();
    data.forEach( player => {
        const tbody = document.querySelector('#players');
        let html = '';
        html += '<tr>';
            html += `<td>${player.name}</td>`;
            html += `<td>${player.kills}</td>`;
            html += `<td>${player.deaths}</td>`;
            html += `<td>${player.kd}</td>`;
        html += '</tr>';
        tbody.innerHTML += html;
    });
}

getData();

function onload() {
    getData();
}