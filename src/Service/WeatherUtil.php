<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Forecast;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;

class WeatherUtil
{
    private $forecastRepository;
    private $locationRepository;

    public function __construct(
        ForecastRepository $forecastRepository,
        LocationRepository $locationRepository
    )
    {
        $this->forecastRepository = $forecastRepository;
        $this->locationRepository = $locationRepository;
    }
    /**
     * @return Forecast[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        $forecast = $this->forecastRepository->findByLocation($location);
        return $forecast;
    }

    /**
     * @return Forecast[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryCode,
            'city' => $city,
        ]);

        $forecast = $this->getWeatherForLocation($location);

        return $forecast;
    }
}
