export function showLoading() {
    $('#loading-overlay').removeClass('d-none');
}

export function hideLoading() {
    $('#loading-overlay').addClass('d-none');
}

export function showAlert(type, message) {
    // Define the allowed types and their corresponding Bootstrap classes
    const alertTypes = {
        primary: 'alert-primary',
        secondary: 'alert-secondary',
        success: 'alert-success',
        danger: 'alert-danger',
        warning: 'alert-warning',
        info: 'alert-info',
        pink: 'alert-pink',
        purple: 'alert-purple',
        light: 'alert-light',
        dark: 'alert-dark',
    };

    // Check if the passed type is valid, if not, set it to 'info'
    if (!alertTypes[type]) {
        console.warn(`Invalid alert type: ${type}. Defaulting to 'info'.`);
        type = 'info';
    }

    // Create the alert element
    const alertElement = document.createElement('div');
    alertElement.classList.add('alert', alertTypes[type], 'alert-dismissible', 'text-bg-' + type, 'border-0', 'fade', 'show');
    alertElement.setAttribute('role', 'alert');

    // Add the close button
    const closeButton = document.createElement('button');
    closeButton.setAttribute('type', 'button');
    closeButton.classList.add('btn-close');
    closeButton.setAttribute('data-bs-dismiss', 'alert');
    closeButton.setAttribute('aria-label', 'Close');

    // Append the close button to the alert
    alertElement.appendChild(closeButton);

    // Add the message to the alert
    const strongText = document.createElement('strong');
    strongText.textContent = `${type.charAt(0).toUpperCase() + type.slice(1)} - `;
    alertElement.appendChild(strongText);
    alertElement.appendChild(document.createTextNode(message));

    // Style the alert to appear at the upper right corner
    alertElement.style.position = 'fixed';
    alertElement.style.top = '10px';
    alertElement.style.right = '10px';
    alertElement.style.zIndex = '1050'; // Ensure it appears above other content
    alertElement.style.width = 'auto'; // Adjust width as necessary

    // Append the alert to the body
    document.body.appendChild(alertElement);

    // Automatically remove the alert after 5 seconds
    setTimeout(() => {
        alertElement.classList.remove('show'); // Remove 'show' class for fading out
        setTimeout(() => alertElement.remove(), 500); // Remove the element after fading
    }, 5000); // 5000 milliseconds (5 seconds) delay before removal
}
