function createElementTable(data){
    let thead = document.createElement("thead");
    let tr = document.createElement("tr");
    let th1 = document.createElement("th");
    th1.innerHTML = "User";
    tr.appendChild(th1);
    thead.appendChild(tr);
    let tbody = document.createElement("tbody");
    for (let i = 0; i < data.length; i++) {
        let tr = document.createElement("tr");
        let td1 = document.createElement("td");
        td1.innerHTML = data[i].nombreGuardian;
        tr.appendChild(td1);
        tbody.appendChild(tr);
        tr.addEventListener("click", function(){
            
        });
    }
    let table = document.createElement("table");
    table.appendChild(thead);
    table.appendChild(tbody);
    return table;
}

const input = document.getElementById("search");
input.addEventListener