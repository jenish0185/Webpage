document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_cars.php')
    .then(response => response.json())
    .then(data => {
        const carList = document.getElementById('car-list');
        data.forEach(car => {
            const carPanel = document.createElement('div');
            carPanel.className = 'car-panel';
            carPanel.innerHTML = `
                <img src="car_images/${car.image}" alt="${car.name}">
                <div class="car-details">
                    <h3>${car.name}</h3>
                    <p>Seats: ${car.seats}</p>
                    <p>Transmission: ${car.transmission}</p>
                    <p>Location: ${car.location}</p>
                    <p>Price: ${car.price}</p>
                </div>
            `;
            carList.appendChild(carPanel);
        });
    })
    .catch(error => console.log(error));
});
