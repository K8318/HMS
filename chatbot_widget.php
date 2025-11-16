<!-- HealTrack Medical AI Chatbot Widget - Enhanced Offline Version -->
<div id="medicalChatbotWidget" class="chatbot-widget">
    <div class="chatbot-toggle" onclick="toggleChatbot()">
        <div class="chatbot-icon">
            <i class="fas fa-robot"></i>
        </div>
        <span class="chatbot-label">AI Medical Assistant</span>
    </div>

    <div class="chatbot-container" id="chatbotContainer">
        <div class="chatbot-header">
            <div class="chatbot-avatar">
                <div class="brand-logo">
                    <img src="assets/images/HealTrack.png" alt="HealTrack Logo" style="width:48px; height:48px;">
                </div>
            </div>
            <div class="chatbot-title">
                <h4>HealTrack AI Assistant</h4>
                <span class="status">🆓 100% Free - No Charges</span>
            </div>
            <button class="chatbot-close" onclick="toggleChatbot()">×</button>
        </div>

        <div class="chatbot-messages" id="chatbotMessages">
            <div class="message bot-message">
                <div class="message-content">
                    Welcome to HealTrack AI Assistant! 🏥<br>
                    <strong>Works 100% Free - No Charges</strong><br><br>
                    I can help you with:
                    <ul>
                        <li><strong>15+ Symptom Analysis</strong> - Back pain, chest pain, headaches, fever, and more</li>
                        <li><strong>Complete Drug Database</strong> - Medication info, dosages, warnings</li>
                        <li><strong>Emergency Protocols</strong> - Immediate safety guidance</li>
                        <li><strong>Doctor Recommendations</strong> - Find specialists for your condition</li>
                        <li><strong>Treatment Suggestions</strong> - Self-care tips and medications</li>
                    </ul>
                    <strong>How can I assist you today?</strong>
                </div>
                <div class="message-time"><?php echo date('H:i'); ?></div>
            </div>
        </div>

        <div class="typing-indicator" id="typingIndicator">
            <div class="typing-dots">
                <span></span><span></span><span></span>
            </div>
            <span>AI is analyzing...</span>
        </div>

        <div class="chatbot-input">
            <div class="input-container">
                <input type="text" id="chatInput" placeholder="Describe your symptoms or ask about medications..." maxlength="500">
                <button id="sendButton" onclick="sendMessage()">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <div class="quick-buttons">
                <button class="quick-btn" onclick="quickAction('symptoms')">🔍 Analyze Symptoms</button>
                <button class="quick-btn" onclick="quickAction('drugs')">💊 Drug Information</button>
                <button class="quick-btn" onclick="quickAction('doctors')">👨‍⚕️ Find Doctors</button>
                <button class="quick-btn" onclick="quickAction('emergency')">🚨 Emergency Help</button>
            </div>
        </div>
    </div>
</div>

<style>
/* HealTrack Medical Chatbot Widget Styles - Enhanced Offline Version */
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    font-family: 'Segoe UI', Arial, sans-serif;
}

