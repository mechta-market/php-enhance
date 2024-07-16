<?php

use MechtaMarket\PhpEnhance\Collections\OutputErrorCollection;
use MechtaMarket\PhpEnhance\OutputError;
use Psr\Log\LoggerInterface;
use Tests\Base\TestInput;
use Tests\Base\TestUsecase;
use MechtaMarket\PhpEnhance\Base\BaseOutput;
use PHPUnit\Framework\TestCase;

class UsecaseTest extends TestCase
{
    private LoggerInterface $logger;

    public function setUp(): void
    {
        parent::setUp();
        $mock = $this->createMock(LoggerInterface::class);
        $this->logger = $mock;
    }

    public function testUsecase()
    {
        $input = new TestInput();
        $usecase = new TestUsecase($this->logger);
        $usecase->setInput($input);

        $usecase->execute();

        $response = $usecase->getOutput();

        $this->assertInstanceOf(BaseOutput::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUsecaseWithClientErrors()
    {
        $input = new TestInput();
        $usecase = new TestUsecase($this->logger);
        $usecase->setInput($input);

        $usecase->withClientErrors = true;
        $usecase->execute();

        $response = $usecase->getOutput();

        $this->assertInstanceOf(OutputErrorCollection::class, $response->getErrors());
        $this->assertInstanceOf(OutputError::class, $response->getErrors()[0]);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testUsecaseWithServerErrors()
    {
        $input = new TestInput();
        $usecase = new TestUsecase($this->logger);
        $usecase->setInput($input);

        $usecase->withServerErrors = true;
        $usecase->execute();

        $response = $usecase->getOutput();

        $this->assertInstanceOf(OutputErrorCollection::class, $response->getErrors());
        $this->assertInstanceOf(OutputError::class, $response->getErrors()[0]);
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testUsecaseWithLogs()
    {
        $input = new TestInput();
        $this->logger->expects($this->once())->method("error");

        $usecase = new TestUsecase($this->logger);
        $usecase->setInput($input);

        $usecase->withLogger = true;
        $usecase->execute();
    }
}
