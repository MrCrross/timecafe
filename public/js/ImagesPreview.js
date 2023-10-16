class ImagesPreview
{
    static fileInputsSelector = '.use-ImagesPreview';
    static canvasMultiSelector = '.canvas_ImagesPreview';
    static canvasCloneMultiSelector = '#canvasClone_ImagesPreview';
    static modalSelector = '#modal_ImagesPreview';
    static modalCanvasMultiSelector = '#modalImage_ImagesPreview';
    static containerCanvasMultiSelector = '#containerCanvas_ImagesPreview';

    constructor() {
        ImagesPreview.addListeners();
    }

    static addListeners() {
        const fileInputs = document.querySelectorAll(ImagesPreview.fileInputsSelector);
        const canvasImagesPreview = document.querySelectorAll(ImagesPreview.canvasMultiSelector);

        if (fileInputs) {
            fileInputs.forEach((fileInput) => {
                fileInput.addEventListener('change', (event) => ImagesPreview.updatePreview(event));
            });
        }
        if (canvasImagesPreview) {
            canvasImagesPreview.forEach((image) => {
                image.addEventListener('click', (event) => ImagesPreview.openModal(event));
            });
        }
    }

    static updatePreview(event) {
        const fileInput = event.target;

        const containerCanvas = document.querySelector(ImagesPreview.containerCanvasMultiSelector);
        containerCanvas.innerHTML = '';

        Array.prototype.forEach.call(fileInput.files, function(fileBlob) {
            const img = ImagesPreview.getImageElement(URL.createObjectURL(fileBlob));
            containerCanvas.append(img);
        });
    }

    static getImageElement(src) {
        const img = document.querySelector(ImagesPreview.canvasCloneMultiSelector);
        const clone = img.cloneNode(true);
        clone.id = '';
        clone.src = src;
        clone.classList.remove('hidden');
        clone.addEventListener('click', (event) => ImagesPreview.openModal(event));
        return clone;
    }

    static openModal(event) {
        const modalCanvasImagePreview = document.querySelector(ImagesPreview.modalCanvasMultiSelector);
        modalCanvasImagePreview.src = event.target.src;
    }
}

