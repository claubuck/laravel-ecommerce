// Importa las funciones de validación desde validaciones.js
import { validarPedido } from './validaciones.js';


let baseDeDatos = [];
fetch('/shoping-card')
    .then(response => response.json())
    .then(data => {
        baseDeDatos = data;
        console.log('Productos cargados desde la API:', baseDeDatos);
        renderizarProductos();
    })
    .catch(error => {
        console.error('Error al cargar los productos desde la API:', error);
    });

let carrito = [];
const divisa = '€';
const DOMitems = document.querySelector('#items');
const DOMcarrito = document.querySelector('#carrito');
const DOMtotal = document.querySelector('#total');
const DOMbotonVaciar = document.querySelector('#boton-vaciar');

// Funciones

/**
 * Dibuja todos los productos a partir de la base de datos. No confundir con el carrito
 */
function renderizarProductos() {
    baseDeDatos.forEach((info) => {
        // Estructura
        const miNodo = document.createElement('div');
        miNodo.classList.add('card', 'col-sm-4');
        miNodo.style.backgroundColor = 'white';
        miNodo.style.marginRight = '1rem';
        miNodo.style.textDecorationColor = 'black';
        // Body
        const miNodoCardBody = document.createElement('div');
        miNodoCardBody.classList.add('card-body');
        // Titulo
        const miNodoTitle = document.createElement('h5');
        miNodoTitle.classList.add('card-title');
        miNodoTitle.textContent = info.name;
        // image
        const imageUrl = "storage/" + info.image;
        const miNodoimage = document.createElement('img');
        miNodoimage.classList.add('img-fluid');
        miNodoimage.setAttribute('src', imageUrl);
        miNodoimage.style.maxWidth = '100%'; // Establece el ancho máximo en 200 píxeles
        miNodoimage.style.maxHeight = 'auto'; // Establece el alto máximo en 200 píxeles
        // sell_price
        const miNodosell_price = document.createElement('p');
        miNodosell_price.classList.add('card-text');
        miNodosell_price.textContent = `${info.sell_price}${divisa}`;
        // Boton 
        const miNodoBoton = document.createElement('button');
        miNodoBoton.classList.add('btn', 'btn-primary');
        miNodoBoton.textContent = '+';
        miNodoBoton.setAttribute('marcador', info.id);
        miNodoBoton.addEventListener('click', anyadirProductoAlCarrito);
        // Insertamos
        miNodoCardBody.appendChild(miNodoimage);
        miNodoCardBody.appendChild(miNodoTitle);
        miNodoCardBody.appendChild(miNodosell_price);
        miNodoCardBody.appendChild(miNodoBoton);
        miNodo.appendChild(miNodoCardBody);
        DOMitems.appendChild(miNodo);
    });
}

/* *
 * Evento para añadir un producto al carrito de la compra
 */
/* function anyadirProductoAlCarrito(evento) {
    // Anyadimos el Nodo a nuestro carrito
    carrito.push(evento.target.getAttribute('marcador'))
    // Actualizamos el carrito 
    renderizarCarrito();

} */

function anyadirProductoAlCarrito(evento) {
    const productoId = evento.target.getAttribute('marcador');
    
    // Verificar si el producto ya está en el carrito
    const cantidadEnCarrito = carrito.filter(item => item === productoId).length;

    // Encontrar el producto en la base de datos
    const producto = baseDeDatos.find(item => item.id === parseInt(productoId));

    // Verificar si hay suficiente stock
    if (producto && cantidadEnCarrito < producto.stock) {
        // Si hay stock disponible, agregar el producto al carrito
        carrito.push(productoId);
        // Actualizar el carrito
        renderizarCarrito();
    } else {
        // Mostrar un mensaje al usuario
        Swal.fire({
            icon: 'error',
            title: 'No hay nas stock de este producto',
          })
    }
}

/**
 * Dibuja todos los productos guardados en el carrito
 */
