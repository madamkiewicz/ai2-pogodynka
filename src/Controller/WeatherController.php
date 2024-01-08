<?php

namespace App\Controller;

use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country?}', name: 'app_weather')]
    public function city(string $city, ?string $country, LocationRepository $locationrepository, ForecastRepository $forecastRepository): Response
    {
        $locationVal =['city'=> $city];
        if($country){
            $locationVal['country'] = $country;
        }

        $location = $locationrepository->findOneBy($locationVal);

        if (!$location){
            throw $this->createNotFoundException('Nie odnaleziono wskazanego miasta');
        }

        $forecasts = $forecastRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'controller_name' => 'WeatherController',
            'location' => $location,
            'forecasts' => $forecasts,
        ]);
    }
}
