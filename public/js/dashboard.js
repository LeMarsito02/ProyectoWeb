document.addEventListener('DOMContentLoaded', function () {
    const loadingDetalles = document.getElementById('loading');
    const loadingFiltro = document.getElementById('loading-filtro');
    const detallesPedido = document.getElementById('dashboard-detalles-pedido');
    const pedidosTbody = document.getElementById('pedidos-tbody');

    console.log("Script cargado y listo.");
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(token);
    // Mostrar detalles del pedido
    document.querySelectorAll('.ver-detalles').forEach(button => {
        button.addEventListener('click', function () {
            const pedidoId = this.dataset.id;

            console.log(`Mostrando detalles del pedido ID: ${pedidoId}`);

            loadingDetalles.style.display = 'block';
            detallesPedido.style.display = 'none';

            fetch(`/dashboard/pedido/${pedidoId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener los detalles del pedido.');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('dashboard-cliente-nombre').innerText = data.cliente.name;
                    document.getElementById('dashboard-cliente-telefono').innerText = data.cliente.phone;
                    document.getElementById('dashboard-cliente-direccion').innerText = data.cliente.address;

                    const productosLista = document.getElementById('dashboard-productos-lista');
                    productosLista.innerHTML = '';
                    data.productos.forEach(producto => {
                        productosLista.innerHTML += `<li>${producto.name} - Cantidad: ${producto.pivot.quantity}, Subtotal: $${producto.pivot.subtotal}</li>`;
                    });

                    document.getElementById('dashboard-pedido-total').innerText = data.total;
                    detallesPedido.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error al obtener los detalles del pedido:', error);
                    alert('Hubo un error al obtener los detalles del pedido.');
                })
                .finally(() => {
                    loadingDetalles.style.display = 'none';
                });
        });
    });

    // Filtrar pedidos por estado
    document.getElementById('estado-filter').addEventListener('change', function () {
        const estado = this.value;
        const url = estado ? `/dashboard?estado=${estado}` : '/dashboard';

        console.log(`Filtrando pedidos por estado: ${estado || 'Todos'}`);

        loadingFiltro.style.display = 'block';

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al filtrar los pedidos.');
                }
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTbody = doc.getElementById('pedidos-tbody').innerHTML;
                pedidosTbody.innerHTML = newTbody;

                attachEvents(); // Reconectar eventos después de actualizar la tabla
            })
            .catch(error => {
                console.error('Error al filtrar los pedidos:', error);
                alert('Hubo un error al filtrar los pedidos.');
            })
            .finally(() => {
                loadingFiltro.style.display = 'none';
            });
    });

    // Filtrar pedidos por cliente
    document.getElementById('cliente-filter').addEventListener('input', function () {
        const cliente = this.value;

        console.log(`Filtrando pedidos por cliente: ${cliente}`);

        loadingFiltro.style.display = 'block';

        fetch(`/dashboard?cliente=${cliente}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al filtrar los pedidos por cliente.');
                }
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTbody = doc.getElementById('pedidos-tbody').innerHTML;
                pedidosTbody.innerHTML = newTbody;

                attachEvents(); // Reconectar eventos después de actualizar la tabla
            })
            .catch(error => {
                console.error('Error al filtrar los pedidos por cliente:', error);
                alert('Hubo un error al filtrar los pedidos por cliente.');
            })
            .finally(() => {
                loadingFiltro.style.display = 'none';
            });
    });

    // Cambiar estado del pedido
    function attachEvents() {
        document.querySelectorAll('.estado-select').forEach(select => {
            select.addEventListener('change', function () {
                const pedidoId = this.dataset.id; // Obtiene el ID del pedido desde el data-id
                const estado = this.value; // Obtiene el estado seleccionado
    
                console.log(`Actualizando estado del pedido ID ${pedidoId} a: ${estado}`);
    
                // Mostrar el indicador de carga
                loadingDetalles.style.display = 'block';
    
                fetch(`/dashboard/pedido/${pedidoId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ status: estado })  // Aquí solo enviamos el "status" en el cuerpo
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al actualizar el estado del pedido.');
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message); // Mensaje de éxito
                })
                .catch(error => {
                    console.error('Error al actualizar el estado del pedido:', error);
                    alert('Hubo un error al actualizar el estado del pedido.');
                })
                .finally(() => {
                    loadingDetalles.style.display = 'none'; // Ocultar el indicador de carga
                });
            });
        });
    }
    
    
    

    // Inicializar eventos
    attachEvents();
});
