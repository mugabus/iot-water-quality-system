// main.js

// Function to fetch the latest water quality data
function fetchLatestData() {
    // Perform an AJAX request to a PHP endpoint that returns the latest data
    fetch('fetch_data.php')
        .then(response => response.json())
        .then(data => {
            // Clear existing table rows
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            // Loop through each data entry and add it to the table
            data.forEach(entry => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${entry.sensor_id}</td>
                    <td>${entry.pH}</td>
                    <td>${entry.turbidity}</td>
                    <td>${entry.residual_chlorine}</td>
                    <td>${entry.conductivity}</td>
                    <td>${entry.temperature}</td>
                    <td>${entry.created_at}</td>
                `;

                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Set an interval to refresh the data every 60 seconds
setInterval(fetchLatestData, 60000);

// Fetch data as soon as the page loads
document.addEventListener('DOMContentLoaded', fetchLatestData);
