const deleteTask = (id) => {
    // console.log(id)
    if(!confirm("¿Desea eliminar la tarea")){
        return;
    }
    const xmlhttp = new XMLHttpRequest()

    xmlhttp.onload = function (){
        console.log(this.responseText)
        document.location.reload()
    }

    xmlhttp.open("POST", "backend/Main.php")
    // Sin esto no recibe el parametro por metodo POST
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xmlhttp.send(`id=${id}`)

}

const clearInputs = (e) => {
    if(e){
        e.preventDefault()
    }
    document.querySelector(".id").value = ""
    document.querySelector(".title").value = ""
    document.querySelector(".desc").value = ""

}

const addTask = (id, title, desc) => {

    if(id != ""){
        // Actualizar
        //console.log(id, title, desc, "Actualizado")

        const xmlhttp = new XMLHttpRequest()

        xmlhttp.onload = function (){
            console.log(this.responseText)
            clearInputs()
            document.location.reload()
        }

        
        xmlhttp.open("POST", "backend/Main.php")
        // Sin esto no recibe el parametro por metodo POST
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlhttp.send(`id=${id}&&title=${title}&&desc=${desc}`)
    }else{
        // Agregar
        if (title == "" || desc == ""){
            alert("Ambos campos deben llenarse!");
            clearInputs()
            return;
        }
        // console.log(title, desc)
        const xmlhttp = new XMLHttpRequest()

        xmlhttp.onload = function (){
            console.log(this.responseText)
            clearInputs()
            document.location.reload()
        }

        
        xmlhttp.open("POST", "backend/Main.php")
        // Sin esto no recibe el parametro por metodo POST
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlhttp.send(`title=${title}&&desc=${desc}`)
    }
    

}

const editTask = (id, title, desc) => {
    let inputId = document.querySelector('.id')
    let inputTitle =  document.querySelector('.title')
    let inputDesc = document.querySelector('.desc')
    let inputAdd = document.querySelector('.add')

    inputId.value = id
    inputTitle.value = title
    inputDesc.value = desc
    inputAdd.value = "Actualizar"

    console.log(id, title, desc)

}


const showTasks = () => {
    const xmlhttp = new XMLHttpRequest()

    xmlhttp.onload = function (){
        let tabla = document.querySelector("#datos")
        const datos = JSON.parse(this.responseText)
        // console.log(datos)
        datos.forEach(tarea => {
            let tr = document.createElement('tr')
            tr.innerHTML = `<td> ${tarea.title} </td> <td> ${tarea.description} </td> <td> <button class="btn btn-danger" onclick="deleteTask(${tarea.id})"> <i class="material-icons">delete</i> </button>  <button class="btn btn-success" onclick="editTask(${tarea.id}, '${tarea.title}', '${tarea.description}')"><i class="material-icons">edit</i></button> </td> `
            tabla.appendChild(tr)

        })
    }

    xmlhttp.open("GET", "backend/Main.php")
    xmlhttp.send()
}

document.onload = showTasks()