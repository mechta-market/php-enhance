## Пакет для работы с базовыми классами

### BaseUsecase
базовый класс для usecase, наследники которого, агрегируют сервисы, запускают процессы, вызывают бизнес логику

### BaseInput
базовый класс для получения данных из запроса и передаче в usecase

### BaseOutput
базовый класс для сбора данных по результатам работы с usecase

### Error
класс для хранения информации об ошибке или исключении

### OutputError
класс для хранения данных для http запросов

### Collection
базовый класс для работы с массивами, примеры в ErrorCollection.php, OutputErrorCollection.php

### Пример использования Usecase в контроллере
```php
public function index(Request $request)
{
    $input = new SomeInput($request->get('product_id'));

    $usecase = new SomeUsecase();
    $usecase->setInput($input);

    $usecase->execute();

    $response = $usecase->getOutput();

    if ($response->isFailed()) {
        abort($response->getStatusCode(), $response->getArrayResponse());
    }

    return $response->getArrayResponse();
}
```

### Пример работы usecase
```php
class SomeInput extends BaseInput
{
    public function __construct(private int $product_id){
    }

    public function getProductId(): int {
        return $this->product_id;
    }
}

class SomeUsecase extends BaseUsecase
{
    /**
     * @property SomeUsecaseData $data
     * @property SomeInput $input
     */
    public function execute(): void
    {
        try {
            $product_id = $this->input->getProductId();

            if ($product_id === 0) {
                throw new \Exception("Product id is zero");
            }

            $product = new Product(
                $product_id, "iPhone 15 Pro Max Ultra GigaByte",
                "iphone-15-super-puper", 999990
            );

            $this->data->setProduct($product);

        } catch (\Exception $ex) {
            $this->errors->addClientError($ex->getMessage(), 400);
        } catch (\Throwable $th) {
            $this->errors->addServerError($th->getMessage());
        }
    }

    protected function setData(): void
    {
        $this->data = new SomeUsecaseData();
    }
}

class SomeUsecaseData implements UsecaseDataInterface
{
    private Product $product;

    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    public function getData(): array
    {
        return [
            "id" => $this->product->getId(),
            "name" => $this->product->getName(),
            "code" => $this->product->getCode(),
            "price" => $this->product->getPrice(),
        ];
    }
}
```