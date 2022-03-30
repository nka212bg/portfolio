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
// upload files
async function uploadFile({ multiple, allowedExtensions } = {}) {
    // creade image uplad ui
    let fileInput = document.createElement("INPUT");
    fileInput.type = "file";
    fileInput.multiple = multiple;

    // get the files and convert to base64
    return await new Promise((resolve, reject) => {
        fileInput.click();
        fileInput.addEventListener("change", () => {
            const tempFiles = [];

            ([...fileInput.files] || []).forEach((f, index) => {
                const isLast = index >= fileInput.files.length - 1;

                let fileExtention = f.name.split(".").pop().toLowerCase();
                if (allowedExtensions && !allowedExtensions.includes(fileExtention)) {
                    return isLast && resolve(tempFiles);
                }

                const reader = new FileReader();
                reader.onload = function () {
                    const file = { file: f, base64: null, meta: { lastModified: f.lastModified, name: f.name, size: f.size, type: f.type } };
                    // if (/\.(jpe?g|A?PNG|GIF|AVIF|SVG|WebP|BMP|ICO|TIFF)$/i.test(f.name)) {
                    file.base64 = reader.result
                    // };
                    tempFiles.push(file);
                    isLast && resolve(tempFiles);
                }
                reader.readAsDataURL(f);
                reader.onerror = function (error) {
                    isLast && resolve(tempFiles);
                };

            });
        }, { once: true });
    });
};


function objToFormData(obj) {
    !Array.isArray(obj) && (obj = Object.assign({}, obj));

    const formData = new FormData();
    for (let i in obj) {
        formData.append(i, obj[i]);
    }

    return formData;
}
