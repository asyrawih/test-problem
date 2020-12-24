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
        return Income::all();
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
        return Income::find($id)->update($income);
    }
    /**
     * Storing the Data
     * @param array $income
     */
    public function store(array $income)
    {
        $income = new Income();
        $income->nama_barang = $income['nama_barang'];
        $income->qty = $income['qty'];
        $income->images = $income['images'];
        $income->total = $income['total'];
        $income->save();
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
