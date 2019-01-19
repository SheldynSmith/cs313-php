var currentPhoto = 0;

function displayPhoto() {
    var picElement = document.getElementById("family-pic");
    if (currentPhoto == 0) {
        picElement.src = "homeData/Family Photo.jpeg";
    }
    else if (currentPhoto == 1) {
        picElement.src = "homeData/wedding.jpeg";
    }
    else if (currentPhoto == 2) {
        picElement.src = "homeData/corn maze.jpeg";
    }
}

function cycleLeft() {
    currentPhoto = ((--currentPhoto % 3) + 3) % 3;
    displayPhoto();
}

function cycleRight() {
    currentPhoto = ((++currentPhoto % 3) + 3) % 3;
    displayPhoto();
}