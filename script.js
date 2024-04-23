// const signUpButton = document.getElementById('signUpButton');
// const signInButton = document.getElementById('signInButton');
// const signInForm=document.getElementById('signIn');
// const signUpForm = document.getElementById('signUp');

// document.addEventListener('DOMContentLoaded', function(){
//     var signUpButton = document.getElementById('signUpButton');
//     var signInButton = document.getElementById('signInButton');
//     var signUpForm = document.getElementById('signUpForm');
//     var signInForm = document.getElementById('signInForm');
//     signUpButton.addEventListener('click', function(){
//         signInForm.style.display ="none";
//         signUpForm.style.display="block";
//     });
    
//     signInButton.addEventListener('click', function(){
//         signInForm.style.display="block";
//         signUpForm.style.display="none";
//     });

// });


function searchLocations() {
    var input, filter, locations, location, title, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    locations = document.getElementsByClassName('location');

    for (i = 0; i < locations.length; i++) {
        location = locations[i];
        title = location.getElementsByTagName('h3')[0];
        txtValue = title.textContent || title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            location.style.display = '';
        } else {
            location.style.display = 'none';
        }
    }
}

function logout() {
    window.location.href = "logout.php";
}


let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
   inputNumber.oninput = () =>{
      if(inputNumber.value.length > inputNumber.maxLength) inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
   };
});