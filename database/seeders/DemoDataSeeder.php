<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\Discount;
use App\Models\Announcement;
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

        // Create Discounts
        $discount1 = Discount::create([
            'name' => 'Early Bird Special',
            'percentage' => 15,
            'valid_until' => now()->addMonths(3),
        ]);

        $discount2 = Discount::create([
            'name' => 'Summer Sale',
            'percentage' => 20,
            'valid_until' => now()->addMonths(2),
        ]);

        $discount3 = Discount::create([
            'name' => 'Last Minute Deal',
            'percentage' => 25,
            'valid_until' => now()->addMonth(),
        ]);

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

        // Tour images from assets/img/tours/
        $tourImages = [
            'assets/img/tours/t1.jpg',
            'assets/img/tours/t2.jpg',
            'assets/img/tours/t3.jpg',
            'assets/img/tours/t4.jpg',
            'assets/img/tours/t5.jpg',
            'assets/img/tours/t6.jpg',
            'assets/img/tours/t7.jpg',
            'assets/img/tours/t8.jpg',
            'assets/img/tours/t9.jpg',
            'assets/img/tours/t10.jpg',
            'assets/img/tours/t11.jpg',
            'assets/img/tours/t12.jpg',
        ];

        // Create Tours with images
        $tours = [
            [
                'title' => 'Paris City Explorer',
                'description' => 'Discover the magic of Paris with visits to the Eiffel Tower, Louvre Museum, Notre-Dame Cathedral, and a romantic Seine River cruise. Includes guided tours, skip-the-line access, and traditional French dinner.',
                'duration' => '5 Days 4 Nights',
                'price' => 1299.00,
                'is_price_defined' => true,
                'discount_id' => $discount1->id,
                'image_path' => $tourImages[0],
                'destinations' => [0], // Paris
            ],
            [
                'title' => 'Tokyo Food Adventure',
                'description' => 'Embark on a culinary journey through Tokyo\'s best food districts. Taste authentic sushi, ramen, yakitori, and street food while exploring vibrant neighborhoods like Tsukiji, Shibuya, and Harajuku.',
                'duration' => '7 Days 6 Nights',
                'price' => 1899.00,
                'is_price_defined' => true,
                'discount_id' => $discount2->id,
                'image_path' => $tourImages[1],
                'destinations' => [1], // Tokyo
            ],
            [
                'title' => 'Bali Wellness Retreat',
                'description' => 'Rejuvenate your mind, body, and soul in Bali with daily yoga sessions, spa treatments, meditation in rice terraces, healthy organic meals, and visits to sacred temples and pristine beaches.',
                'duration' => '10 Days 9 Nights',
                'price' => 2199.00,
                'is_price_defined' => true,
                'discount_id' => null,
                'image_path' => $tourImages[2],
                'destinations' => [2], // Bali
            ],
            [
                'title' => 'New York City Highlights',
                'description' => 'Experience the best of NYC with visits to Empire State Building, Statue of Liberty, Central Park, Broadway show, 9/11 Memorial, Brooklyn Bridge, and shopping on Fifth Avenue.',
                'duration' => '4 Days 3 Nights',
                'price' => 999.00,
                'is_price_defined' => true,
                'discount_id' => $discount3->id,
                'image_path' => $tourImages[3],
                'destinations' => [3], // New York
            ],
            [
                'title' => 'Rome Ancient Wonders',
                'description' => 'Step back in time exploring the Colosseum, Roman Forum, Pantheon, Vatican Museums, Sistine Chapel, and St. Peter\'s Basilica. Includes guided tours by expert historians.',
                'duration' => '6 Days 5 Nights',
                'price' => 1599.00,
                'is_price_defined' => true,
                'discount_id' => null,
                'image_path' => $tourImages[4],
                'destinations' => [4], // Rome
            ],
            [
                'title' => 'Dubai Luxury Experience',
                'description' => 'Live the high life with stays in 5-star hotels, desert safari with BBQ dinner, Burj Khalifa observation deck, Dubai Mall shopping, Palm Jumeirah, and yacht cruise.',
                'duration' => '5 Days 4 Nights',
                'price' => 2499.00,
                'is_price_defined' => true,
                'discount_id' => $discount1->id,
                'image_path' => $tourImages[5],
                'destinations' => [5], // Dubai
            ],
            [
                'title' => 'Santorini Romantic Escape',
                'description' => 'Perfect honeymoon package with sunset views in Oia, wine tasting tour, private catamaran cruise, couples spa treatments, and candlelit dinners overlooking the caldera.',
                'duration' => '7 Days 6 Nights',
                'price' => 2799.00,
                'is_price_defined' => true,
                'discount_id' => null,
                'image_path' => $tourImages[6],
                'destinations' => [6], // Santorini
            ],
            [
                'title' => 'Maldives Island Paradise',
                'description' => 'Ultimate tropical getaway with overwater villa accommodation, snorkeling with manta rays, sunset fishing, spa treatments, and all-inclusive dining at luxury resort.',
                'duration' => '8 Days 7 Nights',
                'price' => 3999.00,
                'is_price_defined' => true,
                'discount_id' => $discount2->id,
                'image_path' => $tourImages[7],
                'destinations' => [7], // Maldives
            ],
            [
                'title' => 'Barcelona Art & Culture',
                'description' => 'Explore Gaudí\'s masterpieces including Sagrada Familia and Park Güell, Gothic Quarter walking tour, Picasso Museum, flamenco show, tapas tasting, and beach time.',
                'duration' => '5 Days 4 Nights',
                'price' => 1399.00,
                'is_price_defined' => true,
                'discount_id' => null,
                'image_path' => $tourImages[8],
                'destinations' => [8], // Barcelona
            ],
            [
                'title' => 'London Royal Heritage',
                'description' => 'Discover British royalty with tours of Buckingham Palace, Tower of London with Crown Jewels, Westminster Abbey, Windsor Castle, and afternoon tea at a historic hotel.',
                'duration' => '6 Days 5 Nights',
                'price' => 1799.00,
                'is_price_defined' => true,
                'discount_id' => $discount3->id,
                'image_path' => $tourImages[9],
                'destinations' => [9], // London
            ],
            [
                'title' => 'Iceland Northern Lights',
                'description' => 'Chase the aurora borealis with expert guides, visit Blue Lagoon geothermal spa, explore Golden Circle (Gullfoss, Geysir, Þingvellir), and ice cave adventure.',
                'duration' => '7 Days 6 Nights',
                'price' => 2599.00,
                'is_price_defined' => true,
                'discount_id' => null,
                'image_path' => $tourImages[10],
                'destinations' => [11], // Iceland
            ],
            [
                'title' => 'Morocco Desert Adventure',
                'description' => 'Experience the magic of Morocco with Marrakech souks, Atlas Mountains trek, Sahara Desert camel ride, overnight in Berber camp, and explore blue city of Chefchaouen.',
                'duration' => '9 Days 8 Nights',
                'price' => 1699.00,
                'is_price_defined' => true,
                'discount_id' => $discount1->id,
                'image_path' => $tourImages[11],
                'destinations' => [13], // Morocco
            ],
        ];

        foreach ($tours as $tourData) {
            $destinationIds = $tourData['destinations'];
            unset($tourData['destinations']);
            
            // Store image path separately
            $imagePath = $tourData['image_path'];
            unset($tourData['image_path']);
            
            $tour = Tour::create($tourData);
            
            // Create associated image record
            $tour->images()->create([
                'path' => $imagePath,
                'alt_text' => $tour->title,
                'order' => 0,
                'is_primary' => true,
            ]);
            
            // Attach destinations
            foreach ($destinationIds as $destIndex) {
                if (isset($createdDestinations[$destIndex])) {
                    $tour->destinations()->attach($createdDestinations[$destIndex]->id);
                }
            }
        }

        // Create Announcements
        Announcement::create([
            'title' => 'Summer Sale Now Live!',
            'content' => 'Get up to 25% off on selected tour packages. Book before the end of the month to secure the best deals for your summer vacation.',
            'visible' => true,
        ]);

        Announcement::create([
            'title' => 'New Destination: Iceland',
            'content' => 'We are excited to announce Iceland tours! Experience the Northern Lights, stunning waterfalls, and geothermal hot springs.',
            'visible' => true,
        ]);

        Announcement::create([
            'title' => 'Travel Safety Guidelines',
            'content' => 'Your safety is our priority. All our tours follow strict health and safety protocols. Check our updated travel guidelines before booking.',
            'visible' => true,
        ]);

        Announcement::create([
            'title' => 'Early Bird Discounts Available',
            'content' => 'Book your 2025 tours now and save 15%! Limited time offer for advance bookings. Plan ahead and travel for less.',
            'visible' => false,
        ]);
    }
}
