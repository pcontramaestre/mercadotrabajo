<?php

/**
 * Data recibied
 * 
 * @param array $dataCompanyProfile
 * @param array $dataJobsApplied
 */


require_once 'views/components/html/jobsAppliedCompany.php';
$controllerJobsApplied = new JobsAppliedCompany('TABLE', $dataJobsApplied);

include_once 'config/config.php';
include_once 'views/company/header.php';
?>

<main class="flex-1 md:ml-64 md:pl-0 pl-0 pt-16 md:pt-0">
    <div class="p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Title -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800"><?php echo $dataCompanyProfile[0]['name'] ?></h1>
                <p class="text-gray-500 mt-1">Ready to jump back in?</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Applied Jobs -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-50 p-3 rounded-md">
                            <i data-lucide="briefcase" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Posted Jobs</div>
                            <div class="text-xl font-bold text-blue-600">2</div>
                        </div>
                    </div>
                </div>

                <!-- Job Alerts -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-red-50 p-3 rounded-md">
                            <i data-lucide="file-text" class="w-6 h-6 text-red-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Application</div>
                            <div class="text-xl font-bold text-red-600">2</div>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-yellow-50 p-3 rounded-md">
                            <i data-lucide="message-square" class="w-6 h-6 text-yellow-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Messages</div>
                            <div class="text-xl font-bold text-yellow-600">2</div>
                        </div>
                    </div>
                </div>

                <!-- Shortlist -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-green-50 p-3 rounded-md">
                            <i data-lucide="bookmark" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Shortlist</div>
                            <div class="text-xl font-bold text-green-600">3</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Views Chart -->
                <div class="bg-white rounded-lg shadow-sm p-6 col-span-2">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Your Profile Views</h3>
                        <div class="relative">
                            <select id="time-range" class="appearance-none bg-white border border-gray-300 rounded-md py-2 pl-3 pr-8 text-sm font-medium text-gray-700 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="6">Last 6 Months</option>
                                <option value="3">Last 3 Months</option>
                                <option value="1">Last Month</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="h-[300px]">
                        <canvas id="profile-views-chart"></canvas>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold mb-6">Notifications</h3>
                    <div class="space-y-4">
                        <!-- Notification Item 1 -->
                        <div class="flex items-start gap-3">
                            <div class="p-1 rounded-full bg-blue-100">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    <i data-lucide="mail" class="w-4 h-4 text-blue-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">Henry Wilson <span class="font-normal text-gray-500">applied for a job</span></div>
                                <div class="text-sm text-blue-600">Product Designer</div>
                            </div>
                        </div>

                        <!-- Notification Item 2 -->
                        <div class="flex items-start gap-3">
                            <div class="p-1 rounded-full bg-green-100">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    <i data-lucide="mail" class="w-4 h-4 text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">Raul Costa <span class="font-normal text-gray-500">applied for a job</span></div>
                                <div class="text-sm text-green-600">Product Manager, Risk</div>
                            </div>
                        </div>

                        <!-- Notification Item 3 -->
                        <div class="flex items-start gap-3">
                            <div class="p-1 rounded-full bg-blue-100">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    <i data-lucide="mail" class="w-4 h-4 text-blue-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">Jack Milk <span class="font-normal text-gray-500">applied for a job</span></div>
                                <div class="text-sm text-blue-600">Technical Architect</div>
                            </div>
                        </div>

                        <!-- Notification Item 4 -->
                        <div class="flex items-start gap-3">
                            <div class="p-1 rounded-full bg-green-100">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    <i data-lucide="mail" class="w-4 h-4 text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">Michel Arian <span class="font-normal text-gray-500">applied for a job</span></div>
                                <div class="text-sm text-green-600">Software Engineer</div>
                            </div>
                        </div>

                        <!-- Notification Item 5 -->
                        <div class="flex items-start gap-3">
                            <div class="p-1 rounded-full bg-blue-100">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden flex items-center justify-center">
                                    <i data-lucide="mail" class="w-4 h-4 text-blue-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium">Wade Warren <span class="font-normal text-gray-500">applied for a job</span></div>
                                <div class="text-sm text-blue-600">Web Developer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Applicants -->
            <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                <h3 class="text-lg font-semibold mb-6">Recent Applicants</h3>

                <?php
                    echo $controllerJobsApplied->render();
                ?>

                <?php 
                if (empty($dataJobsApplied)) {
                    echo '<div class="text-center text-gray-500 py-4">No recent job applications to display.</div>';
                }
                ?>
               
            </div>
        </div>
    </div>
</main>


<script>
    // Inicializar los iconos de Lucide
    lucide.createIcons();

    // Toggle del menú móvil
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });

    // Cerrar el sidebar en móvil cuando se hace clic fuera de él
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');

        if (window.innerWidth < 768 &&
            !sidebar.contains(event.target) &&
            !mobileMenuToggle.contains(event.target)) {
            sidebar.classList.add('hidden');
        }
    });

    // Inicializar el gráfico de vistas de perfil
    const ctx = document.getElementById('profile-views-chart').getContext('2d');
    const profileViewsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Profile Views',
                data: [200, 130, 220, 360, 210, 250],
                fill: false,
                borderColor: '#3b82f6',
                tension: 0.3,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 100,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        stepSize: 50
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 10,
                    cornerRadius: 4
                }
            }
        }
    });

    // Cambiar datos del gráfico según el rango de tiempo seleccionado
    document.getElementById('time-range').addEventListener('change', function() {
        const value = this.value;
        let data;

        if (value === '3') {
            data = [180, 220, 360, 210, 250, 300];
        } else if (value === '1') {
            data = [210, 250, 300, 280, 320, 350];
        } else {
            data = [200, 130, 220, 360, 210, 250];
        }

        profileViewsChart.data.datasets[0].data = data;
        profileViewsChart.update();
    });

    // Ajustar el sidebar en cambios de tamaño de ventana
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    });

    // Inicializar el sidebar como oculto en móvil al cargar
    if (window.innerWidth < 768) {
        document.getElementById('sidebar').classList.add('hidden');
    }
</script>
<?php
include_once 'views/company/footer.php';
?>