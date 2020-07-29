document.addEventListener('DOMContentLoaded', () => {
    const persons = document.getElementsByClassName('contact-line')

    if (persons) {
        for (let i = 0; i < persons.length; i++) {
            persons[i].addEventListener('click', () => {
                const user = persons[i].dataset.user
                persons[i].innerHTML += '<span class="small">chargement ...</span>'
                const url = '/messagerie/reset/' + user
                fetch(url)
                    .then(response => {
                        return response.json()
                    })
                    .then(json => {
                        window.location.href = '/messagerie/admin/' + user
                    })
            })
        }
    }
})
