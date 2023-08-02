<?php

namespace Tests\Unit\Facade;

use App\DTO\CarDTO;
use App\Entity\Car;
use App\EntityFactory\CarFactory;
use App\Facade\CarFacade;
use App\Repository\CarRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

/**
 * Class CarFacadeTest.
 *
 * @covers \App\Facade\CarFacade
 */
final class CarFacadeTest extends TestCase
{
    private CarFacade $carFacade;

    private EntityManagerInterface|Mock $entityManager;

    private CarFactory|Mock $carFactory;

    private CarRepository|Mock $carRepository;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->entityManager = Mockery::mock(EntityManagerInterface::class);
        $this->carFactory = Mockery::mock(CarFactory::class);
        $this->carRepository = Mockery::mock(CarRepository::class);
        $this->carFacade = new CarFacade($this->entityManager, $this->carFactory, $this->carRepository);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->carFacade);
        unset($this->entityManager);
        unset($this->carFactory);
        unset($this->carRepository);
    }

    public function testSave(): void
    {
        $carDto = new CarDTO();
        $carDto->make = 'make';
        $carDto->build_at = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "2021-08-02 13:37:55");
        $carDto->model = 'model';

        $this->carFactory->expects('dtoToEntity')->andReturn(new Car());
        $this->entityManager->expects('persist');
        $this->entityManager->expects('flush');

        $car = $this->carFacade->save($carDto);

        assertTrue($car instanceof Car);

    }

    public function testRemove(): void
    {
        $this->carRepository->expects('find')->andReturn(new Car());
        $this->entityManager->expects('remove');
        $this->entityManager->expects('flush');
        $this->carFacade->remove(1);

        assertTrue(true);

    }
}
