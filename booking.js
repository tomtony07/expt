document.addEventListener("DOMContentLoaded", function () {
    // Assume this is the list of packages added by the admin
    const packages = [
        { id: 1, name: "Package 4", price: 500 },
        { id: 2, name: "Package 5", price: 800 },
        { id: 3, name: "Package 6", price: 1200 }
    ];

    const packageSelect = document.getElementById("package");
    const packagesList = document.getElementById("packages-list");

    // Display packages on the page
    packages.forEach(package => {
        const option = document.createElement("option");
        option.value = package.id;
        option.text = `${package.name} - $${package.price}`;
        packageSelect.appendChild(option);

        const packageItem = document.createElement("div");
        packageItem.innerHTML = `<strong>${package.name}</strong> - $${package.price}`;
        packagesList.appendChild(packageItem);
    });

    // Show the booking form when a package is selected
    packageSelect.addEventListener("change", function () {
        document.getElementById("booking-form").style.display = "block";
    });
});

function submitBooking() {
    const selectedPackageId = document.getElementById("package").value;
    const packageName = document.getElementById("package").options[document.getElementById("package").selectedIndex].text;
    const userName = document.getElementById("name").value;
    const userEmail = document.getElementById("email").value;

    // In a real scenario, you would send this data to the server for processing
    alert(`Booking Confirmed!\nPackage: ${packageName}\nName: ${userName}\nEmail: ${userEmail}`);
}
