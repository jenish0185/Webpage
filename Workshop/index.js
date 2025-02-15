console.log("Hello group wdg4");
//function decalrationa and expression

function randomInteger(){
    return Math.round(Math.random() * 100);
}


const num = randomInteger();
console.log(num);

//expression 
const randomNum = function () {
    return Math.round(Math.random() * 100);

}

const num1 = randomNum();
console.log(num1);


//expression 
const randomNum1 = () => Math.round(Math.random() * 100);



const num2 = randomNum1();
console.log(num2);



const pet = {
    petName: "Doggo",
    petAge: 2,
    likes: {
        indoor: "Sleep",
        outdoor: "Playing Fetch",
    },
};
console.log(`My pet name is ${pet.petName}. He likes to ${pet.likes.outdoor} outdoors.`);


const {
    petName, 
    likes: {indoor}, 
} = pet;

console.log(`My pet name is ${pet.petName}. He likes to ${indoor} indoors.`);

const {outdoor} = pet.likes;

console.log(outdoor);


const req = {
    parms: {
        id: 12,
    },

};


// const { id } = req.parms;

const {
    parms: {id}, 
} = req;

console.log(`Id is ${id}`);


// const originalObject = { a:1 , b:2} 

console.log(__dirname);
console.log(__filename);

console.log(process.argv);



const id123 = process.argv[2];
const UserNote = process.argv[3];
//creating object
const notes ={
    id123,
    note: UserNote
};
console.log(notes);
