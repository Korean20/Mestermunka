javascript
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
  
    var name = document.getElementById("name").value;
    var birthdate = document.getElementById("birthdate").value;
    var gender = document.getElementById("gender").value;
    var email = document.getElementById("email").value;
    var confirmEmail = document.getElementById("confirmEmail").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var phone = document.getElementById("phone").value;
    
    
    if (name === "" || birthdate === "" || email === "" || confirmEmail === "" || password === "" || confirmPassword === "") {
      alert("Kérlek töltsd ki az összes kötelező mezőt!");
      return;
    }
    
    if (email !== confirmEmail) {
      alert("Az email és a megerősítő email nem egyezik!");
      return;
    }
    
    if (password !== confirmPassword) {
      alert("A jelszó és a megerősítő jelszó nem egyezik!");
      return;
    }
    
   
    
    
    document.getElementById("registrationForm").reset();
  });
