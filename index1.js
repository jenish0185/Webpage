// const url = require("url");

// const parsedURL = url.parse("hhtp://www.example.com/profile?name=shyam")

// console.log(parsedURL.protocol);
// console.log(parsedURL.host);
// console.log(parsedURL.query);


const pets = [
    { id: 1, name: "Doggo", breed: "Japanese Spitz" },
    { id: 2, name: "Fluffy", breed: "Maine Coon" },
];

function getPets() {
    return pets;
}

function getTotalNumberOfPets() {
    return pets.length;
}

module.exports = { getPets, getTotalNumberOfPets };
