// Service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then()
        .catch(err => console.log(`sw error init -> ${err}`))
}

// JS
const $n = {
    // resolves to 'success' or an error message
    feedback(email, text, website) {
        return fetch(`model/userRequest?feedback`, { method: "POST", body: JSON.stringify({ text, email, website }) })
            .then(e => e.text())
            .catch(e => `${e}`)
    },

}


////// HELPERS //////
