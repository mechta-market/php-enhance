<?php

use MechtaMarket\PhpEnhance\Collections\OutputErrorCollection;
use MechtaMarket\PhpEnhance\OutputError;
use Tests\Base\TestInput;
use Tests\Base\TestUsecase;
use MechtaMarket\PhpEnhance\Base\BaseOutput;
use PHPUnit\Framework\TestCase;

class UsecaseTest extends TestCase
{
    public function testUsecase()
    {
        $input = new TestInput();
        $usecase = new TestUsecase();
        $usecase->setInput($input);

        $usecase->execute();

        $response = $usecase->getOutput();

        $this->assertInstanceOf(BaseOutput::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUsecaseWithErrors()
    {
        $input = new TestInput();
        $usecase = new TestUsecase();
        $usecase->setInput($input);

        $usecase->withErrors = true;
        $usecase->execute();

        $response = $usecase->getOutput();

        $this->assertInstanceOf(OutputErrorCollection::class, $response->getErrors());
        $this->assertInstanceOf(OutputError::class, $response->getErrors()[0]);
        $this->assertEquals(400, $response->getStatusCode());
    }
}
