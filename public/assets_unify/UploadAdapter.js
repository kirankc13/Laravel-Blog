class UploadAdapter {
    constructor(loader, url, csrf) {
        // CKEditor 5's FileLoader instance.
        this.loader = loader;

        // URL where to send files.
        this.url = url;

        //csrf
        this.csrf = csrf;
    }

    upload() {
        return this.loader.file.then((uploadedFile) => {
            return new Promise((resolve, reject) => {
                const data = new FormData();
                data.append("upload", uploadedFile);

                axios({
                    url: this.url,
                    method: "post",
                    data,
                    headers: {
                        "Content-Type": "multipart/form-data;",
                        "X-CSRF-TOKEN": this.csrf,
                    },
                    withCredentials: false,
                })
                    .then((response) => {
                        console.log(response);
                        if (response.data.result == "success") {
                            resolve({
                                default: response.data.url,
                            });
                        } else {
                            reject(response.data.message);
                        }
                    })
                    .catch((response) => {
                        reject("Upload failed");
                    });
            });
        });
    }

    // // Aborts the upload process.
    // abort() {
    //     if (this.xhr) {
    //         this.xhr.abort();
    //     }
    // }

    // // Example implementation using XMLHttpRequest.
    // _initRequest() {
    //     const xhr = (this.xhr = new XMLHttpRequest());

    //     xhr.open("POST", this.url, true);
    //     xhr.setRequestHeader("X-CSRF-TOKEN", this.csrf);
    //     xhr.responseType = "json";
    // }

    // // Initializes XMLHttpRequest listeners.
    // async _initListeners(resolve, reject) {
    //     const xhr = this.xhr;
    //     let loader = await this.loader.file;
    //     console.log(xhr);

    //     const genericErrorText = "Couldn't upload file:" + ` ${loader.file}.`;

    //     xhr.addEventListener("error", () => reject(genericErrorText));
    //     xhr.addEventListener("abort", () => reject());
    //     xhr.addEventListener("load", () => {
    //         const response = xhr.response;

    //         if (!response || response.error) {
    //             return reject(
    //                 response && response.error
    //                     ? response.error.message
    //                     : genericErrorText
    //             );
    //         }

    //         // If the upload is successful, resolve the upload promise with an object containing
    //         // at least the "default" URL, pointing to the image on the server.
    //         resolve({
    //             default: response.url,
    //         });
    //     });

    //     if (xhr.upload) {
    //         xhr.upload.addEventListener("progress", (evt) => {
    //             if (evt.lengthComputable) {
    //                 loader.uploadTotal = evt.total;
    //                 loader.uploaded = evt.loaded;
    //             }
    //         });
    //     }
    // }

    // // Prepares the data and sends the request.
    // _sendRequest() {
    //     const data = new FormData();

    //     data.append("upload", this.loader.file);

    //     this.xhr.send(data);
    // }
}
