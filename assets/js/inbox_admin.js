document.addEventListener('DOMContentLoaded', ()=>{
    const contacts = document.getElementsByClassName('contact-box');
    for (let i = 0; i < contacts.length; i += 1) {
        contacts[i].addEventListener('click', ()=>{
            const url = contacts[i].getAttribute('data-url');
            window.location.href = url;
        });
    }
})
