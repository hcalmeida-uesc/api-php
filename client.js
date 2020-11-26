var btnGet= document.getElementById("btn-get").addEventListener("click", getUsers);
var btnSend= document.getElementById("btn-send").addEventListener("click", sendForm);
var tab= document.getElementById("table-data");
var inputID= document.getElementById("input-id");

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function sendForm(){
    if(inputID.innerText != ""){
        //método PUT com ID
    }
    else{
        //método POST sem ID
    }
}

function deleteUser(id, nome){
    if(confirm(`Deseja remover o usuário ID ${id} - Nome: ${nome}`)){
        $.ajax({
            url : 'http://localhost/projects/api-php/users/'+id,
            method : 'delete'
        })
        getUsers();
    }
}

function editUser(id){
    inputID.innerHTML = id;
}

function getUsers(){
    fetch('http://localhost/projects/api-php/users')
    .then((res)=>{
        return res.json();
    })
    .then(async (users)=>{
        tab.innerHTML = '';
        for (const key in users) {
            tab.innerHTML+=`
            <tr>
                <th scope="row">${users[key].id}</th>
                <td>${users[key].nome}</td>
                <td>${users[key].nascimento}</td>
                <td><button onclick="editUser('${users[key].id}');" class="btn btn-warning" type="button">Editar</button></td>
                <td><button onclick="deleteUser('${users[key].id}', '${users[key].nome}');" class="btn btn-danger" type="button">Apagar</button></td>
            </tr>
            `
            await sleep(100);
        }
    })
}