import Chart from 'chart.js';

document.addEventListener('DOMContentLoaded', () => {
    const url = document.getElementById('candidate').getAttribute('data-url');
    fetch(url)
        .then((response) => {
            response.json()
                .then((data) => {
                    if (data.pro) {
                        const ctxPro = document.getElementById('myChartPro')
                            .getContext('2d');
                        const myChartPro = new Chart(ctxPro, {
                            type: 'radar',
                            data: {
                                labels: data.pro.ability,
                                datasets: [
                                    {
                                        label: 'Notes',
                                        data: data.pro.score,
                                        backgroundColor: ['rgba(251, 236, 81, 0.5)'],
                                        borderWidth: 1,
                                    },
                                ],
                            },
                            options: {
                                tooltips: {
                                    enabled: false,
                                },
                                legend: {
                                    display: false,
                                },
                                scale: {
                                    ticks: {
                                        beginAtZero: true,
                                        display: false,
                                    },
                                },
                            },
                        });
                    }

                    if (data.perso) {
                        const ctxPerso = document.getElementById('myChartPerso')
                            .getContext('2d');
                        const myChartPerso = new Chart(ctxPerso, {
                            type: 'radar',
                            data: {
                                labels: data.perso.ability,
                                datasets: [
                                    {
                                        label: 'Notes',
                                        data: data.perso.score,
                                        backgroundColor: ['rgba(101, 141, 251, 0.5)'],
                                        borderWidth: 1,
                                    },
                                ],
                            },
                            options: {
                                tooltips: {
                                    enabled: false,
                                },
                                legend: {
                                    display: false,
                                },
                                scale: {
                                    ticks: {
                                        beginAtZero: true,
                                        display: false,
                                    },
                                },
                            },
                        });
                    }
                });
        });
});
