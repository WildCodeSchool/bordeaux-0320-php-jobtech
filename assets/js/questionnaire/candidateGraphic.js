import Chart from 'chart.js';

document.addEventListener('DOMContentLoaded', () => {
    const url = document.getElementById('candidate')
        .getAttribute('data-url');
    let pro = null;
    let perso = null;
    let postedAt = null;
    fetch(url)
        .then((response) => {
            response.json()
                .then((data) => {
                    pro = data.pro;
                    perso = data.perso;
                    postedAt = data.date;

                    const ctxPro = document.getElementById('myChartPro')
                        .getContext('2d');
                    const myChartPro = new Chart(ctxPro, {
                        type: 'radar',
                        data: {
                            labels: pro.ability,
                            datasets: [
                                {
                                    label: 'Notes',
                                    data: pro.score,
                                    backgroundColor: ['rgba(251, 236, 81, 0.5)'],
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            scale: {
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                },
                            },
                        },
                    });

                    const ctxPerso = document.getElementById('myChartPerso')
                        .getContext('2d');
                    const myChartPerso = new Chart(ctxPerso, {
                        type: 'radar',
                        data: {
                            labels: perso.ability,
                            datasets: [
                                {
                                    label: 'Notes',
                                    data: perso.score,
                                    backgroundColor: ['rgba(101, 141, 251, 0.5)'],
                                    borderWidth: 1,
                                },
                            ],
                        },
                        options: {
                            scale: {
                                ticks: {
                                    beginAtZero: true,
                                    max: 100,
                                },
                            },
                        },
                    });
                });
        });
});
