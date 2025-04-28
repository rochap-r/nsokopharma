// Dark mode toggle functionality
const darkModeToggle = document.getElementById('dark-mode-toggle');
const htmlElement = document.documentElement;

darkModeToggle.addEventListener('click', () => {
    htmlElement.classList.toggle('dark');
    updateChartColors();
});

// Sidebar toggle functionality
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const sidebarToggle = document.getElementById('sidebar-toggle');
const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
const header = document.getElementById('header');

function toggleSidebar() {
    sidebar.classList.toggle('sidebar-collapsed');
    mainContent.classList.toggle('ml-20');
    mainContent.classList.toggle('ml-64');
}

function toggleMobileSidebar() {
    sidebar.classList.toggle('translate-x-0');
    sidebar.classList.toggle('-translate-x-full');
}

sidebarToggle?.addEventListener('click', toggleSidebar);
mobileSidebarToggle?.addEventListener('click', toggleMobileSidebar);

// Close sidebar when clicking outside on mobile
document.addEventListener('click', (e) => {
    const isMobile = window.innerWidth < 1024; // lg breakpoint
    if (isMobile && 
        !sidebar.contains(e.target) && 
        !mobileSidebarToggle.contains(e.target)) {
        sidebar.classList.remove('translate-x-0');
        sidebar.classList.add('-translate-x-full');
    }
});

// Tooltip positioning
document.querySelectorAll('.nav-item').forEach(item => {
    const tooltip = item.querySelector('.nav-tooltip');
    
    item.addEventListener('mouseenter', () => {
        if (!sidebar.classList.contains('sidebar-collapsed')) return;
        
        const rect = item.getBoundingClientRect();
        tooltip.style.top = `${rect.top}px`;
        tooltip.style.left = `${rect.right + 10}px`;
    });
});

// User menu toggle
const userMenuBtn = document.getElementById('user-menu-btn');
const userMenu = document.getElementById('user-menu');

userMenuBtn?.addEventListener('click', () => {
    userMenu.classList.toggle('hidden');
});

// Notification toggle
const notificationBtn = document.getElementById('notification-btn');
const notificationMenu = document.getElementById('notification-menu');

notificationBtn?.addEventListener('click', () => {
    notificationMenu.classList.toggle('hidden');
});

// Chart functionality
function createChart() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    const textColor = isDarkMode ? '#E5E7EB' : '#111827';
    const gridColor = isDarkMode ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.05)';

    const ctx = document.getElementById('sales-chart')?.getContext('2d');
    if (!ctx) return;

    window.salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Ventes 2024',
                data: [3000, 3500, 2800, 4200, 3800, 4500],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor
                    }
                },
                x: {
                    grid: {
                        color: gridColor
                    },
                    ticks: {
                        color: textColor
                    }
                }
            }
        }
    });
}

function updateChartColors() {
    if (window.salesChart) {
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? '#E5E7EB' : '#111827';
        const gridColor = isDarkMode ? 'rgba(229, 231, 235, 0.1)' : 'rgba(0, 0, 0, 0.05)';

        window.salesChart.options.scales.x.grid.color = gridColor;
        window.salesChart.options.scales.y.grid.color = gridColor;
        window.salesChart.options.scales.x.ticks.color = textColor;
        window.salesChart.options.scales.y.ticks.color = textColor;
        window.salesChart.update();
    }
}

// Initialize chart when page loads
document.addEventListener('DOMContentLoaded', createChart);
