<?php

namespace App\ResponseFactory;

use App\Entity\Car;
use App\Response\CarResponse;
use Doctrine\Common\Collections\Collection;

class CarResponseFactory
{
    public function fromEntityToCarResponse(Car $car): CarResponse
    {
        return (new CarResponse())->fillFromEntity($car);
    }

    /**
     * @param Car[] $collection
     * @return CarResponse[]|null
     */
    public function fromEntitiesToCarResponse(array $cars): array
    {
        return array_map(fn (Car $car) => (new CarResponse())->fillFromEntity($car), $cars);
    }
}
