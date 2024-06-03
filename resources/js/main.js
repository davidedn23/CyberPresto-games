// BOTTONE E LOADER IMMAGINE FORM
let announcementCreate = document.querySelector("#announcementCreate");
if (announcementCreate) {
    const btnCustom = document.querySelector("#btnCustom");

    document.addEventListener("DOMContentLoaded", function () {

        const imgInput = document.querySelector("#imgInput");
        const imgUploaded = document.querySelector("#imgUploaded");
        const uploadSwitch = document.querySelector("#uploadSwitch");
        // Disable the button
        imgInput.addEventListener("change", function (event) {
            if (imgInput.files.length > 0) {
                btnCustom.style.display = "none";
                uploadSwitch.classList.replace("d-none", "d-block");
            } else {
                btnCustom.style.display = "block";
                uploadSwitch.classList.replace("d-block", "d-none");
            }
        });
    });
}

let home = document.querySelector('#home');
if (home) {
    // Function to create the interval for counting
    function createInterval(total, element, time) {
        let counter = 0;
        let interval = setInterval(() => {
            if (counter < total) {
                counter++;
                element.innerHTML = '+' + counter;
            } else {
                clearInterval(interval);
            }
        }, time);
    }

    // Initialize the observer and counters
    let firstNumber = document.querySelector('#firstNumber');
    let secondNumber = document.querySelector('#secondNumber');
    let thirdNumber = document.querySelector('#thirdNumber');
    let check = true;
    let observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && check) {
                createInterval(600, firstNumber, 10);
                createInterval(1000, secondNumber, 5);
                createInterval(50, thirdNumber, 100);
                check = false;
                setTimeout(() => {
                    check = true;
                }, 8000);
            }
        });
    });

    // Assuming 'thirdNumber' is the element to observe
    observer.observe(thirdNumber);
}
