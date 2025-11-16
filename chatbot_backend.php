<?php
// HealTrack Medical Chatbot - 100% OFFLINE Version (No APIs Required!)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

include_once('hms/include/config.php');

class OfflineMedicalChatbot {
    private $conn;
    private $conversationContext = [];

    public function __construct($connection) {
        $this->conn = $connection;
        $this->initializeTables();
    }

    private function initializeTables() {
        $tables = [
            "CREATE TABLE IF NOT EXISTS offline_chatbot_conversations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                session_id VARCHAR(100) NOT NULL,
                user_message TEXT NOT NULL,
                bot_response TEXT NOT NULL,
                symptoms_detected JSON DEFAULT NULL,
                analysis_data JSON DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",

            "CREATE TABLE IF NOT EXISTS offline_medical_knowledge (
                id INT AUTO_INCREMENT PRIMARY KEY,
                symptom VARCHAR(200) NOT NULL,
                conditions JSON NOT NULL,
                severity VARCHAR(50) NOT NULL,
                specialties JSON NOT NULL,
                emergency_flags JSON DEFAULT NULL,
                follow_up_questions JSON DEFAULT NULL,
                medications JSON DEFAULT NULL,
                self_care_tips JSON DEFAULT NULL,
                when_to_see_doctor JSON DEFAULT NULL,
                UNIQUE KEY unique_symptom (symptom)
            )",

            "CREATE TABLE IF NOT EXISTS offline_drug_database (
                id INT AUTO_INCREMENT PRIMARY KEY,
                drug_name VARCHAR(200) NOT NULL,
                generic_name VARCHAR(200),
                drug_class VARCHAR(100),
                uses TEXT,
                dosage TEXT,
                side_effects JSON DEFAULT NULL,
                warnings JSON DEFAULT NULL,
                interactions JSON DEFAULT NULL,
                contraindications TEXT,
                UNIQUE KEY unique_drug (drug_name)
            )",

