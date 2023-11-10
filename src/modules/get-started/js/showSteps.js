const part1Id = document.getElementById('part-1');
const part2Id = document.getElementById('part-2');
const part3Id = document.getElementById('part-3');
const part4Id = document.getElementById('part-4');
const part5Id = document.getElementById('part-5');
const part6Id = document.getElementById('part-6');
const part7Id = document.getElementById('part-7');

function showStepOne() {
    part1Id.classList.add('active');

    if (part2Id.classList.contains('active')) {
        part2Id.classList.remove('active');
    }
}

function showStepTwo() {
    part2Id.classList.add('active');

    if (part1Id.classList.contains('active')) {
        part1Id.classList.remove('active');
    }

    if (part3Id.classList.contains('active')) {
        part3Id.classList.remove('active');
    }
}

function showStepThree() {

    part3Id.classList.add('active');

    if (part2Id.classList.contains('active')) {
        part2Id.classList.remove('active');
    }

    if (part4Id.classList.contains('active')) {
        part4Id.classList.remove('active');
    }

}

function showStepFour() {

    part4Id.classList.add('active');

    if (part3Id.classList.contains('active')) {
        part3Id.classList.remove('active');
    }

    if (part5Id.classList.contains('active')) {
        part5Id.classList.remove('active');
    }
}

function showStepFive() {

    part5Id.classList.add('active');

    if (part4Id.classList.contains('active')) {
        part4Id.classList.remove('active');
    }

    if (part6Id.classList.contains('active')) {
        part6Id.classList.remove('active');
    }

}

function showStepSix() {
    part6Id.classList.add('active');

    if (part5Id.classList.contains('active')) {
        part5Id.classList.remove('active');
    }

    if (part7Id.classList.contains('active')) {
        part7Id.classList.remove('active');
    }
}

function showStepSeven() {
    part7Id.classList.add('active');

    if (part6Id.classList.contains('active')) {
        part6Id.classList.remove('active');
    }
}

