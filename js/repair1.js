function displayConfirmation() {
  // Create a div element for the confirmation message container
  var confirmationDiv = document.createElement('div');
  confirmationDiv.classList.add('confirmation-popup');

  // Create a paragraph element to hold the message
  var messageParagraph = document.createElement('p');
  messageParagraph.textContent =
    'Your entry to this page means your intention to repair by receiving and delivering by the company';
  messageParagraph.style.fontSize = '20px'; // Adjust the font size as per your requirement

  // Create a "Back to Home" button
  var backButton = document.createElement('button');
  backButton.textContent = 'Cancel';
  backButton.addEventListener('click', function () {
    // Handle the action when the "Back to Home" button is clicked
    window.location.href = '../html/repair.html'; // Replace with the appropriate URL for your home page
  });

  // Create a "Continue" button
  var continueButton = document.createElement('button');
  continueButton.textContent = 'Continue';
  continueButton.addEventListener('click', function () {
    // Handle the action when the "Continue" button is clicked
    window.location.href = '../html/choose-product.html'; // Replace with the appropriate URL for the repair page
  });

  // Append the message and buttons to the confirmation div
  confirmationDiv.appendChild(messageParagraph);
  confirmationDiv.appendChild(backButton);
  confirmationDiv.appendChild(continueButton);

  // Insert the confirmation div before the button
  var button = document.querySelector('button[onclick="displayConfirmation()"]');
  button.parentNode.insertBefore(confirmationDiv, button);
}