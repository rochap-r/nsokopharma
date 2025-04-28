

    // Dark mode toggle functionality
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    darkModeToggle.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));

    // Update chart colors when mode changes
    updateChartColors();
});

    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
    document.documentElement.classList.add('dark');
}

    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-collapsed');
    mainContent.classList.toggle('ml-64');
    mainContent.classList.toggle('ml-20');
});

    // Dropdown menus
    const notificationBtn = document.getElementById('notification-btn');
    const notificationDropdown = document.getElementById('notification-dropdown');
    const userMenuBtn = document.getElementById('user-menu-btn');
    const userMenuDropdown = document.getElementById('user-menu-dropdown');

    notificationBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    notificationDropdown.classList.toggle('hidden');
    userMenuDropdown.classList.add('hidden');
});

    userMenuBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    userMenuDropdown.classList.toggle('hidden');
    notificationDropdown.classList.add('hidden');
});

    // Close dropdowns when clicking outside
    document.addEventListener('click', () => {
    notificationDropdown.classList.add('hidden');
    userMenuDropdown.classList.add('hidden');
});

    // Prevent dropdowns from closing when clicking inside them
    notificationDropdown.addEventListener('click', (e) => e.stopPropagation());
    userMenuDropdown.addEventListener('click', (e) => e.stopPropagation());

    // Sales Chart
    const salesChartCtx = document.getElementById('salesChart').getContext('2d');
    let salesChart;

    function createChart() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#E5E7EB' : '#111827';
    const gridColor = isDarkMode ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.05)';

    salesChart = new Chart(salesChartCtx, {
    type: 'line',
    data: {
    labels: ['1 Oct', '2 Oct', '3 Oct', '4 Oct', '5 Oct', '6 Oct', '7 Oct'],
    datasets: [{
    label: 'Ventes (en $)',
    data: [450, 600, 750, 800, 950, 1100, 1250],
    backgroundColor: 'rgba(59, 130, 246, 0.05)',
    borderColor: '#3b82f6',
    borderWidth: 2,
    tension: 0.4,
    fill: true,
    pointBackgroundColor: '#fff',
    pointBorderColor: '#3b82f6',
    pointBorderWidth: 2,
    pointRadius: 4,
    pointHoverRadius: 6
}]
},
    options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
    legend: {
    display: false
},
    tooltip: {
    backgroundColor: isDarkMode ? '#1F2937' : '#FFFFFF',
    titleColor: textColor,
    bodyColor: textColor,
    borderColor: isDarkMode ? '#4B5563' : '#E5E7EB',
    borderWidth: 1,
    displayColors: false,
    padding: 12,
    callbacks: {
    label: function(context) {
    return 'Ventes: $' + context.parsed.y;
}
}
}
},
    scales: {
    x: {
    grid: {
    display: false
},
    ticks: {
    color: textColor
}
},
    y: {
    grid: {
    color: gridColor
},
    ticks: {
    color: textColor,
    callback: function(value) {
    return '$' + value;
}
}
}
}
}
});
}

    function updateChartColors() {
    if (salesChart) {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#E5E7EB' : '#111827';
    const gridColor = isDarkMode ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.05)';

    salesChart.options.scales.x.ticks.color = textColor;
    salesChart.options.scales.y.ticks.color = textColor;
    salesChart.options.scales.y.grid.color = gridColor;
    salesChart.options.plugins.tooltip.backgroundColor = isDarkMode ? '#1F2937' : '#FFFFFF';
    salesChart.options.plugins.tooltip.titleColor = textColor;
    salesChart.options.plugins.tooltip.bodyColor = textColor;
    salesChart.options.plugins.tooltip.borderColor = isDarkMode ? '#4B5563' : '#E5E7EB';

    salesChart.update();
}
}

    // Initialize chart when page loads
    document.addEventListener('DOMContentLoaded', createChart);
