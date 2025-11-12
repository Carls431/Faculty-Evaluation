<?php
// AI Chat Assistant for Students
// Only appears on student interface
if(!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 3) {
    return; // Only show for students
}
?>

<style>
/* AI Chat Assistant Styles */
.ai-chat-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.chat-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #800000, #a52a2a, #8b0000);
    border: none;
    box-shadow: 0 4px 20px rgba(139, 0, 0, 0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.chat-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(139, 0, 0, 0.4);
}

.chat-toggle-btn i {
    color: white;
    font-size: 24px;
    transition: all 0.3s ease;
}

.chat-toggle-btn.active i.fa-comments {
    transform: rotate(180deg);
    opacity: 0;
}

.chat-toggle-btn.active i.fa-times {
    transform: rotate(0deg);
    opacity: 1;
}

.chat-toggle-btn i.fa-times {
    position: absolute;
    transform: rotate(-180deg);
    opacity: 0;
}

.chat-container {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.3s ease;
}

.chat-container.active {
    display: flex;
    transform: translateY(0);
    opacity: 1;
}

.chat-header {
    background: linear-gradient(135deg, #800000, #a52a2a);
    color: white;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.chat-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.chat-info h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.chat-info p {
    margin: 0;
    font-size: 12px;
    opacity: 0.9;
}

.chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #f8f9fa;
}

.message {
    margin-bottom: 15px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.message.user {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
    overflow: hidden;
}

.message-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.message.ai .message-avatar {
    background: white;
    color: white;
    border: 2px solid #800000;
}

.message.user .message-avatar {
    background: #e9ecef;
    color: #495057;
}

.message-content {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.4;
}

.message.ai .message-content {
    background: white;
    color: #333;
    border-bottom-left-radius: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.message.user .message-content {
    background: linear-gradient(135deg, #800000, #a52a2a);
    color: white;
    border-bottom-right-radius: 6px;
}

.chat-input-container {
    padding: 15px 20px;
    background: white;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 10px;
    align-items: center;
}

.chat-input {
    flex: 1;
    border: 1px solid #ddd;
    border-radius: 25px;
    padding: 10px 15px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s ease;
}

.chat-input:focus {
    border-color: #800000;
}

.chat-send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #800000, #a52a2a);
    border: none;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.chat-send-btn:hover {
    transform: scale(1.1);
}

.chat-send-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.typing-indicator {
    display: none;
    padding: 10px 16px;
    background: white;
    border-radius: 18px;
    border-bottom-left-radius: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    max-width: 70%;
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #800000;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-dots span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.5;
    }
    30% {
        transform: translateY(-10px);
        opacity: 1;
    }
}

.quick-suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.suggestion-btn {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.suggestion-btn:hover {
    background: #800000;
    color: white;
    border-color: #800000;
}

/* Responsive design */
@media (max-width: 768px) {
    .chat-container {
        width: 340px;
        max-width: 90vw;
        height: 450px;
        max-height: 65vh;
        bottom: 70px;
        right: 15px;
        border-radius: 12px;
    }
    
    .chat-popup-notification {
        width: 280px;
        max-width: calc(100vw - 100px);
        bottom: 130px;
        right: 20px;
        left: auto;
    }
    
    .ai-chat-widget {
        bottom: 15px;
        right: 15px;
    }
    
    .chat-toggle-btn {
        width: 55px;
        height: 55px;
    }
    
    .chat-toggle-btn i {
        font-size: 22px;
    }
    
    .chat-input {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

@media (max-width: 480px) {
    .chat-container {
        width: 320px;
        height: 400px;
        bottom: 60px;
        right: 10px;
        border-radius: 10px;
        position: fixed;
    }
    
    .chat-popup-notification {
        width: 260px;
        bottom: 110px;
        right: 10px;
        left: auto;
        padding: 12px 15px;
        max-width: calc(100vw - 80px);
    }
    
    .popup-message {
        font-size: 11px;
        line-height: 1.2;
    }
    
    .popup-title {
        font-size: 12px;
    }
    
    .popup-action {
        padding: 6px 12px;
        font-size: 11px;
    }
    
    .chat-header {
        padding: 10px 12px;
    }
    
    .chat-info h4 {
        font-size: 13px;
    }
    
    .chat-info p {
        font-size: 10px;
    }
    
    .chat-messages {
        padding: 8px 10px;
    }
    
    .message-content {
        font-size: 12px;
        padding: 8px 10px;
        max-width: 75%;
    }
    
    .suggestion-btn {
        font-size: 10px;
        padding: 4px 8px;
        margin: 2px;
    }
    
    .chat-input-container {
        padding: 8px 10px 10px;
    }
    
    .chat-input {
        font-size: 13px;
        padding: 6px 10px;
    }
    
    .chat-toggle-btn {
        width: 40px;
        height: 40px;
    }
    
    .chat-toggle-btn i {
        font-size: 16px;
    }
    
    .chat-send-btn {
        width: 30px;
        height: 30px;
    }
    
    .chat-send-btn i {
        font-size: 12px;
    }
}

/* Scrollbar styling */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #800000;
    border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #a52a2a;
}

/* Proactive popup notification */
.chat-popup-notification {
    position: absolute;
    bottom: 80px;
    right: 0;
    background: white;
    border-radius: 15px;
    padding: 15px 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    max-width: 280px;
    display: none;
    animation: slideInUp 0.5s ease-out;
    border-left: 4px solid #800000;
}

.chat-popup-notification.show {
    display: block;
}

.popup-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
}

.popup-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    overflow: hidden;
    border: 2px solid #800000;
}

.popup-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.popup-title {
    font-weight: 600;
    color: #333;
    font-size: 14px;
    margin: 0;
}

.popup-close {
    margin-left: auto;
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    font-size: 16px;
    padding: 0;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.popup-close:hover {
    color: #666;
}

.popup-message {
    font-size: 13px;
    color: #555;
    line-height: 1.4;
    margin-bottom: 10px;
}

.popup-action {
    background: linear-gradient(135deg, #800000, #a52a2a);
    color: white;
    border: none;
    border-radius: 20px;
    padding: 8px 16px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
}

.popup-action:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(139, 0, 0, 0.3);
}

@keyframes slideInUp {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Mobile-specific animations */
@media (max-width: 480px) {
    .chat-popup-notification {
        animation: slideInUp 0.4s ease-out;
    }
    
    .chat-container.active {
        animation: slideInRight 0.3s ease-out;
    }
}

/* Notification badge on chat button */
.chat-notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 20px;
    height: 20px;
    background: #ff4757;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    color: white;
    font-weight: bold;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 71, 87, 0.7);
    }
    70% {
        transform: scale(1.1);
        box-shadow: 0 0 0 10px rgba(255, 71, 87, 0);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(255, 71, 87, 0);
    }
}

</style>

<div class="ai-chat-widget">
    <!-- Proactive Popup Notification -->
    <div class="chat-popup-notification" id="chatPopup">
        <div class="popup-header">
            <div class="popup-avatar">
                <img src="assets/img/logo.png" alt="MOIST Logo">
            </div>
            <h4 class="popup-title">Need Help?</h4>
            <button class="popup-close" id="popupClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="popup-message">
            Don't know how to evaluate? Feel free to ask me anything about the evaluation process!
        </div>
        <button class="popup-action" id="popupAction">
            <i class="fas fa-comments"></i> Ask EvalBot
        </button>
    </div>
    
    <!-- Chat Toggle Button -->
    <button class="chat-toggle-btn" id="chatToggle">
        <i class="fas fa-comments"></i>
        <i class="fas fa-times"></i>
        <span class="chat-notification-badge" id="notificationBadge">!</span>
    </button>
    
    <!-- Chat Container -->
    <div class="chat-container" id="chatContainer">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="chat-avatar">
                <img src="assets/img/logo.png" alt="MOIST Logo">
            </div>
            <div class="chat-info">
                <h4>EvalChtBot Assistant</h4>
                <p>Here to help with your evaluations</p>
            </div>
        </div>
        
        <!-- Chat Messages -->
        <div class="chat-messages" id="chatMessages">
            <div class="message ai">
                <div class="message-avatar">
                    <img src="assets/img/logo.png" alt="MOIST Logo">
                </div>
                <div class="message-content">
                    Hi! I'm EvalBot, your evaluation assistant. I'm here to help you with:
                    <div class="quick-suggestions">
                        <button class="suggestion-btn" onclick="sendQuickMessage('How do I evaluate a teacher?')">How to evaluate?</button>
                        <button class="suggestion-btn" onclick="sendQuickMessage('What do the ratings mean?')">Rating meanings</button>
                        <button class="suggestion-btn" onclick="sendQuickMessage('Can I change my evaluation?')">Edit evaluation</button>
                        <button class="suggestion-btn" onclick="sendQuickMessage('Help with technical issues')">Technical help</button>
                        <button class="suggestion-btn" onclick="sendQuickMessage('Contact developer')">Contact Developer</button>
                    </div>
                </div>
            </div>
            
            <!-- Typing Indicator -->
            <div class="message ai" id="typingIndicator">
                <div class="message-avatar">
                    <img src="assets/img/logo.png" alt="MOIST Logo">
                </div>
                <div class="typing-indicator">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chat Input -->
        <div class="chat-input-container">
            <input type="text" class="chat-input" id="chatInput" placeholder="Ask me anything about evaluations..." maxlength="500">
            <button class="chat-send-btn" id="chatSend">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script>
// AI Chat Assistant JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('chatToggle');
    const chatContainer = document.getElementById('chatContainer');
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const chatSend = document.getElementById('chatSend');
    const typingIndicator = document.getElementById('typingIndicator');
    const chatPopup = document.getElementById('chatPopup');
    const popupClose = document.getElementById('popupClose');
    const popupAction = document.getElementById('popupAction');
    const notificationBadge = document.getElementById('notificationBadge');
    
    let isOpen = false;
    let popupShown = false;
    let popupInterval;
    let userInteracted = false;
    
    // Start recurring popup every 15 seconds
    function startRecurringPopup() {
        popupInterval = setInterval(function() {
            if (!isOpen && !userInteracted) {
                showProactivePopup();
                // Auto-hide after 5 seconds
                setTimeout(function() {
                    hideProactivePopup();
                }, 5000);
            }
        }, 15000);
    }
    
    // Start the recurring popup after initial 15 seconds
    setTimeout(startRecurringPopup, 15000);
    
    // Show proactive popup function
    function showProactivePopup() {
        chatPopup.classList.add('show');
        notificationBadge.style.display = 'flex';
        popupShown = true;
    }
    
    // Hide proactive popup function
    function hideProactivePopup() {
        chatPopup.classList.remove('show');
        notificationBadge.style.display = 'none';
    }
    
    // Stop recurring popup when user interacts
    function stopRecurringPopup() {
        userInteracted = true;
        if (popupInterval) {
            clearInterval(popupInterval);
        }
        hideProactivePopup();
    }
    
    // Close popup button
    popupClose.addEventListener('click', function() {
        hideProactivePopup();
        // Don't stop recurring - user might still need help later
    });
    
    // Popup action button - open chat
    popupAction.addEventListener('click', function() {
        stopRecurringPopup();
        openChat();
        // Send a welcome message
        setTimeout(() => {
            addMessage("Hi! I see you might need help with evaluations. What would you like to know?", 'ai');
        }, 500);
    });
    
    // Function to open chat
    function openChat() {
        isOpen = true;
        chatToggle.classList.add('active');
        chatContainer.classList.add('active');
        chatInput.focus();
        stopRecurringPopup();
    }
    
    // Toggle chat
    chatToggle.addEventListener('click', function() {
        isOpen = !isOpen;
        chatToggle.classList.toggle('active', isOpen);
        chatContainer.classList.toggle('active', isOpen);
        
        if (isOpen) {
            chatInput.focus();
            hideProactivePopup();
        }
    });
    
    // Send message
    function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;
        
        // Add user message
        addMessage(message, 'user');
        chatInput.value = '';
        
        // Show typing indicator
        showTyping();
        
        // Simulate AI response
        setTimeout(() => {
            hideTyping();
            const response = getAIResponse(message);
            addMessage(response, 'ai');
        }, 1000 + Math.random() * 2000);
    }
    
    // Add message to chat
    function addMessage(content, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.innerHTML = sender === 'ai' ? '<img src="assets/img/logo.png" alt="MOIST Logo">' : '<i class="fas fa-user"></i>';
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        messageContent.innerHTML = content;
        
        messageDiv.appendChild(avatar);
        messageDiv.appendChild(messageContent);
        
        chatMessages.insertBefore(messageDiv, typingIndicator);
        scrollToBottom();
    }
    
    // Show typing indicator
    function showTyping() {
        typingIndicator.style.display = 'flex';
        scrollToBottom();
    }
    
    // Hide typing indicator
    function hideTyping() {
        typingIndicator.style.display = 'none';
    }
    
    // Scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Event listeners
    chatSend.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });
    
    // Quick message function
    window.sendQuickMessage = function(message) {
        chatInput.value = message;
        sendMessage();
    };
    
    // AI Response Generator
    function getAIResponse(message) {
        const lowerMessage = message.toLowerCase();
        
        // Evaluation help responses
        if (lowerMessage.includes('evaluate') || lowerMessage.includes('how to')) {
            return `To evaluate a teacher:<br>
                    1. Select the teacher from the list<br>
                    2. Rate each criteria from 1-5 (1=Poor, 5=Excellent)<br>
                    3. Add optional comments<br>
                    4. Submit your evaluation<br><br>
                    <strong>Remember:</strong> Be honest and constructive in your feedback!`;
        }
        
        if (lowerMessage.includes('rating') || lowerMessage.includes('mean')) {
            return `<strong>Rating Scale:</strong><br>
                    • <strong>5 - Excellent:</strong> Outstanding performance<br>
                    • <strong>4 - Very Good:</strong> Above average<br>
                    • <strong>3 - Good:</strong> Satisfactory<br>
                    • <strong>2 - Fair:</strong> Needs improvement<br>
                    • <strong>1 - Poor:</strong> Unsatisfactory<br><br>
                    Choose the rating that best reflects your experience.`;
        }
        
        if (lowerMessage.includes('change') || lowerMessage.includes('edit') || lowerMessage.includes('modify')) {
            return `Once submitted, evaluations typically cannot be changed to ensure fairness. However, if you made an error:<br><br>
                    1. Contact your IT Developer or administrator immediately<br>
                    2. Explain the situation<br>
                    3. They may be able to help reset your evaluation<br><br>
                    Always double-check before submitting!`;
        }
        
        if (lowerMessage.includes('technical') || lowerMessage.includes('problem') || lowerMessage.includes('error')) {
            return `For technical issues:<br>
                    1. <strong>Refresh the page</strong> and try again<br>
                    2. <strong>Clear browser cache</strong> (Ctrl+F5)<br>
                    3. <strong>Try a different browser</strong><br>
                    4. <strong>Check internet connection</strong><br><br>
                    Still having issues? Contact your IT administrator or teacher for help.`;
        }
        
        if (lowerMessage.includes('anonymous') || lowerMessage.includes('private')) {
            return `Your evaluations are <strong>confidential</strong>. Teachers cannot see who submitted specific evaluations - they only see the overall results and anonymous feedback.<br><br>
                    This ensures you can give honest feedback without worry!`;
        }
        
        if (lowerMessage.includes('deadline') || lowerMessage.includes('when') || lowerMessage.includes('time')) {
            return `Evaluation deadlines are set by your school administration. You can usually see the deadline on your evaluation page.<br><br>
                    <strong>Tip:</strong> Don't wait until the last minute - complete your evaluations early!`;
        }
        
        if (lowerMessage.includes('comment') || lowerMessage.includes('feedback')) {
            return `When writing comments:<br>
                    • Be <strong>specific</strong> and constructive<br>
                    • Focus on teaching methods and classroom experience<br>
                    • Use respectful language<br>
                    • Mention both strengths and areas for improvement<br><br>
                    Good feedback helps teachers improve their teaching!`;
        }
        
        if (lowerMessage.includes('hello') || lowerMessage.includes('hi') || lowerMessage.includes('hey')) {
            return `Hello! 👋 I'm here to help you with the faculty evaluation process. What would you like to know?<br><br>
                    You can ask me about ratings, how to evaluate, technical issues, or anything else related to evaluations!`;
        }
        
        if (lowerMessage.includes('thank') || lowerMessage.includes('thanks')) {
            return `You're welcome! 😊 I'm always here to help. If you have any other questions about evaluations, just ask!<br><br>
                    Good luck with your evaluations!`;
        }
        
        if (lowerMessage.includes('contact') && lowerMessage.includes('developer')) {
            return `<div style="background: linear-gradient(135deg, #800000, #a52a2a); padding: 20px; border-radius: 10px; color: white; margin: 10px 0;">
                    <h4 style="margin: 0 0 15px 0; color: white; text-align: center;"><i class="fas fa-code"></i> System Developers</h4>
                    
                    <!-- Developer Carousel Container -->
                    <div id="devCarousel" style="position: relative; overflow: hidden; margin-bottom: 15px;">
                        <!-- Developer Slides -->
                        <div class="dev-slides">
                            <!-- Developer 1: Carl Cabrera -->
                            <div class="dev-slide active" style="display: block;">
                                <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center;">
                                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2em;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <p style="margin: 0 0 15px 0; font-weight: bold; font-size: 1.2em;">
                                        Carl Cabrera
                                    </p>
                                    <p style="margin: 0 0 10px 0; line-height: 1.5;">
                                        <i class="fas fa-phone"></i> 
                                        <a href="tel:+639169035405" style="color: #fbbf24; text-decoration: none;">+63 916 903 5405</a>
                                    </p>
                                    <p style="margin: 0; line-height: 1.5;">
                                        <i class="fas fa-envelope"></i> 
                                        <a href="mailto:carlcabrera090@gmail.com" style="color: #fbbf24; text-decoration: none; word-break: break-all;">carlcabrera090@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Developer 2: Maria Lanie Valmoria -->
                            <div class="dev-slide" style="display: none;">
                                <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center;">
                                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2em;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <p style="margin: 0 0 15px 0; font-weight: bold; font-size: 1.2em;">
                                        Maria Lanie Valmoria
                                    </p>
                                    <p style="margin: 0; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                        <i class="fas fa-info-circle"></i> 
                                        Contact information available upon request
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Developer 3: Denso Diosdado Jr -->
                            <div class="dev-slide" style="display: none;">
                                <div style="background: rgba(255,255,255,0.1); padding: 20px; border-radius: 8px; text-align: center;">
                                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(255,255,255,0.2); margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 2em;">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <p style="margin: 0 0 15px 0; font-weight: bold; font-size: 1.2em;">
                                        Denso Diosdado Jr
                                    </p>
                                    <p style="margin: 0; line-height: 1.5; color: rgba(255,255,255,0.8);">
                                        <i class="fas fa-info-circle"></i> 
                                        Contact information available upon request
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation Buttons -->
                        <button onclick="(function(){ var s=document.querySelectorAll('.dev-slide'); var i=document.querySelectorAll('.dev-indicator'); if(!window.cds) window.cds=0; s[window.cds].style.display='none'; i[window.cds].style.opacity='0.5'; window.cds--; if(window.cds<0) window.cds=s.length-1; s[window.cds].style.display='block'; i[window.cds].style.opacity='1'; })()" style="position: absolute; left: 5px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.3); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-size: 0.9em; display: flex; align-items: center; justify-content: center; transition: all 0.3s; z-index: 10;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button onclick="(function(){ var s=document.querySelectorAll('.dev-slide'); var i=document.querySelectorAll('.dev-indicator'); if(!window.cds) window.cds=0; s[window.cds].style.display='none'; i[window.cds].style.opacity='0.5'; window.cds++; if(window.cds>=s.length) window.cds=0; s[window.cds].style.display='block'; i[window.cds].style.opacity='1'; })()" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.3); border: none; color: white; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; font-size: 0.9em; display: flex; align-items: center; justify-content: center; transition: all 0.3s; z-index: 10;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    
                    <!-- Slide Indicators -->
                    <div style="text-align: center; margin-bottom: 15px;">
                        <span class="dev-indicator active" onclick="(function(){ var s=document.querySelectorAll('.dev-slide'); var i=document.querySelectorAll('.dev-indicator'); s[window.cds||0].style.display='none'; i[window.cds||0].style.opacity='0.5'; window.cds=0; s[0].style.display='block'; i[0].style.opacity='1'; })()" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: white; margin: 0 5px; cursor: pointer; opacity: 1;"></span>
                        <span class="dev-indicator" onclick="(function(){ var s=document.querySelectorAll('.dev-slide'); var i=document.querySelectorAll('.dev-indicator'); s[window.cds||0].style.display='none'; i[window.cds||0].style.opacity='0.5'; window.cds=1; s[1].style.display='block'; i[1].style.opacity='1'; })()" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: white; margin: 0 5px; cursor: pointer; opacity: 0.5;"></span>
                        <span class="dev-indicator" onclick="(function(){ var s=document.querySelectorAll('.dev-slide'); var i=document.querySelectorAll('.dev-indicator'); s[window.cds||0].style.display='none'; i[window.cds||0].style.opacity='0.5'; window.cds=2; s[2].style.display='block'; i[2].style.opacity='1'; })()" style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: white; margin: 0 5px; cursor: pointer; opacity: 0.5;"></span>
                    </div>
                    
                    <p style="margin: 0; font-size: 0.85em; opacity: 0.9; line-height: 1.5; text-align: center;">
                        <i class="fas fa-info-circle"></i> For technical support, system issues, or feature requests, feel free to contact any of the developers.
                    </p>
                </div>` + 
                `<script>
                    setTimeout(function() {
                        if (!window.devSlideInitialized) {
                            window.devSlideInitialized = true;
                            window.currentDevSlide = 0;
                            
                            window.changeDevSlide = function(direction) {
                                const slides = document.querySelectorAll('.dev-slide');
                                const indicators = document.querySelectorAll('.dev-indicator');
                                
                                if (slides.length === 0) return;
                                
                                slides[window.currentDevSlide].style.display = 'none';
                                indicators[window.currentDevSlide].style.opacity = '0.5';
                                indicators[window.currentDevSlide].classList.remove('active');
                                
                                window.currentDevSlide += direction;
                                
                                if (window.currentDevSlide >= slides.length) window.currentDevSlide = 0;
                                if (window.currentDevSlide < 0) window.currentDevSlide = slides.length - 1;
                                
                                slides[window.currentDevSlide].style.display = 'block';
                                indicators[window.currentDevSlide].style.opacity = '1';
                                indicators[window.currentDevSlide].classList.add('active');
                            };
                            
                            window.showDevSlide = function(index) {
                                const slides = document.querySelectorAll('.dev-slide');
                                const indicators = document.querySelectorAll('.dev-indicator');
                                
                                if (slides.length === 0) return;
                                
                                slides[window.currentDevSlide].style.display = 'none';
                                indicators[window.currentDevSlide].style.opacity = '0.5';
                                indicators[window.currentDevSlide].classList.remove('active');
                                
                                window.currentDevSlide = index;
                                
                                slides[window.currentDevSlide].style.display = 'block';
                                indicators[window.currentDevSlide].style.opacity = '1';
                                indicators[window.currentDevSlide].classList.add('active');
                            };
                        }
                    }, 100);
                <\/script>`;
        }
        
        // Default response
        return `I understand you're asking about "${message}". Here are some things I can help you with:<br><br>
                • <strong>How to evaluate teachers</strong><br>
                • <strong>Understanding rating scales</strong><br>
                • <strong>Technical troubleshooting</strong><br>
                • <strong>Evaluation policies</strong><br>
                • <strong>Feedback and comments</strong><br>
                • <strong>Contact Developer</strong><br><br>
                Could you be more specific about what you'd like to know?`;
    }
});
</script>
