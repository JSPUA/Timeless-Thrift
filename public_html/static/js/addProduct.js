const image_input = document.querySelector("#image_input");
const images = document.querySelector("#images");
const imagesMain = document.getElementById("images_main");
var uploaded_image = "";

images.innerHTML="";

image_input.addEventListener("change",(event)=>{
    const imageFiles = event.target.files;

    if(imageFiles.length>0) {
        for (const imageFile of imageFiles) {
            const reader = new FileReader();
            reader.onload = ()=>{
                var image = new Image();
                image.src = String(reader.result);
                images.append(image);
            }
            reader.readAsDataURL(imageFile);
            console.log(imageFile);
        }
    }
});

var imageMain = document.getElementById("imagemain");

imageMain.addEventListener("change",(event)=>{
    const imageFiles = event.target.files;
    imagesMain.innerHTML="";
    if(imageFiles.length>0) {
        for (const imageFile of imageFiles) {
            const reader = new FileReader();
            reader.onload = ()=>{
                var image = new Image();
                image.src = String(reader.result);
                imagesMain.append(image);
            }
            reader.readAsDataURL(imageFile);
            console.log(imageFile);
        }
    }
    else {

    }
}
)

function resetImages(){
    images.innerHTML="";
    imagesMain.innerHTML="";
}