function renderizarCarrito() {
    // Vaciamos todo el html
    DOMcarrito.textContent = '';
    // Quitamos los duplicados
    const carritoSinDuplicados = [...new Set(carrito)];
    // Generamos los Nodos a partir de carrito
    carritoSinDuplicados.forEach((item) => {
        // Obtenemos el item que necesitamos de la variable base de datos
        const miItem = baseDeDatos.filter((itemBaseDatos) => {
            // ¿Coincide las id? Solo puede existir un caso
            return itemBaseDatos.id === parseInt(item);
        });
        // Cuenta el número de veces que se repite el producto
        const numeroUnidadesItem = carrito.reduce((total, itemId) => {
            // ¿Coincide las id? Incremento el contador, en caso contrario no mantengo
            return itemId === item ? total += 1 : total;
        }, 0);
        // Creamos el nodo del item del carrito
        const miNodo = document.createElement('li');
        miNodo.classList.add('list-group-item', 'text-left', 'mx-2', 'bg-white', 'text-dark', 'd-flex', 'justify-content-between');
        miNodo.textContent = `${numeroUnidadesItem} x ${miItem[0].name} - ${miItem[0].sell_price}${divisa}`;
        // Boton de borrar
        const miBoton = document.createElement('button');
        miBoton.classList.add('btn', 'btn-danger', 'mx-2', 'float-right');
        miBoton.textContent = 'X';
        miBoton.style.marginLeft = '1rem';
        miBoton.dataset.item = item;
        miBoton.addEventListener('click', borrarItemCarrito);
        // Mezclamos nodos
        miNodo.appendChild(miBoton);
        DOMcarrito.appendChild(miNodo);
    });
    // Renderizamos el sell_price total en el HTML
    DOMtotal.textContent = calcularTotal();
    parcearCarrito();
}

/**
 * Evento para borrar un elemento del carrito
 */
function borrarItemCarrito(evento) {
    // Obtenemos el producto ID que hay en el boton pulsado
    const id = evento.target.dataset.item;
    // Borramos todos los productos
    carrito = carrito.filter((carritoId) => {
        return carritoId !== id;
    });
    // volvemos a renderizar
    renderizarCarrito();
}

/**
 * Calcula el sell_price total teniendo en cuenta los productos repetidos
 */

function calcularTotal() {
    // Recorremos el array del carrito 
    return carrito.reduce((total, item) => {
        // De cada elemento obtenemos su sell_price
        const miItem = baseDeDatos.filter((itemBaseDatos) => {
            return itemBaseDatos.id === parseInt(item);
        });
        // Convertir el sell_price en número (de cadena a flotante) y luego sumarlo al total
        return total + parseFloat(miItem[0].sell_price);
    }, 0).toFixed(2);
}
/**
 * Varia el carrito y vuelve a dibujarlo
 */
function vaciarCarrito() {
    // Limpiamos los productos guardados
    carrito = [];
    // Renderizamos los cambios
    renderizarCarrito();
}

/**
 * parcear el carrito
 */
let detail = [];
function parcearCarrito() {
// Tu array original
const ids = carrito;

// Objeto para almacenar la cantidad de cada ID
const idCounts = {};

// Itera sobre el array y cuenta las repeticiones de cada ID
ids.forEach((id) => {
    if (idCounts[id]) {
        idCounts[id].quantity++;
    } else {
        idCounts[id] = { id: id, quantity: 1 };
    }
});

// Convierte el objeto en un array de carrito y actualiza la variable global detail
detail = Object.values(idCounts);
}

/**
 * Guardar carrito
 */

function guardarCarrito() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const carritoConClaveId = carrito.map(item => ({ id: item }));
    //console.log('carrito', carritoConClaveId);
    fetch('/store-shoping-card', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            detalles: detail,
            total: calcularTotal(),
            pedido: pedido,
        })

    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.status);
            }
            console.log('Carrito guardado en la base de datos');
            response.json().then(data => {
                console.log(data);
            });
            // window.location.href = '/'; // redirecciona al index

        })
        .then(data => {
            // Hacer algo con la respuesta del servidor si es necesario
        })
        .catch(error => {
            console.error('Error al guardar detalles en la base de datos:', error);
        });
}


// Eventos
DOMbotonVaciar.addEventListener('click', vaciarCarrito);

document.getElementById('boton-abrir-modal').addEventListener('click', function () {
    $('#modalInformacion').modal('show'); // Abre el modal
});

//guardar datos del modal
// Define variables para guardar los detalles del pedido
let nombrePedido = '';
let telefonoPedido = '';
let direccionPedido = '';
let pedido = [];

// Evento para el botón "Enviar Pedido" en el modal
document.getElementById('boton-enviar-pedido-modal').addEventListener('click', function () {
    // Obtén los valores de los campos del modal
    nombrePedido = document.getElementById('nombre').value;
    telefonoPedido = document.getElementById('telefono').value;
    direccionPedido = document.getElementById('direccion').value;

    // Valida los campos del pedido usando la función importada
    if (validarPedido(nombrePedido, telefonoPedido, direccionPedido)) {
        // Actualiza el carrito y realiza la acción de guardado
        pedido = [];
        pedido.push({
            id: 'pedido',
            nombre: nombrePedido,
            telefono: telefonoPedido,
            direccion: direccionPedido,
        });

        // Cierra el modal
        $('#modalInformacion').modal('hide');
        // guardar carrito
        guardarCarrito();
    }
});

// Inicio
renderizarProductos();
renderizarCarrito();

