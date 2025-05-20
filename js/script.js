document.addEventListener('DOMContentLoaded', () => {
    fetch('../backend/mostrar_carrito.php') // Obtiene los productos del carrito desde el backend
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('productosCarrito');
            contenedor.innerHTML = data.map(p =>
                `<p>${p.nombre} - $${p.precio} (Cantidad: ${p.cantidad})</p>`
            ).join('');
        })
        .catch(error => console.error("Error al obtener carrito:", error));
});

// Función para vaciar el carrito (ejemplo)
function vaciarCarrito() {
    alert("Función de vaciar carrito aún no implementada.");
}

function eliminarProducto(productoId) {
    fetch('../backend/eliminar_producto_carrito.php', {
        method: 'POST',
        body: new URLSearchParams({ producto_id: productoId }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.text())
    .then(mensaje => {
        alert(mensaje);
        location.reload(); // Recargar la página para actualizar el carrito
    })
    .catch(error => console.error("Error al eliminar producto:", error));
}

function aplicarFiltros() {
    const marca = document.getElementById('marcaFiltro').value;
    const minPrecio = document.getElementById('minPrecioFiltro').value;
    const maxPrecio = document.getElementById('maxPrecioFiltro').value;

    fetch(`../backend/filtros.php?marca=${marca}&min_precio=${minPrecio}&max_precio=${maxPrecio}`)
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('productosLista');
            contenedor.innerHTML = data.map(p =>
                `<p>${p.nombre} - $${p.precio} (Marca: ${p.marca})</p>`
            ).join('');
        })
        .catch(error => console.error("Error al aplicar filtros:", error));
}


function realizarPedido() {
    fetch('../backend/realizar_pedido.php', { method: 'POST' })
        .then(response => response.text())
        .then(mensaje => {
            alert(mensaje); // Mostrar mensaje de éxito o error
            location.reload(); // Recargar la página
        })
        .catch(error => console.error("Error al realizar pedido:", error));
}


document.addEventListener('DOMContentLoaded', () => {
    fetch('../backend/historial_pedidos.php') // Obtener pedidos del backend
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('listaPedidos');
            contenedor.innerHTML = data.length > 0
                ? data.map(p => `<p>Pedido #${p.id} - Total: $${p.total} - Fecha: ${p.fecha}</p>`).join('')
                : "<p>No tienes pedidos aún.</p>";
        })
        .catch(error => console.error("Error al obtener historial de pedidos:", error));
});

function cancelarPedido(pedidoId) {
    fetch('../backend/cancelar_pedido.php', {
        method: 'POST',
        body: new URLSearchParams({ pedido_id: pedidoId }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.text())
    .then(mensaje => {
        alert(mensaje);
        location.reload(); // Recargar la página para actualizar el historial
    })
    .catch(error => console.error("Error al cancelar pedido:", error));
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('../backend/historial_pedidos.php') // Obtener pedidos del backend
        .then(response => response.json())
        .then(data => {
            const contenedor = document.getElementById('listaPedidos');
            contenedor.innerHTML = data.length > 0
                ? data.map(p => `<p>Pedido #${p.id} - Total: $${p.total} - Fecha: ${p.fecha} 
                    <button onclick="cancelarPedido(${p.id})">Cancelar Pedido</button></p>`).join('')
                : "<p>No tienes pedidos aún.</p>";
        })
        .catch(error => console.error("Error al obtener historial de pedidos:", error));
});

function procesarPago() {
    const metodo = document.getElementById('metodoPago').value;

    fetch('../backend/procesar_pago.php', {
        method: 'POST',
        body: new URLSearchParams({ metodo_pago: metodo }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.text())
    .then(mensaje => {
        alert(mensaje);
        location.reload();
    })
    .catch(error => console.error("Error al procesar pago:", error));
}