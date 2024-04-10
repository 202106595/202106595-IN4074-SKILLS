document.getElementById('contactForm').addEventListener('submit', function(event) {
  
    
  
    var name = document.getElementById('name').value;
    if (name.trim() === '') {
        alert('Please enter your name.');
        event.preventDefault();
    }
});