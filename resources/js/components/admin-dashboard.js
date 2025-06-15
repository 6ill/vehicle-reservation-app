export default function initAdminDashboardChart() {
    
    const monthlyCtxElement = document.getElementById('monthlyReservationsChart');
    if (!monthlyCtxElement) {
        return; 
    }

    const byTypeCtxElement = document.getElementById('reservationsByTypeChart');

    const chartDataUrl = monthlyCtxElement.dataset.url;

    fetch(chartDataUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const monthlyCtx = monthlyCtxElement.getContext('2d');
            new window.Chart(monthlyCtx, {
                type: 'bar',
                data: {
                    labels: data.monthlyReservations.labels,
                    datasets: [{
                        label: 'Jumlah Reservasi',
                        data: data.monthlyReservations.data,
                        backgroundColor: 'rgba(79, 70, 229, 0.8)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            const byTypeCtx = byTypeCtxElement.getContext('2d');
            new window.Chart(byTypeCtx, {
                type: 'doughnut',
                data: {
                    labels: data.reservationsByType.labels.map(label => label.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())),
                    datasets: [{
                        label: 'Jumlah Pemakaian',
                        data: data.reservationsByType.data,
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                            'rgb(255, 99, 132)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: { responsive: true }
            });
        })
        .catch(error => console.error('Error fetching or rendering chart data:', error));
}