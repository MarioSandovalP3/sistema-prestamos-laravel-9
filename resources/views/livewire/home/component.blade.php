<section class="container mb-5">
    <div class="row">
        <div class="col-12 col-lg-4 col-md-4 col-xl-4 mt-3">
            <div class="card  border-top" style="width: 20rem; height: 13rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between p-1 m-1">
                        <div>
                            <h4>Usuarios</h4>
                            <h5 class="text-black h5">{{ $users }}</h5>
                        </div>
                        <div>
                            <img src="{{ asset('storage/images/users.png') }}" class="img-fluid d-inline">
                        </div>
                    </li>
                </ul>
                <div class="card-body">
                    <div><span class="fs-3">Activos: {{ $users_active }}</span></div>
                    <div><span class="fs-3">Inactivos: {{ $users_inactive }}</span></div>
                </div>
                <div class="mt-2 p-3 text-right">
                    <a href="{{ route('users') }}"
                        class="btn btn-border border btn-outline-info btn-responsive close-modal">
                    <b>Ver</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-xl-4 mt-3">
            <div class="card  border-top" style="width: 20rem; height: 13rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between p-1 m-1">
                        <div>
                            <h4>Clientes</h4>
                            <h5 class="text-black h5">{{ $clients }}</h5>
                        </div>
                        <div>
                            <img src="{{ asset('storage/images/clients.png') }}" class="img-fluid d-inline">
                        </div>
                    </li>
                </ul>
                <div class="card-body">
                </div>
                <div class="mt-2 p-3 text-right">
                    <a href="{{ route('partners') }}"
                        class="btn btn-border border btn-outline-info btn-responsive close-modal">
                    <b>Ver</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-xl-4 mt-3">
            <div class="card  border-top" style="width: 20rem; height: 13rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between p-1 m-1">
                        <div>
                            <h4>Prestamos</h4>
                            <h5 class="text-black h5">{{ $loans }}</h5>
                        </div>
                        <div>
                            <img src="{{ asset('storage/images/loans.png') }}" class="img-fluid d-inline">
                        </div>
                    </li>
                </ul>
                <div class="card-body">
                    <div><span class="fs-3">Completados: {{ $loans_complete }}</span></div>
                    <div><span class="fs-3">Pendientes: {{ $loans_pending }}</span></div>
                    <div><span class="fs-3">Cancelados: {{ $loans_cancel }}</span></div>
                </div>
                <div class="mt-2 p-3 text-right">
                    <a href="{{ route('loans') }}"
                        class="btn btn-border border btn-outline-info btn-responsive close-modal">
                    <b>Ver</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row sales layout-top-spacing">
        <div id="chartLine" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="widget widget-chart-one">
                <div class="widget-content" >
                    <canvas id="PartnersMes" ></canvas>
                </div>
            </div>
        </div>
        <div id="chartLine" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
            <div class="widget widget-chart-one">
                <div class="widget-content" >
                    <canvas id="LoansMes" ></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script type="text/javascript">
        const cDataPartner = JSON.parse('<?php echo $partner; ?>')
        const ctxPartner = document.getElementById('PartnersMes').getContext('2d');
        const PartnersMes = new Chart(ctxPartner, {
            type: 'bar',
            data: {
                labels: cDataPartner.labelPartner,
                datasets: [{
                    label: 'CLIENTES POR MES',
                    data: cDataPartner.partner,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    title: {
                        display: true,
                        text: (ctxPartner) => {
                            // Verificar y convertir a número si es necesario
                            let total = parseFloat(cDataPartner.dataTotalPartner);
                            if (isNaN(total)) {
                                total = 0; // Manejo de error si no es un número válido
                            }
                            return 'TOTAL CLIENTES: ' + total;
                        }
                    },
                },
        
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
            
        });
        
        ///////////////////////////////////////////////////////////////////////
        
        const cData = JSON.parse('<?php echo $data; ?>')
        const ctx = document.getElementById('LoansMes').getContext('2d');
        const LoansMes = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: cData.label,
                datasets: [{
                    label: 'GANANCIAS DEL MES',
                    data: cData.data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    title: {
                        display: true,
                        text: (ctx) => {
                            // Verificar y convertir a número si es necesario
                            let total = parseFloat(cData.dataMesTotal);
                            if (isNaN(total)) {
                                total = 0; // Manejo de error si no es un número válido
                            }
                            return 'TOTAL GANANCIAS: US$ ' + total.toFixed(2);
                        }
                    },
                },  
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
            
        });
        
    </script>
</section>
