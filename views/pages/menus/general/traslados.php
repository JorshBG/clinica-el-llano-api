<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Tablas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Productos</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">Productos</h1>
            <p class="mb-0">Tablas con los productos en existencia.</p>
        </div>
        <div>
            <a href="https://themesberg.com/docs/volt-bootstrap-5-dashboard/components/tables/"
               class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                          clip-rule="evenodd"></path>
                </svg>
                Info
            </a>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tablaProductos" class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                <h2>Productos - Médico: Germán Garmendia</h2>
                <tr>
                    <th class="border-0 rounded-start">ID</th>
                    <th class="border-0">Producto</th>
                    <th class="border-0">Cantidad</th>
                </tr>
                </thead>
                <tbody>
                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">1</a></td>
                    <td class="fw-bold d-flex align-items-center">

                        Aspirinas
                    </td>
                    <td>
                        3
                    </td>

                </tr>
                <!-- End of Item -->

                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">2</a></td>
                    <td class="fw-bold d-flex align-items-center">

                        Paracetamol
                    </td>
                    <td>
                        1
                    </td>


                </tr>
                <!-- End of Item -->

                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">3</a></td>
                    <td class="fw-bold d-flex align-items-center">
                        </svg>
                        Ibuprofeno
                    </td>
                    <td>
                        3
                    </td>


                </tr>
                <!-- End of Item -->

                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">4</a></td>
                    <td class="fw-bold d-flex align-items-center">
                        Amoxicilina
                    </td>
                    <td>
                        2
                    </td>

                </tr>
                <!-- End of Item -->

                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">5</a></td>
                    <td class="fw-bold d-flex align-items-center">
                        Acetaminofén
                    </td>
                    <td>
                        5
                    </td>

                </tr>
                <!-- End of Item -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded" id="tablaTraslados">
                <thead class="thead-light">
                <h2>Producto</h2>
                <tr>
                    <th class="border-0 rounded-start">ID</th>
                    <th class="border-0">Producto</th>
                    <th class="border-0">Cantidad</th>
                    <th class="border-0 rounded-end">Almacén</th>
                </tr>
                </thead>
                <tbody>
                <!-- Item -->
                <tr>
                    <td><a href="#" class="text-primary fw-bold">1</a></td>
                    <td class="fw-bold d-flex align-items-center">

                        <select name="prdt" id="pr0">
                            <optgroup label="Selecciona el producto">
                                <option value="1">Aspirina</option>
                                <option value="2">Ibuprofeno</option>
                                <option value="3">Paracetamol</option>
                                <option value="4">Amoxicilina</option>
                                <option value="5">Acetaminofén</option>
                                <option value="6">Loratadina</option>
                                <option value="7">Atorvastatina</option>
                                <option value="8">Enalapril</option>
                                <option value="9">Naproxeno</option>

                        </select>
                    </td>
                    <td>
                        <select name="prdtCant" id="pr1">
                            <optgroup label="Selecciona la cantidad">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                        </select>
                    </td>

                    <td>
                        <div class="custom-select" style="width:200px;">
                            <select>
                                <option value="0">Almacén General</option>
                                <option value="1">Hospital</option>
                                <option value="2">Farmacia</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <!-- End of Item -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card border-0 shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0 rounded">
                <thead class="thead-light">
                <h1>Traslados

                </h1>
                <tr>

                    <th class="border-0 rounded-start">ID Producto</th>
                    <th class="border-0">Almacén Origen</th>
                    <th class="border-0">Almacén Destino</th>
                    <th class="border-0">Estatus</th>
                    <th class="border-0">Opciones</th>
                    <th class="border-0">ID Usuario</th>
                    <!--
                   <th class="border-0">Widgets</th>
                   <th class="border-0 rounded-end">Widgets Change</th>
                   -->
                </tr>
                </thead>
                <tbody>
                <!-- Item -->
                <tr>
                    <td class="border-0">

                        <div><span class="h6">1</span></div>
                        </a>
                    </td>
                    <td class="border-0 fw-bold">Almacén General</td>
                    <td>Hospital</td>

                    <td class="text-danger">
                        Denegado
                    </td>
                    <td class="border-0">

                        <select name="Opciones">


                            <option class="text-danger">Cancelado</option>

                            <option class="text-danger">Denegado</option>

                            <option class="text-warning">Parcial</option>

                            <option class="text-success">Completado</option>


                        </select>
                    </td>
                    <td class="border-0 fw-bold">
                        8
                    </td>

                </tr>
                <!-- End of Item -->

                <tr>
                    <td class="border-0">

                        <div><span class="h6">1</span></div>
                        </a>
                    </td>
                    <td class="border-0 fw-bold">Farmacia</td>
                    <td> Hospital</td>

                    <td class="text-danger">
                        Cancelado
                    </td>
                    <td class="border-0">

                        <select name="Opciones">


                            <option class="text-danger">Cancelado</option>

                            <option class="text-danger">Denegado</option>

                            <option class="text-warning">Parcial</option>

                            <option class="text-success">Completado</option>

                        </select>
                    </td>
                    <td class="border-0 fw-bold">
                        4
                    </td>

                </tr>

                <tr>
                    <td class="border-0">

                        <div><span class="h6">1</span></div>
                        </a>
                    </td>
                    <td class="border-0 fw-bold">Hospital</td>
                    <td>
                        Almacén General
                    </td>
                    <td class="text-success">
                        Completado
                    </td>
                    <td class="border-0">

                        <select name="Opciones">

                            <option class="text-danger">Cancelado</option>

                            <option class="text-danger">Denegado</option>

                            <option class="text-warning">Parcial</option>

                            <option class="text-success">Completado</option>

                        </select>
                    </td>
                    <td class="border-0 fw-bold">
                        3
                    </td>

                </tr>

                <tr>
                    <td class="border-0">

                        <div><span class="h6">1</span></div>
                        </a>
                    </td>
                    <td class="border-0 fw-bold">Farmacia</td>
                    <td>
                        Almacén General
                    </td>
                    <td class="text-warning">
                        Parcial
                    </td>
                    <td class="border-0">

                        <select name="Opciones">

                            <option class="text-danger">Cancelado</option>

                            <option class="text-danger">Denegado</option>

                            <option class="text-warning">Parcial</option>

                            <option class="text-success">Completado</option>

                        </select>
                    </td>
                    <td class="border-0 fw-bold">
                        3
                    </td>

                </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>
