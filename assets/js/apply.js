document.addEventListener('DOMContentLoaded', () => {
    const apply = document.getElementsByClassName('apply');
    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < apply.length; i++) {
        apply[i].addEventListener('click', (event) => {
            event.preventDefault();
            const { id } = apply[i].dataset;
            document.getElementById(`offer-${id}`).innerText = 'Vous avez déja postulé';
            const link = apply[i].dataset.href;
            fetch(link).then();
        });
    }
});
