<?php

namespace App\Service;

use PSX\Http\Exception as StatusCode;
use App\Model\Collection;
use App\Model\Population as PopulationModel;
use App\Table\Population as TablePopulation;

class Population
{
    /**
     * @var \App\Table\Population
     */
    protected $populationTable;

    /**
     * @param \App\Table\Population $populationTable
     */
    public function __construct(TablePopulation $populationTable)
    {
        $this->populationTable = $populationTable;
    }

    /**
     * @param int $startIndex
     * @param int $count
     * @return \App\Model\Collection
     */
    public function getAll($startIndex = 0, $count = 16)
    {
        return new Collection(
            $this->populationTable->getCount(),
            $this->populationTable->getAll($startIndex, $count)
        );
    }

    /**
     * @param int $id
     * @return \PSX\Record\Record
     */
    public function get($id)
    {
        $population = $this->populationTable->get($id);

        if (empty($population)) {
            throw new StatusCode\NotFoundException('Internet population not found');
        }

        return $population;
    }

    /**
     * @param \App\Model\Population $model
     */
    public function create(PopulationModel $model)
    {
        $this->populationTable->create([
            'place'      => $model->getPlace(),
            'region'     => $model->getRegion(),
            'population' => $model->getPopulation(),
            'users'      => $model->getUsers(),
            'worldUsers' => $model->getWorldUsers(),
            'datetime'   => new \DateTime(),
        ]);
    }

    /**
     * @param int $id
     * @param \App\Model\Population $model
     */
    public function update($id, PopulationModel $model)
    {
        $population = $this->get($id);

        if (empty($population)) {
            throw new StatusCode\NotFoundException('Internet population not found');
        }

        $this->populationTable->update([
            'id'         => $population['id'],
            'place'      => $model->getPlace(),
            'region'     => $model->getRegion(),
            'population' => $model->getPopulation(),
            'users'      => $model->getUsers(),
            'worldUsers' => $model->getWorldUsers(),
        ]);
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $population = $this->get($id);

        if (empty($population)) {
            throw new StatusCode\NotFoundException('Internet population not found');
        }

        $this->populationTable->delete([
            'id' => $population['id']
        ]);
    }
}
