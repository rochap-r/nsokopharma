<x-layouts.app :title="__('Dashboard')">
    <!-- Main Content Container -->
    <div class="p-6 max-w-full overflow-x-hidden">
        <!-- Alerts Section -->
        <div class="mb-6 space-y-3">
            <div class="bg-red-50 dark:bg-red-900/10 border-l-4 border-red-500 dark:border-red-400 p-4 fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle h-5 w-5 text-red-500 dark:text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 dark:text-red-300">
                            <span class="font-semibold">Attention:</span> 5 produits sont en rupture de stock. <a href="#" class="font-medium underline text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">Approvisionner maintenant</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/10 border-l-4 border-yellow-500 dark:border-yellow-400 p-4 fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle h-5 w-5 text-yellow-500 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700 dark:text-yellow-300">
                            <span class="font-semibold">Alerte:</span> 3 produits approchent de leur date de péremption. <a href="#" class="font-medium underline text-yellow-600 dark:text-yellow-400 hover:text-yellow-500 dark:hover:text-yellow-300">Voir les détails</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Sales Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm group hover:shadow-md transition-all duration-300">
                <div class="p-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ventes aujourd'hui</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-white">$1,245.00</p>
                            <p class="mt-0.5 text-xs text-green-600 dark:text-green-400">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span class="font-semibold">+12%</span> vs hier
                            </p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-green-100 dark:bg-green-900/20 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                            <i class="fas fa-shopping-cart text-green-600 dark:text-green-400 text-base"></i>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 dark:border-gray-700">
                    <a href="#" class="block px-3 py-2 text-xs font-medium text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-b-lg">
                        Voir les détails
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Products in Stock Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm group hover:shadow-md transition-all duration-300">
                <div class="p-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produits en stock</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-white">342</p>
                            <p class="mt-0.5 text-xs text-red-600 dark:text-red-400">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <span class="font-semibold">5 en rupture</span>
                            </p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                            <i class="fas fa-pills text-blue-600 dark:text-blue-400 text-base"></i>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 dark:border-gray-700">
                    <a href="#" class="block px-3 py-2 text-xs font-medium text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-b-lg">
                        Gérer le stock
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Expiring Products Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm group hover:shadow-md transition-all duration-300">
                <div class="p-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produits expirant</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-white">8</p>
                            <p class="mt-0.5 text-xs text-yellow-600 dark:text-yellow-400">
                                <i class="fas fa-clock mr-1"></i>
                                <span class="font-semibold">3 cette semaine</span>
                            </p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-yellow-100 dark:bg-yellow-900/20 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                            <i class="fas fa-hourglass-half text-yellow-600 dark:text-yellow-400 text-base"></i>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 dark:border-gray-700">
                    <a href="#" class="block px-3 py-2 text-xs font-medium text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-b-lg">
                        Voir les produits expirants
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Customer Visits Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm group hover:shadow-md transition-all duration-300">
                <div class="p-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Clients aujourd'hui</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900 dark:text-white">42</p>
                            <p class="mt-0.5 text-xs text-green-600 dark:text-green-400">
                                <i class="fas fa-arrow-up mr-1"></i>
                                <span class="font-semibold">+5%</span> vs hier
                            </p>
                        </div>
                        <div class="h-9 w-9 rounded-full bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center transform group-hover:scale-110 transition-transform">
                            <i class="fas fa-users text-purple-600 dark:text-purple-400 text-base"></i>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 dark:border-gray-700">
                    <a href="#" class="block px-3 py-2 text-xs font-medium text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-b-lg">
                        Voir les statistiques clients
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Charts and Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Sales Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-chart-line mr-2 text-primary-light dark:text-primary-dark"></i>
                        Tendances des ventes
                    </h2>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-xs font-medium rounded-md bg-primary-light dark:bg-primary-dark text-white hover:bg-primary-dark dark:hover:bg-primary-light transition-colors">
                            Ce mois
                        </button>
                        <button class="px-3 py-1 text-xs font-medium rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            Cette semaine
                        </button>
                        <button class="px-3 py-1 text-xs font-medium rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            Aujourd'hui
                        </button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i class="fas fa-trophy mr-2 text-primary-light dark:text-primary-dark"></i>
                        Produits les plus vendus
                    </h2>
                    <a href="#" class="text-sm font-medium text-primary-light dark:text-primary-dark hover:text-primary-dark dark:hover:text-primary-light transition-colors">
                        Voir tout
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Catégorie</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ventes</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <i class="fas fa-pills text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Paracétamol 500mg</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Antidouleur</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">156</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">
                                                42 en stock
                                            </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <i class="fas fa-pills text-purple-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Amoxicilline 250mg</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Antibiotique</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">98</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200">
                                                12 en stock
                                            </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <i class="fas fa-pills text-green-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">Vitamine C 100mg</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">Vitamine</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">87</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200">
                                                Rupture
                                            </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Stock Overview Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5 mb-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-box-open mr-2 text-primary-light dark:text-primary-dark"></i>
                    Aperçu du stock
                </h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un produit..." class="w-64 px-4 py-2 text-sm rounded-lg border border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white">
                        <i class="fas fa-search absolute right-3 top-2.5 text-gray-400"></i>
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-xs font-medium rounded-md bg-primary-light dark:bg-primary-dark text-white hover:bg-primary-dark dark:hover:bg-primary-light transition-colors">
                            Filtrer
                        </button>
                        <button class="px-3 py-1 text-xs font-medium rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom du produit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Catégorie</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock actuel</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date de péremption</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <i class="fas fa-pills text-blue-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Paracétamol 500mg</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">PHA-001</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Antidouleur</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">42</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">15/12/2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">
                                            Bon
                                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <button class="text-primary-light dark:text-primary-dark hover:text-primary-dark dark:hover:text-primary-light mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <i class="fas fa-pills text-purple-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Amoxicilline 250mg</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">PHA-002</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Antibiotique</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">12</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">30/11/2023</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200">
                                            Faible
                                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <button class="text-primary-light dark:text-primary-dark hover:text-primary-dark dark:hover:text-primary-light mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <i class="fas fa-pills text-red-500 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Vitamine C 100mg</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">PHA-003</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">Vitamine</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">0</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-400">15/01/2024</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200">
                                            Rupture
                                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            <button class="text-primary-light dark:text-primary-dark hover:text-primary-dark dark:hover:text-primary-light mr-3">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tenant Information Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-5">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations du tenant</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-3">Détails de la pharmacie</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de la pharmacie</label>
                            <p class="text-sm text-gray-900 dark:text-white">Pharmacie du Peuple</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse</label>
                            <p class="text-sm text-gray-900 dark:text-white">123 Avenue Lumumba, Kolwezi, RDC</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                            <p class="text-sm text-gray-900 dark:text-white">+243 81 234 5678</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-md font-medium text-gray-700 dark:text-gray-300 mb-3">Gestion des utilisateurs</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Utilisateurs actifs</label>
                            <p class="text-sm text-gray-900 dark:text-white">3/5</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dernière connexion</label>
                            <p class="text-sm text-gray-900 dark:text-white">Aujourd'hui, 10:45</p>
                        </div>
                        <div>
                            <button class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light focus:outline-none">
                                <i class="fas fa-user-plus mr-1"></i> Ajouter un utilisateur
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
