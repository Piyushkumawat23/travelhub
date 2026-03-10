document.addEventListener('DOMContentLoaded', function() {
    // Form Tab Switching Logic
    const tabs = document.querySelectorAll('.tab-btn');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submit on button click
            
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
        });
    });
});




document.getElementById("whatsappForm").addEventListener("submit", function(e){

    e.preventDefault();

    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var pickup = document.getElementById("pickup").value;
    var drop = document.getElementById("drop").value;
    var date = document.getElementById("date").value;
    var message = document.getElementById("message").value;

    var whatsappNumber = "919782870390"; // apna whatsapp number

    var text = "New Tempo Traveller Enquiry:%0A%0A"
        + "Name: " + name + "%0A"
        + "Phone: " + phone + "%0A"
        + "Pickup: " + pickup + "%0A"
        + "Drop: " + drop + "%0A"
        + "Date: " + date + "%0A"
        + "Message: " + message;

    var url = "https://wa.me/" + whatsappNumber + "?text=" + text;

    window.open(url, '_blank');

});

