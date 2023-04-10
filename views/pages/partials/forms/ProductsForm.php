<!-- PRODUCT NAME -->
<div class="form-group mb-4">
    <label for="form_product-name">Registra tu producto</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="text" class="form-control" placeholder="producto de ejemplo" id="form_product-name" autofocus required />
    </div>
</div>

<!-- PRODUCT SUSTANCIA ACTIVA -->
<div class="form-group mb-4">
    <label for="form_product-activeSustance">Sustancia activa</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="text" class="form-control" placeholder="Ibuprofeno" id="form_product-activeSustance" autofocus required />
    </div>
</div>

<!-- COSTO -->
<div class="form-group mb-4">
    <label for="form_product-cost">Costo</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="number" pattern="[0-9]+\.?[0-9]*" class="form-control" placeholder="600.87" id="form_product-cost" autofocus required />
    </div>
</div>

<!--COSTO POR UNIDAD -->
<div class="form-group mb-4">
    <label for="form_product-uniteCost">Costo por unidad</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="number" pattern="[0-9]+\.?[0-9]*" class="form-control" placeholder="500.65" id="form_product-uniteCost" autofocus required />
    </div>
</div>

<!-- PRESENTACIÓN -->
<div class="mb-4">
    <label class="my-1 me-2" for="form_product-presentation">
        Presentación
    </label> 
    <select class="form-select" id="form_product-presentation" aria-label="Presentation select">
    </select>
</div>

<!-- CATEGORÍA -->
<div class="mb-4">
    <label class="my-1 me-2" for="form_product-categorie">
        Categoría
    </label> 
    <select class="form-select" id="form_product-categorie" aria-label="Categorie select">
    </select>
</div>


<!-- UNIDAD DE VENTA -->
<div class="mb-4">
    <label class="my-1 me-2" for="form_product-sellUnite">
        Unidad de venta
    </label> 
    <select class="form-select" id="form_product-sellUnite" aria-label="Unite buy select">
    </select>
</div>

<!-- UNIDAD DE COMPRA -->
<div class="mb-4">
    <label class="my-1 me-2" for="form_product-buyUnite">
        Unidad de compra
    </label> 
    <select class="form-select" id="form_product-buyUnite" aria-label="Unite buy select">
    </select>
</div>

<!-- CONTENIDO -->
<div class="form-group mb-4">
    <label for="form_product-content">Contenido en miligramos</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="number" pattern="[0-9]+" class="form-control" placeholder="500" id="form_product-content" autofocus required />
    </div>
    <span>&nbsp;mg</span>
</div>

<!-- DESCUENTO -->
<div class="form-group mb-4">
    <label for="form_product-discount">Descuento</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><input type="number" pattern="[0-9]+\.?[0-9]*" class="form-control" id="form_product-discount" autofocus required />
    </div>
</div>

<!-- BREVE DESCRIPCIÓN -->
<div class="form-group mb-4">
    <label for="form_product-description">Describe brevemente el producto</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg> </span><textarea class="form-control" placeholder="Descríbelo..." id="form_product-description" autofocus required></textarea>
    </div>
</div>