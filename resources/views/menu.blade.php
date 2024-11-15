@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Style.css') }}">
<div class="menuProductos">
                <div class="search-bar">
                    <span class="out-of-stock">Papa´s Pizeria Menu</span>
                </div>
                <div class="categories">
                    <button class="category active" data-category="pizza" onclick="filterCategory('pizza')">Pizza</button>
                    <button class="category" data-category="drinks" onclick="filterCategory('drinks')">Bebidas</button>
                    <button class="category" data-category="dessert" onclick="filterCategory('dessert')">Postres</button>
                </div>
                <div id="loading" style="display: none;">
                <p>Cargando...</p>
                <div class="spinner"></div>
                </div>
                <div class="menu-items" id="menu-items">
                    <!-- Items will be dynamically generated here -->
                </div>
            </div>


            <div class="order-summary">
                <h2>Tu carrito de compras :D</h2>
                <div id="order-items">
                    <!-- Order Items will be dynamically added here -->
                </div>
                <div class="customer-info">
                    <label for="customer-name">Nombre del Cliente:</label>
                    <input type="text" id="customer-name" placeholder="Ingresa tu nombre" />
            
                    <label for="customer-phone">Teléfono del Cliente:</label>
                    <input type="tel" id="customer-phone" placeholder="Ingresa tu teléfono" />
            
                    <label for="customer-address">Dirección del Cliente:</label>
                    <input type="text" id="customer-address" placeholder="Ingresa tu dirección" />
                </div>
    
                
                <!-- New Button Group for Pick Up or Delivery -->
                <div class="delivery-options">
                    <button class="delivery-btn active" onclick="setDeliveryOption('pickup')">Recoger en restaurante</button>
                    <button class="delivery-btn" onclick="setDeliveryOption('delivery')">A Domicilio</button>
                </div>
    
                <div class="summary">
                    <p>Productos:(<span id="item-count">0</span>) <span id="item-total">$0.00</span></p>
                    <p>Iva (10%) <span id="tax-amount">$0.00</span></p>
                    <h3>Total <span id="total-amount">$0.00</span></h3>
                    <button class="print-btn" onclick="printBill()">Print Bills</button>
                </div>
        </div>
@endsection