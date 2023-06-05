$( document ).ready(function() {
    let uploadInput = document.getElementById("upload-input");
    let imageDisplay = document.getElementById("image-display");
    let uploadButton = document.getElementById('upload-button');

    //Upload Button
    uploadButton.addEventListener("click", () => {
        console.log("1");
        
        Array.from(uploadInput.files).forEach((file) => {
            fileHandler(file, file.name, file.type);
        });
    });


    // File Handler
    const fileHandler = (file, name, type) => {

        // File Type Control
        if (type.split("/")[0] !== "image") {
            // Pop File Type Error
            console.error("Sadece resim dosyaları yüklenebilir!");

            return false;
        }

        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = _ => {
            // create image and filename
            let imageContainer = document.createElement("figure");
            let img = document.createElement("img");

            img.src = reader.result;

            imageContainer.appendChild(img);

            img.onload = _ => {
                canvasImg(img, imageDisplay);
            }

            imageContainer.innerHTML += `<figurecaption>${name}</figurecaption>`;
            imageDisplay.appendChild(imageContainer);
        };
    };

    // Create Canvas Image
    const canvasImg = (imgEl, imageDisplay) => {
        let imageContainer = document.createElement("div");

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        // Set width and height
        canvas.width = 144;
        canvas.height = 73;
        ctx.drawImage(imgEl, 0,0, canvas.width, canvas.height);

        // Draw image and export to a data-uri
        imageContainer.innerHTML += 'PDF çıktısındaki imza <br>';
        imageContainer.appendChild(canvas);
        imageDisplay.appendChild(imageContainer);

        $.post("../../db/resimkaydet.php", {resim:canvas.toDataURL("image/png"), tcno: $("#tcno").val}, (res) => {
            console.log(res);
        });
        console.log(canvas.toDataURL("image/png"));
    };

    // Dükman hazır olduğunda ready yaz. Kodlar bitince sil
    console.log( "ready!" );
});










// // Container dragenter
// container.addEventListener("dragenter", (e) =>{
//     e.preventDefault();
//     e.stopPropagation();

//     container.classList.add("active");
// }, false);

// // Container dragleave
// container.addEventListener("dragleave", (e) => {
//     e.preventDefault();
//     e.stopPropagation();

//     container.classList.remove("active");
// }, false);

// // Container dragover
// container.addEventListener("dragover", (e) => {
//     e.preventDefault();
//     e.stopPropagation();

//     container.classList.add("active");
// }, false);

// // Container drop
// container.addEventListener("drop", (e) => {
//     e.preventDefault();
//     e.stopPropagation();

//     container.classList.remove("active");

//     let draggedData = e.dataTransger;
//     let files = draggedData.files;

//     imageDisplay.innerHTML = "";
    
//     Array.from(files).forEach((file) => {
//         fileHandler(file, file.name, file.type);
//     });
// }, false);