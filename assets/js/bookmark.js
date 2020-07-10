document.addEventListener('DOMContentLoaded', () => {
    const bookmark = document.getElementsByClassName('bookmark');
    // eslint-disable-next-line no-plusplus
    for (let i = 0; i < bookmark.length; i++) {
        bookmark[i].addEventListener('click', (event) => {
            event.preventDefault();
            const { id } = bookmark[i].dataset;
            document.getElementById(`bookmark-card-${id}`).classList.toggle('heart');
            document.getElementById(`bookmark-modal-${id}`).classList.toggle('heart');
            const link = bookmark[i].dataset.href;
            fetch(link).then();
        });
    }
});
