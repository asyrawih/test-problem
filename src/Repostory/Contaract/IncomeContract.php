<?php


namespace Repostory\Contaract;


interface IncomeContract
{
    /**
     * Get All Data
     * 
     */
    public function all();
    /**
     * Show One data
     * @param int $id
     */
    public function show(int $id);
    /**
     * Updating data
     * @param int $id
     */
    public function update(int $id, array $income);
    /**
     * Storing the Data
     * @param array $income
     */
    public function store(array $income);
    /**
     * Delete Data
     * @param int $id
     */
    public function delete(int $id);
}