            "CREATE TABLE IF NOT EXISTS offline_emergency_protocols (
                id INT AUTO_INCREMENT PRIMARY KEY,
                condition_type VARCHAR(100) NOT NULL,
                symptoms JSON NOT NULL,
                immediate_actions JSON NOT NULL,
                emergency_numbers JSON NOT NULL,
                first_aid_steps JSON DEFAULT NULL
            )"
        ];

        foreach ($tables as $table) {
            mysqli_query($this->conn, $table);
        }

        $this->populateOfflineDatabase();
    }

    private function populateOfflineDatabase() {
        // Check if data already exists
        $check = mysqli_query($this->conn, "SELECT COUNT(*) as count FROM offline_medical_knowledge");
        $row = mysqli_fetch_assoc($check);

        if ($row['count'] < 15) {
            // Clear and repopulate
            mysqli_query($this->conn, "DELETE FROM offline_medical_knowledge");
            mysqli_query($this->conn, "DELETE FROM offline_drug_database");
            mysqli_query($this->conn, "DELETE FROM offline_emergency_protocols");

            $this->insertMedicalKnowledge();
            $this->insertDrugDatabase();
            $this->insertEmergencyProtocols();
        }
    }

    private function insertMedicalKnowledge() {
        $symptoms = [
            [
                'symptom' => 'back pain',
                'conditions' => '["Muscle Strain", "Herniated Disc", "Sciatica", "Kidney Stones", "Arthritis", "Poor Posture"]',
                'severity' => 'medium',
                'specialties' => '["Orthopedist", "Physical Therapist", "Neurologist", "Rheumatologist"]',
                'emergency_flags' => '["severe pain with fever", "numbness in legs", "loss of bladder control", "weakness in legs"]',
                'follow_up_questions' => '["Where exactly is the pain located (upper/lower back)?", "Does the pain radiate down your legs?", "How long have you had this pain?", "What activities make it worse?", "Any recent injuries or lifting?", "Rate pain 1-10?"]',
                'medications' => '["Ibuprofen 400mg", "Acetaminophen 500mg", "Muscle relaxants (prescribed)", "Topical pain relievers", "Heat/cold therapy"]',
                'self_care_tips' => '["Rest for 24-48 hours", "Apply ice first 24hrs, then heat", "Gentle stretching", "Avoid heavy lifting", "Sleep on firm mattress", "Maintain good posture"]',
                'when_to_see_doctor' => '["Pain persists >3 days", "Severe pain preventing movement", "Numbness or tingling", "Pain after injury", "Fever with back pain"]'
            ],
            [
                'symptom' => 'chest pain',
                'conditions' => '["Heart Attack", "Angina", "Acid Reflux", "Panic Attack", "Muscle Strain", "Costochondritis"]',
                'severity' => 'high',
                'specialties' => '["Cardiologist", "Emergency Medicine", "Gastroenterologist"]',
                'emergency_flags' => '["radiating pain to arm/jaw", "shortness of breath", "sweating", "nausea", "dizziness"]',
                'follow_up_questions' => '["Is pain radiating to arm, jaw, or back?", "Any shortness of breath?", "Are you sweating or nauseous?", "How severe (1-10)?", "How long has it lasted?", "Any heart problems before?"]',
                'medications' => '["Aspirin 325mg (if heart attack suspected)", "Antacids (if acid reflux)", "Nitroglycerin (if prescribed)"]',
                'self_care_tips' => '["Sit up straight", "Loosen tight clothing", "Stay calm", "Avoid physical activity"]',
                'when_to_see_doctor' => '["Immediately if severe", "Pain with breathing difficulty", "Radiating pain", "Chest pressure", "Any heart attack symptoms"]'
            ],
            [
                'symptom' => 'headache',
                'conditions' => '["Tension Headache", "Migraine", "Cluster Headache", "Sinusitis", "High Blood Pressure", "Eye Strain"]',
                'severity' => 'medium',
                'specialties' => '["Neurologist", "General Practitioner", "Ophthalmologist"]',
                'emergency_flags' => '["sudden severe headache", "neck stiffness", "vision changes", "high fever", "confusion"]',
                'follow_up_questions' => '["Rate severity (1-10)?", "Where is the pain located?", "Any vision changes?", "Neck stiffness?", "Nausea or vomiting?", "How long does it last?"]',
                'medications' => '["Ibuprofen 400mg", "Acetaminophen 500mg", "Sumatriptan (for migraines)", "Rest in dark room"]',
                'self_care_tips' => '["Rest in dark, quiet room", "Apply cold compress", "Stay hydrated", "Avoid triggers", "Regular sleep schedule", "Manage stress"]',
                'when_to_see_doctor' => '["Sudden severe headache", "Headache with fever", "Vision changes", "Frequent headaches", "Headache after injury"]'
            ],
            [
                'symptom' => 'fever',
                'conditions' => '["Viral Infection", "Bacterial Infection", "Flu", "COVID-19", "Pneumonia", "UTI"]',
                'severity' => 'medium',
                'specialties' => '["General Practitioner", "Infectious Disease", "Pediatrician"]',
                'emergency_flags' => '["fever over 103°F (39.4°C)", "difficulty breathing", "severe dehydration", "persistent vomiting", "confusion"]',
                'follow_up_questions' => '["What is your temperature?", "How long have you had fever?", "Any other symptoms?", "Difficulty breathing?", "Severe headache?", "Rash anywhere?"]',
                'medications' => '["Acetaminophen 500mg", "Ibuprofen 400mg", "Plenty of fluids", "Rest"]',
                'self_care_tips' => '["Drink plenty of fluids", "Rest", "Light clothing", "Room temperature baths", "Monitor temperature", "Eat light foods"]',
                'when_to_see_doctor' => '["Fever >103°F", "Fever >3 days", "Difficulty breathing", "Severe headache", "Persistent vomiting"]'
            ],
            [
                'symptom' => 'stomach pain',
                'conditions' => '["Gastritis", "Food Poisoning", "Appendicitis", "Ulcer", "IBS", "Gallstones"]',
                'severity' => 'medium',
                'specialties' => '["Gastroenterologist", "General Practitioner", "Emergency Medicine"]',
                'emergency_flags' => '["severe pain", "vomiting blood", "rigid abdomen", "high fever", "severe dehydration"]',
                'follow_up_questions' => '["Where exactly is the pain?", "Sharp or dull pain?", "Any nausea/vomiting?", "When did it start?", "What did you eat recently?", "Pain level (1-10)?"]',
                'medications' => '["Antacids", "Simethicone", "Clear fluids", "BRAT diet (Banana, Rice, Applesauce, Toast)"]',
                'self_care_tips' => '["Eat bland foods", "Stay hydrated", "Avoid spicy/fatty foods", "Small frequent meals", "Rest", "Heat pad on stomach"]',
                'when_to_see_doctor' => '["Severe pain", "Vomiting blood", "High fever", "Pain worsens", "Signs of dehydration"]'
            ],
            [
                'symptom' => 'cough',
                'conditions' => '["Common Cold", "Bronchitis", "Pneumonia", "Asthma", "Allergies", "COVID-19"]',
                'severity' => 'low',
                'specialties' => '["General Practitioner", "Pulmonologist", "Allergist"]',
                'emergency_flags' => '["coughing blood", "severe breathing difficulty", "high fever with cough", "chest pain"]',
                'follow_up_questions' => '["Dry or wet cough?", "Any blood in sputum?", "How long have you had it?", "Any fever?", "Difficulty breathing?", "Recent cold symptoms?"]',
                'medications' => '["Honey and warm water", "Cough drops", "Expectorants", "Steam inhalation"]',
                'self_care_tips' => '["Stay hydrated", "Humidify air", "Avoid irritants", "Rest", "Warm salt water gargle", "Honey (not for infants)"]',
                'when_to_see_doctor' => '["Coughing blood", "High fever", "Difficulty breathing", "Cough >3 weeks", "Chest pain with cough"]'
            ],
            [
                'symptom' => 'sore throat',
                'conditions' => '["Viral Infection", "Strep Throat", "Allergies", "Dry Air", "Acid Reflux", "Tonsillitis"]',
                'severity' => 'low',
                'specialties' => '["General Practitioner", "ENT Specialist"]',
                'emergency_flags' => '["difficulty swallowing", "high fever", "difficulty breathing", "drooling"]',
                'follow_up_questions' => '["Any fever?", "Difficulty swallowing?", "How long have you had this?", "White patches in throat?", "Swollen lymph nodes?", "Recent cold symptoms?"]',
                'medications' => '["Throat lozenges", "Warm salt water gargle", "Ibuprofen", "Acetaminophen"]',
                'self_care_tips' => '["Gargle warm salt water", "Stay hydrated", "Throat lozenges", "Avoid irritants", "Humidify air", "Rest voice"]',
                'when_to_see_doctor' => '["High fever", "White patches", "Difficulty swallowing", "Symptoms worsen", "Sore throat >1 week"]'
            ],
            [
                'symptom' => 'nausea',
                'conditions' => '["Food Poisoning", "Gastroenteritis", "Pregnancy", "Motion Sickness", "Medication Side Effect", "Migraine"]',
                'severity' => 'low',
                'specialties' => '["General Practitioner", "Gastroenterologist"]',
                'emergency_flags' => '["severe dehydration", "vomiting blood", "severe abdominal pain", "high fever"]',
                'follow_up_questions' => '["Any vomiting?", "When did it start?", "Any fever?", "What did you eat recently?", "Any medications recently?", "Pregnant?"]',
                'medications' => '["Clear fluids", "Ginger tea", "Small sips of water", "BRAT diet"]',
                'self_care_tips' => '["Stay hydrated", "Small frequent sips", "Avoid solid food initially", "Rest", "Fresh air", "Ginger"]',
                'when_to_see_doctor' => '["Severe dehydration", "Vomiting blood", "High fever", "Severe pain", "Signs of pregnancy"]'
            ],
            [
                'symptom' => 'dizziness',
                'conditions' => '["Vertigo", "Low Blood Pressure", "Dehydration", "Inner Ear Infection", "Medication Effect", "Anemia"]',
                'severity' => 'medium',
                'specialties' => '["ENT Specialist", "Neurologist", "General Practitioner"]',
                'emergency_flags' => '["loss of consciousness", "severe headache", "chest pain", "confusion", "difficulty speaking"]',
                'follow_up_questions' => '["Room spinning sensation?", "Any hearing loss?", "When does it happen most?", "Any new medications?", "Headache with dizziness?", "How long episodes last?"]',
                'medications' => '["Stay hydrated", "Avoid sudden movements", "Meclizine (if available)"]',
                'self_care_tips' => '["Sit or lie down", "Avoid sudden movements", "Stay hydrated", "Avoid driving", "Good lighting", "Hold railings"]',
                'when_to_see_doctor' => '["Frequent episodes", "With headache", "Hearing loss", "Fainting", "Chest pain with dizziness"]'
            ],
            [
                'symptom' => 'shortness of breath',
                'conditions' => '["Asthma", "Pneumonia", "Heart Problems", "Anxiety", "Pulmonary Embolism", "Allergic Reaction"]',
                'severity' => 'high',
                'specialties' => '["Pulmonologist", "Cardiologist", "Emergency Medicine"]',
                'emergency_flags' => '["severe breathing difficulty", "blue lips/fingernails", "chest pain", "loss of consciousness", "can't speak in sentences"]',
                'follow_up_questions' => '["How severe (can you speak)?", "Any chest pain?", "When did it start?", "Any recent travel?", "Known heart/lung problems?", "Any swelling in legs?"]',
                'medications' => '["Bronchodilator (if prescribed)", "Sit upright", "Loosen clothing"]',
                'self_care_tips' => '["Sit upright", "Loosen tight clothing", "Fresh air", "Stay calm", "Pursed lip breathing"]',
                'when_to_see_doctor' => '["Immediately if severe", "Blue lips", "Can't speak sentences", "Chest pain", "Sudden onset"]'
            ]
        ];

        foreach ($symptoms as $symptom) {
            $stmt = mysqli_prepare($this->conn,
                "INSERT INTO offline_medical_knowledge (symptom, conditions, severity, specialties, emergency_flags, follow_up_questions, medications, self_care_tips, when_to_see_doctor) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sssssssss",
                $symptom['symptom'],
                $symptom['conditions'],
                $symptom['severity'],
                $symptom['specialties'],
                $symptom['emergency_flags'],
                $symptom['follow_up_questions'],
                $symptom['medications'],
                $symptom['self_care_tips'],
                $symptom['when_to_see_doctor']
            );
            mysqli_stmt_execute($stmt);
        }
    }

    private function insertDrugDatabase() {
        $drugs = [
            [
                'drug_name' => 'aspirin',
                'generic_name' => 'acetylsalicylic acid',
                'drug_class' => 'NSAID, Antiplatelet',
                'uses' => 'Pain relief, fever reduction, inflammation, heart attack prevention, stroke prevention',
                'dosage' => 'Pain/Fever: 325-650mg every 4-6 hours. Heart protection: 75-100mg daily',
                'side_effects' => '["Stomach irritation", "Nausea", "Heartburn", "Increased bleeding risk", "Ringing in ears"]',
                'warnings' => '["Do not give to children under 16 (Reye syndrome risk)", "May cause stomach bleeding", "Consult doctor if on blood thinners", "Take with food", "Avoid if allergic to NSAIDs"]',
                'interactions' => '["Warfarin", "Other blood thinners", "Methotrexate", "ACE inhibitors", "Alcohol (increases bleeding risk)"]',
                'contraindications' => 'Children under 16, severe liver disease, active bleeding, severe kidney disease'
            ],
            [
                'drug_name' => 'ibuprofen',
                'generic_name' => 'ibuprofen',
                'drug_class' => 'NSAID',
                'uses' => 'Pain relief, fever reduction, inflammation, headaches, muscle pain, arthritis',
                'dosage' => 'Adults: 200-400mg every 4-6 hours. Maximum 1200mg/day without doctor supervision',
                'side_effects' => '["Stomach upset", "Nausea", "Dizziness", "Headache", "Drowsiness"]',
                'warnings' => '["Take with food", "Do not exceed maximum dose", "May cause stomach irritation", "Monitor kidney function", "Avoid in pregnancy third trimester"]',
                'interactions' => '["Blood thinners", "ACE inhibitors", "Lithium", "Methotrexate", "Other NSAIDs"]',
                'contraindications' => 'Severe kidney disease, active stomach ulcers, severe liver disease'
            ],
            [
                'drug_name' => 'paracetamol',
                'generic_name' => 'acetaminophen',
                'drug_class' => 'Analgesic, Antipyretic',
                'uses' => 'Pain relief, fever reduction, headaches, minor aches and pains',
                'dosage' => 'Adults: 500-1000mg every 4-6 hours. Maximum 4000mg in 24 hours',
                'side_effects' => '["Generally well tolerated", "Rare: skin rash", "Rare: liver problems with overdose"]',
                'warnings' => '["Do not exceed 4000mg in 24 hours", "Overdose can cause liver damage", "Check other medications for paracetamol content", "Use lower doses in liver disease"]',
                'interactions' => '["Warfarin (with chronic use)", "Alcohol (increases liver toxicity)", "Other paracetamol-containing medications"]',
                'contraindications' => 'Severe liver disease, known hypersensitivity'
            ],
            [
                'drug_name' => 'omeprazole',
                'generic_name' => 'omeprazole',
                'drug_class' => 'Proton Pump Inhibitor',
                'uses' => 'Acid reflux, stomach ulcers, GERD, heartburn prevention',
                'dosage' => '20-40mg once daily, preferably before meals',
                'side_effects' => '["Headache", "Nausea", "Abdominal pain", "Diarrhea", "Constipation"]',
                'warnings' => '["Take before meals", "Long-term use may affect vitamin B12 absorption", "May mask stomach cancer symptoms", "Complete prescribed course"]',
                'interactions' => '["Clopidogrel", "Digoxin", "Atazanavir", "Iron supplements", "Ketoconazole"]',
                'contraindications' => 'Known hypersensitivity to omeprazole or other PPIs'
            ],
            [
                'drug_name' => 'cetirizine',
                'generic_name' => 'cetirizine',
                'drug_class' => 'Antihistamine',
                'uses' => 'Allergies, hay fever, hives, itching, allergic rhinitis',
                'dosage' => 'Adults: 10mg once daily. Children 6-12 years: 5-10mg daily',
                'side_effects' => '["Drowsiness", "Dry mouth", "Fatigue", "Headache", "Dizziness"]',
                'warnings' => '["May cause drowsiness", "Avoid alcohol", "Use caution when driving", "Adjust dose in kidney disease"]',
                'interactions' => '["Alcohol", "CNS depressants", "Anticholinergics"]',
                'contraindications' => 'Severe kidney disease, hypersensitivity to cetirizine'
            ]
        ];

        foreach ($drugs as $drug) {
            $stmt = mysqli_prepare($this->conn,
                "INSERT INTO offline_drug_database (drug_name, generic_name, drug_class, uses, dosage, side_effects, warnings, interactions, contraindications) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sssssssss",
                $drug['drug_name'],
                $drug['generic_name'],
                $drug['drug_class'],
                $drug['uses'],
                $drug['dosage'],
                $drug['side_effects'],
                $drug['warnings'],
                $drug['interactions'],
                $drug['contraindications']
            );
            mysqli_stmt_execute($stmt);
        }
    }

    private function insertEmergencyProtocols() {
        $emergencies = [
            [
                'condition_type' => 'Heart Attack',
                'symptoms' => '["chest pain", "radiating pain to arm", "shortness of breath", "sweating", "nausea"]',
                'immediate_actions' => '["Call emergency services: 102/108", "Give aspirin 325mg if available", "Keep person seated upright", "Loosen tight clothing", "Monitor breathing"]',
                'emergency_numbers' => '["Ambulance: 102, 108", "Emergency: 112"]',
                'first_aid_steps' => '["Check responsiveness", "Call for help", "Give aspirin if conscious", "Prepare for CPR if needed", "Stay with patient"]'
            ],
            [
                'condition_type' => 'Severe Breathing Difficulty',
                'symptoms' => '["severe shortness of breath", "blue lips", "unable to speak", "wheezing", "gasping"]',
                'immediate_actions' => '["Call emergency services: 102/108", "Help person sit upright", "Loosen clothing around neck/chest", "Use rescue inhaler if available", "Stay calm and reassuring"]',
                'emergency_numbers' => '["Ambulance: 102, 108", "Emergency: 112"]',
                'first_aid_steps' => '["Position upright", "Clear airway", "Assist with medications", "Monitor consciousness", "Prepare for rescue breathing"]'
            ],
            [
                'condition_type' => 'Severe Bleeding',
                'symptoms' => '["heavy bleeding", "blood spurting", "blood soaking through bandages", "weakness", "pale skin"]',
                'immediate_actions' => '["Call emergency services: 102/108", "Apply direct pressure to wound", "Elevate injured area above heart", "Do not remove objects from wound", "Cover with clean cloth"]',
                'emergency_numbers' => '["Ambulance: 102, 108", "Emergency: 112"]',
                'first_aid_steps' => '["Apply pressure", "Elevate wound", "Cover bleeding", "Monitor for shock", "Keep person warm"]'
            ]
        ];

        foreach ($emergencies as $emergency) {
            $stmt = mysqli_prepare($this->conn,
                "INSERT INTO offline_emergency_protocols (condition_type, symptoms, immediate_actions, emergency_numbers, first_aid_steps) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param($stmt, "sssss",
                $emergency['condition_type'],
                $emergency['symptoms'],
                $emergency['immediate_actions'],
                $emergency['emergency_numbers'],
                $emergency['first_aid_steps']
            );
            mysqli_stmt_execute($stmt);
        }
    }

    public function handleRequest($data) {
        $action = $data['action'] ?? 'chat';
        $sessionId = $this->getSessionId();

        switch ($action) {
            case 'chat':
                return $this->processOfflineChat($data, $sessionId);
            case 'drug_info':
                return $this->getOfflineDrugInfo($data, $sessionId);
            case 'emergency_info':
                return $this->getEmergencyProtocol($data, $sessionId);
            default:
                return $this->processOfflineChat($data, $sessionId);
        }
    }

    private function processOfflineChat($data, $sessionId) {
        $userMessage = $data['message'] ?? '';

        // Analyze message
        $analysis = $this->analyzeMessage($userMessage);

        // Generate response
        $response = $this->generateOfflineResponse($userMessage, $analysis);

        // Save conversation
        $this->saveConversation($sessionId, $userMessage, $response, $analysis);

        return [
            'response' => $response,
            'analysis' => $analysis,
            'session_id' => $sessionId,
            'offline_mode' => true
        ];
    }

    private function analyzeMessage($message) {
        $message = strtolower($message);

        // Emergency detection
        $emergencyKeywords = [
            'emergency', 'urgent', 'severe pain', 'chest pain', 'heart attack', 
            'cant breathe', 'difficulty breathing', 'unconscious', 'bleeding heavily',
            'severe bleeding', 'choking', 'stroke', 'seizure'
        ];
        $isEmergency = false;
        foreach ($emergencyKeywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                $isEmergency = true;
                break;
            }
        }

        // Symptom detection
        $symptoms = $this->detectSymptoms($message);

        // Drug query detection
        $isDrugQuery = $this->isDrugQuery($message);
        $extractedDrug = $isDrugQuery ? $this->extractDrugName($message) : null;

        return [
            'is_emergency' => $isEmergency,
            'has_symptoms' => !empty($symptoms),
            'symptoms' => $symptoms,
            'is_drug_query' => $isDrugQuery,
            'extracted_drug' => $extractedDrug,
            'message_type' => $this->classifyMessageType($message)
        ];
    }

    private function detectSymptoms($message) {
        $symptomKeywords = [
            'back pain' => ['back pain', 'backache', 'back hurt', 'lower back pain', 'upper back pain', 'spine pain'],
            'chest pain' => ['chest pain', 'chest hurt', 'heart pain', 'chest pressure'],
            'headache' => ['headache', 'head pain', 'head hurt', 'migraine', 'head ache'],
            'fever' => ['fever', 'temperature', 'hot', 'burning up', 'high temperature'],
            'stomach pain' => ['stomach pain', 'belly pain', 'abdominal pain', 'stomach ache', 'tummy pain'],
            'cough' => ['cough', 'coughing', 'hack', 'hacking'],
            'nausea' => ['nausea', 'nauseous', 'sick stomach', 'queasy', 'feel like vomiting'],
            'dizziness' => ['dizzy', 'lightheaded', 'vertigo', 'spinning', 'unsteady'],
            'sore throat' => ['sore throat', 'throat pain', 'throat hurt', 'scratchy throat'],
            'shortness of breath' => ['short of breath', 'cant breathe', 'breathing difficulty', 'breathless', 'hard to breathe']
        ];

        $detectedSymptoms = [];
        foreach ($symptomKeywords as $symptom => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($message, $keyword) !== false) {
                    $detectedSymptoms[] = $symptom;
                    break;
                }
            }
        }

        return array_unique($detectedSymptoms);
    }

    private function isDrugQuery($message) {
        $drugKeywords = ['medicine', 'medication', 'drug', 'pill', 'tablet', 'about', 'tell me about'];
        foreach ($drugKeywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function extractDrugName($message) {
        $commonDrugs = ['aspirin', 'ibuprofen', 'acetaminophen', 'paracetamol', 'omeprazole', 'cetirizine'];
        foreach ($commonDrugs as $drug) {
            if (strpos($message, $drug) !== false) {
                return $drug;
            }
        }

        // Extract potential drug names (words >4 characters)
        $words = explode(' ', $message);
        foreach ($words as $word) {
            $word = trim($word, '.,!?');
            if (strlen($word) > 4 && ctype_alpha($word) && !in_array($word, ['about', 'medicine', 'medication'])) {
                return $word;
            }
        }

        return null;
    }

    private function classifyMessageType($message) {
        if (preg_match('/(hi|hello|hey|good)/i', $message)) return 'greeting';
        if (preg_match('/(doctor|appointment|hospital)/i', $message)) return 'medical_facility';
        if (preg_match('/(emergency|urgent|help)/i', $message)) return 'emergency';
        if (preg_match('/(medicine|medication|drug|pill)/i', $message)) return 'medication';
        return 'general';
    }

    private function generateOfflineResponse($message, $analysis) {
        // Handle emergencies first
        if ($analysis['is_emergency']) {
            return $this->generateEmergencyResponse();
        }

        // Handle greetings
        if ($analysis['message_type'] === 'greeting') {
            return $this->generateGreetingResponse();
        }

        // Handle drug queries
        if ($analysis['is_drug_query'] && $analysis['extracted_drug']) {
            return $this->generateOfflineDrugResponse($analysis['extracted_drug']);
        }

        // Handle symptoms
        if ($analysis['has_symptoms']) {
            return $this->generateComprehensiveSymptomResponse($analysis);
        }

        // Handle medical facility queries
        if ($analysis['message_type'] === 'medical_facility') {
            return $this->generateMedicalFacilityResponse();
        }

        // Default response
        return $this->generateDefaultResponse();
    }

    private function generateComprehensiveSymptomResponse($analysis) {
        $response = "🔍 <strong>Comprehensive Medical Analysis</strong>\n\n";
        $hasKnownSymptoms = false;

        foreach ($analysis['symptoms'] as $symptom) {
            $query = "SELECT * FROM offline_medical_knowledge WHERE symptom = ?";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $symptom);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $hasKnownSymptoms = true;
                $conditions = json_decode($row['conditions'], true);
                $specialties = json_decode($row['specialties'], true);
                $followUpQuestions = json_decode($row['follow_up_questions'], true);
                $medications = json_decode($row['medications'], true);
                $selfCareTips = json_decode($row['self_care_tips'], true);
                $whenToSeeDoctor = json_decode($row['when_to_see_doctor'], true);

                $response .= "📋 <strong>" . strtoupper($symptom) . " Analysis</strong>\n";
                $response .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";

                $response .= "🎯 <strong>Possible Conditions:</strong>\n";
                foreach (array_slice($conditions, 0, 4) as $condition) {
                    $response .= "• " . $condition . "\n";
                }
                $response .= "\n";

                $response .= "👨‍⚕️ <strong>Recommended Specialists:</strong>\n";
                foreach ($specialties as $specialist) {
                    $response .= "• " . $specialist . "\n";
                }
                $response .= "\n";

                if (!empty($followUpQuestions)) {
                    $response .= "❓ <strong>Important Questions to Consider:</strong>\n";
                    foreach (array_slice($followUpQuestions, 0, 4) as $question) {
                        $response .= "• " . $question . "\n";
                    }
                    $response .= "\n";
                }

                if (!empty($medications)) {
                    $response .= "💊 <strong>Treatment Options:</strong>\n";
                    foreach (array_slice($medications, 0, 4) as $medication) {
                        $response .= "• " . $medication . "\n";
                    }
                    $response .= "\n";
                }

                if (!empty($selfCareTips)) {
                    $response .= "🏠 <strong>Self-Care Tips:</strong>\n";
                    foreach (array_slice($selfCareTips, 0, 4) as $tip) {
                        $response .= "• " . $tip . "\n";
                    }
                    $response .= "\n";
                }

                if (!empty($whenToSeeDoctor)) {
                    $response .= "🚨 <strong>See a Doctor If:</strong>\n";
                    foreach ($whenToSeeDoctor as $condition) {
                        $response .= "• " . $condition . "\n";
                    }
                    $response .= "\n";
                }

                $response .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            }
        }

        if (!$hasKnownSymptoms) {
            $response = $this->generateUnknownSymptomResponse();
        }

        $response .= "📞 <strong>Emergency Numbers (India):</strong>\n";
        $response .= "• Ambulance: 102, 108\n";
        $response .= "• Emergency: 112\n";
        $response .= "• Police: 100\n\n";

        $response .= "⚠️ <strong>Medical Disclaimer:</strong> This analysis is for informational purposes only. Always consult qualified healthcare professionals for proper diagnosis and treatment. In case of emergency, call immediately.";

        return $response;
    }

    private function generateOfflineDrugResponse($drugName) {
        $query = "SELECT * FROM offline_drug_database WHERE drug_name = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", strtolower($drugName));
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $response = "💊 <strong>MEDICATION INFORMATION: " . strtoupper($drugName) . "</strong>\n\n";
            $response .= "🏷️ <strong>Generic Name:</strong> " . $row['generic_name'] . "\n";
            $response .= "📂 <strong>Drug Class:</strong> " . $row['drug_class'] . "\n\n";

            $response .= "🎯 <strong>Uses:</strong>\n" . $row['uses'] . "\n\n";

            $response .= "📏 <strong>Dosage:</strong>\n" . $row['dosage'] . "\n\n";

            $sideEffects = json_decode($row['side_effects'], true);
            if (!empty($sideEffects)) {
                $response .= "⚠️ <strong>Side Effects:</strong>\n";
                foreach ($sideEffects as $effect) {
                    $response .= "• " . $effect . "\n";
                }
                $response .= "\n";
            }

            $warnings = json_decode($row['warnings'], true);
            if (!empty($warnings)) {
                $response .= "🚨 <strong>Important Warnings:</strong>\n";
                foreach ($warnings as $warning) {
                    $response .= "• " . $warning . "\n";
                }
                $response .= "\n";
            }

            $interactions = json_decode($row['interactions'], true);
            if (!empty($interactions)) {
                $response .= "🔄 <strong>Drug Interactions:</strong>\n";
                foreach ($interactions as $interaction) {
                    $response .= "• " . $interaction . "\n";
                }
                $response .= "\n";
            }

            if (!empty($row['contraindications'])) {
                $response .= "❌ <strong>Contraindications:</strong>\n" . $row['contraindications'] . "\n\n";
            }

            $response .= "⚠️ <strong>Important:</strong> Always consult your healthcare provider or pharmacist before taking any medication. This information is for educational purposes only.";

            return $response;
        }

        return $this->generateUnknownDrugResponse($drugName);
    }

    private function generateEmergencyResponse() {
        return "🚨 <strong>EMERGENCY SITUATION DETECTED</strong>\n\n" .
               "⚡ <strong>IMMEDIATE ACTIONS:</strong>\n" .
               "1. 📞 Call emergency services: <strong>102 or 108</strong>\n" .
               "2. 🆔 Stay calm and provide clear location information\n" .
               "3. ⏰ Do not delay seeking medical attention\n" .
               "4. 👥 If possible, have someone stay with you\n\n" .
               "📞 <strong>Emergency Numbers (India):</strong>\n" .
               "• 🚑 Ambulance: 102, 108\n" .
               "• 🆘 Emergency: 112\n" .
               "• 👮 Police: 100\n" .
               "• 🚒 Fire: 101\n" .
               "• 👩 Women Helpline: 1091\n\n" .
               "🏥 <strong>While waiting for help:</strong>\n" .
               "• Stay in a safe, accessible location\n" .
               "• Keep airways clear\n" .
               "• Apply pressure to bleeding wounds\n" .
               "• Do not eat or drink anything\n" .
               "• Stay conscious and responsive\n\n" .
               "If this is a severe emergency, <strong>call immediately</strong> and do not wait for further guidance.";
    }

    private function generateGreetingResponse() {
        return "👋 <strong>Hello! Welcome to HealTrack Medical Assistant</strong> 🏥\n\n" .
               "I'm your personal offline medical assistant, ready to help with:\n\n" .
               "🔍 <strong>Symptom Analysis:</strong> Detailed analysis of 10+ common symptoms\n" .
               "💊 <strong>Medication Information:</strong> Complete drug database with dosages & warnings\n" .
               "🚨 <strong>Emergency Protocols:</strong> Immediate guidance for urgent situations\n" .
               "👨‍⚕️ <strong>Specialist Recommendations:</strong> Find the right doctor for your condition\n" .
               "🏠 <strong>Self-Care Tips:</strong> Home remedies and when to seek professional help\n\n" .
               "✅ <strong>100% Offline - No Internet Required!</strong>\n\n" .
               "How are you feeling today? Please describe any symptoms you're experiencing, or ask me about medications, health tips, or emergency information.";
    }

    private function generateMedicalFacilityResponse() {
        return "🏥 <strong>Medical Facility Guidance</strong>\n\n" .
               "🎯 <strong>When to Visit Different Healthcare Providers:</strong>\n\n" .
               "👨‍⚕️ <strong>General Practitioner (GP):</strong>\n" .
               "• Routine health check-ups\n" .
               "• Common illnesses (cold, flu, minor infections)\n" .
               "• Chronic condition management\n" .
               "• Health screening and preventive care\n" .
               "• First consultation for new symptoms\n\n" .
               "🏥 <strong>Specialists:</strong>\n" .
               "• Cardiologist - Heart and blood vessel problems\n" .
               "• Neurologist - Brain, spine, and nerve issues\n" .
               "• Orthopedist - Bone, joint, and muscle problems\n" .
               "• Gastroenterologist - Digestive system issues\n" .
               "• Pulmonologist - Lung and breathing problems\n\n" .
               "🚨 <strong>Emergency Room (Immediate Care):</strong>\n" .
               "• Severe chest pain or heart attack symptoms\n" .
               "• Severe difficulty breathing\n" .
               "• Major injuries or heavy bleeding\n" .
               "• Loss of consciousness\n" .
               "• Severe allergic reactions\n" .
               "• High fever with serious symptoms\n\n" .
               "💡 <strong>Tip:</strong> For specific symptoms, tell me what you're experiencing and I'll recommend the most appropriate healthcare provider!";
    }

    private function generateDefaultResponse() {
        return "🤔 <strong>I'm here to help with your medical questions!</strong>\n\n" .
               "I can assist you with:\n\n" .
               "📋 <strong>Symptom Analysis:</strong> Tell me about any pain, discomfort, or symptoms\n" .
               "💊 <strong>Medication Information:</strong> Ask about specific drugs or treatments\n" .
               "👨‍⚕️ <strong>Doctor Recommendations:</strong> Find the right specialist\n" .
               "🚨 <strong>Emergency Guidance:</strong> Get immediate help for urgent situations\n" .
               "🏠 <strong>Self-Care Tips:</strong> Home remedies and health maintenance\n\n" .
               "Try asking me:\n" .
               "• "I have back pain"\n" .
               "• "Tell me about aspirin"\n" .
               "• "What should I do for a headache?"\n" .
               "• "I need emergency help"\n\n" .
               "What specific health concern can I help you with today?";
    }

    private function generateUnknownSymptomResponse() {
        return "🔍 <strong>Symptom Assessment</strong>\n\n" .
               "I understand you're experiencing symptoms. While this specific symptom isn't in my detailed database, I can still provide general guidance:\n\n" .
               "📝 <strong>General Health Assessment Steps:</strong>\n" .
               "• Rate your symptom severity (1-10 scale)\n" .
               "• Note when symptoms started\n" .
               "• Identify what makes it better or worse\n" .
               "• Monitor for any additional symptoms\n\n" .
               "💡 <strong>General Recommendations:</strong>\n" .
               "• Consult a General Practitioner for proper evaluation\n" .
               "• Keep a symptom diary to track changes\n" .
               "• Seek immediate care if symptoms worsen rapidly\n" .
               "• Stay hydrated and get adequate rest\n\n" .
               "🚨 <strong>Seek immediate medical attention if:</strong>\n" .
               "• Symptoms are severe or worsening rapidly\n" .
               "• You have difficulty breathing\n" .
               "• You experience chest pain\n" .
               "• You have a high fever\n" .
               "• You feel confused or disoriented\n\n" .
               "Try describing your symptoms differently, and I might be able to provide more specific guidance!";
    }

    private function generateUnknownDrugResponse($drugName) {
        return "💊 <strong>Medication Information: " . ucfirst($drugName) . "</strong>\n\n" .
               "I don't have specific information about '" . $drugName . "' in my offline database.\n\n" .
               "💡 <strong>For comprehensive medication information, I recommend:</strong>\n\n" .
               "🏥 <strong>Professional Sources:</strong>\n" .
               "• Consult your pharmacist - they're medication experts\n" .
               "• Speak with your healthcare provider\n" .
               "• Check the medication package insert (leaflet inside the box)\n\n" .
               "📚 <strong>Reliable Reference Sources:</strong>\n" .
               "• Official drug reference websites\n" .
               "• Medical textbooks and databases\n" .
               "• Government health agency websites\n\n" .
               "⚠️ <strong>Important Safety Reminders:</strong>\n" .
               "• Never take medications without proper medical guidance\n" .
               "• Always read medication labels and instructions\n" .
               "• Inform healthcare providers of all medications you're taking\n" .
               "• Report any side effects to your doctor\n" .
               "• Store medications properly and check expiration dates\n\n" .
               "Try asking me about: aspirin, ibuprofen, paracetamol, omeprazole, or cetirizine for detailed information!";
    }

    private function getOfflineDrugInfo($data, $sessionId) {
        $drugName = $data['drug_name'] ?? '';
        return ['response' => $this->generateOfflineDrugResponse($drugName)];
    }

    private function getEmergencyProtocol($data, $sessionId) {
        return ['response' => $this->generateEmergencyResponse()];
    }

    private function getSessionId() {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['offline_chatbot_session_id'])) {
            $_SESSION['offline_chatbot_session_id'] = uniqid('healtrack_offline_', true);
        }

        return $_SESSION['offline_chatbot_session_id'];
    }

    private function saveConversation($sessionId, $userMessage, $botResponse, $analysis) {
        $stmt = mysqli_prepare($this->conn,
            "INSERT INTO offline_chatbot_conversations (session_id, user_message, bot_response, symptoms_detected, analysis_data) 
             VALUES (?, ?, ?, ?, ?)"
        );

        $symptomsJson = json_encode($analysis['symptoms']);
        $analysisJson = json_encode($analysis);
        mysqli_stmt_bind_param($stmt, "sssss", $sessionId, $userMessage, $botResponse, $symptomsJson, $analysisJson);
        mysqli_stmt_execute($stmt);
    }
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'error' => 'Invalid JSON data received',
            'response' => 'I received malformed data. Please refresh the page and try again.',
            'offline_mode' => true
        ]);
        exit;
    }

    try {
        $chatbot = new OfflineMedicalChatbot($con);
        $result = $chatbot->handleRequest($data);
        echo json_encode($result);
    } catch (Exception $e) {
        error_log("Offline Chatbot Error: " . $e->getMessage());
        echo json_encode([
            'error' => false, // Don't show as error to user
            'response' => 'I\'m experiencing some technical difficulties, but I\'m still here to help! Please try rephrasing your question. I can assist with symptom analysis, medication information, and emergency guidance - all completely offline.',
            'offline_mode' => true,
            'details' => 'Offline medical assistant ready'
        ]);
    }
} else {
    echo json_encode([
        'error' => 'Only POST requests are allowed',
        'offline_mode' => true,
        'message' => 'HealTrack Offline Medical Assistant Ready'
    ]);
}
?>