<?php
/**
 * Namespace App\Repositories
 *
 * @category RepositoryInterface
 * @package  App\Repositories
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
namespace App\Repositories;
/**
 * Namespace RepositoryInterfaceClass
 *
 * @category RepositoryInterface
 * @package  App\Repositories
 * @author   ranghivanguy <ranghivanhuy@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     https://github.com/appleluong1905/nta_intern102020_backend
 */
interface RepositoryInterface
{
    /**
     * Get all
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     *
     * @param int $id id_model
     *
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     *
     * @param array $attributes attribute
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     *
     * @param int   $id         id_model
     * @param array $attributes array_attribute
     *
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     *
     * @param int $id id_model
     *
     * @return mixed
     */
    public function delete($id);

}