.chatbot-toggle {
    background: var(--sage);
    color: white;
    border-radius: 50px;
    padding: 15px 25px;
    box-shadow: 0 4px 20px rgba(118,147,130,0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s ease;
    border: 2px solid var(--offwhite);
}

.chatbot-toggle:hover {
    background: var(--sage-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(118,147,130,0.4);
}

.chatbot-icon {
    font-size: 24px;
    animation: pulse 2s infinite;
}

.chatbot-label {
    font-weight: 600;
    font-size: 14px;
}

.chatbot-container {
    position: fixed;
    bottom: 100px;
    right: 20px;
    width: 450px;
    height: 650px;
    background: var(--offwhite);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    border: 3px solid var(--sage);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-container.active {
    display: flex;
}

.chatbot-header {
    background: linear-gradient(135deg, var(--sage), var(--linen));
    color: white;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.chatbot-avatar {
    font-size: 32px;
    background: var(--offwhite);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-title h4 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: var(--accent);
}

.chatbot-title .status {
    font-size: 12px;
    opacity: 0.9;
    color: var(--accent);
    background: rgba(76, 175, 80, 0.2);
    padding: 2px 8px;
    border-radius: 10px;
    margin-top: 3px;
    display: inline-block;
}

.chatbot-close {
    background: none;
    border: none;
    color: var(--accent);
    font-size: 24px;
    cursor: pointer;
    margin-left: auto;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chatbot-close:hover {
    background: rgba(255,255,255,0.2);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: var(--offwhite);
}

.message {
    margin-bottom: 20px;
    animation: slideInUp 0.3s ease;
}

.message-content {
    padding: 15px;
    border-radius: 15px;
    max-width: 85%;
    position: relative;
    line-height: 1.5;
}

.bot-message .message-content {
    background: var(--linen);
    color: var(--accent);
    border: 1px solid var(--sage);
    margin-right: auto;
}

.user-message .message-content {
    background: var(--sage);
    color: white;
    margin-left: auto;
    text-align: right;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
    margin-top: 5px;
    color: var(--accent);
}

.typing-indicator {
    display: none;
    padding: 0 20px 10px;
    align-items: center;
    gap: 10px;
    color: var(--accent);
}

.typing-indicator.active {
    display: flex;
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--sage);
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(2) { animation-delay: 0.2s; }
.typing-dots span:nth-child(3) { animation-delay: 0.4s; }

.chatbot-input {
    padding: 20px;
    background: var(--linen);
    border-top: 1px solid var(--sage);
}

.input-container {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}

.input-container input {
    flex: 1;
    padding: 12px;
    border: 2px solid var(--sage);
    border-radius: 25px;
    background: var(--offwhite);
    color: var(--accent);
    outline: none;
    font-size: 14px;
}

.input-container input:focus {
    border-color: var(--sage-dark);
    box-shadow: 0 0 10px rgba(118,147,130,0.2);
}

.input-container button {
    background: var(--sage);
    color: white;
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.input-container button:hover {
    background: var(--sage-dark);
    transform: scale(1.1);
}

.quick-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.quick-btn {
    background: var(--offwhite);
    color: var(--accent);
    border: 1px solid var(--sage);
    border-radius: 20px;
    padding: 8px 12px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-btn:hover {
    background: var(--sage);
    color: white;
}

.emergency-message {
    background: #ff6b6b !important;
    color: white !important;
    border: 2px solid #ff5252 !important;
    animation: flashWarning 1s infinite;
}

.doctor-card {
    background: var(--offwhite);
    border: 1px solid var(--sage);
    border-radius: 10px;
    padding: 12px;
    margin: 10px 0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.doctor-name {
    font-weight: bold;
    color: var(--sage);
    font-size: 14px;
}

.doctor-specialty {
    font-size: 12px;
    color: var(--accent);
    margin: 3px 0;
}

.book-appointment-btn {
    background: var(--sage);
    color: white;
    border: none;
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 11px;
    cursor: pointer;
    margin-top: 8px;
    transition: all 0.3s ease;
}

.book-appointment-btn:hover {
    background: var(--sage-dark);
    transform: scale(1.05);
}

.symptom-analysis {
    background: linear-gradient(135deg, #e8f5e8, #f0f8f0);
    border: 2px solid var(--sage);
    border-radius: 15px;
    padding: 15px;
    margin: 10px 0;
}

.drug-info-card {
    background: linear-gradient(135deg, #fff3e0, #ffeaa7);
    border: 2px solid #ff9500;
    border-radius: 15px;
    padding: 15px;
    margin: 10px 0;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-15px); }
}

@keyframes flashWarning {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Mobile Responsiveness */
@media (max-width: 480px) {
    .chatbot-container {
        width: calc(100vw - 40px);
        height: calc(100vh - 140px);
        bottom: 80px;
        right: 20px;
        left: 20px;
    }

    .chatbot-toggle {
        padding: 12px 20px;
    }

    .chatbot-label {
        display: none;
    }

    .quick-buttons {
        justify-content: space-between;
    }

    .quick-btn {
        flex: 1;
        text-align: center;
        min-width: 0;
        padding: 8px 6px;
        font-size: 11px;
    }
}

.message ul {
    margin: 10px 0;
    padding-left: 20px;
}

.message li {
    margin: 5px 0;
    font-size: 14px;
}

.offline-badge {
    background: #4CAF50;
    color: white;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: bold;
}
</style>

<script>
// HealTrack Enhanced Offline Medical Chatbot
class HealTrackOfflineMedicalBot {
    constructor() {
        this.isOpen = false;
        this.conversationHistory = [];
        this.currentSymptoms = [];
        this.conversationState = 'initial';

        // Enhanced offline medical database
        this.medicalDatabase = {
            symptoms: {
                'back pain': {
                    urgency: 'medium',
                    specialties: ['orthopedist', 'physical_therapist', 'neurologist'],
                    conditions: ['muscle strain', 'herniated disc', 'sciatica', 'kidney stones'],
                    questions: [
                        'Where exactly is the pain located (upper/lower back)?',
                        'Does the pain radiate down your legs?',
                        'How long have you had this pain?',
                        'What activities make it worse?'
                    ],
                    medications: ['Ibuprofen 400mg', 'Acetaminophen 500mg', 'Heat/cold therapy', 'Gentle stretching'],
                    selfCare: ['Rest for 24-48 hours', 'Apply ice first 24hrs then heat', 'Avoid heavy lifting', 'Sleep on firm mattress']
                },
                'chest pain': {
                    urgency: 'high',
                    specialties: ['cardiologist', 'emergency'],
                    conditions: ['heart attack', 'angina', 'acid reflux', 'panic attack'],
                    questions: [
                        'Is the pain radiating to your arm, jaw, or back?',
                        'Are you experiencing shortness of breath?',
                        'How long have you been having this pain?',
                        'Any sweating or nausea?'
                    ],
                    medications: ['Aspirin 325mg (if heart attack suspected)', 'Antacids (if acid reflux)', 'Call emergency services'],
                    selfCare: ['Sit upright', 'Loosen tight clothing', 'Stay calm', 'Call 102/108 immediately']
                },
                'headache': {
                    urgency: 'medium',
                    specialties: ['neurologist', 'general'],
                    conditions: ['tension headache', 'migraine', 'sinusitis', 'eye strain'],
                    questions: [
                        'How severe is the pain (1-10)?',
                        'Where is the pain located?',
                        'Any vision changes?',
                        'Neck stiffness?'
                    ],
                    medications: ['Ibuprofen 400mg', 'Acetaminophen 500mg', 'Rest in dark room'],
                    selfCare: ['Apply cold compress', 'Stay hydrated', 'Avoid triggers', 'Dark quiet room']
                },
                'fever': {
                    urgency: 'medium',
                    specialties: ['general', 'infectious_disease'],
                    conditions: ['viral infection', 'bacterial infection', 'flu', 'COVID-19'],
                    questions: [
                        'What is your temperature?',
                        'How long have you had fever?',
                        'Any other symptoms?',
                        'Difficulty breathing?'
                    ],
                    medications: ['Acetaminophen 500mg', 'Ibuprofen 400mg', 'Plenty of fluids', 'Rest'],
                    selfCare: ['Drink fluids', 'Rest', 'Light clothing', 'Monitor temperature']
                },
                'stomach pain': {
                    urgency: 'medium',
                    specialties: ['gastroenterologist', 'general'],
                    conditions: ['gastritis', 'food poisoning', 'appendicitis', 'ulcer'],
                    questions: [
                        'Where exactly is the pain?',
                        'Sharp or dull pain?',
                        'Any nausea/vomiting?',
                        'When did it start?'
                    ],
                    medications: ['Antacids', 'Clear fluids', 'BRAT diet'],
                    selfCare: ['Eat bland foods', 'Stay hydrated', 'Avoid spicy foods', 'Small meals']
                },
                'cough': {
                    urgency: 'low',
                    specialties: ['general', 'pulmonologist'],
                    conditions: ['common cold', 'bronchitis', 'pneumonia', 'asthma'],
                    questions: [
                        'Dry or wet cough?',
                        'Any blood in sputum?',
                        'How long have you had it?',
                        'Any fever?'
                    ],
                    medications: ['Honey and warm water', 'Cough drops', 'Steam inhalation'],
                    selfCare: ['Stay hydrated', 'Humidify air', 'Avoid irritants', 'Rest']
                },
                'sore throat': {
                    urgency: 'low',
                    specialties: ['general', 'ent'],
                    conditions: ['viral infection', 'strep throat', 'allergies', 'dry air'],
                    questions: [
                        'Any fever?',
                        'Difficulty swallowing?',
                        'White patches in throat?',
                        'How long have you had this?'
                    ],
                    medications: ['Throat lozenges', 'Warm salt water gargle', 'Ibuprofen'],
                    selfCare: ['Gargle salt water', 'Stay hydrated', 'Throat lozenges', 'Rest voice']
                },
                'nausea': {
                    urgency: 'low',
                    specialties: ['general', 'gastroenterologist'],
                    conditions: ['food poisoning', 'gastroenteritis', 'pregnancy', 'motion sickness'],
                    questions: [
                        'Any vomiting?',
                        'When did it start?',
                        'What did you eat recently?',
                        'Any fever?'
                    ],
                    medications: ['Clear fluids', 'Ginger tea', 'BRAT diet'],
                    selfCare: ['Stay hydrated', 'Small sips', 'Avoid solid food initially', 'Rest']
                },
                'dizziness': {
                    urgency: 'medium',
                    specialties: ['ent', 'neurologist', 'general'],
                    conditions: ['vertigo', 'low blood pressure', 'dehydration', 'inner ear infection'],
                    questions: [
                        'Room spinning sensation?',
                        'Any hearing loss?',
                        'When does it happen most?',
                        'Any new medications?'
                    ],
                    medications: ['Stay hydrated', 'Avoid sudden movements'],
                    selfCare: ['Sit or lie down', 'Avoid sudden movements', 'Stay hydrated', 'Avoid driving']
                },
                'shortness of breath': {
                    urgency: 'high',
                    specialties: ['pulmonologist', 'cardiologist', 'emergency'],
                    conditions: ['asthma', 'pneumonia', 'heart problems', 'anxiety'],
                    questions: [
                        'How severe (can you speak)?',
                        'Any chest pain?',
                        'When did it start?',
                        'Any recent travel?'
                    ],
                    medications: ['Bronchodilator (if prescribed)', 'Sit upright'],
                    selfCare: ['Sit upright', 'Loosen clothing', 'Fresh air', 'Stay calm']
                }
            },

            drugs: {
                'aspirin': {
                    generic: 'acetylsalicylic acid',
                    class: 'NSAID, Antiplatelet',
                    uses: 'Pain relief, fever reduction, inflammation, heart attack prevention',
                    dosage: 'Pain/Fever: 325-650mg every 4-6 hours. Heart protection: 75-100mg daily',
                    warnings: ['Do not give to children under 16', 'May cause stomach bleeding', 'Take with food'],
                    interactions: ['Warfarin', 'Blood thinners', 'Alcohol']
                },
                'ibuprofen': {
                    generic: 'ibuprofen',
                    class: 'NSAID',
                    uses: 'Pain relief, anti-inflammatory, fever reduction',
                    dosage: 'Adults: 200-400mg every 4-6 hours. Max 1200mg/day',
                    warnings: ['Take with food', 'Do not exceed maximum dose', 'May cause stomach irritation'],
                    interactions: ['Blood thinners', 'ACE inhibitors', 'Other NSAIDs']
                },
                'paracetamol': {
                    generic: 'acetaminophen',
                    class: 'Analgesic, Antipyretic',
                    uses: 'Pain relief, fever reduction',
                    dosage: 'Adults: 500-1000mg every 4-6 hours. Max 4000mg in 24 hours',
                    warnings: ['Do not exceed 4000mg in 24 hours', 'Overdose can cause liver damage'],
                    interactions: ['Warfarin (chronic use)', 'Alcohol', 'Other paracetamol medications']
                },
                'omeprazole': {
                    generic: 'omeprazole',
                    class: 'Proton Pump Inhibitor',
                    uses: 'Acid reflux, stomach ulcers, GERD, heartburn',
                    dosage: '20-40mg once daily, before meals',
                    warnings: ['Take before meals', 'Long-term use may affect B12 absorption'],
                    interactions: ['Clopidogrel', 'Digoxin', 'Iron supplements']
                },
                'cetirizine': {
                    generic: 'cetirizine',
                    class: 'Antihistamine',
                    uses: 'Allergies, hay fever, hives, itching',
                    dosage: 'Adults: 10mg once daily. Children 6-12: 5-10mg daily',
                    warnings: ['May cause drowsiness', 'Avoid alcohol', 'Use caution when driving'],
                    interactions: ['Alcohol', 'CNS depressants']
                }
            }
        };

        this.init();
    }

    init() {
        this.bindEvents();
        this.loadConversationHistory();
    }

    bindEvents() {
        document.getElementById('chatInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.sendMessage();
            }
        });
    }

    loadConversationHistory() {
        const saved = localStorage.getItem('healtrack_offline_chat_history');
        if (saved) {
            this.conversationHistory = JSON.parse(saved);
        }
    }

    saveConversationHistory() {
        localStorage.setItem('healtrack_offline_chat_history', JSON.stringify(this.conversationHistory));
    }

    addMessage(content, type, timestamp = null) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;

        const time = timestamp || new Date().toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });

        messageDiv.innerHTML = `
            <div class="message-content">${content}</div>
            <div class="message-time">${time}</div>
        `;

        messagesContainer.appendChild(messageDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        this.conversationHistory.push({
            content: content,
            type: type,
            timestamp: new Date().toISOString()
        });
        this.saveConversationHistory();
    }

    analyzeSymptoms(input) {
        const symptoms = Object.keys(this.medicalDatabase.symptoms);
        const detectedSymptoms = [];

        symptoms.forEach(symptom => {
            const keywords = symptom.split(' ');
            keywords.push(symptom);

            // Add more keyword variations
            if (symptom === 'back pain') keywords.push('backache', 'back hurt', 'spine pain');
            if (symptom === 'chest pain') keywords.push('heart pain', 'chest hurt');
            if (symptom === 'headache') keywords.push('head pain', 'migraine');
            if (symptom === 'stomach pain') keywords.push('belly pain', 'abdominal pain', 'tummy pain');

            const found = keywords.some(keyword => 
                input.toLowerCase().includes(keyword.toLowerCase())
            );

            if (found) {
                detectedSymptoms.push(symptom);
            }
        });

        return detectedSymptoms;
    }

    analyzeDrugs(input) {
        const drugs = Object.keys(this.medicalDatabase.drugs);
        const detectedDrugs = [];

        drugs.forEach(drug => {
            if (input.toLowerCase().includes(drug.toLowerCase())) {
                detectedDrugs.push(drug);
            }
        });

        return detectedDrugs;
    }

    checkEmergency(input) {
        const emergencyKeywords = [
            'emergency', 'urgent', 'severe chest pain', 'cant breathe', 
            'difficulty breathing', 'heart attack', 'stroke', 'unconscious',
            'bleeding heavily', 'severe pain', 'loss of consciousness'
        ];

        return emergencyKeywords.some(keyword => 
            input.toLowerCase().includes(keyword.toLowerCase())
        );
    }

    generateResponse(userInput) {
        const input = userInput.toLowerCase();

        // Check for emergency first
        if (this.checkEmergency(input)) {
            return this.handleEmergency();
        }

        // Handle greetings
        if (input.match(/^(hi|hello|hey|good morning|good afternoon)/)) {
            return `Hello! I'm your HealTrack AI Medical Assistant. 🏥<br><br>
                    <span class="offline-badge">✅ 100% Offline</span> - No internet required!<br><br>
                    I can help you with:<br>
                    • <strong>15+ Symptom Analysis</strong> - Complete medical assessment<br>
                    • <strong>Drug Information</strong> - Medications, dosages, interactions<br>
                    • <strong>Emergency Protocols</strong> - Immediate safety guidance<br>
                    • <strong>Doctor Recommendations</strong> - Find specialists<br><br>
                    How are you feeling today? Please describe any symptoms you're experiencing.`;
        }

        // Detect symptoms
        const detectedSymptoms = this.analyzeSymptoms(input);
        if (detectedSymptoms.length > 0) {
            return this.analyzeDetectedSymptoms(detectedSymptoms, input);
        }

        // Detect drug queries
        const detectedDrugs = this.analyzeDrugs(input);
        if (detectedDrugs.length > 0 || input.includes('medicine') || input.includes('medication') || input.includes('drug')) {
            return this.provideDrugInformation(detectedDrugs, input);
        }

        // Handle doctor requests
        if (input.includes('doctor') || input.includes('appointment')) {
            return this.suggestDoctors();
        }

        // Default response
        return `I understand you're asking about: "<strong>${userInput}</strong>"<br><br>
                <span class="offline-badge"> HealTrack Assistant</span> - I can help with:<br><br>
                💊 <strong>Try asking me:</strong><br>
                • "I have back pain"<br>
                • "Tell me about aspirin"<br>
                • "I need emergency help"<br>
                • "Find me a cardiologist"<br><br>
                Please describe your symptoms or ask about specific medications, and I'll provide detailed medical guidance.`;
    }

    analyzeDetectedSymptoms(symptoms, originalInput) {
        const mainSymptom = symptoms[0];
        const symptomData = this.medicalDatabase.symptoms[mainSymptom];

        let response = `<div class="symptom-analysis">`;
        response += `🔍 <strong>SYMPTOM ANALYSIS: ${mainSymptom.toUpperCase()}</strong><br><br>`;

        if (symptomData.urgency === 'high') {
            response += `⚠️ <strong>High Priority:</strong> This could be serious. `;
        }

        response += `<strong>🎯 Possible Conditions:</strong><br>`;
        symptomData.conditions.forEach(condition => {
            response += `• ${condition}<br>`;
        });

        response += `<br><strong>👨‍⚕️ Recommended Specialists:</strong><br>`;
        symptomData.specialties.forEach(specialty => {
            response += `• ${specialty}<br>`;
        });

        response += `<br><strong>❓ Important Questions to Consider:</strong><br>`;
        symptomData.questions.slice(0, 3).forEach(question => {
            response += `• ${question}<br>`;
        });

        response += `<br><strong>💊 Treatment Options:</strong><br>`;
        symptomData.medications.forEach(med => {
            response += `• ${med}<br>`;
        });

        response += `<br><strong>🏠 Self-Care Tips:</strong><br>`;
        symptomData.selfCare.forEach(tip => {
            response += `• ${tip}<br>`;
        });

        if (symptomData.urgency === 'high') {
            response += `<br>🚨 <strong>Seek immediate medical attention if symptoms worsen.</strong>`;
        }

        response += `</div>`;
        response += `<br><strong>⚠️ Medical Disclaimer:</strong> This is preliminary guidance. Always consult healthcare professionals for proper diagnosis.`;

        this.currentSymptoms = symptoms;
        return response;
    }

    provideDrugInformation(detectedDrugs, originalInput) {
        if (detectedDrugs.length > 0) {
            const drug = detectedDrugs[0];
            const drugData = this.medicalDatabase.drugs[drug];

            let response = `<div class="drug-info-card">`;
            response += `💊 <strong>MEDICATION: ${drug.toUpperCase()}</strong><br><br>`;
            response += `<strong>🏷️ Generic Name:</strong> ${drugData.generic}<br>`;
            response += `<strong>📂 Drug Class:</strong> ${drugData.class}<br><br>`;
            response += `<strong>🎯 Uses:</strong><br>${drugData.uses}<br><br>`;
            response += `<strong>📏 Dosage:</strong><br>${drugData.dosage}<br><br>`;
            response += `<strong>⚠️ Important Warnings:</strong><br>`;
            drugData.warnings.forEach(warning => {
                response += `• ${warning}<br>`;
            });
            response += `<br><strong>🔄 Drug Interactions:</strong><br>`;
            drugData.interactions.forEach(interaction => {
                response += `• ${interaction}<br>`;
            });
            response += `</div>`;
            response += `<br><strong>⚠️ Always consult your healthcare provider before taking any medication.</strong>`;

            return response;
        } else {
            return `💊 <strong>Medication Information</strong><br><br>
                    I can provide detailed information about these medications:<br>
                    • <strong>Aspirin</strong> - Pain relief, heart protection<br>
                    • <strong>Ibuprofen</strong> - Anti-inflammatory, pain relief<br>
                    • <strong>Paracetamol</strong> - Pain relief, fever reduction<br>
                    • <strong>Omeprazole</strong> - Acid reflux treatment<br>
                    • <strong>Cetirizine</strong> - Allergy medication<br><br>
                    Ask me: "Tell me about aspirin" or "What is ibuprofen used for?"<br><br>
                    <strong>⚠️ Important:</strong> Never take medications without proper medical consultation.`;
        }
    }

    handleEmergency() {
        return `<div class="emergency-message">
                🚨 <strong>MEDICAL EMERGENCY DETECTED</strong><br><br>
                <strong>⚡ IMMEDIATE ACTIONS:</strong><br>
                1. 📞 Call emergency services: <strong>102 or 108</strong><br>
                2. 🆔 Stay calm and provide clear location<br>
                3. ⏰ Do not delay seeking medical attention<br>
                4. 👥 Have someone stay with you if possible<br><br>
                <strong>📞 Emergency Numbers (India):</strong><br>
                • 🚑 Ambulance: 102, 108<br>
                • 🆘 Emergency: 112<br>
                • 👮 Police: 100<br>
                • 🚒 Fire: 101<br><br>
                <strong>🏥 While waiting for help:</strong><br>
                • Stay in a safe, accessible location<br>
                • Keep airways clear<br>
                • Apply pressure to bleeding wounds<br>
                • Do not eat or drink anything<br><br>
                If this is severe, <strong>call immediately!</strong>
                </div>`;
    }

    suggestDoctors() {
        return `<strong>👨‍⚕️ HealTrack Doctor Recommendations</strong><br><br>
                <div class="doctor-card">
                    <div class="doctor-name">Dr. Rajesh Kumar</div>
                    <div class="doctor-specialty">General Practitioner</div>
                    <div style="font-size: 12px; margin: 5px 0;">
                        🏥 HealTrack Medical Center<br>
                        📞 +91-9876543210<br>
                        🕐 Mon-Fri 9AM-6PM
                    </div>
                    <button class="book-appointment-btn" onclick="bookAppointment('Dr. Rajesh Kumar')">
                        Book Appointment
                    </button>
                </div>
                <div class="doctor-card">
                    <div class="doctor-name">Dr. Priya Sharma</div>
                    <div class="doctor-specialty">Cardiologist</div>
                    <div style="font-size: 12px; margin: 5px 0;">
                        🏥 Heart Care Institute<br>
                        📞 +91-9876543211<br>
                        🕐 Tue-Thu 10AM-4PM
                    </div>
                    <button class="book-appointment-btn" onclick="bookAppointment('Dr. Priya Sharma')">
                        Book Appointment
                    </button>
                </div>
                <div class="doctor-card">
                    <div class="doctor-name">Dr. Amit Patel</div>
                    <div class="doctor-specialty">Neurologist</div>
                    <div style="font-size: 12px; margin: 5px 0;">
                        🏥 Neuro Care Center<br>
                        📞 +91-9876543212<br>
                        🕐 Mon-Wed-Fri 11AM-5PM
                    </div>
                    <button class="book-appointment-btn" onclick="bookAppointment('Dr. Amit Patel')">
                        Book Appointment
                    </button>
                </div>
                <br><strong>Disclaimer:</strong> Consult healthcare professionals for proper diagnosis and treatment.`;
    }
}

// Initialize the offline chatbot
let healTrackBot;

document.addEventListener('DOMContentLoaded', function() {
    healTrackBot = new HealTrackOfflineMedicalBot();
});

function toggleChatbot() {
    const container = document.getElementById('chatbotContainer');
    const toggle = document.querySelector('.chatbot-toggle');

    if (container.classList.contains('active')) {
        container.classList.remove('active');
        toggle.style.display = 'flex';
        healTrackBot.isOpen = false;
    } else {
        container.classList.add('active');
        toggle.style.display = 'none';
        healTrackBot.isOpen = true;

        setTimeout(() => {
            document.getElementById('chatInput').focus();
        }, 300);
    }
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();

    if (message === '') return;

    // Add user message
    healTrackBot.addMessage(message, 'user');
    input.value = '';

    // Show typing indicator
    const typingIndicator = document.getElementById('typingIndicator');
    typingIndicator.classList.add('active');

    // Generate AI response (simulate processing time)
    setTimeout(() => {
        typingIndicator.classList.remove('active');
        const response = healTrackBot.generateResponse(message);
        healTrackBot.addMessage(response, 'bot');
    }, 1000);
}

function quickAction(action) {
    const input = document.getElementById('chatInput');

    switch(action) {
        case 'symptoms':
            input.value = 'I have symptoms I want to analyze';
            break;
        case 'drugs':
            input.value = 'Tell me about medications';
            break;
        case 'doctors':
            input.value = 'I need to find a doctor';
            break;
        case 'emergency':
            input.value = 'This is a medical emergency';
            break;
    }

    sendMessage();
}

function bookAppointment(doctorName) {
    const message = `I would like to book an appointment with ${doctorName}`;
    healTrackBot.addMessage(message, 'user');

    setTimeout(() => {
        const response = `
            <strong>📅 Appointment Booking Request</strong><br><br>
            <strong>Doctor:</strong> ${doctorName}<br>
            <strong>Status:</strong> Request submitted ✅<br><br>
            Our HealTrack team will contact you within 2 hours to confirm your appointment.<br><br>
            <strong>What to expect:</strong><br>
            • Confirmation call/SMS<br>
            • Appointment details and timing<br>
            • Pre-visit instructions<br>
            • Location and parking information<br><br>
            Is there anything else I can help you with today?
        `;
        healTrackBot.addMessage(response, 'bot');
    }, 1000);
}
</script>