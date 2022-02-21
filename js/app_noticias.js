"use strict"

const noticias_container=document.querySelector("#nuevasNoticias");

//FORMULARIO INSERTAR
const titular=document.querySelector("#titulo");
const contenido=document.querySelector("#contenido");
const imagen=document.querySelector("#imagen");
const fecha=document.querySelector("#fecha");

const añadir_noticia=document.querySelector("#boton_añadir");

const formulario_insercion=document.querySelector("#añadir_formulario");
const formu=document.querySelector("#formu")

const boton_insertar=document.querySelector("#añadir_prod");

if(añadir_noticia!=null){
    añadir_noticia.addEventListener("click",
        ()=>{
            if(formulario_insercion.classList.contains("d-none")){
                formulario_insercion.classList.remove("d-none");
                formulario_insercion.classList.add("d-flex");
                añadir_noticia.innerText="Cancelar";
            }else{
                formulario_insercion.classList.remove("d-flex");
                formulario_insercion.classList.add("d-none");
                añadir_noticia.innerText("Añadir noticia");
            }
        }
    )
}



// Cards para el apartado noticias
const nuevasNoticias=(noticia)=>{
    let nuevaNoticia=document.createElement("div");
    nuevaNoticia.id="ID"+noticia["titulo"].toUpperCase().replaceAll(" ","");
    nuevaNoticia.classList.add("row","lazyLoad");

    let col_noticia=document.createElement("div");
    col_noticia.classList.add("col-6","text-center","mx-auto","my-3");
    nuevaNoticia.appendChild(col_noticia);

    let col_card=document.createElement("div");
    col_noticia.classList.add("card");
    col_noticia.appendChild(col_card);

    let imagen=document.createElement("img");
    imagen.src=noticia["imagen"];
    imagen.classList.add("card-img-top","img-fluid");
    col_card.appendChild(imagen);

    let card_body=document.createElement("div");
    col_noticia.classList.add("card");
    col_card.appendChild(card_body);

    let titular=document.createElement("h2");
    titular.innerText=noticia["titulo"];
    titular.classList.add("card-title");
    card_body.appendChild(titular);

    let contenido=document.createElement("p");
    contenido.innerText=noticia["contenido"];
    contenido.classList.add("card-text");
    card_body.appendChild(contenido);

    let fecha_publi=document.createElement("p");
    fecha_publi.innerText=noticia["fecha_publicacion"];
    fecha_publi.classList.add("card-text","bg-secondary");
    card_body.appendChild(fecha_publi);

    return nuevaNoticia;
}

// AÑADIR NUEVA NOTICIA
if(boton_insertar!=null){
    boton_insertar.addEventListener("click",
        async(evento)=>{
            evento.preventDefault();
            if(titular.value.trim().length==="" || contenido.value.trim().length==="" || imagen.value.trim().length==="" || fecha.value.trim()===""){
                mensajeError("Error, tienen que estar todos los campos rellenos");
            }else{
                const datos_noticias=new URLSearchParams(new FormData(formu));
                const respuesta=await fetch("configurar_noticias/insertar_noticias.php",
                    {
                        method:"POST",
                        body:datos_noticias
                    }
                );


                const id_noticia=await respuesta.json();

                
                console.log(id_noticia);

                const datos_noticia={
                    "id":id_noticia.id,
                    "titulo":titular.value.trim(),
                    "contenido":contenido.value.trim(),
                    "imagen":imagen.value.trim(),
                    "fecha_publicacion":fecha.value.trim()
                }

                const nueva_noticia=nuevasNoticias(datos_noticia);

                noticias_container.appendChild(nueva_noticia);
                sessionStorage.setItem("ID"+titular.value.trim().toUpperCase().replaceAll(" ",""),JSON.stringify(datos_noticia));
            
                document.documentElement.scrollTop = document.documentElement.scrollHeight;
                mensajeOk("Añadido correctamente");
                
                formulario_insercion.classList.remove("d-flex");
                formulario_insercion.classList.add("d-none");
            }
        }
    );
}


if(sessionStorage.length===0){
    (async()=>{
        const respuesta=await fetch("configurar_noticias/sacar_noticias.php");
        const datos=await respuesta.json();

        datos.forEach(
            (noticia)=>{
                sessionStorage.setItem("ID"+noticia["titulo"].toUpperCase().replaceAll(" ",""),JSON.stringify(noticia))
            }
        );
        Object.values(sessionStorage).forEach(
            (noticia)=>{
                noticias_container.appendChild(nuevasNoticias(JSON.parse(noticia)))
            }
        )
    })();
}else{
    Object.values(sessionStorage).forEach(
        (noticia)=>{
            noticias_container.appendChild(nuevasNoticias(JSON.parse(noticia)))
        }
    )
}

const noticias=document.querySelectorAll(".lazyLoad");

const observer=new IntersectionObserver(
    (noticia)=>{
        noticia.forEach(
            (noti)=>{
                if(noti.isIntersecting){
                    noti.target.classList.add("visible");
                }
            }
        )
    }
)

noticias.forEach(
    (noticia)=>{
        observer.observe(noticia)
    }
)