// Get the current date
let currentDate = new Date();

// Function to render the calendar
function renderCalendar() {
    const monthYearDisplay = document.getElementById("month-year");
    const calendarDays = document.getElementById("calendar-days");

    // Set the month and year
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    monthYearDisplay.textContent = `${currentDate.toLocaleString("default", { month: "long" })} ${year}`;

    // Clear previous days
    calendarDays.innerHTML = "";

    // Get the first day of the month
    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    // Add empty divs for previous month days
    for (let i = 0; i < (firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1); i++) {
        const emptyDiv = document.createElement("div");
        calendarDays.appendChild(emptyDiv);
    }

    // Add days of the current month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = day;

        // Highlight today's date
        if (
            day === new Date().getDate() &&
            month === new Date().getMonth() &&
            year === new Date().getFullYear()
        ) {
            dayDiv.classList.add("today");
        }

        calendarDays.appendChild(dayDiv);
    }
}

// Functions to go to the previous and next month
function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initial render
document.addEventListener("DOMContentLoaded", renderCalendar);





//redirect to main club pages when you click the search button
document.addEventListener("DOMContentLoaded", () => {
    const searchButtons = document.querySelectorAll(".search-button");

    searchButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            if (index === 0) {
                window.location.href = "physical.html";
            } else if (index === 1) {
                window.location.href = "non-physical.html";
            } else if (index === 2) {
                window.location.href = "create.html";
            }
        });
    });
});




//sort and search option
function performSearch() {
    const searchTerm = document.getElementById("searchInput").value.toLowerCase();
    const sortOption = document.getElementById("sortSelect").value;
    
    // Logic for handling search and sort options
    console.log(`Searching for: ${searchTerm}`);
    console.log(`Sorting by: ${sortOption}`);
    
    // Implement actual search and sort logic here if needed
}


