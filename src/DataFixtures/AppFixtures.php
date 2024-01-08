<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Location;
use App\Entity\Forecast;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $szczecin = $this->addLocation(
            $manager, 
            city:'Szczecin', 
            country:'PL', 
            latitude:53.4289, 
            longitude:14.553
        );
        $this->addSzczecinForecasts($manager, $szczecin);

        $police = $this->addLocation(
            $manager, 
            city:'Police', 
            country:'PL', 
            latitude:53.5521, 
            longitude:14.5718
        );

        $manager->flush();
    }

    private function addLocation(ObjectManager $manager, $city, $country, $latitude, $longitude
    ): Location {
        $location = new Location();
        $location
            ->setCity($city)
            ->setCountry($country)
            ->setLatitude($latitude)
            ->setLongitude($longitude)
        ;

        $manager->persist($location);


        return $location;
    }

    private function addSzczecinForecasts(ObjectManager $manager, Location $szczecin): void
    {
        $forecast = new Forecast();
        $forecast 
        ->setDate(new \DateTime('2024-02-02'))
        ->setLocation($szczecin)
        ->setTemperature(10)
        ->setPressure(1009)
        ->setHumidity(49)
        ->setWindSpeed(7.7)
        ->setWindDirection('S')
        ->setCloudiness(0)
        ->setIcon('sun')
        ->setPrecipilation('brak opadow')
        ;
        $manager->persist($forecast);

        $forecast = new Forecast();
        $forecast 
        ->setDate(new \DateTime('2024-02-03'))
        ->setLocation($szczecin)
        ->setTemperature(9)
        ->setPressure(999)
        ->setHumidity(30)
        ->setWindSpeed(8.5)
        ->setWindDirection('SN')
        ->setCloudiness(0)
        ->setIcon('cloud')
        ->setPrecipilation('brak opadow')
        ;
        $manager->persist($forecast);
    }
}
