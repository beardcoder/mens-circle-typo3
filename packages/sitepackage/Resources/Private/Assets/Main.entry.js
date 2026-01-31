/**
 * Mens Circle Niederbayern - Main JavaScript
 * Minimal, modern JavaScript with no dependencies
 */

'use strict';

document.addEventListener('DOMContentLoaded', function() {
    console.log('Mens Circle Niederbayern - Website loaded');
    
    // Add any interactive functionality here
    initForms();
});

/**
 * Initialize form handling
 */
function initForms() {
    const forms = document.querySelectorAll('form[data-ajax]');
    
    forms.forEach(form => {
        form.addEventListener('submit', handleFormSubmit);
    });
}

/**
 * Handle AJAX form submissions
 */
async function handleFormSubmit(event) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');
    
    try {
        // Disable submit button
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'Wird gesendet...';
        }
        
        const response = await fetch(form.action, {
            method: form.method,
            body: formData
        });
        
        if (response.ok) {
            const result = await response.json();
            showMessage('success', result.message || 'Erfolgreich gesendet!');
            form.reset();
        } else {
            throw new Error('Server error');
        }
    } catch (error) {
        showMessage('error', 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
    } finally {
        // Re-enable submit button
        if (submitButton) {
            submitButton.disabled = false;
            submitButton.textContent = 'Absenden';
        }
    }
}

/**
 * Show message to user
 */
function showMessage(type, message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    messageDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 2rem;
        background-color: ${type === 'success' ? '#4CAF50' : '#f44336'};
        color: white;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 1000;
    `;
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}
