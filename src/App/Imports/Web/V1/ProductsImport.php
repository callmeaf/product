<?php

namespace Callmeaf\Product\App\Imports\Web\V1;

use Callmeaf\Base\App\Services\Importer;
use Callmeaf\Product\App\Enums\ProductStatus;
use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport extends Importer implements ToCollection,WithChunkReading,WithStartRow,SkipsEmptyRows,WithValidation,WithHeadingRow
{
    private ProductRepoInterface $productRepo;

    public function __construct()
    {
        $this->productRepo = app(ProductRepoInterface::class);
    }

    public function collection(Collection $collection)
    {
        $this->total = $collection->count();

        foreach ($collection as $row) {
            $this->productRepo->freshQuery()->create([
                // 'status' => $row['status'],
            ]);
            ++$this->success;
        }
    }

    public function chunkSize(): int
    {
        return \Base::config('import_chunk_size');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        $table = $this->productRepo->getTable();
        return [
            // 'status' => ['required',Rule::enum(ProductStatus::class)],
        ];
    }

}
