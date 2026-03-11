<?php
/**
 * Database connection and initialization
 */

require_once 'config.php';

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        try {
            $this->conn = new PDO("sqlite:" . DB_PATH);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->initialize();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }

    private function initialize() {
        $queries = [
            "CREATE TABLE IF NOT EXISTS bookings (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                booking_id TEXT UNIQUE,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                address TEXT,
                car_make TEXT,
                car_model TEXT,
                car_year INTEGER,
                registration_number TEXT,
                mileage INTEGER,
                service_type TEXT,
                service_date TEXT,
                service_time TEXT,
                urgency TEXT,
                message TEXT,
                status TEXT DEFAULT 'pending',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS contacts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                contact_id TEXT UNIQUE,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT,
                subject TEXT,
                message TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS newsletter (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT UNIQUE,
                subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS rate_limits (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                ip TEXT,
                action TEXT,
                last_request INTEGER,
                request_count INTEGER DEFAULT 1
            )",
            "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE,
                password TEXT,
                role TEXT DEFAULT 'admin',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            "CREATE TABLE IF NOT EXISTS knowledge (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                slug TEXT UNIQUE,
                title TEXT NOT NULL,
                summary TEXT,
                content TEXT,
                cover_image TEXT,
                image2 TEXT,
                image3 TEXT,
                video_url TEXT,
                status TEXT DEFAULT 'published',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )"
        ];

        foreach ($queries as $query) {
            $this->conn->exec($query);
        }

        // Seed example knowledge articles
        $this->seedKnowledge();
    }

    private function seedKnowledge() {
        $count = $this->conn->query("SELECT COUNT(*) FROM knowledge")->fetchColumn();
        if ($count > 0) return;

        $articles = [
            [
                'slug' => 'why-regular-oil-changes-matter',
                'title' => 'Why Regular Oil Changes Matter More Than You Think',
                'summary' => 'Skipping oil changes can silently damage your engine. Here is what every car owner should know about this simple but critical maintenance step.',
                'content' => "Your engine oil is the lifeblood of your car. It lubricates moving parts, reduces friction, prevents overheating, and keeps harmful deposits from building up inside the engine.\n\nOver time, engine oil breaks down and becomes contaminated with dust, metal particles, and combustion byproducts. When this happens, the oil loses its ability to protect your engine effectively.\n\nHere are the key signs that your car needs an oil change:\n\n1. The oil on the dipstick looks dark and gritty instead of amber and smooth\n2. You hear increased engine noise or knocking sounds\n3. The oil change or check engine light comes on\n4. You have driven more than 5,000-7,500 km since the last change\n5. You notice decreased fuel efficiency\n\nAt The Auto Shoppers, we recommend changing your engine oil every 5,000 km for conventional oil or every 10,000 km for synthetic oil. We use only manufacturer-recommended grades to ensure optimal engine performance.\n\nNeglecting oil changes can lead to engine sludge buildup, increased wear on engine components, reduced fuel economy, and in severe cases, complete engine failure — a repair that can cost lakhs of rupees.\n\nA simple oil change takes less than 30 minutes and costs a fraction of what engine repairs would. It is the most cost-effective way to extend your car engine life.",
                'cover_image' => '',
                'image2' => '',
                'image3' => '',
                'video_url' => 'https://www.youtube.com/watch?v=O1hF25Cowv8',
                'status' => 'published'
            ],
            [
                'slug' => 'car-ac-not-cooling-common-reasons',
                'title' => 'Car AC Not Cooling? Here Are 5 Common Reasons',
                'summary' => 'Indian summers are brutal on your car AC. Learn the most common causes of poor cooling and when you should visit a service center.',
                'content' => "Nothing is worse than getting into your car on a hot Surat afternoon only to find the AC blowing warm air. Before you panic, here are the five most common reasons your car AC might not be cooling properly.\n\n1. Low Refrigerant (Gas Leak)\nThis is the number one cause. The AC system is sealed, so if the refrigerant level is low, there is a leak somewhere. A trained technician can detect the leak using UV dye or electronic leak detectors, fix it, and recharge the system.\n\n2. Dirty or Clogged Cabin Filter\nThe cabin air filter catches dust, pollen, and pollutants before they enter your car. In dusty Indian conditions, this filter gets clogged quickly. A blocked filter restricts airflow, making the AC feel weak even though the system is working fine. We recommend replacing it every 10,000 km.\n\n3. Faulty Compressor\nThe compressor is the heart of the AC system. If it fails, the refrigerant cannot circulate and no cooling happens. Compressor issues often show up as unusual noises when the AC is turned on.\n\n4. Condenser Problems\nThe condenser sits at the front of the car and can get blocked by dirt, leaves, or bugs. It can also get damaged by road debris. A blocked or damaged condenser cannot release heat properly, reducing cooling performance.\n\n5. Electrical Issues\nBlown fuses, faulty relays, or damaged wiring can prevent the AC system from engaging. These are often the trickiest to diagnose but are usually inexpensive to fix.\n\nAt The Auto Shoppers, our AC service includes a complete system check — compressor, condenser, evaporator, refrigerant levels, cabin filter, and all electrical connections. We ensure your AC runs at peak performance before summer hits.",
                'cover_image' => '',
                'image2' => '',
                'image3' => '',
                'video_url' => '',
                'status' => 'published'
            ],
            [
                'slug' => 'understanding-warning-lights-on-dashboard',
                'title' => 'Understanding the Warning Lights on Your Dashboard',
                'summary' => 'That glowing symbol on your dashboard is trying to tell you something important. Here is a quick guide to the most common warning lights.',
                'content' => "Modern cars have dozens of sensors monitoring everything from engine temperature to tire pressure. When something needs attention, your dashboard lights up with warning symbols. Ignoring them can turn a small issue into an expensive repair.\n\nHere are the most important warning lights you should never ignore:\n\nCheck Engine Light (Engine Symbol)\nThis is the most common and most misunderstood light. It can indicate anything from a loose fuel cap to a serious engine misfire. When this light comes on, get a diagnostic scan done as soon as possible. At The Auto Shoppers, we use advanced OBD-II scanners to read the exact error codes.\n\nOil Pressure Warning (Oil Can Symbol)\nThis means your engine oil pressure is dangerously low. Stop driving immediately and check the oil level. Driving with low oil pressure can destroy the engine in minutes.\n\nTemperature Warning (Thermometer Symbol)\nYour engine is overheating. Pull over safely, turn off the AC, and let the engine cool down. Do not open the radiator cap when the engine is hot. Common causes include low coolant, a faulty thermostat, or a broken water pump.\n\nBattery Light (Battery Symbol)\nThis indicates a charging system problem, not necessarily a dead battery. The alternator may be failing, or there could be a loose belt. If this light comes on while driving, you have limited time before the car stalls.\n\nBrake Warning Light (Exclamation Mark in Circle)\nCheck if the handbrake is fully released first. If the light stays on, it could mean low brake fluid, worn brake pads, or a problem with the ABS system. Get it checked immediately as brakes are critical for safety.\n\nABS Light\nThe Anti-lock Braking System has detected a fault. Your regular brakes will still work, but the ABS may not function in an emergency stop. Have it diagnosed promptly.\n\nTire Pressure Warning (Exclamation Mark in Tire Shape)\nOne or more tires have low pressure. Check all tires including the spare. Driving on underinflated tires increases fuel consumption and can cause a blowout.\n\nRemember: warning lights exist to protect you and your car. Never cover them with tape or ignore them hoping they will go away. A quick diagnostic check can save you from costly repairs down the road.",
                'cover_image' => '',
                'image2' => '',
                'image3' => '',
                'video_url' => '',
                'status' => 'published'
            ]
        ];

        $stmt = $this->conn->prepare("INSERT INTO knowledge (slug, title, summary, content, cover_image, image2, image3, video_url, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($articles as $a) {
            $stmt->execute([$a['slug'], $a['title'], $a['summary'], $a['content'], $a['cover_image'], $a['image2'], $a['image3'], $a['video_url'], $a['status']]);
        }
    }
}
