$( document ).ready(function() {
    let uploadInput = document.getElementById("upload-input");
    let uploadButton = document.getElementById('upload-button');

    //Upload Button
    uploadButton.addEventListener("click", () => {
        
        Array.from(uploadInput.files).forEach((file) => {
            fileHandler(file, file.type);
        });
    });


    // File Handler
    const fileHandler = (file, type) => {

        let reader = new FileReader();
        reader.readAsDataURL(file);
 
        reader.onloadend = _ => {
            let img = document.createElement("img");
            img.src = reader.result;

            img.onload = _ => {
                canvasImg(img);
            }
        };
    };

    // Create Canvas Image
    const canvasImg = (imgEl) => {
        
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        // Set width and height
        canvas.width = 144;
        canvas.height = 73;
        ctx.drawImage(imgEl, 0,0, canvas.width, canvas.height);
        
        
        // Go resimkaydet.php and save to db 
        $.post(`../db/resimkaydet.php?tcno=${$("#tcno").val()}`, {resim:canvas.toDataURL("image/png")}, (res) => {
            if (res === "1") {
                alert("Yükleme İşlemi Başarılı\nYönlendirileceksiniz...")
                window.location.replace("./goruntuyukle.php");
            }else{
                alert("Yükleme İşlemi Başarısız")
                
            }

        });
    };

   
});