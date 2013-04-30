<?php

namespace UAM\Bundle\AwsEcsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemSearchType extends AbstractType
{
    protected $stores;

    public function __construct(array $stores)
    {
        $this->setStores($stores);
    }

    public function getStores()
    {
        return $this->stores;
    }

    public function setStores(array $stores)
    {
        $this->stores = $stores;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'name'       => 'uam_aws_ecs_itemsearch',
            'translation_domain' => 'ecs',
            'show_legend' => false
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('store', 'choice', array(
            'choices' => $this->getStoreChoices()
        ));

        $builder->add('search_index', 'choice', array(
            'choices' => $this->getSearchIndexOptions()
        ));

        $builder->add('keywords');

    }

    public function getName()
    {
        return 'uam_aws_ecs_itemsearch';
    }

    protected function getStoreChoices()
    {    
        $choices = array();

        foreach ($this->getStores() as $name => $store) {
            $choices[$name] = $name;
        }

        return $choices;
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

        $choices = array();

        if (count($this->getStores()) == 1) {
            $choices = $data[array_values($this->getStores())[0]['region']];
            asort($choices);
        }

        return $choices;
    }
}