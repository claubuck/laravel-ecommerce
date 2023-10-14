

// Función para validar los campos del pedido
export function validarPedido(nombre, telefono, direccion) {
    if (nombre === '' || telefono === '' || direccion === '') {
        Swal.fire({
            icon: 'error',
            title: 'Por favor, completa todos los campos del pedido.',
          })
        return false;
    }
    return true;
}

