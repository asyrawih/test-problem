<?php


namespace Repostory\Income;

use App\Models\Income;
use Repostory\Contaract\IncomeContract;

/**
 * @method get
 * @method show
 * @method store
 * @method delete
 */
class RepoIncome implements IncomeContract
{
    /**
     * Get All Data
     * 
     */
    public function all()
    {
        return Income::with('customer')
            ->get();
    }
    /**
     * Show One data
     * @param int $id
     */
    public function show(int $id)
    {
        return Income::findOrFail($id);
    }
    /**
     * Updating data
     * @param int $id
     */
    public function update(int $id, array $income)
    {
        Income::where('id', $id)->update([
            "nama_barang" => $income['nama_barang'],
            "harga_barang" => $income['harga_barang'],
            "qty"      => $income['qty'],
            "total" => $income['total'],
        ]);
    }
    /**
     * Storing the Data
     * @param array $income
     */
    public function store(array $income)
    {
        Income::create([
            "nama_barang" => $income['nama_barang'],
            "harga_barang" => $income['harga_barang'],
            "images"       => $income['images'],
            "qty" => $income['qty'],
            "total" => $income['total'],
        ]);
    }

    /**
     * Delete Data
     * @param int $id
     */
    public function delete(int $id)
    {
        Income::destroy($id);
    }
}
