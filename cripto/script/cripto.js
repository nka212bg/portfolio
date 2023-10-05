// https://pieroxy.net/blog/pages/lz-string/demo.html

async function decriptPasswords(pass) {
    if (localStorage.rawData) {
        const { error, data } = cripto(pass).undo(localStorage.rawData);
        if (error) return { error };

        try {
            return { data: JSON.parse(data) };
        } catch (error) {
            return { error: "wrong_salt" };
        }
    } else {
        return await importPasswords(pass);
    }
}

async function importPasswords(pass) {
    const files = await selectFile();
    if (!files?.length) return { error: "no_file" };

    let stream = await files[0].text();

    if (/\w,/.test(stream)) {
        const obj = csvObject(stream);
        let rawData = cripto(pass).do(JSON.stringify(obj));

        localStorage.rawData = rawData;
        return { data: obj };
    } else {
        localStorage.rawData = stream;
        const { error, data } = cripto(pass).undo(stream);
        if (error) return { error };

        return { data: JSON.parse(data) };
    }
}

function cripto(salt) {
    return {
        do(string) {
            const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
            const applySaltToChar = (code) => textToChars(salt.toString()).reduce((a, b) => a ^ b, code);
            const byteHex = (n) => ("0" + Number(n).toString(16)).slice(-2);

            const messup = encodeURIComponent(string).split("").map(textToChars).map(applySaltToChar).map(byteHex).join("");
            return btoa(uint8ToString(pako.deflate(messup)));

            // return encodeURIComponent(string).split("").map(textToChars).map(applySaltToChar).map(byteHex).join("");
            // return btoa(encodeURIComponent(string)).split("").map(textToChars).map(applySaltToChar).map(byteHex).join("");
        },
        undo(string) {
            try {
                const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
                const applySaltToChar = (code) => textToChars(salt.toString()).reduce((a, b) => a ^ b, code);

                string = atob(string.trim());
                string = textToChars(string);
                string = pako.inflate(string, { to: "string" });

                const decodedString = string
                    .match(/.{1,2}/g)
                    .map((hex) => parseInt(hex, 16))
                    .map(applySaltToChar)
                    .map((charCode) => String.fromCharCode(charCode))
                    .join("");

                return { data: decodeURIComponent(decodedString) };
                // return { data: decodeURIComponent(atob(decodedString)) };
            } catch (error) {
                return { error: "wrong_salt" };
            }
        },
    };

    function uint8ToString(uint8Value) {
        var bufferSize = 0x8000;
        var c = [];
        for (var i = 0; i < uint8Value.length; i += bufferSize) {
            c.push(String.fromCharCode.apply(null, uint8Value.subarray(i, i + bufferSize)));
        }
        return c.join("");
    }
}

async function selectFile({ multiple, accept } = {}) {
    let file = document.createElement("INPUT");
    file.type = "file";
    if (multiple) file.multiple = true;
    if (accept) file.accept = accept;

    return await new Promise((resolve, reject) => {
        file.click();
        file.addEventListener("change", () => resolve([...file.files]), { once: true });
    });
}

async function downloadFile(filename, text) {
    var element = document.createElement("a");
    element.href = "data:text/plain;charset=utf-8," + text;
    element.download = filename;
    element.style.display = "none";
    element.click();

    // var blob = new Blob([text], { type: "octet/stream" });
    // var url = window.URL.createObjectURL(blob);
    // element.href = url;
    // element.download = filename;
    // element.click();
    // window.URL.revokeObjectURL(url);
}

function csvObject(csv) {
    const lines = csv.split("\n");
    const headers = lines[0].split(",").map((e) => e.replace(/(^(\s+)?["']+(\s+)?|(\s+)?["']+(\s+)?$)/g, "").trim());
    const result = [];

    for (let i = 1; i < lines.length; i++) {
        const obj = {};
        const currentline = lines[i].split(",").map((e) => e.replace(/(^(\s+)?["']+(\s+)?|(\s+)?["']+(\s+)?$)/g, "").trim());

        for (let j = 0; j < headers.length; j++) {
            obj[headers[j]] = currentline[j];
        }
        result.push(obj);
    }
    return result;
}

function copyToClipboard(text) {
    const el = document.createElement("textarea");
    el.value = text;
    document.body.appendChild(el);
    el.select();
    document.execCommand("copy");
    document.body.removeChild(el);
    return text;
}
