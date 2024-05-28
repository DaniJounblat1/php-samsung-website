document.addEventListener('DOMContentLoaded', function() {
  var phonesCard = document.getElementById('phones');
  var budsCard = document.getElementById('buds');
  var tvCard = document.getElementById('tv');
  var smartwatchesCard = document.getElementById('smartwatches');
  var productsContainer = document.querySelector('.cards');
  var modelsContainer = null; // Initialize modelsContainer as null
  var serialNumberFieldContainer = document.getElementById('serial-number-field-container');
  var serialNumberField = document.getElementById('serial-number-field');
  var submitButton = document.getElementById('submit-button');

  var samsungPhonesModels = ['Samsung A', 'Samsung S', 'Samsung Z'];
  var samsungSmartwatchModels = ['Galaxy Watchs 5', 'Galaxy Watchs 4', 'Galaxy Watchs 3'];
  var samsungBudsModels = ['Buds 2 Pro', 'Buds 2', 'Buds Pro'];
  var samsungTVModels = ['Neo QLED 8K 85', 'The Frame 85', 'Neo QLED 4K 55'];

  
  phonesCard.addEventListener('click', function(event) {
    event.stopPropagation();
    toggleModels('phones', samsungPhonesModels);
    hideSerialNumber();
  });

  budsCard.addEventListener('click', function(event) {
    event.stopPropagation();
    toggleModels('buds', samsungBudsModels);
    hideSerialNumber();
  });

  tvCard.addEventListener('click', function(event) {
    event.stopPropagation();
    toggleModels('tv', samsungTVModels);
    hideSerialNumber();
  });

  smartwatchesCard.addEventListener('click', function(event) {
    event.stopPropagation();
    toggleModels('smartwatches', samsungSmartwatchModels);
    hideSerialNumber();
  });

  function hideSerialNumber() {
    serialNumberFieldContainer.classList.add('hidden'); // Hide the serial number field container
  }

  // Add a variable to keep track of the selected model card
  var selectedModelCard = null;

  function toggleModels(category, models) {
    var categoryContainer = document.getElementById(category);

    if (modelsContainer && categoryContainer !== modelsContainer.parentNode) {
      modelsContainer.remove();
      modelsContainer = null;
      deselectModelCard(); // Deselect the previously selected model card
      hideSerialNumber(); // Hide the serial number field
    }

    if (!modelsContainer) {
      modelsContainer = document.createElement('div');
      modelsContainer.classList.add('models');
      modelsContainer.id = 'models-container';

      models.forEach(function(model) {
        var modelCard = createModelCard(model);
        modelCard.addEventListener('click', function() {
          if (selectedModelCard === modelCard) {
            deselectModelCard(); // Deselect the clicked model card
            hideSerialNumber(); // Hide the serial number field
          } else {
            selectModelCard(modelCard); // Select the clicked model card
            openSerialNumber(model);
          }
        });
        modelsContainer.appendChild(modelCard);
      });

      productsContainer.parentNode.insertBefore(modelsContainer, productsContainer.nextSibling);
    }
  }

  function selectModelCard(card) {
    if (selectedModelCard) {
      selectedModelCard.classList.remove('selected'); // Remove the 'selected' class from the previously selected card
    }
    card.classList.add('selected'); // Add the 'selected' class to the newly selected card
    selectedModelCard = card; // Update the selectedModelCard variable
  }

  function deselectModelCard() {
    if (selectedModelCard) {
      selectedModelCard.classList.remove('selected'); // Remove the 'selected' class from the currently selected card
      selectedModelCard = null; // Reset the selectedModelCard variable
    }
  }

  function createModelCard(model) {
    var modelCard = document.createElement('div');
    modelCard.classList.add('model-card');

    var modelImage = document.createElement('img');

    // Set the image source and CSS class based on the model
    if (model === 'Samsung A') {
      modelImage.src = '../img/A.png';
      modelImage.classList.add('samsung-a'); // Customize the size for Samsung A image
    } else if (model === 'Samsung S') {
      modelImage.src = '../img/c.png';
      modelImage.classList.add('samsung-s'); // Customize the size for Samsung S image
    } else if (model === 'Samsung Z') {
      modelImage.src = '../img/zPage.png';
      modelImage.classList.add('samsung-z'); // Customize the size for Samsung Z image
    } else if (model === 'Buds 2 Pro') {
      modelImage.src = '../img/buds2pro.png';
      modelImage.classList.add('buds2-pro'); // Customize the size for Buds 2 Pro image
    } else if (model === 'Buds 2') {
      modelImage.src = '../img/buds2.png';
      modelImage.classList.add('buds2'); // Customize the size for Buds 2 image
    } else if (model === 'Buds Pro') {
      modelImage.src = '../img/budspro.png';
      modelImage.classList.add('buds-pro'); // Customize the size for Buds Pro image
    } else if (model === 'Galaxy Watchs 5') {
      modelImage.src = '../img/watch5.png';
      modelImage.classList.add('watch-5'); // Customize the size for Galaxy Watch 5 image
    } else if (model === 'Galaxy Watchs 4') {
      modelImage.src = '../img/watch4.png';
      modelImage.classList.add('watch-4'); // Customize the size forGalaxy Watch 4 image
    } else if (model === 'Galaxy Watchs 3') {
      modelImage.src = '../img/watch2.png';
      modelImage.classList.add('watch-3'); // Customize the size for Galaxy Watch 3 image
    } else if (model === 'Neo QLED 4K 55') {
      modelImage.src = '../img/Neo.png';
      modelImage.classList.add('neo-qled-4k'); // Customize the size for Neo QLED 4K image
    } else if (model === 'The Frame 85') {
      modelImage.src = '../img/frame.png';
      modelImage.classList.add('the-frame'); // Customize the size for The Frame 85 image
    } else if (model === 'Neo QLED 8K 85') {
      modelImage.src = '../img/Neo41.png';
      modelImage.classList.add('neo-qled-8k'); // Customize the size for Neo QLED 8K image
    }

    modelImage.alt = model;

    var modelName = document.createElement('h4');
    modelName.textContent = model;

    modelCard.appendChild(modelImage);
    modelCard.appendChild(modelName);

    return modelCard;
  }

  function openSerialNumber(model) {
    serialNumberFieldContainer.classList.remove('hidden');
    // Show the serial number field container

    submitButton.addEventListener('click', function(event) {
      event.preventDefault();
      var serialNumber = serialNumberField.value;

      // Add your PHP code here to handle the form submission and insert the serial number into the 'repair' table
      // Make sure to establish a connection to the database and sanitize the input to prevent SQL injection

      var messageElement = document.getElementById('serial-number-message');

      // Regular expression pattern to match only letters (alphabetic characters)
      var alphanumericPattern = /^[A-Za-z0-9]+$/;

if (serialNumber.length !== 11) {
  messageElement.textContent = 'The serial number should be exactly 11 characters.';
  messageElement.style.color = 'red';
  messageElement.style.display = 'block';
} else if (!alphanumericPattern.test(serialNumber)) {
  messageElement.textContent = 'Serial number ' + serialNumber + ' has been submitted successfully.';
  messageElement.style.color = 'green';
  messageElement.style.display = 'block';
} else {
  messageElement.textContent = 'Serial number ' + serialNumber + ' has been submitted successfully.';
  messageElement.style.color = 'green';
  messageElement.style.display = 'block';
}

    });
  }
  submitButton.addEventListener('click', function(event) {
    event.preventDefault();
    var serialNumber = serialNumberField.value;

    if (selectedModelCard && serialNumber) {
      // Create an object with the selected product and serial number
      var data = {
        model: selectedModelCard.querySelector('h4').textContent,
        serialNumber: serialNumber
      };

      // Send an AJAX request to the server-side script
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../html/repair.php', true);
      xhr.setRequestHeader('Content-Type', 'application/json');

      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);

          if (response.success) {
            var messageElement = document.getElementById('serial-number-message');
            messageElement.textContent = 'Serial number ' + serialNumber + ' has been submitted successfully.';
            messageElement.style.color = 'green';
            messageElement.style.display = 'block';
          } else {
            console.error(response.error);
          }
        }
      };

      xhr.send(JSON.stringify(data));
    }
  });
});

