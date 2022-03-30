// Service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then()
        .catch(err => console.log(`sw error init -> ${err}`))
}

// JS
const $n = {
    async subscribe(email, fileName, filePath) {
        await fetch(`private/model/userRequest?subscribe`, { method: "POST", body: JSON.stringify({ email }) }).then(e => e.text()).then(e => {
            const link = document.createElement("a");
            link.download = fileName;
            link.href = filePath;
            link.click();

            console.log(e);
            return e;
        })
    },
    async feedback(email, text) {
        await fetch(`private/model/userRequest?feedback`, { method: "POST", body: JSON.stringify({ text, email }) }).then(e => e.text()).then(e => {
            console.log("feedback responce -> ", e);
            return e;
        })
    },
    async saveItem(item) {
        await fetch(`private/model/userRequest?saveItem`, { method: "POST", body: JSON.stringify(item) }).then(e => e.text()).then(e => {
            console.log("saveItem responce -> ", e);
            return e;
        })
    },
    async itemAddFiles({ itemId, about }) {
        const files = await uploadFile({ multiple: true });

        await fetch(`private/model/userRequest?itemAddFiles`, { method: "POST", body: JSON.stringify({ files: files.map(e => ({ base64: e.base64, meta: e.meta })), info: { itemId, about } }) })
            .then(e => e.text())
            .then(e => {
                setTimeout(location.reload(), 400);
            });

    },
    itemDelete(id) {
        confirm('Delete item !?') && fetch(`private/model/userRequest?itemDelete=${id}`)
            .then(e => e.text())
            .then(e => {
                setTimeout(() => location.href = "/", 400);
            });
    },
    itemDeleteFile(filePath) {
        confirm('Delete file !?') && fetch(`private/model/userRequest?itemDeleteFile`, { method: "POST", body: JSON.stringify({ filePath }) })
            .then(e => e.text())
            .then(e => {
                setTimeout(location.reload(), 400);
            });
    }
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
