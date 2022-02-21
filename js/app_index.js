"use strict"

const div_clientes=document.querySelector("#ult_clientes");

(async()=>{
    for(let i=0;i<3;i++){
        const respuesta = await fetch("https://dog.ceo/api/breeds/image/random");
        const datos = await respuesta.json();

        const lista_clientes=await datos["message"];
        // console.log(lista_clientes);
        div_clientes.appendChild(generar_card(lista_clientes));
    }
})();


// Creo apartado ultimos clientes(Index)
const generar_card=(url)=>{
    const col=document.createElement("div");
    col.classList.add("col-4");
    col.style.marginLeft=60+"px";
    col.style.minWidth=350+"px";
    col.style.maxWidth=350+"px";

    col.style.minHeight=350+"px";
    col.style.maxHeight=350+"px";

    const imagen=document.createElement("img");
    imagen.classList.add("img-fluid");
    imagen.id="imagen_externa";
    imagen.src=url;
    col.appendChild(imagen);

    return col;
}
