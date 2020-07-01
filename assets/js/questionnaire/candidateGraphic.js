import Chart from 'chart.js';

const ctxPro = document.getElementById('myChartPro').getContext('2d');
const myChartPro = new Chart(ctxPro, {
    type: 'radar',
    data: {
        labels: ['Capacité d\'Orientation', 'Capacité d\'Influence', 'Capacité d\'Organisation', 'Capacité Relationelle'],
        datasets: [{
            label: 'Notes',
            data: [68, 55, 87, 70],
            backgroundColor: [
                'rgba(251, 236, 81, 0.5)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1,
        }],
    },
    options: {
        scale: {
            ticks: {
                beginAtZero: true,
            },
        },
    },
});
const ctxPerso = document.getElementById('myChartPerso').getContext('2d');
const myChartPerso = new Chart(ctxPerso, {
    type: 'radar',
    data: {
        labels: ['Initiative', 'Prise de décision', 'Flexibilité', 'Résistance au stress', 'Ambition', 'Indépendance', 'Capacité de persévèrence', 'Orientation, Résultat', 'Disposition à apprendre', 'Implication', 'Exactitude'],
        datasets: [{
            label: 'Notes',
            data: [10, 47, 73, 85, 92, 83, 47, 28, 59, 80, 33],
            backgroundColor: [
                'rgba(101, 141, 251, 0.5)',
            ],
            pointBackgroundColor: [
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',
                'rgba(255, 0, 22, 0.5)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1,
        }],
    },
    options: {
        scale: {
            ticks: {
                beginAtZero: true,
            },
        },
    },
});
