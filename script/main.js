// Service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then()
        .catch(err => console.log(`sw error init -> ${err}`))
}

// JS
const $n = {
    async feedback(email, text) {
        await fetch(`model/userRequest?feedback`, { method: "POST", body: JSON.stringify({ text, email }) }).then(e => e.text()).then(e => {
            console.log("feedback responce -> ", e);
            return e;
        })
    },
}


////// HELPERS //////
