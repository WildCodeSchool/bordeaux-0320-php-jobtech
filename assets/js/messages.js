document.addEventListener('DOMContentLoaded', () => {
    const persons = document.getElementsByClassName('contact-line')

    if (persons) {
        for (let i = 0; i < persons.length; i++) {
            persons[i].addEventListener('click', () => {
                console.log('click');
                persons[i].innerHTML += '<span class="small">chargement ...</span>'
            })
        }
    }
})
