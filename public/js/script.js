window.onload = function() {
    window.scrollTo(0, 0);
    $('#loader').css('display', 'none');
}

/**
 *@param {string} canvasId insert the canvas ID
 *@param {number} canvasW insert canvas Width (image width)
 *@param {number} canvasH insert canvas Height (image height)
 *@param {number} frames insert the number of frames
 *@param {string} path insert the path to the frame, do not insert the file name
 *@param {string} triggerEl insert between "" the class or ID of the triggered Element
 *@param {string} triggerStart insert where to start the trigger from the triggered Element
 *@param {string} triggerEnd insert where to end the trigger from the triggered Element
 *@param {boolean} pined insert true or false
 *@param {boolean} marks insert true or false 
 */
function animateCanvas(canvasId, canvasW, canvasH, frames, path, triggerEl, triggerStart, triggerEnd, pined, marks) {
    const canvas = document.getElementById(canvasId);
    const context = canvas.getContext("2d");

    canvas.width = canvasW;
    canvas.height = canvasH;

    const frameCount = frames;
    const currentFrame = (index) =>
        path + (index + 1).toString().padStart(4, "0") + '.jpg';

    const images = [];
    const animation = {
        frame: 0
    };

    for (let i = 0; i < frameCount; i++) {
        const img = new Image();
        img.src = currentFrame(i);
        images.push(img);
    }

    gsap.to(animation, {
        frame: frameCount - 1,
        snap: "frame",
        scrollTrigger: {
            trigger: triggerEl,
            scrub: 2,
            anticipatePin: true,
            pin: pined,
            start: triggerStart,
            end: triggerEnd,
            markers: marks
        },
        onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
    });

    images[0].onload = render;

    function render() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.drawImage(images[animation.frame], 0, 0);
    }

}



/**
 * 
 * @param {string} glideEl insert the ID or class of the glide container
 * @returns {Glide}
 */
function menuGlide(glideEl) {
    new Glide(glideEl, {
        type: 'carousel',
        startAt: 0,
        perView: 3,
        gap: 20,
        focusAt: "center",
        peek: {
            before: 70,
            after: 70
        },
        breakpoints: {
            3000: {
                perView: 5,
                focusAt: "center",
                startAt: 0
            },
            2500: {
                perView: 5,
                focusAt: "center",
                startAt: 0
            },
            1600: {
                perView: 3,
                focusAt: "center",
                startAt: 0
            },
            600: {
                perView: 2,
                focusAt: 1,
                startAt: 1
            },
            400: {
                perView: 1,
                focusAt: 1,
                startAt: 1
            }
        }
    }).mount();
}