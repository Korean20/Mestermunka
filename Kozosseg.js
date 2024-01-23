function postMessage() {
    var messageInput = document.getElementById('message-input');
    var messageText = messageInput.value;

    if (messageText.trim() !== '') {
        var messagesContainer = document.getElementById('messages-container');
        var messageElement = document.createElement('div');
        messageElement.className = 'message';
        messageElement.textContent = messageText;

        messagesContainer.appendChild(messageElement);
        messageInput.value = '';
    }
}