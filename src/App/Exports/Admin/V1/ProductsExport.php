<?php

namespace Callmeaf\Product\App\Exports\Admin\V1;

use Callmeaf\Product\App\Models\Product;
use Callmeaf\Product\App\Repo\Contracts\ProductRepoInterface;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class ProductsExport implements FromCollection,WithHeadings,Responsable,WithMapping,WithCustomChunkSize
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    private ProductRepoInterface $productRepo;
    public function __construct()
    {
        $this->productRepo = app(ProductRepoInterface::class);
        $this->fileName = $this->fileName ?: \Base::exportFileName(model: $this->productRepo->getModel()::class,extension: $this->writerType);
    }

    public function collection()
    {
        if(\Base::getTrashedData()) {
            $this->productRepo->trashed();
        }

        $this->productRepo->latest()->search();

        if(\Base::getAllPagesData()) {
            return $this->productRepo->lazy();
        }

        return $this->productRepo->paginate();
    }

    public function headings(): array
    {
        return [
           // 'status',
        ];
    }

    /**
     * @param Product $row
     * @return array
     */
    public function map($row): array
    {
        return [
            // $row->status?->value,
        ];
    }

    public function chunkSize(): int
    {
        return \Base::config('export_chunk_size');
    }
}
