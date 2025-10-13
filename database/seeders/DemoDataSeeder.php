<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Destination;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        // Create Root Admin User from environment variables
        // These should be set in your .env file before seeding
        $rootName = env('ROOT_ADMIN_NAME', 'Root Administrator');
        $rootEmail = env('ROOT_ADMIN_EMAIL');
        $rootPassword = env('ROOT_ADMIN_PASSWORD');

        // Validate that root admin credentials are provided
        if (empty($rootEmail) || empty($rootPassword)) {
            throw new \Exception(
                'Root admin credentials not found! Please set ROOT_ADMIN_EMAIL and ROOT_ADMIN_PASSWORD in your .env file before seeding.'
            );
        }

        // Ensure password meets minimum requirements
        if (strlen($rootPassword) < 8) {
            throw new \Exception(
                'ROOT_ADMIN_PASSWORD must be at least 8 characters long.'
            );
        }

        $admin = User::create([
            'name' => $rootName,
            'email' => $rootEmail,
            'password' => Hash::make($rootPassword),
            'is_root' => true, // Mark as root admin
        ]);
        $admin->roles()->attach($adminRole);

        $this->command->info("✅ Root admin created successfully: {$rootEmail}");

        // Create Demo Client Users (only if SEED_DEMO_USERS is true)
        if (env('SEED_DEMO_USERS', false)) {
            $client = User::create([
                'name' => 'John Doe',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
            ]);
            $client->roles()->attach($clientRole);

            $client2 = User::create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ]);
            $client2->roles()->attach($clientRole);

            $this->command->info("✅ Demo client users created (for testing only)");
        }

        // Clean up any existing tour-related files
        $this->cleanupTourFiles();

        // Destination images from assets/img/destinations/
        $destinationImages = [
            'assets/img/destinations/d1.jpg',
            'assets/img/destinations/d2.jpg',
            'assets/img/destinations/d3.jpg',
            'assets/img/destinations/d4.jpg',
            'assets/img/destinations/d5.jpg',
            'assets/img/destinations/d6.jpg',
            'assets/img/destinations/d7.jpg',
            'assets/img/destinations/d8.jpg',
            'assets/img/destinations/d9.jpg',
            'assets/img/destinations/d10.jpg',
            'assets/img/destinations/d11.jpg',
            'assets/img/destinations/d13.jpg',
            'assets/img/destinations/d14.jpg',
            'assets/img/destinations/d15.jpg',
            'assets/img/destinations/d16.jpg',
            'assets/img/destinations/d17.jpg',
        ];

        // Create Destinations with images
        $destinations = [
            // EUROPE - Western Europe
            ['name' => 'Paris', 'location' => 'France', 'description' => 'The City of Light beckons with its iconic Eiffel Tower, world-class museums like the Louvre, charming cafés, and romantic Seine River. Explore historic neighborhoods, indulge in exquisite cuisine, and immerse yourself in art and culture.', 'image_path' => $destinationImages[0]],
            ['name' => 'Rome', 'location' => 'Italy', 'description' => 'The Eternal City is an open-air museum with ancient ruins like the Colosseum, Vatican City, Renaissance art, delicious Italian cuisine, and charming piazzas. Walk through millennia of history in every corner.', 'image_path' => $destinationImages[1]],
            ['name' => 'Barcelona', 'location' => 'Spain', 'description' => 'Gaudí\'s architectural masterpieces, vibrant nightlife, beautiful beaches, delicious tapas, and rich Catalan culture make Barcelona irresistible. Explore La Sagrada Familia, Park Güell, and Gothic Quarter.', 'image_path' => $destinationImages[2]],
            ['name' => 'London', 'location' => 'United Kingdom', 'description' => 'Historic royal palaces, Big Ben, the Tower of London, world-class museums, theater in the West End, diverse neighborhoods, and a vibrant multicultural atmosphere await in Britain\'s capital.', 'image_path' => $destinationImages[3]],
            ['name' => 'Amsterdam', 'location' => 'Netherlands', 'description' => 'Charming canal houses, world-famous museums like Van Gogh and Anne Frank House, vibrant nightlife, bicycle culture, tulip fields, and liberal atmosphere make Amsterdam uniquely captivating.', 'image_path' => $destinationImages[4]],
            ['name' => 'Berlin', 'location' => 'Germany', 'description' => 'Rich history, cutting-edge art scene, Brandenburg Gate, remnants of the Berlin Wall, world-class museums, vibrant nightlife, and a progressive spirit define Germany\'s dynamic capital.', 'image_path' => $destinationImages[5]],
            ['name' => 'Venice', 'location' => 'Italy', 'description' => 'Romantic gondola rides through historic canals, stunning St. Mark\'s Basilica, Doge\'s Palace, Venetian masks, exquisite glass art, and unique island architecture create an unforgettable experience.', 'image_path' => $destinationImages[6]],
            ['name' => 'Florence', 'location' => 'Italy', 'description' => 'Renaissance art capital with Michelangelo\'s David, Uffizi Gallery, stunning Duomo, Ponte Vecchio bridge, Tuscan cuisine, leather markets, and breathtaking architecture at every turn.', 'image_path' => $destinationImages[7]],
            ['name' => 'Madrid', 'location' => 'Spain', 'description' => 'Spain\'s vibrant capital offers Prado Museum, Royal Palace, lively tapas bars, Retiro Park, flamenco shows, and an infectious energy that keeps the city buzzing until dawn.', 'image_path' => $destinationImages[8]],
            ['name' => 'Lisbon', 'location' => 'Portugal', 'description' => 'Hilly coastal capital with pastel buildings, historic trams, Fado music, delicious pastéis de nata, stunning viewpoints, and a laid-back Mediterranean atmosphere perfect for wandering.', 'image_path' => $destinationImages[9]],
            ['name' => 'Brussels', 'location' => 'Belgium', 'description' => 'EU capital famous for Grand Place, Atomium, incredible chocolates, Belgian waffles, hundreds of beers, Art Nouveau architecture, and charming medieval streets.', 'image_path' => $destinationImages[10]],
            ['name' => 'Zurich', 'location' => 'Switzerland', 'description' => 'Pristine Swiss city with stunning alpine views, crystal-clear lake, world-class banking, luxury shopping, medieval old town, and proximity to ski resorts and mountain adventures.', 'image_path' => $destinationImages[11]],
            
            // EUROPE - Eastern Europe
            ['name' => 'Prague', 'location' => 'Czech Republic', 'description' => 'Fairy-tale city with Prague Castle, Charles Bridge, astronomical clock, Gothic architecture, medieval charm, excellent beer culture, and affordability make it a European gem.', 'image_path' => $destinationImages[12]],
            ['name' => 'Vienna', 'location' => 'Austria', 'description' => 'Imperial palaces, classical music heritage, stunning opera houses, Sachertorte, coffee house culture, Art Nouveau architecture, and Danube River charm define Austria\'s elegant capital.', 'image_path' => $destinationImages[13]],
            ['name' => 'Budapest', 'location' => 'Hungary', 'description' => 'Divided by the Danube, thermal baths, stunning Parliament building, ruin bars, Chain Bridge, rich history, affordable prices, and vibrant nightlife create Budapest\'s unique appeal.', 'image_path' => $destinationImages[14]],
            
            // EUROPE - Greece
            ['name' => 'Athens', 'location' => 'Greece', 'description' => 'Ancient Acropolis and Parthenon, birthplace of democracy, archaeological wonders, rooftop dining with Acropolis views, vibrant Plaka district, and gateway to Greek islands.', 'image_path' => $destinationImages[15]],
            ['name' => 'Santorini', 'location' => 'Greece', 'description' => 'Famous for its whitewashed buildings with blue domes perched on cliffs, stunning sunsets, volcanic beaches, and excellent wine. A romantic paradise perfect for honeymoons and relaxation.', 'image_path' => $destinationImages[0]],
            
            // EUROPE - UK & Ireland
            ['name' => 'Edinburgh', 'location' => 'Scotland', 'description' => 'Medieval Edinburgh Castle, Royal Mile, annual Festival Fringe, Scottish whisky, bagpipes, highland culture, and dramatic landscape create Scotland\'s captivating capital.', 'image_path' => $destinationImages[1]],
            ['name' => 'Dublin', 'location' => 'Ireland', 'description' => 'Guinness Storehouse, Trinity College, Temple Bar pubs, Georgian architecture, Irish hospitality, literary heritage, and vibrant music scene make Dublin wonderfully welcoming.', 'image_path' => $destinationImages[2]],
            
            // NORDIC COUNTRIES
            ['name' => 'Copenhagen', 'location' => 'Denmark', 'description' => 'Design capital with colorful Nyhavn harbor, Tivoli Gardens, bicycle-friendly streets, hygge culture, innovative Nordic cuisine, Little Mermaid statue, and Scandinavian charm.', 'image_path' => $destinationImages[3]],
            ['name' => 'Stockholm', 'location' => 'Sweden', 'description' => 'Spread across 14 islands, stunning archipelago, Vasa Museum, ABBA Museum, royal palaces, Nobel Prize, IKEA, meatballs, and beautiful Scandinavian design everywhere.', 'image_path' => $destinationImages[4]],
            ['name' => 'Oslo', 'location' => 'Norway', 'description' => 'Surrounded by fjords and mountains, Viking Ship Museum, modern opera house, Nobel Peace Center, outdoor recreation, midnight sun, and gateway to Norwegian natural wonders.', 'image_path' => $destinationImages[5]],
            ['name' => 'Helsinki', 'location' => 'Finland', 'description' => 'Modern Finnish capital with stunning architecture, saunas, design district, Market Square, proximity to nature, clean environment, and unique Nordic-Baltic culture.', 'image_path' => $destinationImages[6]],
            ['name' => 'Reykjavik', 'location' => 'Iceland', 'description' => 'Land of fire and ice with spectacular waterfalls, geothermal springs like the Blue Lagoon, Northern Lights, midnight sun, volcanic landscapes, and unique Nordic culture.', 'image_path' => $destinationImages[7]],
            
            // TURKEY
            ['name' => 'Istanbul', 'location' => 'Turkey', 'description' => 'Where East meets West, Hagia Sophia, Blue Mosque, Grand Bazaar, Bosphorus cruises, Turkish baths, delicious cuisine, rich history spanning Byzantine and Ottoman empires.', 'image_path' => $destinationImages[8]],
            ['name' => 'Cappadocia', 'location' => 'Turkey', 'description' => 'Otherworldly landscape with fairy chimneys, hot air balloon rides at sunrise, underground cities, cave hotels, ancient rock-cut churches, and unique geological formations.', 'image_path' => $destinationImages[9]],
            ['name' => 'Antalya', 'location' => 'Turkey', 'description' => 'Turkish Riviera with beautiful beaches, ancient ruins, turquoise Mediterranean waters, all-inclusive resorts, historic old town Kaleiçi, and warm hospitality.', 'image_path' => $destinationImages[10]],
            ['name' => 'Bodrum', 'location' => 'Turkey', 'description' => 'Stunning Aegean coast, Bodrum Castle, vibrant nightlife, luxury marinas, whitewashed houses, crystal-clear waters, and perfect blend of relaxation and entertainment.', 'image_path' => $destinationImages[11]],
            
            // UNITED STATES
            ['name' => 'New York', 'location' => 'United States', 'description' => 'The city that never sleeps offers iconic landmarks like Times Square and Statue of Liberty, Broadway shows, world-renowned museums, diverse neighborhoods, and a melting pot of cultures and cuisines.', 'image_path' => $destinationImages[12]],
            ['name' => 'Los Angeles', 'location' => 'United States', 'description' => 'Hollywood glamour, beautiful beaches, celebrity sightings, Universal Studios, Griffith Observatory, diverse food scene, perfect weather, and entertainment capital of the world.', 'image_path' => $destinationImages[13]],
            ['name' => 'Miami', 'location' => 'United States', 'description' => 'Tropical paradise with Art Deco architecture, vibrant nightlife, beautiful beaches, Cuban influence, colorful street art in Wynwood, and year-round sunshine.', 'image_path' => $destinationImages[14]],
            ['name' => 'Las Vegas', 'location' => 'United States', 'description' => 'Entertainment capital with world-class casinos, spectacular shows, luxury hotels, Grand Canyon nearby, vibrant nightlife, celebrity chef restaurants, and non-stop excitement.', 'image_path' => $destinationImages[15]],
            ['name' => 'San Francisco', 'location' => 'United States', 'description' => 'Golden Gate Bridge, cable cars, Alcatraz Island, diverse neighborhoods, tech innovation hub, steep hills, foggy charm, and progressive culture by the bay.', 'image_path' => $destinationImages[0]],
            ['name' => 'Hawaii', 'location' => 'United States', 'description' => 'Tropical paradise with volcanic landscapes, pristine beaches, surfing, luaus, Polynesian culture, Pearl Harbor, active volcanoes, and the spirit of Aloha.', 'image_path' => $destinationImages[1]],
            
            // ASIA - Japan
            ['name' => 'Tokyo', 'location' => 'Japan', 'description' => 'A vibrant blend of ultra-modern and traditional, Tokyo offers neon-lit streets, ancient temples, cutting-edge technology, and incredible food. Experience the bustling Shibuya crossing, serene gardens, and unique Japanese hospitality.', 'image_path' => $destinationImages[2]],
            ['name' => 'Kyoto', 'location' => 'Japan', 'description' => 'Ancient capital with thousands of temples and shrines, traditional geishas, bamboo forests, zen gardens, tea ceremonies, cherry blossoms, and preserved Japanese culture.', 'image_path' => $destinationImages[3]],
            
            // ASIA - Southeast Asia
            ['name' => 'Bali', 'location' => 'Indonesia', 'description' => 'The Island of Gods features pristine beaches, lush rice terraces, ancient temples, and vibrant culture. Enjoy world-class surfing, yoga retreats, traditional dance performances, and stunning sunsets over the Indian Ocean.', 'image_path' => $destinationImages[4]],
            ['name' => 'Bangkok', 'location' => 'Thailand', 'description' => 'Vibrant capital with ornate temples, bustling street markets, spicy cuisine, tuk-tuks, Grand Palace, rooftop bars, massage spas, and energetic nightlife scene.', 'image_path' => $destinationImages[5]],
            ['name' => 'Phuket', 'location' => 'Thailand', 'description' => 'Thailand\'s largest island with stunning beaches, clear waters, vibrant nightlife, island hopping, Thai cuisine, water sports, and tropical paradise atmosphere.', 'image_path' => $destinationImages[6]],
            ['name' => 'Singapore', 'location' => 'Singapore', 'description' => 'Futuristic city-state with Gardens by the Bay, Marina Bay Sands, hawker centers, multicultural neighborhoods, ultra-modern architecture, and impeccable cleanliness.', 'image_path' => $destinationImages[7]],
            
            // ASIA - China
            ['name' => 'Beijing', 'location' => 'China', 'description' => 'Ancient capital with Great Wall of China, Forbidden City, Temple of Heaven, Tiananmen Square, Peking duck, rich imperial history, and modern development.', 'image_path' => $destinationImages[8]],
            ['name' => 'Shanghai', 'location' => 'China', 'description' => 'Futuristic skyline, historic Bund waterfront, Yu Garden, French Concession, world-class shopping, innovative cuisine, and China\'s most cosmopolitan city.', 'image_path' => $destinationImages[9]],
            ['name' => 'Hong Kong', 'location' => 'China', 'description' => 'Vertical city with stunning harbor views, dim sum, Victoria Peak, bustling markets, mix of East and West, skyscrapers, and vibrant energy.', 'image_path' => $destinationImages[10]],
            
            // ASIA - Other
            ['name' => 'Seoul', 'location' => 'South Korea', 'description' => 'K-pop culture, cutting-edge technology, ancient palaces, Korean BBQ, vibrant street food, shopping districts, traditional hanbok, and dynamic nightlife.', 'image_path' => $destinationImages[11]],
            ['name' => 'Dubai', 'location' => 'United Arab Emirates', 'description' => 'A futuristic city of superlatives featuring the world\'s tallest building (Burj Khalifa), luxury shopping, indoor skiing, pristine beaches, and a perfect blend of Arabian tradition and modern innovation.', 'image_path' => $destinationImages[12]],
        ];

        $createdDestinations = [];
        foreach ($destinations as $destinationData) {
            // Store image path separately
            $imagePath = $destinationData['image_path'];
            
            // Remove image_path from destination data (we'll use Image model)
            unset($destinationData['image_path']);
            
            // Create destination
            $destination = Destination::create($destinationData);
            
            // Create associated image record
            $destination->images()->create([
                'path' => $imagePath,
                'alt_text' => $destination->name,
                'order' => 0,
                'is_primary' => true,
            ]);
            
            $createdDestinations[] = $destination;
        }

        $destinationCount = count($createdDestinations);
        $this->command->info("✅ {$destinationCount} destinations created successfully");
    }

    /**
     * Clean up tour-related files from storage
     */
    private function cleanupTourFiles(): void
    {
        $this->command->info("🧹 Cleaning up tour-related files...");
        
        // Delete tour images from public storage
        $tourImagesPath = public_path('storage/tours');
        if (is_dir($tourImagesPath)) {
            $this->deleteDirectory($tourImagesPath);
            $this->command->info("  ✅ Deleted tour images");
        }

        // Delete tour attachments from public storage
        $tourAttachmentsPath = public_path('storage/tour-attachments');
        if (is_dir($tourAttachmentsPath)) {
            $this->deleteDirectory($tourAttachmentsPath);
            $this->command->info("  ✅ Deleted tour attachments");
        }

        // Delete from storage/app/public as well
        $storageTourImagesPath = storage_path('app/public/tours');
        if (is_dir($storageTourImagesPath)) {
            $this->deleteDirectory($storageTourImagesPath);
        }

        $storageTourAttachmentsPath = storage_path('app/public/tour-attachments');
        if (is_dir($storageTourAttachmentsPath)) {
            $this->deleteDirectory($storageTourAttachmentsPath);
        }

        $this->command->info("✅ Tour-related files cleaned up");
    }

    /**
     * Recursively delete a directory
     */
    private function deleteDirectory(string $dir): bool
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }
}
