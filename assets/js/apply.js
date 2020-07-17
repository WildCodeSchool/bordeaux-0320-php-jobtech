document.addEventListener('DOMContentLoaded', () => {
    const apply = document.getElementsByClassName('apply');
    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < apply.length; i++) {
        apply[i].addEventListener('click', (event) => {
            event.preventDefault();
            const link = apply[i].dataset.href;
            fetch(link).then();
        });
    }
});
