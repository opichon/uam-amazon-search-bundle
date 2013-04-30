<?php

namespace UAM\Bundle\AmazonSearchBundle\Command;

use \PDO;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DBCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('uam:amazon:db_create')
            ->setDescription("Create the SQLite DB used by this bundle")
            ->setHelp(<<<EOT
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $db = new PDO(sprintf('sqlite:%s', dirname(__FILE__) . '/../Resources/data/ecs.db'));

        $sql = <<<EOD
CREATE TABLE IF NOT EXISTS search_index
(
    id INTEGER PRIMARY KEY,
    value CHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS search_index_i18n
(
    id INTEGER,
    locale CHAR(7) NOT NULL,
    name CHAR(100) NOT NULL,
    PRIMARY KEY (id, locale),
    CONSTRAINT search_index_i18n
        FOREIGN KEY (id)
        REFERENCES search_index (id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS search_index_locale
(
    id INTEGER,
    locale CHAR(2) NOT NULL,
    PRIMARY KEY (id, locale),
    CONSTRAINT search_index_locale
        FOREIGN KEY (id)
        REFERENCES search_index (id)
        ON DELETE CASCADE
);
EOD
;

        $db->exec($sql);

        $select = "SELECT * FROM search_index WHERE value = :value";
        $stmt_select = $db->prepare($select);
        $stmt_select->bindParam(':value', $value);

        $insert = "INSERT INTO search_index (id, value) VALUES (NULL, :value)";
        $stmt_insert = $db->prepare($insert);
        $stmt_insert->bindParam(':value', $value);

        foreach ($this->getSearchIndexOptions() as $locale => $options) {
            foreach ($options as $value => $translation_key) {
                $result = $stmt_select->execute();
                if ($row = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['id'];
                    $output->writeln($id);
                }
                else {
                    $result = $stmt_insert->execute();
                    $result = $stmt_select->execute();
                    $output->writeln($stmt_select->fetch(PDO::FETCH_ASSOC));
                    $id = $row['id'];
                }

                
            }
        }

        $db = null;
    }

    protected function getSearchIndexOptions()
    {
        $data = array(
            'ca' => array(
                'All'                 => 'ecs.search_index.all',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'LawnGarden'          => 'ecs.search_index.lawn_garden',
                'Music'               => 'ecs.search_index.music',
                'PetSupplies'         => 'ecs.search_index.pet_supplies',
                'Software'            => 'ecs.search_index.software',
                'SoftwareVideoGames'  => 'ecs.search_index.software_video_games',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games'
            ),
            'cn' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Appliances'          => 'ecs.search_index.appliances',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Electronics'         => 'ecs.search_index.electronics',
                'Grocery'             => 'ecs.search_index.grocery',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'Home'                => 'ecs.search_index.home',
                'HomeImprovement'     => 'ecs.search_index.home_improvement',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Misc'                => 'ecs.search_index.misc',
                'Music'               => 'ecs.search_index.music',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'PetSupplies'          => 'ecs.search_index.pet_supplies',
                'Photo'               => 'ecs.search_index.photo',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'SportingGoods'       => 'ecs.search_index.sporting_goods',
                'Toys'                => 'ecs.search_index.toys',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'de' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'HomeGarden'          => 'ecs.search_index.home_garden',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'LawnGarden'          => 'ecs.search_index.lawn_garden',
                'Lighting'            => 'ecs.search_index.lighting',
                'Magazines'           => 'ecs.search_index.magazines',
                'Marketplace'         => 'ecs.search_index.marketplace',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'MusicalInstruments'  => 'ecs.search_index.musical_instruments',
                'MusicTracks'         => 'ecs.search_index.music_tracks',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'OutdoorLiving'       => 'ecs.search_index.outdoor_living',
                'Outlet'              => 'ecs.search_index.outlet',
                'PCHardware'          => 'ecs.search_index.pc_hardware',
                'Photo'               => 'ecs.search_index.photo',
                'Software'            => 'ecs.search_index.software',
                'SoftwareVideoGames'  => 'ecs.search_index.software_video_games',
                'SportingGoods'       => 'ecs.search_index.sporting_goods',
                'Tools'               => 'ecs.search_index.tools',
                'Toys'                => 'ecs.search_index.toys',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'es' => array(
                'All'                 => 'ecs.search_index.all',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Books'               => 'ecs.search_index.books',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'Toys'                => 'ecs.search_index.toys',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'fr' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'HomeImprovement'     => 'ecs.search_index.home_improvement',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'Lighting'            => 'ecs.search_index.lighting',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'MusicalInstruments'  => 'ecs.search_index.musical_instruments',
                'MusicTracks'         => 'ecs.search_index.music_tracks',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'Outlet'              => 'ecs.search_index.outlet',
                'PetSupplies'         => 'ecs.search_index.pet_supplies',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'SoftwareVideoGames'  => 'ecs.search_index.software_video_games',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'it' => array(
                'All'                 => 'ecs.search_index.all',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Books'               => 'ecs.search_index.books',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'Garden'              => 'ecs.search_index.  garden',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'Lighting'            => 'ecs.search_index.lighting',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'Toys'                => 'ecs.search_index.toys',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'jp' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Appliances'          => 'ecs.search_index.appliances',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'Grocery'             => 'ecs.search_index.grocery',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'Hobbies'             => 'ecs.search_index.hobbies',
                'HomeImprovement'     => 'ecs.search_index.home_improvement',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'Marketplace'         => 'ecs.search_index.marketplace',
                'MobileApps'          => 'ecs.search_index.mobile_apps',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'MusicalInstruments'  => 'ecs.search_index.musical_instruments',
                'MusicTracks'         => 'ecs.search_index.music_tracks',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'SportingGoods'       => 'ecs.search_index.sporting_goods',
                'Toys'                => 'ecs.search_index.toys',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'uk' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'Grocery'             => 'ecs.search_index.grocery',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'HomeGarden'          => 'ecs.search_index.home_garden',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'Lighting'            => 'ecs.search_index.lighting',
                'Marketplace'         => 'ecs.search_index.marketplace',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'MusicalInstruments'  => 'ecs.search_index.musical_instruments',
                'MusicTracks'         => 'ecs.search_index.music_tracks',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'OutdoorLiving'       => 'ecs.search_index.outdoor_living',
                'Outlet'              => 'ecs.search_index.outlet',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'SoftwareVideoGames'  => 'ecs.search_index.software_video_games',
                'Toys'                => 'ecs.search_index.toys',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches'
            ),
            'us' => array(
                'All'                 => 'ecs.search_index.all',
                'Apparel'             => 'ecs.search_index.apparel',
                'Appliances'          => 'ecs.search_index.appliances',
                'ArtsAndCrafts'       => 'ecs.search_index.arts_and_crafts',
                'Automotive'          => 'ecs.search_index.automotive',
                'Baby'                => 'ecs.search_index.baby',
                'Beauty'              => 'ecs.search_index.beauty',
                'Blended'             => 'ecs.search_index.blended',
                'Books'               => 'ecs.search_index.books',
                'Classical'           => 'ecs.search_index.classical',
                'Collectibles'        => 'ecs.search_index.collectibles',
                'DigitalMusic'        => 'ecs.search_index.digital_music',
                'DVD'                 => 'ecs.search_index.dvd',
                'Electronics'         => 'ecs.search_index.electronics',
                'ForeignBooks'        => 'ecs.search_index.foreign_books',
                'Grocery'             => 'ecs.search_index.grocery',
                'HealthPersonalCare'  => 'ecs.search_index.health_personal_care',
                'HomeGarden'          => 'ecs.search_index.home_garden',
                'Industrial'          => 'ecs.search_index.industrial',
                'Jewelry'             => 'ecs.search_index.jewelry',
                'KindleStore'         => 'ecs.search_index.kindle_store',
                'Kitchen'             => 'ecs.search_index.kitchen',
                'LawnGarden'          => 'ecs.search_index.lawn_garden',
                'Magazines'           => 'ecs.search_index.magazines',
                'Marketplace'         => 'ecs.search_index.marketplace',
                'Merchants'           => 'ecs.search_index.mierchants',
                'Miscellaneous'       => 'ecs.search_index.miscellaneous',
                'MobileApps'          => 'ecs.search_index.mobile_apps',
                'MP3Downloads'        => 'ecs.search_index.mp3_downloads',
                'Music'               => 'ecs.search_index.music',
                'MusicalInstruments'  => 'ecs.search_index.musical_instruments',
                'MusicTracks'         => 'ecs.search_index.music_tracks',
                'OfficeProducts'      => 'ecs.search_index.office_products',
                'OutdoorLiving'       => 'ecs.search_index.outdoor_living',
                'PCHardware'          => 'ecs.search_index.pc_hardware',
                'PetSupplies'         => 'ecs.search_index.pet_supplies',
                'Photo'               => 'ecs.search_index.photo',
                'Shoes'               => 'ecs.search_index.shoes',
                'Software'            => 'ecs.search_index.software',
                'SportingGoods'       => 'ecs.search_index.sporting_goods',
                'Tools'               => 'ecs.search_index.tools',
                'Toys'                => 'ecs.search_index.toys',
                'UnboxVideo'          => 'ecs.search_index.unbox_video',
                'VHS'                 => 'ecs.search_index.vhs',
                'Video'               => 'ecs.search_index.video',
                'VideoGames'          => 'ecs.search_index.video_games',
                'Watches'             => 'ecs.search_index.watches',
                'Wireless'            => 'ecs.search_index.wireless',
                'WirelessAccessories' => 'ecs.search_index.wireless_accessories'
            )
        );
    
       return $data;
    }
}