import { Chart, registerables } from 'chart.js';
import './bootstrap';
import TomSelect from 'tom-select';
import initAdminDashboardChart from './components/admin-dashboard';

Chart.register(...registerables)

window.TomSelect = TomSelect;
window.Chart = Chart;

document.addEventListener('DOMContentLoaded', () => {
    initAdminDashboardChart()
})