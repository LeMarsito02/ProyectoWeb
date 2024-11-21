let order = [];
let deliveryOption = 'pickup'; 

document.addEventListener('DOMContentLoaded', () => {
    loadMenuItems('pizza'); 
});

async function fetchMenuItems() {
    try {
        const response = await fetch('/api/menu-items'); // Nueva ruta en Laravel
        if (!response.ok) {
            throw new Error('Error al obtener los productos desde la API');
        }

        const data = await response.json();

        if (!data || !Array.isArray(data)) {
            throw new Error('Datos inválidos recibidos de la API');
        }
        console.log('Productos cargados:', data);

        return data; 
    } catch (error) {
        console.error('Error al cargar los productos:', error);
        document.getElementById('menu-items').innerHTML = `<p>Error al cargar los productos: ${error.message}</p>`;
        return []; 
    }
}

async function loadMenuItems(category) {
    const loadingElement = document.getElementById('loading');
    loadingElement.style.display = 'block'; // Mostrar el spinner

    try {
        const menuItems = await fetchMenuItems(); 
        renderMenuItems(menuItems, category);
    } catch (error) {
        console.error('Error al cargar los productos:', error);
    } finally {
        loadingElement.style.display = 'none'; // Ocultar el spinner al finalizar
    }
}

function renderMenuItems(menuItems, category) {
    const menuItemsContainer = document.getElementById('menu-items');
    menuItemsContainer.innerHTML = ''; 

    // Filtra los elementos basados en la categoría seleccionada
    const filteredItems = menuItems.filter(item => item.category === category);
    
    // Si no hay elementos, muestra un mensaje
    if (filteredItems.length === 0) {
        menuItemsContainer.innerHTML = `<p>No hay productos disponibles en esta categoría</p>`;
        return;
    }

    // Renderiza los productos filtrados
    filteredItems.forEach(item => {   
        const itemElement = document.createElement('div');
        itemElement.className = 'item';
        itemElement.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <h3>${item.name}</h3>
            <p>$${item.price.toFixed(2)}</p>
            <p>${item.availableDescription}</p>
            <button class="add-btn" onclick="addToOrder('${item.name}', ${item.price})">Agregar</button>
        `;
        menuItemsContainer.appendChild(itemElement);
    });
}

function filterCategory(category) {
    loadMenuItems(category); // Cargar productos filtrados de la API
    const categoryButtons = document.querySelectorAll('.category');
    categoryButtons.forEach(button => {
        button.classList.remove('active');
        if (button.getAttribute('data-category') === category) {
            button.classList.add('active');
        }
    });
}

function addToOrder(name, price) {
    const existingItem = order.find(item => item.name === name);
    if (existingItem) {
        existingItem.quantity++;
        existingItem.totalPrice += price;
    } else {
        order.push({ name, price, quantity: 1, totalPrice: price });
    }

    updateOrderSummary();
}

function removeFromOrder(name) {
    const itemIndex = order.findIndex(item => item.name === name);

    if (itemIndex > -1) {
        if (order[itemIndex].quantity > 1) {
            order[itemIndex].quantity--;
            order[itemIndex].totalPrice -= order[itemIndex].price;
        } else {
            order.splice(itemIndex, 1);
        }
    }

    updateOrderSummary();
}

function updateOrderSummary() {
    const orderItems = document.getElementById('order-items');
    orderItems.innerHTML = '';

    let itemCount = 0;
    let total = 0;

    order.forEach((item, index) => {
        itemCount += item.quantity;
        total += item.totalPrice;

        const orderItem = document.createElement('div');
        orderItem.className = 'order-item';
        orderItem.innerHTML = `
            <p>${item.name} <span>$${item.totalPrice.toFixed(2)}</span></p>
            <button class="remove-btn" onclick="removeFromOrder('${item.name}')">-</button>
            <span>${item.quantity}</span>
            <button class="add-btn" onclick="addToOrder('${item.name}', ${item.price})">+</button>
        `;
        orderItems.appendChild(orderItem);
    });

    document.getElementById('item-count').textContent = itemCount;
    document.getElementById('item-total').textContent = `$${total.toFixed(2)}`;
    const tax = total * 0.10;
    document.getElementById('tax-amount').textContent = `$${tax.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `$${(total + tax).toFixed(2)}`;
}

function setDeliveryOption(option) {
    deliveryOption = option;

    const deliveryButtons = document.querySelectorAll('.delivery-btn');
    deliveryButtons.forEach(button => {
        button.classList.remove('active');
    });

    if (option === 'pickup') {
        document.querySelector('.delivery-btn:nth-child(1)').classList.add('active');
    } else if (option === 'delivery') {
        document.querySelector('.delivery-btn:nth-child(2)').classList.add('active');
    }
}

async function printBill() {
    const customerName = document.getElementById('customer-name').value.trim();
    const customerPhone = document.getElementById('customer-phone').value.trim();
    const customerAddress = document.getElementById('customer-address').value.trim();

    if (!customerName || !customerPhone || !customerAddress) {
        alert("Por favor, completa la información del cliente.");
        return;
    }

    if (order.length === 0) {
        alert("No hay productos en el pedido para imprimir.");
        return;
    }

    let itemsList = order.map(item => ({
        nombre: item.name,
        precio: item.totalPrice,
    }));

    let total = order.reduce((sum, item) => sum + item.totalPrice, 0); 
    let tax = (total * 0.10).toFixed(2); 
    let totalAmount = (total + parseFloat(tax)).toFixed(2); 

    const orderDetails = {
        cliente: {
            nombre: customerName,
            telefono: customerPhone,
            direccion: customerAddress
        },
        pedido: itemsList
    };

    try {
        const response = await fetch('/api/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Protección CSRF
            },
            body: JSON.stringify(orderDetails)
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        const result = await response.json();
        if (result.success) {
            alert('¡Pedido realizado con éxito!');
            window.location.href = 'index.html';
        } else {
            throw new Error('Error al procesar el pedido.');
        }
    } catch (error) {
        console.error('Error al enviar el pedido:', error);
        alert('Hubo un problema al procesar tu pedido. Por favor, inténtalo de nuevo.');
    }
}


