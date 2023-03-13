const loginForm = document.getElementById('login-form');
const loginMessage = document.getElementById('login-message');

loginForm.addEventListener('submit', (event) => {
  event.preventDefault();
  
  const username = loginForm.elements.username.value;
  const password = loginForm.elements.password.value;
  
  const request = new XMLHttpRequest();
  request.open('POST', 'authenticate.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function() {
    if (request.readyState === XMLHttpRequest.DONE) {
      if (request.status === 200) {
        const response = JSON.parse(request.responseText);
        if (response.success) {
          window.location.href = 'homepage.html';
        } else {
          loginMessage.textContent = 'Invalid username or password.';
        }
      } else {
        loginMessage.textContent = 'Error: ' + request.statusText;
      }
    }
  };
  const requestBody = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
  request.send(requestBody);
});
